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
use App\Entity\Artisan;

class ArtisanNew
{

    public function prePersist(Artisan $artisan, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();
        $lastId = $em->getRepository(Artisan::class)->findOneBy([], ['id' => 'DESC'])->getId();
        $artisan->setWn('A' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT));
    }
}

