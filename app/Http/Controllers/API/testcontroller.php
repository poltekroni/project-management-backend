<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class testcontroller extends Controller
{
    public function index(){
        return response()->json(['message'=>'message from API controller']);
    }
}
