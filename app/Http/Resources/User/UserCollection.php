<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user' => UserResource::collection($this->collection),
            'paginate' => [
                'current_page' => $this->resource->currentPage(),
                'num_page' => $this->resource->lastPage(),
                'total' => $this->resource->total()
            ]
        ];
    }
}