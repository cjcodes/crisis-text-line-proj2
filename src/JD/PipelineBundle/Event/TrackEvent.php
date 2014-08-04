<?php

namespace JD\PipelineBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use JD\PipelineBundle\Entity\Thing;

class TrackEvent extends Event
{
    protected $thing;

    public function __construct(Thing $thing)
    {
        $this->thing = $thing;
    }

    public function getThing()
    {
        return $this->thing;
    }
}