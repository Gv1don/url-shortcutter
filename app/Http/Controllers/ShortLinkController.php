<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    public function index()
    {
        $links = ShortLink::where('user_id', auth()->id())
            ->withCount('clicks')
            ->latest()
            ->paginate(10);

        return view('links.index', compact('links'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'original_url' => 'required|url|max:2048',
        ]);

        $shortCode = $this->generateUniqueCode();

        ShortLink::create([
            'user_id' => auth()->id(),
            'original_url' => $data['original_url'],
            'short_code' => $shortCode,
        ]);

        return redirect()->route('links.index')
            ->with('success', 'Link created!');
    }

    public function show(ShortLink $link)
    {
        if ($link->user_id !== auth()->id()) {
            abort(403);
        }

        $clicks = $link->clicks()->latest('created_at')->paginate(15);

        return view('links.show', compact('link', 'clicks'));
    }

    public function destroy(ShortLink $link)
    {
        if ($link->user_id !== auth()->id()) {
            abort(403);
        }

        $link->delete();

        return redirect()->route('links.index')
            ->with('success', 'Link deleted!');
    }

    private function generateUniqueCode(): string
    {
        do {
            $code = Str::random(6);
        } while (ShortLink::where('short_code', $code)->exists());

        return $code;
    }
}
