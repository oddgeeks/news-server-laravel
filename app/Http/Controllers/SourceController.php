<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Source;
use GuzzleHttp\Client;

class SourceController extends Controller
{
    public function index(Request $request) {
        $client = new Client();
        $req = $client->request('GET','https://newsapi.org/v1/sources', [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ]);

        $stream   = $req->getBody();
        $contents = json_decode($stream->getContents());
        $sources = collect($contents->sources);

        $sources->each(function ($source) {
            $ng_source = Source::updateOrCreate(['id' => $source->id],
            [
                'category'       => $source->category,
                'description'    => $source->description,
                'url'            => $source->url,
                'language'       => $source->language,
                'country'        => $source->country,
            ]);
        });

        return Source::all();

    }

    public function show(Request $request, Source $source) {
        return $source;
    }
}
