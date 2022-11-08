<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public static $wrap = 'articles';

    public function toArray($request)
    {
        return [
            'type' => 'articles',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'body' => $this->body,
                'created_at' => $this->created_at,
            ],

            'relationships' => [
                'author' =>  new AuthorResource($this->author),
            ],
            'links' => [
                'self' => route('articles.show', ['article' => $this->id]),
                'related' => route('articles.show', ['article' => $this->slug]),
            ],
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'success',
        ];
    }

    public function withResponse($request, $response)
    {
        $response->header('Accept', 'application/json');
    }
}
