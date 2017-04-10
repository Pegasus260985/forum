<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateTreadsTest extends TestCase {

    use DatabaseMigrations;

    /** @test */
    public function guest_may_not_create_treads() {

        $this->expectException('Illuminate\Auth\AuthenticationException');
        
        $tread = make('App\Tread');

        $this->post('/treads', $tread->toArray());
    }

    /** @test */
    public function an_authenticated_user_can_create_new_treads() {
        $this->signIn();

        $tread = make('App\Tread');

        $this->post('/treads', $tread->toArray());

        $this->get($tread->path())
                ->assertSee($tread->title)
                ->assertSee($tread->body);
    }

}
