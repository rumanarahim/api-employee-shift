<?php
// api/src/Entity/Book.php

namespace App\Resource\Factory\EmployeesForShift;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Entity\Employee;
use App\Entity\Role;
use App\Repository\EmployeeRepository;
use App\Repository\QualificationRepository;
use App\Resource\Model\EmployeesForShift\EmployeeForShiftResponseObject;
use App\Resource\Model\EmployeesForShift\EmployeesForShiftInputDTO;
use App\Resource\Model\EmployeesForShift\EmployeesForShiftRequestObject;
use App\Resource\Model\EmployeesForShift\EmployeesForShiftResponseObject;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/** A book.
 *
 */
class EmployeesForShiftResponseObjectFactory
{
    /**
     * @var EmployeeRepository $repoEmployee
     */
    private $repoEmployee;

    /**
     * @var QualificationRepository $repoQualification
     */
    private $repoQualification;

    /**
     * @var EmployeeForShiftResponseObjectFactory
     */
    private $factoryEmployeeResponseObject;

    /**
     * EmployeesForShiftResponseObjectFactory constructor.
     * @param EmployeeRepository $repoEmployee
     * @param QualificationRepository $repoQualification
     * @param EmployeeForShiftResponseObjectFactory $factoryEmployeeResponseObject
     */
    public function __construct(
        EmployeeRepository $repoEmployee,
        QualificationRepository $repoQualification,
        EmployeeForShiftResponseObjectFactory $factoryEmployeeResponseObject
    ){
        $this->repoEmployee = $repoEmployee;
        $this->repoQualification = $repoQualification;
        $this->factoryEmployeeResponseObject = $factoryEmployeeResponseObject;
    }


    /**
     * @return EmployeesForShiftResponseObject
     */
    public static function create()
    {
        return new EmployeesForShiftResponseObject();
    }

    /**
     * @param EmployeesForShiftRequestObject $requestObject
     * @return EmployeesForShiftResponseObject
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function createFromRequestObject(EmployeesForShiftRequestObject $requestObject)
    {
        $responseObject = self::create();

        // TODO: Needs to be refactored
        // Best Matches
        $endDateTime = clone $requestObject->getStartDateTime();
        $shiftLength = $requestObject->getShiftLength();
        $interval = \DateInterval::createFromDateString('+ '.$shiftLength.' minutes');
        $endDateTime->add($interval);

        $allEmployeeMatches= $this->repoEmployee->findAllMatches(
            $requestObject->getArea(),
            $requestObject->getRole(),
            $requestObject->getStartDateTime(),
            $endDateTime
        );

        $topMatches = $this->getTopBestMatches($allEmployeeMatches, $requestObject->getRole(), $requestObject->getBestMatchesLimit());

        if (count($topMatches) > 0) {
            $highestScore = $topMatches[array_key_first($topMatches)];

            $allBestMatches = [];
            foreach ($topMatches as $employeeId => $score) {
                if ($score < 0 || $highestScore < 0) {
                    $finalScore = 0;
                } else {
                    $finalScore = round(($score / $highestScore) * \App\Constants\Employee::MAX_RATING);
                }
                if ($finalScore < 0) {
                    $finalScore = 0;
                }
                $empResponseObject = $this->factoryEmployeeResponseObject->createFromEmployeeScore($employeeId, $finalScore);
                $allBestMatches[] = $empResponseObject;
            }

            $responseObject->setBestMatches($allBestMatches);
        }

        $allOtherEmployees = $this->repoEmployee->findOtherEmployees(
            $requestObject->getArea(),
            $requestObject->getRole(),
            $requestObject->getStartDateTime(),
            $endDateTime
        );

        $topOther = $this->getTopOtherEmployees($allOtherEmployees, $requestObject->getRole(), $requestObject->getOtherStaffLimit());

        if (count($topOther) > 0) {
            $highestScoreOther = $topOther[array_key_first($topOther)];


            $allOtherMatches = [];
            foreach ($topOther as $employeeId => $score) {
                if ($score < 0 || $highestScoreOther < 0) {
                    $finalScore = 0;
                } else {
                    $finalScore = round(($score / $highestScoreOther) * \App\Constants\Employee::MAX_RATING);
                }

                $empResponseObject = $this->factoryEmployeeResponseObject->createFromEmployeeScore($employeeId, $finalScore);
                $allOtherMatches[] = $empResponseObject;
            }

            $responseObject->setOtherStaff($allOtherMatches);
        }

        return $responseObject;
    }


    /**
     * @param iterable $allEmployeeMatches
     * @param Role $role
     * @param int $limit
     * @return array
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    private function getTopBestMatches(iterable $allEmployeeMatches, Role $role, int $limit)
    {
        $scores = [];

        foreach($allEmployeeMatches as $employeeMatch) {
            $employee = $employeeMatch['employee'];
            $rosterScore = 0;
            $proficiencyScore = 0;
            $qualScore = 0;

            if (array_key_exists('rosterScore', $employeeMatch)) {
                $rosterScore = $employeeMatch['rosterScore'] * \App\Constants\Employee::ROSTER_WEIGHT;
            }
            if (array_key_exists('profScore', $employeeMatch)) {
                $proficiencyScore = $employeeMatch['profScore'] * \App\Constants\Employee::PROFICIENCY_WEIGHT;
            }

            $qualCount = $this->repoQualification->findCountOfQual($role, $employee);
            if ($qualCount !== null) {
                $qualScore = $qualCount['qualCount'] * \App\Constants\Employee::QUALIFICATION_WEIGHT;
            }
            $scores[$employee->getId()] = $rosterScore + $proficiencyScore + $qualScore;
        }

        arsort($scores);
        if ($limit < count($scores)) {
            $scores = array_slice( $scores,0, $limit, true);
        }

        return $scores;

    }

    /**
     * @param iterable $allEmployeeMatches
     * @param Role $role
     * @param int $limit
     * @return array
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    private function getTopOtherEmployees(iterable $allOtherEmployees, Role $role, int $limit)
    {
        $scores = [];

        foreach($allOtherEmployees as $employeeMatch) {
            $employee = $employeeMatch['employee'];
            $rosterScore = 0;
            $qualScore = 0;
            if (array_key_exists('rosterScore', $employeeMatch)) {
                $rosterScore = $employeeMatch['rosterScore'] * \App\Constants\Employee::ROSTER_WEIGHT;
            }

            $qualCount = $this->repoQualification->findCountOfQual($role, $employee);
            if ($qualCount !== null) {
                $qualScore = $qualCount['qualCount'] * \App\Constants\Employee::QUALIFICATION_WEIGHT;
            }
            $scores[$employee->getId()] = $rosterScore + $qualScore;
        }

        arsort($scores);
        if ($limit < count($scores)) {
            $scores = array_slice( $scores,0, $limit, true);
        }

        return $scores;

    }
}
