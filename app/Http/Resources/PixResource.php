<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PixResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'QRcode' => $this->encodedImage,
            'copiaCola' => $this->payload,
            'expiraEm' => $this->expirationDate
        ];
    }
}
