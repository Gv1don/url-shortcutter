<?php

namespace App\Http\Controllers;

use App\Models\Click;
use App\Models\ShortLink;

class RedirectController extends Controller
{
    public function __invoke(string $shortCode)
    {
        $link = ShortLink::where('short_code', $shortCode)->firstOrFail();

        Click::create([
            'short_link_id' => $link->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        $link->increment('clicks_count');

        return redirect($link->original_url);
    }
}
