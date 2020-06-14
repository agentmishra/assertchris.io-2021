<?php

namespace App\Http\Responders;

use Wink\WinkPost;

class ShowHomeResponder
{
    public function handle()
    {
        $posts = WinkPost::latest()
            ->published()
            ->simplePaginate(10);

        return view('show-home', [
            'posts' => $posts,
        ]);
    }
}
