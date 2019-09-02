<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlayGroundTest extends TestCase
{
    /**
     * A test for accessing the graphql playground
     *
     * @return void
     */
    public function testAccessPlayGround()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
