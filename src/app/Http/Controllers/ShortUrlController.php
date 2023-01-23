<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;

class ShortUrlController extends Controller
{
    //
    public function index() {
        return view('upload');
    }

    public function create(Request $request) {
        $input_url = $request->input('url');
        if(!$input_url) {
            return back()->with('error','URL must be a valid non-blank value.');
        }

        /*
            There are better ways to architect this, but we'll make 5 tries at random slug checks. 
            If it fails, return back with an error.
        */
        for($i = 0; $i < 5; $i++) {
            $slug = $this::generate_short_slug();
            if(!ShortUrl::where('slug', '=', $slug)->exists()) {
                $shortened_url = new ShortUrl();
                $shortened_url->slug = $slug;
                $shortened_url->long_url = $input_url;
                $shortened_url->save();

                $base_site_url = url('/');
                $final_url = $base_site_url . '/custom/' . $slug; // This can easily be a computed attribute on our Eloquent models
                return back()->with('success', 'Successfully generated shortened URL: '.$final_url);
            } 
        }
        return back()->with('error', 'Failed to generate a random slug after five tries; may consider refactoring.');
    }

    public function delete(Request $request) {

    }

    public function update(Request $request) {

    }

    public function redirect(Request $request, $slug) {
        // Find one by that slug, if found, redirect else throw 404.
        $short_urls = ShortUrl::where('slug', '=', $slug)->get();
        foreach($short_urls as $short_url) {
            return redirect($short_url->long_url);
        }

        abort(404);
    }

    public static function generate_short_slug($length=5) {
        // We like to keep this one simple; we'll just use a hexadecimal string, randomly generated
        return bin2hex(random_bytes($length));
    }
}
