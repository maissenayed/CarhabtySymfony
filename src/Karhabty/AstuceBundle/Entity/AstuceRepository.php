<?php


namespace Karhabty\AstuceBundle\Entity;
use Doctrine\ORM\EntityRepository;

/**


 */


class AstuceRepository extends EntityRepository
{
    public function findDetailsAstuceDQL($id) {

        $query = $this->_em->createQuery('SELECT ro FROM KarhabtyAstuceBundle:Astuce ro where ro.id=:id')
            ->setParameter('id', $id);
        $results = $query->getResult();

        return $results;
    }
    public function relatedAstuce($theme) {

        $query = $this->_em->createQuery('SELECT p FROM KarhabtyAstuceBundle:Astuce p where p.theme=:theme')
            ->setParameter('theme', $theme);
        $results = $query->getResult();
        return $results;
    }
    public function recentAstuce($date) {

        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->orderBy('p.date', 'DESC')
            ->setMaxResults(4);

        return $qb->getQuery()->getResult();
    }

    public function findThemeAstucetDQL($theme) {

        $query = $this->_em->createQuery('SELECT ro FROM KarhabtyAstuceBundle:Astuce ro where ro.theme=:theme')
            ->setParameter('theme', $theme);
        $results = $query->getResult();

        return $results;
    }
}