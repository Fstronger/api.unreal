<?php

namespace App\Http\Resources;

use App\Helpers\FactionHelper;
use App\Models\RefFactions;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FactionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $faction = RefFactions::where('id', $this->id)->first();
        $factionHelper = new FactionHelper($faction);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
//            'heroes' => $factionHelper->getFactionHeroes()
        ];
    }
}
