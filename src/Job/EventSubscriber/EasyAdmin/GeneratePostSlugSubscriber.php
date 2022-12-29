<?php

namespace App\Job\EventSubscriber\EasyAdmin;

use App\Entity\Blog\Post;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

final readonly class GeneratePostSlugSubscriber implements EventSubscriberInterface
{
    public function __construct(private SluggerInterface $slugger)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['generatePostSlug'],
        ];
    }

    public function generatePostSlug(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Post)) {
            return;
        }

        $slug = $this->slugger->slug($entity->getTitle())->lower();
        $entity->setSlug($slug);
    }
}