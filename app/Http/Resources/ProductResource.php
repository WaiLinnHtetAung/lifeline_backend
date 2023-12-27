<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "price" => $this->price,
            "image" => $this->media ? $this->media[0]->original_url : '',
            "principle_id" => $this->principle->id,
            "principle_name" => $this->principle->name,
            "principle_country" => $this->principle->country,
            "category_id" => $this->category->id,
            "category" => $this->category->name,
            "ingredients" => array_map(function ($item) {
                return $item['name'];
            }, $this->ingredients->toArray())
        ];
    }
}