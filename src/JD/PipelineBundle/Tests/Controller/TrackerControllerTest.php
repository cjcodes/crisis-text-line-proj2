<?php

namespace JD\PipelineBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrackerControllerTest extends WebTestCase
{
    public function testTrack()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/track');
    }

}
