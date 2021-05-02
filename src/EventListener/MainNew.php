<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Entity\Main;

class MainNew
{
    public function prePersist(Main $main, LifecycleEventArgs $event): void
    {
        $date = new \DateTime('now');
        $dateString = $date->format('Ymd');
        $id = $main->getId();
        $doctype = $main->getDoctype();
        $em = $event->getEntityManager();
        $latest = $em->getRepository(Main::class)->getLatest();
        if ($dateString == substr($latest->getSn(), 0, 8)) {
            $snId = substr($latest->getSn(), -4) + 1;
            $sn = $dateString . str_pad($doctype->getId(), 2, '0', STR_PAD_LEFT) . str_pad($snId, 4, '0', STR_PAD_LEFT);
        }
        else {
            $sn = $dateString . str_pad($doctype->getId(), 2, '0', STR_PAD_LEFT) . '0001';
        }
        $main->setSn($sn);
    }

    public function postPersist(Main $main, LifecycleEventArgs $event): void
    {
        // $em = $event->getEntityManager();
        // $em->persist($main);
        // $em->flush();
    }
}

