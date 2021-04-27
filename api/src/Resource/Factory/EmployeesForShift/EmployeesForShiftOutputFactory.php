<?php

namespace App\Resource\Factory\EmployeesForShift;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Resource\Model\EmployeesForShift\EmployeesForShiftOutputDTO;
use App\Resource\Model\EmployeesForShift\EmployeesForShiftRequestObject;
use App\Resource\Model\EmployeesForShift\EmployeesForShiftResponseObject;
use Doctrine\Common\Collections\ArrayCollection;

class EmployeesForShiftOutputFactory
{

    /**
     * @return mixed
     */
    public static function create()
    {
        return new EmployeesForShiftOutputDTO();
    }


    public function createFromResponseObject(EmployeesForShiftResponseObject $responseObject)
    {
        $output = self::create();
        // TODO: Needs to be refactored
        $bestMatches = $responseObject->getBestMatches();
        $bestMatchDTO = [];
        foreach ($bestMatches as $bestMatch) {
            $employee = EmployeeForShiftOutputFactory::createFromResponseObject($bestMatch);
            $bestMatchDTO[] = $employee;
        }
        $output->setBestMatch($bestMatchDTO);

        $otherEmployees = $responseObject->getOtherStaff();
        $otherStaffDTO = [];
        foreach ($otherEmployees as $otherEmployee) {
            $employeeOther = EmployeeForShiftOutputFactory::createFromResponseObject($otherEmployee);
            $otherStaffDTO[] = $employeeOther;
        }
        $output->setOtherStaff($otherStaffDTO);

        return $output;
    }


}
