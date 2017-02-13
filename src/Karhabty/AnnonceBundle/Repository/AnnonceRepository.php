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
}