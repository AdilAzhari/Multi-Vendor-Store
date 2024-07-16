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
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'image' => $this->image,
            'price' => [
                'original' => $this->price,
                'compare_price' => $this->compare_price,
            ],
            'status' => $this->status,
            'category_id' => $this->category_id,
            'store_id' => $this->store_id,
            'image_url' => $this->image_url,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'store' => new StoreResource($this->whenLoaded('store')),
        ];
    }
}
