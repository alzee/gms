<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Cc;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class CcUpdate
{
    public function postUpdate(Cc $cc, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();
        if ($cc->getStatus()->getId() == 2) {
            $recipient = $cc->getRecipient();
            // add to box
            $weight = $cc->getWeight();
            $goldclass = $cc->getGoldclass();
            $box = $event->getReposity(Box::class)->findOneBy(['clerk' => $recipient , 'goldclass' => $goldclass]);
            if (is_null($box)) {
                $box = new Box();
                $box->setClerk($recipient);
                $box->setGoldclass($goldclass);
                $box->setWeight($weight);
            }
            else {
                $box->setWeight($box->getWeight() + $weight);
            }
            $em->persist($box);
            $em->flush();
        }
    }
}
