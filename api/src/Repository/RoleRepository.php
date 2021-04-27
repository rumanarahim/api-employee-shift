<?php

namespace App\Repository;

use App\Entity\Employee;
use App\Entity\Role;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class RoleRepository
 * @package App\Repository
 *
 * @method Role|null find(int $id)
 */

class RoleRepository extends ServiceEntityRepository
{

    /**
     * RoleRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Role::class);
    }

    /**
     * @param Role $role
     * @return array
     */
    public function findRelatedRoles(Role $role)
    {
        $queryBuilder = $this->createQueryBuilder('m')
            ->select('m.id')
            ->leftJoin('m.relatedRoles', 'relatedRoles')
            ->andWhere('relatedRoles = :role')
            ->setParameter('role', $role);

        return $queryBuilder->getQuery()->getArrayResult();
    }
}
