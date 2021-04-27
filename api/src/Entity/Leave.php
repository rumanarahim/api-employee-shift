<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** A book.
 *
 * @ORM\Table(name="Leave")
 * @ORM\Entity
 *
 */
class Leave
{
    /** The id of this leave record.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private int $id;

    /**
     * @var Employee
     *
     * @ORM\ManyToOne (targetEntity="Employee", inversedBy="leaves")
     * @ORM\JoinColumn (name="employee", referencedColumnName="id")
     */
    public Employee $employee;

    /**
     * @var int
     * @ORM\Column(name="type", type="integer")
     */
    public int $type;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(name="start_date", type="datetime")
     */
    public \DateTimeInterface $startDate;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(name="end_date", type="datetime")
     */
    public \DateTimeInterface $endDate;

    /**
     * @var int
     * @ORM\Column(name="status", type="integer")
     */
    public int $status;

}
