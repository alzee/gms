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
use App\Entity\Child;
use App\Entity\Cgd;

class CgdNew
{
    public function prePersist(Cgd $cgd, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();
        $weight = $cgd->getWeight();
        $main = $cgd->getMain();
        $goldclass = $cgd->getGoldclass();
        $position = $cgd->getPosition();
        if (!is_null($main)) {
            $children = $em->getRepository(Child::class)->findBy(['main' => $main]);
            $perWeight = $weight / $main->getCountChild();
            foreach ($children as $child) {
                $cgd = new Cgd();
                $cgd->setMain(null);
                $cgd->setChild($child);
                $cgd->setGoldclass($goldclass);
                $cgd->setPosition($position);
                $cgd->setWeight($perWeight);
                $cgd->setDate(new \DateTimeImmutable());
                $child->setBox($child->getBox() + $perWeight);
                $em->persist($cgd);
            }
        }
        else {
            $child = $cgd->getChild();
            if (!is_null($child)) {
                $main = $child->getMain();
                $cgd->setMain($main);
                $child->setBox($child->getBox() + $weight);
            }
        }

    }
}

