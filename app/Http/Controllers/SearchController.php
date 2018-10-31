<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $psts = Post::where('title', 'like', '%' . $request->keywords . '%' )
                ->orWhere('desc', 'like', '%' . $request->keywords . '%')
                ->with('User')->get();

        return response()->json($psts);
    }
}
