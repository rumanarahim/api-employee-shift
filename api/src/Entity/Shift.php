<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** A Shift
 *
 * @ORM\Table(name="Shift")
 * @ORM\Entity
 *
 */
class Shift
{
    /** The id of this book.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(name="start_datetime",type="datetime")
     */
    private \DateTimeInterface $startDateTime;

    /**
     * @ORM\Column(name="end_datetime", type="datetime")
     */
    private \DateTimeInterface $endDateTime;

    /**
     * @var Role
     *
     * @ORM\ManyToOne (targetEntity="Role", inversedBy="shifts")
     * @ORM\JoinColumn (name="role", referencedColumnName="id")
     */
    private Role $role;

    /**
     * @var Employee
     *
     * @ORM\ManyToOne (targetEntity="Employee", inversedBy="shifts")
     * @ORM\JoinColumn (name="employee", referencedColumnName="id")
     */
    private Employee $employee;
}
