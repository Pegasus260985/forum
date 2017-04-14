<?php

namespace Tests\Feature;

use function array_column;
use function create;
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
    
    /** @test */
    public function a_user_can_filter_treads_by_any_username() {
        
        $this->signIn(create('App\User', ['name' => 'JaimeCastrillo']));
        
        $treadByJaime = create('App\Tread' , ['user_id' => auth()->id()]);
        
        $treadNotByJaime  = create('App\Tread');
        
        $this->get('treads?by=JaimeCastrillo')
                ->assertSee($treadByJaime->title)
                ->assertDontSee($treadNotByJaime->title);
        
    }
    
    /** @test */
    public function a_user_can_filter_treads_by_popularity()

    {
        //Given three treads
        //2 replies, 3 replies no reply
        $treadsWithTwoReplies = create('App\Tread');
        create('App\Reply', ['tread_id' => $treadsWithTwoReplies->id], 2);


        $treadsWithThreeReplies = create('App\Tread');
        create('App\Reply', ['tread_id' => $treadsWithThreeReplies->id], 3);

        $treadsWithNoReplies = $this->tread;

        // when I filter all treads by popularity
        $response = $this->getJson('treads?popular=1')->json();

        //Then they should be returned from most replies to least
        $this->assertEquals([3,2,0], array_column($response, 'replies_count'));

    }
}

