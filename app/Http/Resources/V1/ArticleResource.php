<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public static $wrap = 'articles';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'type' => 'articles',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'created_at' => $this->created_at,
            ],
            /*'relationships' => [
                'author' => [
                    'links' => [
                        'self' => route('articles.relationships.author', ['article' => $this->id()]),
                        'related' => route('articles.author', ['article' => $this->id()]),
                    ],
                    'data' => new AuthorResource($this->author),
                ],
            ],*/
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
