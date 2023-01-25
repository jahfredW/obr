<?php 

namespace App\EventListener;

use DateTimeImmutable;
use App\Entity\Contact;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;


class AccountListener
{
    // the entity listener methods receive two arguments:
    // the entity instance and the lifecycle event
    public function prePersist(Contact $contact, LifecycleEventArgs $event): void
    {   
        
        $contact->setIsActive(true);
        $contact->setCreatedAt( new \DateTimeImmutable);
    }

    // public function preUpdate(Contact $contact, LifecycleEventsArgs $event): void
    // {
    //     $contact->setUpdatedAt(new \DateTimeImmutable);
    // }
}