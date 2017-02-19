<?php


namespace Karhabty\UserBundle\Repository;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{


    function countUser(){




        return $query=$this->getEntityManager()->createQuery("select count(m) from KarhabtyUserBundle:User m ")
            ->getSingleScalarResult();


    }



}