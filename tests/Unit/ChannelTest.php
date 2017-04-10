<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChannelTest extends TestCase {

    use DatabaseMigrations;

    /** @test */
    public function a_channel_consiste_of_treads() {
        $channel = create('App\Channel');
        
        $tread = create('App\Tread', ['channel_id' => $channel->id]);
        
        $this->assertTrue($channel->treads->contains($tread));
    }



}


