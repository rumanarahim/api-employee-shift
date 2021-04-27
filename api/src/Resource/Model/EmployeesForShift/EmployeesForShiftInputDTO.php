<?php
// api/src/Entity/Book.php

namespace App\Resource\Model\EmployeesForShift;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Entity\Employee;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class EmployeesForShiftInputDTO
 * @package App\Resource\Model\EmployeesForShift
 */
class EmployeesForShiftInputDTO
{
    /**
     * @var string
     * @Assert\NotBlank
     */
    private string $role;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private string $area;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private string $startDateTime;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private string $shiftLength;

    /**
     * @var string
     */
    private string $bestMatchLimit;

    /**
     * @var string
     */
    private string $otherStaffLimit;

    /**
     * @param string $role
     * @return EmployeesForShiftInputDTO
     */
    public function setRole(string $role): EmployeesForShiftInputDTO
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @param string $area
     * @return EmployeesForShiftInputDTO
     */
    public function setArea(string $area): EmployeesForShiftInputDTO
    {
        $this->area = $area;
        return $this;
    }

    /**
     * @param string $startDateTime
     * @return EmployeesForShiftInputDTO
     */
    public function setStartDateTime(string $startDateTime): EmployeesForShiftInputDTO
    {
        $this->startDateTime = $startDateTime;
        return $this;
    }

    /**
     * @param string $shiftLength
     * @return EmployeesForShiftInputDTO
     */
    public function setShiftLength(string $shiftLength): EmployeesForShiftInputDTO
    {
        $this->shiftLength = $shiftLength;
        return $this;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return string
     */
    public function getArea(): string
    {
        return $this->area;
    }

    /**
     * @return string
     */
    public function getStartDateTime(): string
    {
        return $this->startDateTime;
    }

    /**
     * @return string
     */
    public function getShiftLength(): string
    {
        return $this->shiftLength;
    }

    /**
     * @return string
     */
    public function getBestMatchLimit(): string
    {
        return $this->bestMatchLimit;
    }

    /**
     * @param string $bestMatchLimit
     * @return EmployeesForShiftInputDTO
     */
    public function setBestMatchLimit(string $bestMatchLimit): EmployeesForShiftInputDTO
    {
        $this->bestMatchLimit = $bestMatchLimit;
        return $this;
    }

    /**
     * @return string
     */
    public function getOtherStaffLimit(): string
    {
        return $this->otherStaffLimit;
    }

    /**
     * @param string $otherStaffLimit
     * @return EmployeesForShiftInputDTO
     */
    public function setOtherStaffLimit(string $otherStaffLimit): EmployeesForShiftInputDTO
    {
        $this->otherStaffLimit = $otherStaffLimit;
        return $this;
    }

}
