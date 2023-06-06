<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function setConfig (Request $req) {
        try {
            $user = Auth::user();
            return $user;
            $user->author =  $req['data']['author'];
            $user->category =  $req['data']['category'];
            $user->source =  $req['data']['source'];
            $user->save();

            return response([
                'author' => $user->author, 
                'category' => $user->category,
                'source' => $user->source 
            ], 200);
        } catch (Exeption $e) {
            return response($e, 500);
        }
    }

    public function getConfig (Request $req) {
        try {
            $user = Auth::user();
            if ($user !== null) {
                return response([
                    'author' => $user->author? $user->author : '', 
                    'category' => $user->category? $user->category: '',
                    'source' => $user->source? $user->source: '' 
                ], 200);
            }
        } catch (Exception $e) {
            return response($e, 500);
        }
    }
}
