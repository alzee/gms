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
use App\Entity\Gca;
use App\Entity\Box;

class GcaNew
{
    public function prePersist(Gca $gca, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();
        $clerk = $gca->getClerk();
        $artisan = $gca->getArtisan();
        $goldclass = $gca->getGoldclass();
        $weight = $gca->getWeight();

        // subtract from clerk box
        $clerkBox= $em->getRepository(Box::class)->findOneBy(['clerk' => $clerk, 'goldclass' => $goldclass]);
        if (is_null($clerkBox)) {
            $clerkBox = new Box();
            $clerkBox->setClerk($clerk);
            $clerkBox->setGoldclass($goldclass);
            $clerkBox->setWeight(0 - $weight);
        }
        else {
            $clerkBox->setWeight($clerkBox->getWeight() - $weight);
        }
        $em->persist($clerkBox);

        // add to artisan box
        $artisanBox = $em->getRepository(Box::class)->findOneBy(['clerk' => $artisan, 'goldclass' => $goldclass]);
        if (is_null($artisanBox)) {
            $artisanBox = new Box();
            $artisanBox->setArtisan($artisan);
            $artisanBox->setGoldclass($goldclass);
            $artisanBox->setWeight($weight);
        }
        else {
            $artisanBox->setWeight($artisanBox->getWeight() + $weight);
        }
        $em->persist($artisanBox);
    }
}

