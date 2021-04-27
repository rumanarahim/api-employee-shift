<?php
// api/src/Entity/Book.php

namespace App\Resource\Model\EmployeesForShift;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Entity\Employee;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** A book.
 *
 */
class EmployeesForShiftResponseObject
{
    /**
     * @var EmployeeForShiftResponseObject[]
     */
    private iterable $bestMatches;

    /**
     * @var EmployeeForShiftResponseObject[]
     */
    private iterable $otherStaff;

    /**
     * EmployeesForShiftResponseObject constructor.
     */
    public function __construct()
    {
        $this->bestMatches = new ArrayCollection();
        $this->otherStaff = new ArrayCollection();
    }

    /**
     * @return EmployeeForShiftResponseObject[]
     */
    public function getBestMatches(): iterable
    {
        return $this->bestMatches;
    }

    /**
     * @param EmployeeForShiftResponseObject[] $bestMatches
     * @return EmployeesForShiftResponseObject
     */
    public function setBestMatches(iterable $bestMatches): EmployeesForShiftResponseObject
    {
        $this->bestMatches = $bestMatches;
        return $this;
    }

    /**
     * @return EmployeeForShiftResponseObject[]
     */
    public function getOtherStaff(): iterable
    {
        return $this->otherStaff;
    }

    /**
     * @param EmployeeForShiftResponseObject[] $otherStaff
     * @return EmployeesForShiftResponseObject
     */
    public function setOtherStaff(iterable $otherStaff): EmployeesForShiftResponseObject
    {
        $this->otherStaff = $otherStaff;
        return $this;
    }



}
