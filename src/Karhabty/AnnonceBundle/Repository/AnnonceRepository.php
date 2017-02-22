<?php
/**
 * Created by PhpStorm.
 * User: Maissen
 * Date: 12/02/2017
 * Time: 13:57
 */
namespace Karhabty\AnnonceBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AnnonceRepository extends EntityRepository
{
    public function findAllOrderedByName($prix,$title,$category)
    {
        return $this->getEntityManager()
            ->createQuery(
         //       'SELECT p FROM KarhabtyAnnonceBundle:Annonce p ORDER BY p.Model ASC'
           // )
           // ->getResult();

            "SELECT p
                      FROM KarhabtyAnnonceBundle:Annonce p
                           WHERE (p.Prix = :prix
                                  OR p.title LIKE :title 
                                  OR p.Category = :category )"

        )->setParameter('title', '%' . $title . '%')
            ->setParameter('category',$category)
            ->setParameter('prix',$prix)

        ->getResult();
    }
    public function findAllOrderedBydate()
    {
        return $this->getEntityManager()
            ->createQuery(
            //       'SELECT p FROM KarhabtyAnnonceBundle:Annonce p ORDER BY p.Model ASC'
            // )
            // ->getResult();

                "SELECT p
                      FROM KarhabtyAnnonceBundle:Annonce p
                            where( p.AnneePub > :dateday)
                           ORDER BY p.AnneePub ASC"

            )->setParameter('dateday', new \DateTime('-2 day'))
            ->getResult();
    }
    public function countannoncenew()
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT COUNT (p.id)
                      FROM KarhabtyAnnonceBundle:Annonce p
                           where( p.AnneePub > :dateday)"




            )->setParameter('dateday', new \DateTime('-1 day'))
            ->getSingleScalarResult();
    }
    public function countannoncelastweek()
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT COUNT (p.id)
                      FROM KarhabtyAnnonceBundle:Annonce p
                           where( p.AnneePub > :dateday)"




            )->setParameter('dateday', new \DateTime('-2 day'))
            ->getSingleScalarResult();
    }
    function countAnnonce(){

        return  $query=$this->getEntityManager()->createQuery("select count(p) from KarhabtyAnnonceBundle:Annonce p ")
            ->getSingleScalarResult();
    }

}