<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** A role.
 *
 * @ORM\Table(name="Role")
 * @ORM\Entity
 *
 */
class Role
{
    /** The id of this role
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private int $id;

    /**
     * @var string - The title of this role
     *
     * @ORM\Column(name="title", type="string")
     */
    private string $title;

    /**
     * @var Role[] - Other Roles related to this role
     *
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="Link_Related_Roles",
     *      joinColumns={@ORM\JoinColumn(name="role", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="related_role", referencedColumnName="id")}
     *      )
     **/
    private iterable $relatedRoles;

    /**
     * @var Area[] - The areas this role belongs to
     *
     * @ORM\ManyToMany(targetEntity="Area")
     * @ORM\JoinTable(name="Link_Area_Role",
     *      joinColumns={@ORM\JoinColumn(name="role", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="area", referencedColumnName="id")}
     *      )
     **/
    private iterable $areas;

    /**
     * @var Employee[]
     *
     * @ORM\OneToMany(targetEntity="Employee", mappedBy="role", cascade={"persist"})
     */
    private iterable $employees;

    /**
     * @var EmployeeRoles[]
     *
     *@ORM\OneToMany (targetEntity="EmployeeRoles", mappedBy="role", fetch="EXTRA_LAZY", orphanRemoval=true)
     */
    private iterable $employeeRoles;

    /**
     * @var RoleQualifications[]
     *
     * @ORM\OneToMany (targetEntity="RoleQualifications", mappedBy="role", fetch="EXTRA_LAZY", orphanRemoval=true)
     */
    private iterable $roleQualifications;

    /**
     * @var Shift[]
     *
     * @ORM\OneToMany (targetEntity="Shift", mappedBy="role", fetch="EXTRA_LAZY", orphanRemoval=true)
     */
    private iterable $shifts;


    /**
     * Role constructor.
     */
    public function __construct()
    {
        $this->relatedRoles = new ArrayCollection();
        $this->areas = new ArrayCollection();
        $this->employeeRoles = new ArrayCollection();
        $this->roleQualifications = new ArrayCollection();
        $this->shifts = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Role
     */
    public function setId(int $id): Role
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Role
     */
    public function setTitle(string $title): Role
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return Role[]
     */
    public function getRelatedRoles(): iterable
    {
        return $this->relatedRoles;
    }

    /**
     * @param Role[] $relatedRoles
     * @return Role
     */
    public function setRelatedRoles(iterable $relatedRoles): Role
    {
        $this->relatedRoles = $relatedRoles;
        return $this;
    }

    /**
     * @return Area[]
     */
    public function getAreas(): iterable
    {
        return $this->areas;
    }

    /**
     * @param Area[] $areas
     * @return Role
     */
    public function setAreas(iterable $areas): Role
    {
        $this->areas = $areas;
        return $this;
    }

    /**
     * @return Employee[]
     */
    public function getEmployees(): iterable
    {
        return $this->employees;
    }

    /**
     * @param Employee[] $employees
     * @return Role
     */
    public function setEmployees(iterable$employees): Role
    {
        $this->employees = $employees;
        return $this;
    }

    /**
     * @return EmployeeRoles[]
     */
    public function getEmployeeRoles(): iterable
    {
        return $this->employeeRoles;
    }

    /**
     * @param EmployeeRoles[] $employeeRoles
     * @return Role
     */
    public function setEmployeeRoles(iterable $employeeRoles): Role
    {
        $this->employeeRoles = $employeeRoles;
        return $this;
    }

    /**
     * @return RoleQualifications[]
     */
    public function getRoleQualifications(): iterable
    {
        return $this->roleQualifications;
    }

    /**
     * @param RoleQualifications[] $roleQualifications
     * @return Role
     */
    public function setRoleQualifications(iterable$roleQualifications): Role
    {
        $this->roleQualifications = $roleQualifications;
        return $this;
    }

    /**
     * @return Shift[]
     */
    public function getShifts(): iterable
    {
        return $this->shifts;
    }

    /**
     * @param Shift[] $shifts
     * @return Role
     */
    public function setShifts(iterable $shifts): Role
    {
        $this->shifts = $shifts;
        return $this;
    }



}
