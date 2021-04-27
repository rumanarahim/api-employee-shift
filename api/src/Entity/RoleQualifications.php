<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** A book.
 *
 * @ORM\Table(name="Role_Qualifications")
 * @ORM\Entity
 *
 */
class RoleQualifications
{
    /** The id of this book.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private int $id;

    /**
     * @var Role
     *
     * @ORM\ManyToOne (targetEntity="Role", inversedBy="roleQualifications")
     * @ORM\JoinColumn (name="role", referencedColumnName="id")
     */
    public Role $role;

    /**
     * @var Qualification
     *
     * @ORM\ManyToOne (targetEntity="Qualification", inversedBy="roleQualifications")
     * @ORM\JoinColumn (name="qualification", referencedColumnName="id")
     */
    public Qualification $qualification;

    /**
     * @var bool
     * @ORM\Column(name="legal_requirement", type="boolean")
     */
    public bool $legalRequirement;


}
