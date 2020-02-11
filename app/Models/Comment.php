<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use GuzzleHttp\Client;


class Comment extends JsonResource
{
    const ENDPOINT = "https://jsonplaceholder.typicode.com/comments";

    public static function fromSource() {
        $client = new Client(); //GuzzleHttp\Client
        $result = $client->get(self::ENDPOINT);
        $data = collect(json_decode($result->getBody()->getContents()));
        // return new self($data);
        return self::collection($data);
    }

    public function toArray($input)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'body' => $this->body,
            'comments' => Comment::fromSource()->where('postId', $this->id)
            // 'total_number_of_comments' => $item->count()
        ];
    }
}
