<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),
<<<<<<< HEAD
            new Karhabty\AstuceBundle\KarhabtyAstuceBundle(),
=======

            new Karhabty\EventsBundle\KarhabtyEventsBundle(),

>>>>>>> b308c0b126b2a57f76029eaf79603ea271c003c1
            new Karhabty\UserBundle\KarhabtyUserBundle(),
            new FOS\UserBundle\FOSUserBundle(),

            new Karhabty\OffreBundle\KarhabtyOffreBundle(),
            new Karhabty\MapBundle\KarhabtyMapBundle(),
            new Vich\UploaderBundle\VichUploaderBundle(),
            new Karhabty\FutureConducteurBundle\KarhabtyFutureConducteurBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new AncaRebeca\FullCalendarBundle\FullCalendarBundle(),
            new Karhabty\CalendarBundle\KarhabtyCalendarBundle(),
            new Karhabty\AnnonceBundle\KarhabtyAnnonceBundle(),
            new Karhabty\PaiementBundle\KarhabtyPaiementBundle(),
            new WhiteOctober\TCPDFBundle\WhiteOctoberTCPDFBundle(),
            new Nomaya\SocialBundle\NomayaSocialBundle(),
            new Karhabty\BankBundle\KarhabtyBankBundle(),
            new Karhabty\AdminBundle\KarhabtyAdminBundle(),
            new Ob\HighchartsBundle\ObHighchartsBundle(),
            new Gregwar\CaptchaBundle\GregwarCaptchaBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
