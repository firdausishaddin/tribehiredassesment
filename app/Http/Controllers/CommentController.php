<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\GuzzleHelper;

class CommentController extends Controller
{
    use GuzzleHelper;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = "https://jsonplaceholder.typicode.com/comments";
        try {
            return $this->guzzleGet($url);
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
        //
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

    public function filter(Request $request)
    {
        $urlPost = "https://jsonplaceholder.typicode.com/posts/";
        $urlComment = "https://jsonplaceholder.typicode.com/comments/";

        $comments = collect($this->guzzleGet($urlComment));

        $input = $request->all();
        if (!empty($input)) {
            $comments = $comments->filter(function ($comment, $key) use ($input) {
                $return = true;
                foreach ($input as $column => $value) {
                    // $return =  \Str::contains($comment->$column, $value);
                    $return = $return && \Str::contains($comment->$column, $value);
                    // dump($return);
                }
                return $return;
            });
            return $comments->all();
        } else {
            return response()->json([
                'data' => $comments
            ]);
        }
    }
}
