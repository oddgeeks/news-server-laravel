<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Source;
use App\Models\Category;

class SourceController extends Controller
{
    public function index(Request $request) {
        try {
            $category = $request['category'];
            $res = Http::get('https://newsapi.org/v2/top-headlines/sources', [
                'apiKey' => env('NEWSAPI_API_KEY'),
                'category' => $request['category']
            ]);
            $sources = $res['sources'];
            
            foreach ($sources as $source) {
                $ng_source = Source::updateOrCreate(
                    ['name' => $source['name']],
                    [
                        'slug' => $source['id'],
                        'name' => $source['name'],
                        'description'    => $source['description'],
                        'url'            => $source['url'],
                        'category'       => $source['category'],
                        'language'       => $source['language'],
                        'country'        => $source['country'],
                    ]);
            }
            return response(['sources' => ($request['category'] == 'all')? Source::select('name')->get(): Source::where('category', $request['category'])->select('name')->get()], 200);
        } catch (Exception $e) {
            return response($e->getMessage());
        }
    }
}
