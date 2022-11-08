<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'type' => 'people',
            'id' => $this->id,
            'name' => $this->name,
            'links' => [
                'self' => route('authors', $this->id),
            ],
        ];
    }
}
