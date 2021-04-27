<?php
// api/src/Entity/Book.php

namespace App\Resource\Model\EmployeesForShift;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Entity\Area;
use App\Entity\Employee;
use App\Entity\Role;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class EmployeesForShiftRequestObject
 * @package App\Resource\Model\EmployeesForShift
 */
class EmployeesForShiftRequestObject
{
    /**
     * @var Area
     */
    private Area $area;

    /**
     * @var Role
     */
    private Role $role;

    /**
     * @var \DateTime
     */
    private \DateTime $startDateTime;

    /**
     * @var int
     */
    private int $shiftLength;

    /**
     * @var int
     */
    private int $bestMatchesLimit;

    /**
     * @var int
     */
    private int $otherStaffLimit;

    /**
     * @return Area
     */
    public function getArea(): Area
    {
        return $this->area;
    }

    /**
     * @param Area $area
     * @return EmployeesForShiftRequestObject
     */
    public function setArea(Area $area): EmployeesForShiftRequestObject
    {
        $this->area = $area;
        return $this;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @param Role $role
     * @return EmployeesForShiftRequestObject
     */
    public function setRole(Role $role): EmployeesForShiftRequestObject
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartDateTime(): \DateTime
    {
        return $this->startDateTime;
    }

    /**
     * @param \DateTime $startDateTime
     * @return EmployeesForShiftRequestObject
     */
    public function setStartDateTime(\DateTime $startDateTime): EmployeesForShiftRequestObject
    {
        $this->startDateTime = $startDateTime;
        return $this;
    }

    /**
     * @return int
     */
    public function getShiftLength(): int
    {
        return $this->shiftLength;
    }

    /**
     * @param int $shiftLength
     * @return EmployeesForShiftRequestObject
     */
    public function setShiftLength(int $shiftLength): EmployeesForShiftRequestObject
    {
        $this->shiftLength = $shiftLength;
        return $this;
    }

    /**
     * @return int
     */
    public function getBestMatchesLimit(): int
    {
        return $this->bestMatchesLimit;
    }

    /**
     * @param int $bestMatchesLimit
     * @return EmployeesForShiftRequestObject
     */
    public function setBestMatchesLimit(int $bestMatchesLimit): EmployeesForShiftRequestObject
    {
        $this->bestMatchesLimit = $bestMatchesLimit;
        return $this;
    }

    /**
     * @return int
     */
    public function getOtherStaffLimit(): int
    {
        return $this->otherStaffLimit;
    }

    /**
     * @param int $otherStaffLimit
     * @return EmployeesForShiftRequestObject
     */
    public function setOtherStaffLimit(int $otherStaffLimit): EmployeesForShiftRequestObject
    {
        $this->otherStaffLimit = $otherStaffLimit;
        return $this;
    }



}
