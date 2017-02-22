<?php


namespace Karhabty\OffreBundle\Repository;
use Doctrine\ORM\EntityRepository;

class OffreRepository extends EntityRepository
{


    function MesOffres($id){

       $query=$this->getEntityManager()->createQuery("select m from KarhabtyOffreBundle:Offre m WHERE m.user=:user")->setParameter('user',$id);

        //print_r($query->getResult());

        return $query->getResult();
    }



    public function getoffres($date){


        $qb = $this->createQueryBuilder("e")->select('e');
        $qb->andWhere('e.DateExpirationOffre > :now')
            ->setParameter('now', $date )
        ;
        $result = $qb->getQuery()->getResult();

        return $result;



   }



    public function getadresse($date){

        $qb = $this->createQueryBuilder("e")->select('e');
        $qb->andWhere('e.DateExpirationOffre > :now')
            ->setParameter('now', $date )
        ;
        $result = $qb->getQuery()->getResult();

        return $result;



    }




    function offrespasses(\Datetime $date){



        $qb = $this->createQueryBuilder("e")->select('e');
        $qb->andWhere('e.DateExpirationOffre < :now')
            ->setParameter('now', $date );
        $result = $qb->getQuery()->getResult();

        return $result;




    }


    function countOffre($id){




        $query=$this->getEntityManager()->createQuery("select count(m) from KarhabtyOffreBundle:Coupon m WHERE m.offre=:offre")
            ->setParameter('offre',$id);
        return $query->getResult();


    }
    function countAllOffre(){




        return $query=$this->getEntityManager()->createQuery("select count(m) from KarhabtyOffreBundle:Coupon m ")
            ->getSingleScalarResult();


    }



    function countStat($id){


        $query=$this->getEntityManager()->createQuery("select count(m) from KarhabtyOffreBundle:Coupon m WHERE m.user=:user")
            ->setParameter('user',$id);
        return $query->getResult();



    }


}