<?php
// api/src/Entity/Book.php

namespace App\Resource\Factory\EmployeesForShift;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Entity\Employee;
use App\Resource\Model\EmployeesForShift\EmployeesForShiftInputDTO;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpKernel\Exception\HttpException;

/** A book.
 *
 */
class EmployeesForShiftInputDTOFactory
{
    /**
     * @return EmployeesForShiftInputDTO
     */
    public static function create()
    {
        return new EmployeesForShiftInputDTO();
    }

    /**
     * @param Request $request
     * @return EmployeesForShiftInputDTO
     */
    public static function createFromRequestQueryParams(Request $request)
    {
        $roleId = $request->get('role');
        $areaId = $request->get('area');
        $startDateTime = $request->get('start_datetime');
        $shiftLength = $request->get('shift_length');
        $bestMatchesLimit = $request->get('best_matches_limit');
        $otherStaffLimit = $request->get('other_staff_limit');

        if ($roleId === '' || $areaId === '' || $startDateTime === '' || $shiftLength === '' || $bestMatchesLimit === '' || $otherStaffLimit === '' ) {
            throw new HttpException(400, 'Bad Request - Your request is missing parameters.');
        }

        $inputDTO = self::create();

        $inputDTO->setArea($areaId)
            ->setRole($roleId)
            ->setShiftLength($shiftLength)
            ->setStartDateTime($startDateTime)
            ->setBestMatchLimit($bestMatchesLimit)
            ->setOtherStaffLimit($otherStaffLimit);

        return $inputDTO;


    }
}
