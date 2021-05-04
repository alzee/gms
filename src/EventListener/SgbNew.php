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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Sgb;
use App\Entity\Box;

class SgbNew
{
    public function prePersist(Sgb $sgb, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();
        $goldclass = $sgb->getGoldclass();
        $weight = $sgb->getWeight();

        // subtract from box
        $box= $em->getRepository(Box::class)->findOneBy(['clerk' => null, 'artisan' => null, 'goldclass' => $goldclass]);
        if (is_null($box)) {
            $box = new Box();
            $box->setGoldclass($goldclass);
            $box->setWeight(0 - $weight);
        }
        else {
            $box->setWeight($box->getWeight() - $weight);
        }
        $em->persist($box);
    }
}

