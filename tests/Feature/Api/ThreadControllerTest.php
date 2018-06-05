<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\TopicThreadController;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class ThreadControllerTest extends TestCase
{
    /**
     * Test to see if show() gives us messages
     *
     * @return void
     */
    public function testIfShowMethodReturnsMessages()
    {
        // Create our topics for testing
        factory(\App\Models\Topic::class, 3)->create();
        factory(\App\Models\Message::class, 50)->create();

        $class = App::make(TopicThreadController::class);

        // Retrieve a topic to test against
        $topic = \App\Models\Topic::inRandomOrder()->first();

        $messages = $class->show($topic);

        $this->assertInternalType('array', $messages);
    }

    /**
     * Test to see if a message has the "children" attribute
     *
     * @return void
     */
    public function testMessageCanHaveChildren()
    {
        // Create our topics for testing
        factory(\App\Models\Topic::class, 3)->create();
        factory(\App\Models\Message::class, 50)->create();

        $class = App::make(TopicThreadController::class);

        // Retrieve a topic to test against
        $topic = \App\Models\Topic::inRandomOrder()->first();

        $messages = $class->show($topic);

        foreach ($messages as $message) {
            $this->assertArrayHasKey('children', $message);
        }
    }
}
