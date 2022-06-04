<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Jobs\StoreBlogPostJob;
use App\Constants\PostConstants;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Post\CreatePostRequest;

class PostController extends Controller
{
    /**
     * show all user's posts
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $perPage = 10;
        
        $posts = Post::where('user_id', auth()->id())
            ->with(['user'])
            ->sortColumn($request->sort ?? 'publication_date', $request->order ?? "desc")
            ->latest('publication_date')
            ->paginate($perPage)
            ->appends($request->all());
            
        return view('blogs.posts.index')
            ->with('posts', $posts)
            ->with('sortParams', PostConstants::SORT_PARAMETERS)
            ->with('sortOrders', PostConstants::SORT_ORDERS);
    }

    /**
     * show a post resource
     *
     * @param Post $post
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Post $post)
    {
        $post->load('user');

        return view('blogs.posts.show')
            ->with('post', $post);
    }

    /**
     * show create post form
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('blogs.posts.create');
    }

    /**
     * handles the creation of new post
     *
     * @param CreatePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePostRequest $request)
    {
        try {
            
            $data = $request->validated() + ['user_id' => auth()->id()];
            
            StoreBlogPostJob::dispatch($data)
                ->onQueue('high');

            return redirect()->route('posts.index')
                ->with('success', 'Your post is processing and will be published in a bit');

        } catch (\Throwable $th) {
            
            Log::error($th->getMessage());

            return redirect()->back()
                ->withInput()
                ->withErrors('Something went wrong! Kindly try again');
        }
    }
}
