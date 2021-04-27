<?php

namespace App\Repository;

use App\Constants\Leave;
use App\Entity\Area;
use App\Entity\Employee;
use App\Entity\Role;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class EmployeeRepository
 * @package App\Repository
 *
 * @method Employee|null find(int $id)
 */

class EmployeeRepository extends ServiceEntityRepository
{

    private QualificationRepository $repoQualification;

    private RoleRepository $repoRole;


    /**
     * EmployeeRepository constructor.
     * @param ManagerRegistry $registry
     * @param QualificationRepository $repoQualification
     */
    public function __construct(
        ManagerRegistry $registry,
        QualificationRepository $repoQualification,
        RoleRepository $repoRole
    )
    {
        parent::__construct($registry, Employee::class);
        $this->repoQualification = $repoQualification;
        $this->repoRole = $repoRole;
    }

    /**
     * @param Area $area
     * @param Role $role
     * @param \DateTime $shiftStartDateTime
     * @param \DateTime $shiftEndDateTime
     * @return int|mixed|string
     */
    public function findAllMatches(Area $area, Role $role, \DateTime $shiftStartDateTime, \DateTime $shiftEndDateTime)
    {
        $queryBuilder = $this->findEmployeesInAreaRoleQB($area, $role)
            ->select('m as employee, (m.weeklyHoursAllowance - m.weeklyHoursRostered) as rosterScore, employeeRoles.proficiencyRating as profScore')
            // Role is directly assigned to employee
            ->andWhere('m.role = :empRole')
            ->setParameter('empRole', $role)
            ->leftJoin('m.employeeRoles', 'employeeRoles')
            ->andWhere('employeeRoles.roles = :empRole1' )
            ->setParameter('empRole1', $role);

        // Hard Constraints - Cannot be on leave, have a shift at the time or not meet legal requirements
        $queryBuilder = $this->filterOnLeave($queryBuilder, $shiftStartDateTime);
        $queryBuilder = $this->filterOnAssigned($queryBuilder, $shiftStartDateTime, $shiftEndDateTime);
        $queryBuilder = $this->filterOnLegalRequirements($queryBuilder, $role);

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param Area $area
     * @param Role $role
     * @param \DateTime $shiftStartDateTime
     * @param \DateTime $shiftEndDateTime
     * @return int|mixed|string
     */
    public function findOtherEmployees(Area $area, Role $role, \DateTime $shiftStartDateTime, \DateTime $shiftEndDateTime)
    {
        $queryBuilder = $this->findEmployeesInAreaRoleQB($area, $role)
            ->select('m as employee, (m.weeklyHoursAllowance - m.weeklyHoursRostered) as rosterScore');

        $queryBuilder = $this->filterOnRelatedRoles($queryBuilder, $role);

        // Hard Constraints - Cannot be on leave, have a shift at the time or not meet legal requirements
        $queryBuilder = $this->filterOnLeave($queryBuilder, $shiftStartDateTime);
        $queryBuilder = $this->filterOnAssigned($queryBuilder, $shiftStartDateTime, $shiftEndDateTime);
        $queryBuilder = $this->filterOnLegalRequirements($queryBuilder, $role);


        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param \DateTime $shiftDateTime
     * @return int|mixed[]|string
     */
    private function findEmployeesOnLeave(\DateTime $shiftDateTime)
    {
        $queryBuilder = $this->createQueryBuilder('m')
            ->select('m.id')
            ->join('m.leave', 'leave')
            ->andWhere('leave.status = :status')
            ->setParameter('status', Leave::APPROVED)
            ->andWhere(':shiftDate BETWEEN leave.startDate AND leave.endDate')
            ->setParameter('shiftDate', $shiftDateTime);


        return $queryBuilder->getQuery()->getArrayResult();
    }

    /**
     * @param \DateTime $shiftStartDateTime
     * @param \DateTime $shiftEndDateTime
     * @return int|mixed[]|string
     */
    private function findEmployeesAlreadyAssigned(\DateTime $shiftStartDateTime, \DateTime $shiftEndDateTime)
    {

        $queryBuilder = $this->createQueryBuilder('m')
            ->select('m.id')
            ->join('m.shifts', 'shift')
            // Overlap formula: StartA < EndB && EndA > StartB
            ->andWhere('shift.startDateTime < :shiftEnd AND shift.endDateTime > :shiftStart')
            ->setParameter('shiftStart', $shiftStartDateTime)
            ->setParameter('shiftEnd', $shiftEndDateTime);

        return $queryBuilder->getQuery()->getArrayResult();

    }

    /**
     * @param Area $area
     * @param Role $role
     * @return QueryBuilder
     */
    private function findEmployeesInAreaRoleQB(Area $area, Role $role)
    {
        return $this->createQueryBuilder('m')
            ->join('m.areas', 'areas')
            ->join('areas.roles', 'roles')
            // Match Employee's Area
            ->andWhere('areas = :areas')
            ->setParameter('areas', $area)
            // Match a role in that area
            ->andWhere('roles = :roles')
            ->setParameter('roles', $role);
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param \DateTime $shiftStartDateTime
     * @return QueryBuilder
     */
    private function filterOnLeave(QueryBuilder $queryBuilder, \DateTime $shiftStartDateTime)
    {
        $employeesOnLeave = $this->findEmployeesOnLeave($shiftStartDateTime);

        // Exclude employees on leave
        if (count($employeesOnLeave) > 0) {
            $queryBuilder->andWhere('m.id NOT IN (:ids)')
                ->setParameter('ids', $employeesOnLeave);
        }
        return $queryBuilder;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param \DateTime $shiftStartDateTime
     * @param \DateTime $shiftEndDateTime
     * @return QueryBuilder
     */
    private function filterOnAssigned(QueryBuilder $queryBuilder, \DateTime $shiftStartDateTime, \DateTime $shiftEndDateTime)
    {
        $employessAssigned = $this->findEmployeesAlreadyAssigned($shiftStartDateTime, $shiftEndDateTime);

        // Exclude employees on leave
        if (count($employessAssigned) > 0) {
            $queryBuilder->andWhere('m.id NOT IN (:ids)')
                ->setParameter('ids', $employessAssigned);
        }

        return $queryBuilder;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param Role $role
     * @return QueryBuilder
     */
    private function filterOnLegalRequirements(QueryBuilder $queryBuilder, Role $role)
    {
        $legalQuals = $this->repoQualification->findLegallyRequiredQualForRole($role);

        if (count($legalQuals) > 0) {
            $queryBuilder->leftJoin('m.employeeQualifications', 'empQual')
                ->andWhere('empQual.qualification IN (:qualIds)')
                ->setParameter('qualIds', $legalQuals);
        }

        return $queryBuilder;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param Role $role
     * @return QueryBuilder
     */
    private function filterOnRelatedRoles(QueryBuilder $queryBuilder, Role $role)
    {
        $relatedRoles = $this->repoRole->findRelatedRoles($role);

            $queryBuilder
                ->andWhere('m.role IN (:relatedRoles)')
                ->setParameter('relatedRoles', $relatedRoles);


        return $queryBuilder;
    }





}
