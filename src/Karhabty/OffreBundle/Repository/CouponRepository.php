<?php


namespace Karhabty\OffreBundle\Repository;
use Doctrine\ORM\EntityRepository;

class CouponRepository extends EntityRepository
{

    function MesCoupon($id){

        $query=$this->getEntityManager()->createQuery("select m from KarhabtyOffreBundle:Coupon m WHERE m.user=:user")->setParameter('user',$id);

        //print_r($query->getResult());

        return $query->getResult();
    }


}