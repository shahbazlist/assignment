<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlRequest;
use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    public function create_shorturl(StoreUrlRequest $request)
    {
        $data = new ShortUrl;
        $data->url = $request->url;
        $data->user_id = Auth::user()->id;
        $data->token = 's/' . Str::random(10);

        $data->save();
        if ($data) {
            return response()->json(['status' => true, 'message' => 'Success']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }

    public function redirect_to_original($token)
    {
        $shortUrl = ShortUrl::where('token', 's/'.$token)->firstOrFail();
        $shortUrl->increment('hits');
        return redirect()->away($shortUrl->url);
    }
}
