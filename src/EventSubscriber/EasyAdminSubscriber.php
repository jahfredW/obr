<?php

// attention a bien respecter le chjemin et le nommage
# src/EventSubscriber/EasyAdminSubscriber.php
namespace App\EventSubscriber;

use App\Entity\News;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

// création de EasyAdminSubscriber qui implémente EventSubscriberInterface
class EasyAdminSubscriber implements EventSubscriberInterface
{
    // funi d ecoute sur le beforePersist 
    public static function getSubscribedEvents()
    {
        // retourn la fonction definie plus bas setCreatedAt
        return [
            BeforeEntityPersistedEvent::class => ['setCreatedAt'],
            BeforeEntityUpdatedEvent::class => ['setUpdatedAt']
        ];
    }

    // fonction de msie à jour du created At
    // param $event = objet de classe BEPE
    // event contient l'instance de l'entité 
    public function setCreatedAt(BeforeEntityPersistedEvent $event)
    {
        // récupération de l'instance de l'entité 
        $entityInstance = $event->getEntityInstance();

        // si l'instance de l'entité n'hérite ni de Product ni de Category on return
        if (!$entityInstance instanceof News ) {
            return;
        }
        // sinon on met à jour le created At 
        $entityInstance->setCreatedAt(new \DateTimeImmutable);

    }

    // Mise à jour de updated 
    public function setUpdatedAt(BeforeEntityUpdatedEvent $event){

        $entityInstance = $event->getEntityInstance();

        if (!$entityInstance instanceof News ) {
            return;
        }

        $entityInstance->setUpdatedAt(new \DateTimeImmutable);
      
    }
}