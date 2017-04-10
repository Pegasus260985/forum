<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadTreadsTest extends TestCase {

    use DatabaseMigrations;

    public function setUp() {
        parent::setUp();
        $this->tread = create('App\Tread');
    }

    /** @test */
    public function a_user_can_view__all_treads() {
        $response = $this->get('/treads');

        $response->assertSee($this->tread->title);
    }

    /** @test */
    public function a_user_read_a_single_tread() {
        $this->signIn();
        $this->get($this->tread->path())
                ->assertSee($this->tread->title);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_tread() {
//        $reply = factory('App\Reply')->create(['tread_id' => $this->tread->id]);
        $reply = create('App\Reply', ['tread_id' => $this->tread->id]);
        $this->get($this->tread->path())
                ->assertSee($reply->body);
    }

    /** @test */
    public function a_user_cam_fiter_tread_according_to_a_channel() {
        $channel = create('App\Channel');
        
        $treadInChannel = create('App\Tread', ['channel_id' => $channel->id]);
        $treadNotChannel = create('App\Tread');
        
        
        $this->get('/treads/' . $channel->slug)
                ->assertSee($treadInChannel->title)
                ->assertDontSee($treadNotChannel->title);
    }
}

