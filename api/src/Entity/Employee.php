<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Resource\Model\EmployeesForShift;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** An Employee.
 *
 * @ORM\Table(name="Employee")
 * @ORM\Entity
 *
 */
class Employee
{
    /** The id of this employee.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private int $id;

    /**
     * @var ?string
     *
     * @ORM\Column(name="title", type="string", nullable=true)
     */
    private ?string $title;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", nullable=false)
     */
    public string $firstName;

    /**
     * @var ?string
     * @ORM\Column(name="middle_name", type="string", nullable=true)
     */
    private ?string $middleName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", nullable=false)
     */
    private string $lastName;


    /**
     * @var File[]
     *
     * @ORM\OneToMany(targetEntity="File", mappedBy="employee", cascade={"persist"})
     */
    private iterable $files;


    /**
     * @var Role
     * @ORM\ManyToOne (targetEntity="Role", inversedBy="employees", cascade={"persist", "remove"})
     * @ORM\JoinColumn (name="role", referencedColumnName="id")
     */
    private Role $role;

    /**
     * @var Area[] - The area this employee belongs to
     *
     * @ORM\ManyToMany(targetEntity="Area")
     * @ORM\JoinTable(name="Link_Area_Employee",
     *      joinColumns={@ORM\JoinColumn(name="employee", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="area", referencedColumnName="id")}
     *      )
     **/
    private iterable $areas;

    /**
     * @var EmployeeRoles[]
     *
     * @ORM\OneToMany (targetEntity="EmployeeRoles", mappedBy="employee", fetch="EXTRA_LAZY", orphanRemoval=true)
     */
    private iterable $employeeRoles;

    /**
     * @var EmployeeQualifications[]
     *
     * @ORM\OneToMany (targetEntity="EmployeeQualifications", mappedBy="employee", fetch="EXTRA_LAZY", orphanRemoval=true)
     */
    private iterable $employeeQualifications;

    /**
     * @var int - The number of hours this employee is allowed to work in a week
     * @ORM\Column(name="weekly_hours_allowance", type="integer")
     */
    private int $weeklyHoursAllowance;

    /**
     * @var int - The number of hours this employee has already been rostered in a week
     * @ORM\Column(name="weekly_hours_rostered", type="integer", nullable=true)
     */
    private int $weeklyHoursRostered;

    /**
     * @var Shift[]
     *
     * @ORM\OneToMany (targetEntity="Shift", mappedBy="employee", fetch="EXTRA_LAZY", orphanRemoval=true)
     */
    private iterable $shifts;

    /**
     * @var Leave[]
     *
     * @ORM\OneToMany (targetEntity="Leave", mappedBy="employee", fetch="EXTRA_LAZY", orphanRemoval=true)
     */
    private iterable $leave;

    /**
     * @var string
     * @ORM\Column(name="city", type="string", nullable=true)
     */
    private string $city;

    /**
     * Constructor
     */
    public function _construct()
    {
        $this->files = new ArrayCollection();
        $this->employeeRoles = new ArrayCollection();
        $this->employeeQualifications = new ArrayCollection();
        $this->shifts = new ArrayCollection();
        $this->leave = new ArrayCollection();
        $this->areas = new ArrayCollection();
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
     * @return Employee
     */
    public function setId(int $id): Employee
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Employee
     */
    public function setTitle(?string $title): Employee
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Employee
     */
    public function setFirstName(string $firstName): Employee
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * @param string|null $middleName
     * @return Employee
     */
    public function setMiddleName(?string $middleName): Employee
    {
        $this->middleName = $middleName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Employee
     */
    public function setLastName(string $lastName): Employee
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return File[]
     */
    public function getFiles(): iterable
    {
        return $this->files;
    }

    /**
     * @param File[] $files
     * @return Employee
     */
    public function setFiles(iterable$files): Employee
    {
        $this->files = $files;
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
     * @return Employee
     */
    public function setRole(Role $role): Employee
    {
        $this->role = $role;
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
     * @return Employee
     */
    public function setEmployeeRoles(iterable $employeeRoles): Employee
    {
        $this->employeeRoles = $employeeRoles;
        return $this;
    }

    /**
     * @return EmployeeQualifications[]
     */
    public function getEmployeeQualifications(): iterable
    {
        return $this->employeeQualifications;
    }

    /**
     * @param EmployeeQualifications[] $employeeQualifications
     * @return Employee
     */
    public function setEmployeeQualifications(iterable $employeeQualifications): Employee
    {
        $this->employeeQualifications = $employeeQualifications;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeeklyHoursAllowance(): int
    {
        return $this->weeklyHoursAllowance;
    }

    /**
     * @param int $weeklyHoursAllowance
     * @return Employee
     */
    public function setWeeklyHoursAllowance(int $weeklyHoursAllowance): Employee
    {
        $this->weeklyHoursAllowance = $weeklyHoursAllowance;
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
     * @return Employee
     */
    public function setShifts(iterable $shifts): Employee
    {
        $this->shifts = $shifts;
        return $this;
    }

    /**
     * @return Leave[]
     */
    public function getLeave(): iterable
    {
        return $this->leave;
    }

    /**
     * @param Leave[] $leave
     * @return Employee
     */
    public function setLeave(iterable $leave): Employee
    {
        $this->leave = $leave;
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
     * @return Employee
     */
    public function setAreas(iterable $areas): Employee
    {
        $this->areas = $areas;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeeklyHoursRostered(): int
    {
        return $this->weeklyHoursRostered;
    }

    /**
     * @param int $weeklyHoursRostered
     * @return Employee
     */
    public function setWeeklyHoursRostered(int $weeklyHoursRostered): Employee
    {
        $this->weeklyHoursRostered = $weeklyHoursRostered;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Employee
     */
    public function setCity(string $city): Employee
    {
        $this->city = $city;
        return $this;
    }

}
