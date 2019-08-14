<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LadderRepository;

class LadderController extends Controller
{
    private $ladderRepo;
    public function __construct(LadderRepository $lr)
    {
        $this->ladderRepo = $lr;
    }

    public function listScores(Request $request)
    {
        $season = $request->season;
        $round = $request->round;

        $this->ladderRepo->getScoresForSeasonAndRound($season, $round);

        return view(
            'pages.ladder',
            [
                'seasons' => [
                    [
                        'id' => 0,
                        'name' => "2018-2019"
                    ],
                    [
                        'id' => 1,
                        'name' => "2019-2020"
                    ]
                ],
                'rounds' => [
                    [
                        'id' => 0,
                        'round_nr' => 0
                    ],
                    [
                        'id' => 1,
                        'round_nr' => 1
                    ]
                ]
            ]
        );
    }
}
