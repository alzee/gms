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
        $weight = $cgd->getWeight();
        $child = $cgd->getChild();
        $child->setBox($child->getBox() + $weight);
    }
}

