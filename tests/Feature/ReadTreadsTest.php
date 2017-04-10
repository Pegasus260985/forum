<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TreadsTest extends TestCase {

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

}

