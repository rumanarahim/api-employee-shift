<?php
// api/src/Entity/Book.php

namespace App\Resource\Model\EmployeesForShift;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

//input=EmployeesForShiftInputDTO::class,
// *      output=EmployeesForShiftOutputDTO::class,


/** A book.
 *
 */
final class EmployeeForShiftOutputDTO
{
    public string $id;

    public ?string $title;

    public string $firstName;

    public ?string $middleName;

    public string $lastName;

//    public ?string $profilePicturePath;

    public ?string $rating;

    public ?string $weeklyHoursAllowance;

    public ?string $weeklyHoursRostered;

    public string $role;

    public string $city;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return EmployeeForShiftOutputDTO
     */
    public function setTitle(?string $title): EmployeeForShiftOutputDTO
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
     * @return EmployeeForShiftOutputDTO
     */
    public function setFirstName(string $firstName): EmployeeForShiftOutputDTO
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
     * @return EmployeeForShiftOutputDTO
     */
    public function setMiddleName(?string $middleName): EmployeeForShiftOutputDTO
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
     * @return EmployeeForShiftOutputDTO
     */
    public function setLastName(string $lastName): EmployeeForShiftOutputDTO
    {
        $this->lastName = $lastName;
        return $this;
    }

//    /**
//     * @return string|null
//     */
//    public function getProfilePicturePath(): ?string
//    {
//        return $this->profilePicturePath;
//    }
//
//    /**
//     * @param string|null $profilePicturePath
//     * @return EmployeeForShiftOutputDTO
//     */
//    public function setProfilePicturePath(?string $profilePicturePath): EmployeeForShiftOutputDTO
//    {
//        $this->profilePicturePath = $profilePicturePath;
//        return $this;
//    }

    /**
     * @return string|null
     */
    public function getRating(): ?string
    {
        return $this->rating;
    }

    /**
     * @param string|null $rating
     * @return EmployeeForShiftOutputDTO
     */
    public function setRating(?string $rating): EmployeeForShiftOutputDTO
    {
        $this->rating = $rating;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWeeklyHoursAllowance(): ?string
    {
        return $this->weeklyHoursAllowance;
    }

    /**
     * @param string|null $weeklyHoursAllowance
     * @return EmployeeForShiftOutputDTO
     */
    public function setWeeklyHoursAllowance(?string $weeklyHoursAllowance): EmployeeForShiftOutputDTO
    {
        $this->weeklyHoursAllowance = $weeklyHoursAllowance;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWeeklyHoursRostered(): ?string
    {
        return $this->weeklyHoursRostered;
    }

    /**
     * @param string|null $weeklyHoursRostered
     * @return EmployeeForShiftOutputDTO
     */
    public function setWeeklyHoursRostered(?string $weeklyHoursRostered): EmployeeForShiftOutputDTO
    {
        $this->weeklyHoursRostered = $weeklyHoursRostered;
        return $this;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return EmployeeForShiftOutputDTO
     */
    public function setRole(string $role): EmployeeForShiftOutputDTO
    {
        $this->role = $role;
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
     * @return EmployeeForShiftOutputDTO
     */
    public function setCity(string $city): EmployeeForShiftOutputDTO
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return EmployeeForShiftOutputDTO
     */
    public function setId(string $id): EmployeeForShiftOutputDTO
    {
        $this->id = $id;
        return $this;
    }



}
