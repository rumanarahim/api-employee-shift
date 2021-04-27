<?php
// api/src/Entity/Book.php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** A Qualification.
 *
 * @ORM\Table(name="Qualification")
 * @ORM\Entity
 *
 */
class Qualification
{
    /** The id of this book.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string")
     */
    public string $title;

    /**
     * @var EmployeeQualifications[]
     *
     * @ORM\OneToMany (targetEntity="EmployeeQualifications", mappedBy="qualification", fetch="EXTRA_LAZY", orphanRemoval=true)
     */
    private iterable $employeeQualifications;

    /**
     * @var EmployeeQualifications[]
     *
     * @ORM\OneToMany (targetEntity="RoleQualifications", mappedBy="qualification", fetch="EXTRA_LAZY", orphanRemoval=true)
     */
    private iterable $roleQualifications;

    public function __construct()
    {
        $this->employeeQualifications = new ArrayCollection();
        $this->roleQualifications = new ArrayCollection();
    }
}
