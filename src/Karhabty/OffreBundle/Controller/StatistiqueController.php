<?php

namespace Karhabty\OffreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatistiqueController extends Controller
{
    public function StatAction()
    {
        return $this->render('@KarhabtyOffre/offre/statistique.html.twig');
    }
}
