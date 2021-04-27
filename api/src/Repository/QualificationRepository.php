<?php

namespace App\Repository;

use App\Entity\Employee;
use App\Entity\Qualification;
use App\Entity\Role;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class QualificationRepository
 * @package App\Repository
 *
 * @method Qualification|null find(int $id)
 */

class QualificationRepository extends ServiceEntityRepository
{

    /**
     * RoleRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Qualification::class);
    }

    /**
     * @param Role $role
     * @return int|mixed[]|string
     */
    public function findLegallyRequiredQualForRole(Role $role)
    {
        $queryBuilder = $this->createQueryBuilder('m')
            ->select('m.id')
            ->join('m.roleQualifications', 'rq')
            ->andWhere('rq.role = :role')
            ->setParameter('role', $role)
            ->andWhere('rq.legalRequirement = :true')
            ->setParameter('true', true);

        return $queryBuilder->getQuery()->getArrayResult();
    }

    /**
     * @param Role $role
     * @param Employee $employee
     * @return int|mixed|string
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findCountOfQual(Role $role, Employee $employee)
    {
        $queryBuilder = $this->createQueryBuilder('m')
            ->select('COUNT(m.id) as qualCount')
            ->join('m.roleQualifications', 'rq')
            ->andWhere('rq.role = :role')
            ->setParameter('role', $role)
            ->join('m.employeeQualifications', 'eq')
            ->andWhere('eq.employee = :employee')
            ->setParameter('employee', $employee)
            ->groupBy('m.id');

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}
