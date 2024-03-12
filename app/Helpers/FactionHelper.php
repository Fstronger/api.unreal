<?php

namespace App\Helpers;

use App\Models\RefFactions;
use App\Models\RefHeroesFactions;

class FactionHelper
{

    protected RefFactions $faction;

    public function __construct(RefFactions $faction)
    {
        $this->faction = $faction;
    }

    /**
     * Получение Героев фракции
     * @return array
     */
    public function getFactionHeroes(): array
    {
        $factionHeroes = $this->faction->heroes;
        $heroes = [];
        foreach ($factionHeroes as $factionHero) {
            $heroes[] = [
                'id' => $factionHero->id,
                'name' => $factionHero->name,
                'description' => $factionHero->description,
                'image' => $factionHero->image,
                'characteristics' => $this->getFactionHeroesCharacteristic($factionHero)
            ];

        }

        return $heroes;
    }

    /**
     * Получение характеристик Героев фракции
     * @param RefHeroesFactions $heroesFactions
     * @return array
     */
    public function getFactionHeroesCharacteristic(RefHeroesFactions $heroesFactions): array
    {
        $characteristics = $heroesFactions->characteristics;
        $heroesCharacteristics = [];
        foreach ($characteristics as $characteristic) {
            $heroesCharacteristics[] = [
                'name' => $characteristic->characteristicName->name,
                'icon' => $characteristic->characteristicName->icon,
                'amount' => $characteristic->amount
            ];
        }

        return $heroesCharacteristics;
    }

}
