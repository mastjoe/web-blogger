<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Constants\PostConstants;

class BlogController extends Controller
{
    /**
     * shows all blogs
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = 10;

        $posts = Post::with(['user'])
            ->sortColumn($request->sort ?? 'publication_date', $request->order ?? 'desc')
            ->paginate($perPage)
            ->appends($request->all());
            
        return view('blogs.index')
            ->with('posts', $posts)
            ->with('sortParams', PostConstants::SORT_PARAMETERS)
            ->with('sortOrders', PostConstants::SORT_ORDERS);
    }
}
