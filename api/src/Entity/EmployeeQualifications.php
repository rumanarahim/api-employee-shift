<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** A book.
 *
 * @ORM\Table(name="Employee_Qualifications")
 * @ORM\Entity
 *
 */
class EmployeeQualifications
{
    /** The id of this qualification.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private int $id;

    /**
     * @var Employee
     *
     * @ORM\ManyToOne (targetEntity="Employee", inversedBy="employeeQualifications")
     * @ORM\JoinColumn (name="employee", referencedColumnName="id")
     */
    private Employee $employee;

    /**
     * @var Qualification
     *
     * @ORM\ManyToOne (targetEntity="Qualification", inversedBy="employeeQualifications")
     * @ORM\JoinColumn (name="qualification", referencedColumnName="id")
     */
    private Qualification $qualification;


    /**
     * @var int
     * @ORM\Column(name="status", type="integer")
     */
    private int $status;

}
