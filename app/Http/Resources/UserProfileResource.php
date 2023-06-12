<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\RoleResource;
class UserProfileResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email'=>$this->email,
            'device_name'=>$this->device_name,
            'role'=> new RoleResource($this->role),
            'country'=> new  CountryResource($this->country),
           // 'country'=>$this->country_id,

            
        ];


    }
}