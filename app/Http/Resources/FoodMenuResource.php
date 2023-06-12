<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\FoodMenuImageResource;

class FoodMenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      //  return parent::toArray($request);

    
      return [
                'id'=>$this->id,
                'user_id'=>$this->user_id,
                'food_title'=>$this->food_title,
                'food_description'=>$this->food_description,
                'veg_status'=>$this->veg_status,
                'vender_price'=>$this->vender_price,
                'customer_price'=>$this->customer_price,
                'discount_per'=>$this->discount_per,
                'menu_profile_img_id'=>$this->menu_profile_img_id,
                'active_status'=>$this->active_status,
                'images'=> new  FoodMenuImageResource($this->images),

            ];
    }
}