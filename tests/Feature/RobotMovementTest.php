<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\DataObjects\MovementData;
use Tests\TestCase;

class RobotMovementTest extends TestCase
{
    /**
     * Test robot move post request.
     */
    public function test_the_robot_move_post_request_returns_a_successful_response() : void
    {
        $response = $this->followingRedirects()
            ->withHeaders(['Accept' => 'application/json'])
            ->post(
                route('robot.move', ['xLocation' => 1, 'yLocation' => 1]),
                ['command' => 'N E']
            );

        $response->assertStatus(200);

        $content = $response->getOriginalContent();

        $resultData = $content->getData();

        $movementData = new MovementData(2, 2, [
            [1, 1],
            [1, 2]
        ]);

        $expected = $movementData->toArray();

        $this->assertEquals($resultData, $expected);
    }

    /**
     * Test robot index page.
     */
    public function test_the_robot_index_returns_a_successful_response() : void
    {
        $response = $this->get(route('robot.index'));

        $response->assertStatus(200);
    }
}
