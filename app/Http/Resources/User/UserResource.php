<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'avatar' => $this->avatar ? Storage::disk('s3')->url($this->avatar) : '',
            'role' => 'user',
            'full_name' => $this->first_name . ' ' . $this->last_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'furigana_first_name' => $this->furigana_first_name,
            'furigana_last_name' => $this->furigana_last_name,
            'tel' => $this->tel,
            'fax' => $this->fax,
            'agree_description' => $this->agree_description,
            'travel_agency' => new TravelAgencyResource($this->travelAgency),
        ];
    }
}
