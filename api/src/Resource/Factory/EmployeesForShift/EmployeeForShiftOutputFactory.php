<?php

namespace App\Resource\Factory\EmployeesForShift;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\Employee;
use App\Resource\Model\EmployeesForShift\EmployeeForShiftOutputDTO;
use App\Resource\Model\EmployeesForShift\EmployeesForShiftOutputDTO;
use App\Resource\Model\EmployeesForShift\EmployeesForShiftRequestObject;
use App\Resource\Model\EmployeesForShift\EmployeeForShiftResponseObject;

class EmployeeForShiftOutputFactory
{
    /**
     * @return EmployeeForShiftOutputDTO
     */
    public static function create()
    {
        return new EmployeeForShiftOutputDTO();
    }

    /**
     * @param EmployeeForShiftResponseObject $responseObject
     * @return EmployeeForShiftOutputDTO
     */
    public static function createFromResponseObject(EmployeeForShiftResponseObject $responseObject)
    {
        $output = self::create();

        $employee = $responseObject->getEmployee();


        $output->setId($employee->getId())
            ->setTitle($employee->getTitle())
            ->setFirstName($employee->getFirstName())
            ->setLastName($employee->getLastName())
            ->setRole($employee->getRole()->getTitle())
            ->setCity($employee->getCity())
            ->setRating($responseObject->getScore())
            ->setWeeklyHoursAllowance($employee->getWeeklyHoursAllowance())
            ->setWeeklyHoursRostered($employee->getWeeklyHoursRostered());

        return $output;

    }

}
