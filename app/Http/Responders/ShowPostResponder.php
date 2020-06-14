<?php

namespace App\Http\Responders;

use App\Models\WinkPostProxy;

class ShowPostResponder
{
    public function handle(WinkPostProxy $post)
    {
        return view('show-post', [
            'post' => $post,
        ]);
    }
}
