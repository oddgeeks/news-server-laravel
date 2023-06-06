<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request) {
        try {
            return response(['categories' => Category::select('name')->get()], 200);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
