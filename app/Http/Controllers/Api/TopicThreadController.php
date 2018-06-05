<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

class TopicThreadController extends Controller
{

    /**
     * Returns a nested "thread" of messages within the topic
     *
     * @param Topic $topic
     * @return array
     */
    public function show(Topic $topic)
    {
        return $topic->messages()
            ->with('children')
            ->get()
            ->toArray();
    }
}