<?php
// api/src/Entity/Book.php

namespace App\Resource\Factory\EmployeesForShift;


use App\Repository\EmployeeRepository;
use App\Resource\Model\EmployeesForShift\EmployeeForShiftResponseObject;


/** A book.
 *
 */
class EmployeeForShiftResponseObjectFactory
{
    public EmployeeRepository $repoEmployee;

    /**
     * EmployeeForShiftResponseObjectFactory constructor.
     * @param EmployeeRepository $repoEmployee
     */
    public function __construct(EmployeeRepository $repoEmployee)
    {
        $this->repoEmployee = $repoEmployee;
    }
    /**
     * @return EmployeeForShiftResponseObject
     */
    public static function create()
    {
        return new EmployeeForShiftResponseObject();
    }

    /**
     * @param int $employeeId
     * @param int $score
     * @return EmployeeForShiftResponseObject
     */
    public function createFromEmployeeScore(int $employeeId, int $score)
    {
        $responseObject = self::create();
        $employee = $this->repoEmployee->find($employeeId);
        $responseObject->setEmployee($employee);
        $responseObject->setScore($score);

        return $responseObject;
    }

}
