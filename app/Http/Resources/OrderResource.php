<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\OrderDetails;
use App\Models\address;
use App\Models\User;

class OrderResource extends JsonResource
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
            'user_id' => User::find($this->user_id),
            'adress_id' => address::find($this->adress_id),
            'final_price' => $this->final_price,
            'order_details' => OrderDetails::where('order_id', '=', $this->id)->latest()->get(),
        ];
    }
}
