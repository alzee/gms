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
use App\Entity\Gac;
use App\Entity\Box;

class GacNew
{
    public function prePersist(Gac $gac, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();
        $clerk = $gac->getClerk();
        $artisan = $gac->getArtisan();
        $goldclass = $gac->getGoldclass();
        $weight = $gac->getWeight();

        // subtract from artisan box
        $artisanBox = $em->getRepository(Box::class)->findOneBy(['artisan' => $artisan, 'goldclass' => $goldclass]);
        if (is_null($artisanBox)) {
            $artisanBox = new Box();
            $artisanBox->setArtisan($artisan);
            $artisanBox->setGoldclass($goldclass);
            $artisanBox->setWeight(0 - $weight);
        }
        else {
            $artisanBox->setWeight($artisanBox->getWeight() - $weight);
        }
        $em->persist($artisanBox);

        // add to clerk box
        $clerkBox= $em->getRepository(Box::class)->findOneBy(['clerk' => $clerk, 'goldclass' => $goldclass]);
        if (is_null($clerkBox)) {
            $clerkBox = new Box();
            $clerkBox->setClerk($clerk);
            $clerkBox->setGoldclass($goldclass);
            $clerkBox->setWeight($weight);
        }
        else {
            $clerkBox->setWeight($clerkBox->getWeight() + $weight);
        }
        $em->persist($clerkBox);
    }
}

