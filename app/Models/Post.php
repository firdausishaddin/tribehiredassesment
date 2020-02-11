<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\Resources\Json\JsonResource;
use GuzzleHttp\Client;

class Post extends JsonResource
{

    const ENDPOINT = "https://jsonplaceholder.typicode.com/posts";

    public static function fromSource() {
        $client = new Client(); //GuzzleHttp\Client
        $result = $client->get(self::ENDPOINT);
        $data = collect(json_decode($result->getBody()->getContents()));
        // return new self($data);
        return self::collection($data);
    }

    public function toArray($request)
    {
        // dd($this);

        return [
            'ids' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'body' => $this->body,
            'comments' => Comment::collection(Comment::fromSource())
            // 'total_number_of_comments' => $item->count()
        ];
    }

    public function with($request)
    {
        return [
            'comments' => Comment::collection(Comment::fromSource()),
        ];
    }
}
