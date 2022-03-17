<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'author' => $this->author,
            'post_id' => $this->post_id,
            'created_at' => $this->created_at
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
