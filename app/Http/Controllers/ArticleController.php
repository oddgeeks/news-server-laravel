<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Source;

class ArticleController extends Controller
{
    public function index(Request $request, Source $source) {
        try {
            $client = new Client();

            $req = $client->request('GET','https://newsapi.org/v2/articles', [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
                'query' => [
                    'source'       => $source->id,
                    'apiKey'       => env('NEWSAPI_API_KEY'),
                ],
            ]);

            return response($req);

            // $stream   = $req->getBody();
            // $contents = json_decode($stream->getContents());
            // $articles = collect($contents->articles);

            // $articles->each(function ($article) use ($source) {
            //     $ng_article = Article::updateOrCreate(['url' => $article->url],
            //     [
            //         'source_id'      => $source->id,
            //         'author'         => $article->author,
            //         'title'          => $article->title,
            //         'description'    => $article->description,
            //         'url'            => $article->url,
            //         'urlToImage'     => $article->urlToImage,
            //     ]);
            // });


            // return Article::where('source_id', $source->id)->get();
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function show(Request $request, Source $source, Article $article) {
        return $article;
    }
}
