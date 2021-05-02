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
    public function postPersist(Main $main, LifecycleEventArgs $event): void
    {
        $date = new \DateTime('now');
        $doctype = $main->getDoctype();
        $id = $main->getId();
        $sn = $date->format('Ymd') . 0 . $doctype->getId() . str_pad($id, 4, '0', STR_PAD_LEFT);
        $em = $event->getEntityManager();
        $main->setSn($sn);
        $em->persist($main);
        $em->flush();
    }
}

