<?php


namespace Karhabty\OffreBundle\Repository;
use Doctrine\ORM\EntityRepository;

class CouponRepository extends EntityRepository
{


    function countCouponlast(){

        return  $query=$this->getEntityManager()->createQuery("select count(m) from KarhabtyOffreBundle:Coupon m where( m.date > :dateday)")
            ->setParameter('dateday', new \DateTime('-2 day'))
            ->getSingleScalarResult();
    }
    function countCouponnew(){

        return  $query=$this->getEntityManager()->createQuery("select count(m) from KarhabtyOffreBundle:Coupon m where( m.date > :dateday)")
            ->setParameter('dateday', new \DateTime('0 day'))
            ->getSingleScalarResult();
    }
    function countCoupon(){

        return  $query=$this->getEntityManager()->createQuery("select count(m) from KarhabtyOffreBundle:Coupon m ")
            ->getSingleScalarResult();
    }








    function MesCoupon($id){


        $query=$this->getEntityManager()->createQuery("select m from KarhabtyOffreBundle:Coupon m WHERE m.user=:user")->setParameter('user',$id);

        //print_r($query->getResult());

        return $query->getResult();
    }


}