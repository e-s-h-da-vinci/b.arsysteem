<?php
namespace App\Repositories;

use App\Models\LadderRound;
use App\Models\LadderScore;
use App\Models\LadderSeason;
use App\Helpers\LadderFunctions;

class LadderRepository
{
    public function getScoresForSeasonAndRound($season, $round)
    {
        $round = $this->getRound($season, $round);
        if (!is_null($round)) {
            $start = $round->start;
            $end = $round->end;
            var_dump($start);
            var_dump($end);

            $scores = LadderScore::whereBetween('date', [$start, $end])->get();
            echo json_encode($scores);
            die();
        }

        return null;
    }

    public function getRound($season, $round)
    {
        return LadderRound::where(['season_id' => $season, 'round_nr' => $round])->first();
    }
}
