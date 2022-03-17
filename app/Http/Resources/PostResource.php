<?php

namespace App\Http\Resources;

use Auth;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'author' => $this->author,
            'created_at' => $this->created_at,
            'comments' => $this->comments
        ];
    }

    /**
     * @param $request
     * @return array
     */
    public function with($request): array
    {
        return [
            'version' => "1.0",
        ];
    }
}
