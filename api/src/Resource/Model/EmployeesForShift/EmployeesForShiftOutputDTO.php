<?php
// api/src/Entity/Book.php

namespace App\Resource\Model\EmployeesForShift;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

//input=EmployeesForShiftInputDTO::class,
// *      output=EmployeesForShiftOutputDTO::class,


/** A book.
 *
 *    @ApiResource(
 *     itemOperations={},
 *      collectionOperations = {
 *        "employeesforshift" = { "route_name"="get_employees_for_shift" }
 *       }
 * )
 *
 */
final class EmployeesForShiftOutputDTO
{
    /**
     * @var EmployeeForShiftOutputDTO[]
     */
    public iterable $bestMatch;

    /**
     * @var EmployeeForShiftOutputDTO[]
     */
    public iterable $otherStaff;

    /**
     * EmployeesForShiftOutputDTO constructor.
     */
    public function __construct()
    {
        $this->bestMatch = new ArrayCollection();
        $this->otherStaff = new ArrayCollection();
    }

    /**
     * @return EmployeeForShiftOutputDTO[]
     */
    public function getBestMatch(): iterable
    {
        return $this->bestMatch;
    }

    /**
     * @param EmployeeForShiftOutputDTO[] $bestMatch
     * @return EmployeesForShiftOutputDTO
     */
    public function setBestMatch(iterable $bestMatch): EmployeesForShiftOutputDTO
    {
        $this->bestMatch = $bestMatch;
        return $this;
    }

    /**
     * @param EmployeeForShiftOutputDTO $bestMatch
     * @return $this
     */
    public function addBestMatch(EmployeeForShiftOutputDTO $bestMatch): EmployeesForShiftOutputDTO
    {
        $this->bestMatch->add($bestMatch);
        return $this;
    }

    /**
     * @return EmployeeForShiftOutputDTO[]
     */
    public function getOtherStaff(): iterable
    {
        return $this->otherStaff;
    }

    /**
     * @param EmployeeForShiftOutputDTO[] $otherStaff
     * @return EmployeesForShiftOutputDTO
     */
    public function setOtherStaff(iterable $otherStaff): EmployeesForShiftOutputDTO
    {
        $this->otherStaff = $otherStaff;
        return $this;
    }


}
