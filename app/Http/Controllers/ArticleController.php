<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Source;
use App\Models\User;

class ArticleController extends Controller
{
    public function index(Request $request) {
        return env('NEWSAPI_API_KEY');
        try {
            $user = Auth::user();
            $params = [
                'apiKey' => env('NEWSAPI_API_KEY'),
                'pageSize' => '10',
                'page' => $request['page']
            ];
            if ($user->author) {
                $params['author'] = $user->author;
            }
            if ($user->source) {
                $params['source'] = $user->source;
            }
            if ($user->source) {
                $params['category'] = $user->category;
            }
            if (!$user->author && !$user->source && !$user->category) {
                return response(['articles' => [], 'error' => $e->getMessage()], 500);
            }
            $res = Http::get('https://newsapi.org/v2/top-headlines', [
                'apiKey' => env('NEWSAPI_API_KEY'),
                'author' => $user->author, 
                'category' => $user->category,
                'source' => $user->source,
                'pageSize' => '10',
                'page' => $request['page']
            ]);

            return response(['articles' => $res['articles']], 200);
        } catch (Exception $e) {
            return response(['articles' => [], 'error' => $e->getMessage()], 200);
        }
    }

    public function filter(Request $request) {
        try {
            $filterParams = [
                'apiKey' => env('NEWSAPI_API_KEY'),
                'sortBy' => 'popularity',
                'from' => explode('T', $request['from'])[0],
                'to' => explode('T', $request['to'])[0],
                'pageSize' => '10',
                'page' => $request['page'],
                'q'=> $request['keyword']
            ];
            if ($request['source'] != 'all') 
                $filterParams['source'] = $request['source'];
            $res = Http::get('https://newsapi.org/v2/everything/', $filterParams);

            return response($res);
        } catch (Exception $e) {
            return response(['articles' => [], 'error' => $e->getMessage()], 500);
        }
    }
}
