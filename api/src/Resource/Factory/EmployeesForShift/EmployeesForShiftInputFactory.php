<?php

namespace App\Resource\Factory\EmployeesForShift;


use App\Repository\AreaRepository;
use App\Repository\RoleRepository;
use App\Resource\Model\EmployeesForShift\EmployeesForShiftInputDTO;
use App\Resource\Model\EmployeesForShift\EmployeesForShiftRequestObject;

final class EmployeesForShiftInputFactory
{
    /**
     * @var AreaRepository $repoArea
     */
    private $repoArea;

    /**
     * @var RoleRepository $repoRole
     */
    private $repoRole;

    /**
     * EmployeesForShiftInputFactory constructor.
     * @param AreaRepository $repoArea
     * @param RoleRepository $repoRole
     */
    public function __construct(
        AreaRepository $repoArea,
        RoleRepository $repoRole
    )
    {
        $this->repoArea = $repoArea;
        $this->repoRole = $repoRole;
    }

    /**
     * @return EmployeesForShiftRequestObject
     */
    public static function create()
    {
        return new EmployeesForShiftRequestObject();
    }

    /**
     * @param EmployeesForShiftInputDTO $input
     * @return EmployeesForShiftRequestObject
     * @throws \Exception
     */
    public function createFromInput(EmployeesForShiftInputDTO $input)
    {
        // Do some validation here - if the repo calls return null then throw an exception

        $requestObject = self::create();
        $requestObject->setArea($this->repoArea->find($input->getArea()));
        $requestObject->setRole($this->repoRole->find($input->getRole()));
        $requestObject->setStartDateTime(new \DateTime($input->getStartDateTime()));
        $requestObject->setShiftLength($input->getShiftLength());
        $requestObject->setBestMatchesLimit($input->getBestMatchLimit());
        $requestObject->setOtherStaffLimit($input->getOtherStaffLimit());

        return $requestObject;
    }



}
