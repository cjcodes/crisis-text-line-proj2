<?php

namespace JD\TriggerBundle\EventListener;

use Symfony\Component\EventDispatcher\Event;

class TrackerListener
{
    public function onThingTracked(Event $event)
    {
        // Extract Thing Entity from event object

        // Check if count is 0

        // Send mail if 0
        $this->sendEmail($thing);
    }

    private function sendEmail($thing)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Low Inventory')
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody(
                $this->renderView(
                    'TriggerBundle:Email:email.txt.twig',
                    array('name' => $thing->getName())
                )
            )
        ;
        $this->get('mailer')->send($message);

        return $this->render(...);
    }
}