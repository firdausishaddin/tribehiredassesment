<?php

namespace App\Http\Controllers;

use App\Http\Traits\GuzzleHelper;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use GuzzleHelper;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urlPost = "https://jsonplaceholder.typicode.com/posts/";
        $urlComment = "https://jsonplaceholder.typicode.com/comments/";
        try {
            $posts = collect($this->guzzleGet($urlPost));
            $comments = collect($this->guzzleGet($urlComment));

            $commentGroup = $comments->groupBy('postId');
            $commentCount = $commentGroup->map(function ($item, $key) use ($posts) {
                $post = $posts->where('id', $key)->first();
                return [
                    'post_id' => $post->id,
                    'post_title' => $post->title,
                    'post_body' => $post->body,
                    'total_number_of_comments' => $item->count()
                ];
            });

            $data = $commentCount->sortBy('count');

            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = "https://jsonplaceholder.typicode.com/posts/{$id}";
        try {
            return $this->guzzleShow($url);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
