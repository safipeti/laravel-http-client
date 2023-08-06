<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Seeder;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

class CharacterSeeder extends Seeder
{
    const RESOURCE_CHARACTER = 'https://rickandmortyapi.com/api/character';

    public function run()
    {
        $response = Http::get(self::RESOURCE_CHARACTER);
        if (($pagesCount = $response->object()->info->pages) < 1) {
            abort(404);
        }
        Http::pool(function (Pool $pool) use($pagesCount) {

            return collect()
                ->range(1, $pagesCount)
                ->map(function($p) use($pool) {
                    $pool->get(self::RESOURCE_CHARACTER . '?page=' . $p)
                        ->then(function ($response) {
                            foreach ($response->object()->results as $ch) {
                                Character::create([
                                    'id' => $ch->id,
                                    'name' => $ch->name,
                                    'status' => $ch->status,
                                    'species' => $ch->species,
                                    'type' => $ch->type,
                                    'gender' => $ch->gender,
                                    'origin_id' => $ch->origin->url !== '' ? substr($ch->origin->url, strripos($ch->origin->url, '/') +1) : null,
                                    'location_id' => $ch->location->url !== '' ?  substr($ch->location->url, strripos($ch->location->url, '/') +1) : null,
                                    'image' => $ch->image,
                                    'url' => $ch->url,
                                    'created' => date('Y-m-d h:i:s', strtotime($ch->created)),
                                ]);
                            }
                        })->wait();
                });
        });
    }
}
