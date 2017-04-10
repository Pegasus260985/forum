<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateTreadsTest extends TestCase {

    use DatabaseMigrations;

    /** @test */
    public function guest_may_not_create_treads() {

        $this->withExceptionHandling();

        $this->get('/treads/create')
                ->assertRedirect('/login');

        $this->post('/treads', [])
                ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_create_new_treads() {
        $this->signIn();

        $tread = make('App\Tread');


        $response = $this->post('/treads', $tread->toArray());

        $this->get($response->headers->get('Location'))
                ->assertSee($tread->title)
                ->assertSee($tread->body);
    }

    /** @test */
    public function a_tread_requires_a_title() {

        $this->publishTread(['title' => null])
                ->assertSessionHasErrors('title');
    }
    
    
     /** @test */
    public function a_tread_requires_a_body() {

        $this->publishTread(['body' => null])
                ->assertSessionHasErrors('body');
    }
    
    /** @test */
    public function a_tread_requires_a_valid_channel() {
        
        factory('App\Channel', 2)->create();
        
        $this->publishTread(['channel_id' => null])
                ->assertSessionHasErrors('channel_id');
        
         $this->publishTread(['channel_id' => 999])
                ->assertSessionHasErrors('channel_id');
    }
    
    
    

    public function publishTread($overrides) {


        $this->withExceptionHandling()->signIn();

        $tread = make('App\Tread', $overrides);

        return $this->post('/treads', $tread->toArray());
    }

}
