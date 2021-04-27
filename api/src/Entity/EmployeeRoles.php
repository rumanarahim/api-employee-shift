<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** A book.
 *
 * @ORM\Entity
 * @ORM\Table(name="Employee_Roles")
 *
 */
class EmployeeRoles
{
    /** The id of this book.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private int $id;


    /**
     * @var Employee
     *
     * @ORM\ManyToOne (targetEntity="Employee", inversedBy="employeeRoles")
     * @ORM\JoinColumn (name="employee", referencedColumnName="id")
     */
    private Employee $employee;

    /**
     * @var Role - Roles that this employee can work in
     *
     * @ORM\ManyToOne (targetEntity="Role", inversedBy="employeeRoles")
     * @ORM\JoinColumn (name="role", referencedColumnName="id")
     */
    private Role $roles;

    /**
     * @var int - A score between 1 and 10 to indicate this employee's proficiency in this role
     *
     * @ORM\Column(name="proficiency_rating", type="integer")
     */
    private int $proficiencyRating;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return EmployeeRoles
     */
    public function setId(int $id): EmployeeRoles
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Employee
     */
    public function getEmployee(): Employee
    {
        return $this->employee;
    }

    /**
     * @param Employee $employee
     * @return EmployeeRoles
     */
    public function setEmployee(Employee $employee): EmployeeRoles
    {
        $this->employee = $employee;
        return $this;
    }

    /**
     * @return Role
     */
    public function getRoles(): Role
    {
        return $this->roles;
    }

    /**
     * @param Role $roles
     * @return EmployeeRoles
     */
    public function setRoles(Role $roles): EmployeeRoles
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @return int
     */
    public function getProficiencyRating(): int
    {
        return $this->proficiencyRating;
    }

    /**
     * @param int $proficiencyRating
     * @return EmployeeRoles
     */
    public function setProficiencyRating(int $proficiencyRating): EmployeeRoles
    {
        $this->proficiencyRating = $proficiencyRating;
        return $this;
    }



}
