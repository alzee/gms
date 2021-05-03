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
use App\Entity\Box;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class CcUpdate
{
    public function postUpdate(Cc $cc, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();
        if ($cc->getStatus() == 2) {
            $sender = $cc->getSender();
            $recipient = $cc->getRecipient();
            $weight = $cc->getWeight();
            $goldclass = $cc->getGoldclass();

            // subtract from sender box
            $senderBox= $em->getRepository(Box::class)->findOneBy(['clerk' => $sender, 'goldclass' => $goldclass]);
            if (is_null($senderBox)) {
                $senderBox = new Box();
                $senderBox->setClerk($sender);
                $senderBox->setGoldclass($goldclass);
                $senderBox->setWeight(0 - $weight);
            }
            else {
                $senderBox->setWeight($senderBox->getWeight() - $weight);
            }
            $em->persist($senderBox);

            // add to recipient box
            $recipientBox = $em->getRepository(Box::class)->findOneBy(['clerk' => $recipient , 'goldclass' => $goldclass]);
            if (is_null($recipientBox)) {
                $recipientBox = new Box();
                $recipientBox->setClerk($recipient);
                $recipientBox->setGoldclass($goldclass);
                $recipientBox->setWeight($weight);
            }
            else {
                $recipientBox->setWeight($recipientBox->getWeight() + $weight);
            }
            $em->persist($recipientBox);
            $em->flush();
        }
    }
}
