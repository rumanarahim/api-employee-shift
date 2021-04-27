<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** An Area
 *
 * @ORM\Table(name="Area")
 * @ORM\Entity
 *
 */
class Area
{
    /** The id of this area
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * The name of this location
     *
     * @ORM\Column(nullable=false)
     */

    private string $name;

    /**
     * @var Role[]
     *
     * @ORM\ManyToMany (targetEntity="Role", mappedBy="areas", fetch="EXTRA_LAZY")
     */
    private iterable $roles;

    /**
     * @var Employee[]
     *
     * @ORM\ManyToMany (targetEntity="Employee", mappedBy="areas", fetch="EXTRA_LAZY")
     **/
    private iterable $employees;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Area
     */
    public function setId(int $id): Area
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Area
     */
    public function setName(string $name): Area
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Role[]
     */
    public function getRoles(): iterable
    {
        return $this->roles;
    }

    /**
     * @param Role[] $roles
     * @return Area
     */
    public function setRoles(iterable $roles): Area
    {
        $this->roles = $roles;
        return $this;
    }

}
