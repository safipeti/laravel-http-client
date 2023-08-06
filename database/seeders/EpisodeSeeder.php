<?php

namespace Database\Seeders;

use App\Models\Episode;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

class EpisodeSeeder extends Seeder
{
    const RESOURCE_EPISODE = 'https://rickandmortyapi.com/api/episode';

    public function run()
    {
        $response = Http::get(self::RESOURCE_EPISODE);
        if (($pagesCount = $response->object()->info->pages) < 1) {
            abort(404);
        }
        Http::pool(function (Pool $pool) use($pagesCount) {

            return collect()
                ->range(1, $pagesCount)
                ->map(function($p) use($pool) {
                    $pool->get(self::RESOURCE_EPISODE . '?page=' . $p)
                    ->then(function ($response) {
                        foreach ($response->object()->results as $e) {
                            $episode = Episode::create([
                                'id' =>  $e->id,
                                'name' => $e->name,
                                'air_date' => (new DateTime($e->air_date))->format( "Y-m-d"),
                                'episode' => $e->episode,
                                'url' => $e->url,
                                'created' => date('Y-m-d h:i:s', strtotime($e->created))
                            ]);

                            $characterIds = array_map(function ($character) {
                                return substr($character, strripos($character, '/') + 1);
                            }, $e->characters);

                            $episode->characters()->attach($characterIds);
                        }
                    })->wait();
                });
        });
    }
}
