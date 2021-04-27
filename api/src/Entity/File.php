<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** A File.
 *
 * @ORM\Table(name="File")
 * @ORM\Entity
 *
 */
class File
{
    /** The id of this file.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    public string $title;

    /**
     * @var Employee
     * @ORM\ManyToOne (targetEntity="Employee", inversedBy="files", cascade={"persist", "remove"})
     * @ORM\JoinColumn (name="employee", referencedColumnName="id")
     */
    public Employee $employee;

    /**
     * @var string
     *
     * @ORM\Column(name="mime", type="string", length=100, nullable=false)
     */
    public string $mime;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=false)
     */
    public string $path;

    /**
     * @var int
     * @ORM\Column(name="size", type="integer", nullable=false)
     */
    public int $size;

    /**
     * @var int
     * @ORM\Column(name="category", type="integer", length=2, nullable=false)
     */
    public int $category;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    public \DateTimeInterface $created;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(name="modified", type="datetime", nullable=true)
     */
    public \DateTimeInterface $modified;


    public function getId(): ?int
    {
        return $this->id;
    }
}
