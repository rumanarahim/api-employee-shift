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
class EmployeeForShiftResponseObject
{
    private Employee $employee;

    private int $score;

    /**
     * @return Employee
     */
    public function getEmployee(): Employee
    {
        return $this->employee;
    }

    /**
     * @param Employee $employee
     * @return EmployeeForShiftResponseObject
     */
    public function setEmployee(Employee $employee): EmployeeForShiftResponseObject
    {
        $this->employee = $employee;
        return $this;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @param int $score
     * @return EmployeeForShiftResponseObject
     */
    public function setScore(int $score): EmployeeForShiftResponseObject
    {
        $this->score = $score;
        return $this;
    }


}
