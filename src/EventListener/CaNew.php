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
use App\Entity\Ca;
use App\Entity\Main;
use App\Entity\Child;

class CaNew
{

    public function prePersist(Ca $ca, LifecycleEventArgs $event): void
    {
        $em = $event->getEntityManager();

        $ca->setDate(new \DateTimeImmutable());

        $doc = $ca->getDoc();
        if (!is_null($doc)) {
            $child = $em->getRepository(Child::class)->findOneBy(['sn' => $doc]);
            if (!is_null($child)) {
                $ca->setChild($child);
            }
            else {
                $main = $em->getRepository(Main::class)->findOneBy(['sn' => $doc]);
                if (!is_null($main)) {
                    $ca->setMain($main);
                }
            }
        }
    }
}

