<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TreadTest extends TestCase {

    use DatabaseMigrations;
    
    protected  $tread;

    public function setUp() {
        parent::setUp();

        $this->tread = factory('App\Tread')->create();
    }

    /** @test */
    public function a_thread_has_replies() {
        $this->assertInstanceOf(
                '\Illuminate\Database\Eloquent\Collection', $this->tread->replies
        );
    }
    
    /** @test */
    public function a_tread_has_a_creator() {
        $this->assertInstanceOf('App\User', $this->tread->owner);
    }

    /** @test */
    public function a_tread_can_add_a_reply() {
        $this->tread->addReply([
           'body' => 'foobar',
            'user_id' => 1
        ]);
        
        $this->assertCount(1, $this->tread->replies);
    }
}
