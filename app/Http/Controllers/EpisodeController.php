<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Episode;
use App\Models\Location;
use App\Models\Origin;
use App\Services\EpisodeService;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EpisodeController extends Controller
{
    private $episodeService;

    public function __construct(EpisodeService $episodeService)
    {
        $this->episodeService = $episodeService;
    }

    public function __invoke()
    {
        $episodes = $this->episodeService->get();
        return view('index', compact('episodes'));
    }

}
