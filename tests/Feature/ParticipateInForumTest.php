<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase {

    use DatabaseMigrations;

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_treads() {
        //Given we have an authenticated user        
        $this->signIn();
//        $user = factory('App\User')->create();
        //An an existing Tread
        $tread = create('App\Tread');

        //When te user adds a reply to the tread
        $reply = make('App\Reply');

        $this->post($tread->path() . ' /replies', $reply->toArray());


        //Then their reply should be visible on the page
        $this->get($tread->path())
                ->assertSee($reply->body);
    }
    
    

}
