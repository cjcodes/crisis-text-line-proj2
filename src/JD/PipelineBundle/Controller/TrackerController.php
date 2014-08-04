<?php

namespace JD\PipelineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JD\PipelineBundle\Entity\Thing;
use JD\PipelineBundle\Event\TrackEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

class TrackerController extends Controller
{
    protected $dispatcher = null;

    public function __construct()
    {
        $this->dispatcher = new EventDispatcher();
    }

    public function trackAction($name, $count, $direction)
    {
        $thing = $this->getDoctrine()
            ->getRepository('PipelineBundle:Thing')
            ->findOneBy(array('name' => $name));

        if (!$thing) {
            $thing = $this->declareThing($name);
            $this->storeThing($thing);
        } else {
            $this->updateThing($thing, $count, $direction);
        }

        $this->emitTrackEvent($thing);

        return $this->render('PipelineBundle:Tracker:track.html.twig', array('name' => $name));
    }

    private function emitTrackEvent($thing)
    {
        $event = new TrackEvent($thing);
        $this->dispatcher->dispatch('thing.tracked', $event);
    }

    private function declareThing($name)
    {
        $thing = new Thing();
        $thing->setName($name);
        $thing->setCount(0);
        return $thing;
    }

    private function storeThing($thing)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($thing);
        $em->flush();
    }

    private function updateThing($thing, $count, $direction)
    {
        $currentCount = $thing->getCount();

        if ($direction === 'up') {
            $thing->setCount($currentCount + $count);
        } else if ($direction === 'down') {
            $thing->setCount($currentCount - $count);
        }
        $this->storeThing($thing);
    }

}
