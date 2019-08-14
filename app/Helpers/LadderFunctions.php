<?php
namespace App\Helpers;

class LadderFunctions
{
    /**
     * Functions by Mitchel
     */

    private function sortScores($scores)
    {
        $i = 1;
        while ($i < count($scores)) {
            $x = $scores[$i];
            $j = $i - 1;
            while ($j >= 0 && ($scores[$j][2] < $x[2] || ($scores[$j][2] == $x[2] && strcmp(md5($scores[$j][3]), md5($x[3])) <= 0))) {
                if ($scores[$j][2] == $x[2] && strcmp(md5($scores[$j][3]), md5($x[3])) == 0) {
                    exit("Something really rare happened. Nice. Please tell someone to fix the tiebreaker in sortScores().");
                }
                $scores[$j+1] = $scores[$j];
                $j--;
            }
            $scores[$j+1] = $x;
            $i++;
        }
        return $scores;
    }

    private function sortRung($rung)
    {
        $i = 1;
        while ($i < count($rung)) {
            $x = $rung[$i];
            $j = $i - 1;
            while ($j >= 0 && $rung[$j][2] < $x[2]) {
                $rung[$j+1] = $rung[$j];
                $j--;
            }
            $rung[$j+1] = $x;
            $i++;
        }
        return $rung;
    }

    public function formatRanking($ranking)
    {
        $out = "<pre>\n";
        $out .= "                            Name     Class Score\n";
        $out .= "Rung Place                                      \n";

        foreach ($ranking as $rungnr=>$rung) {
            foreach ($rung as $posnr=>$pos) {
                if ($posnr == 0) {
                    $line = str_pad($rungnr+1, 5).str_pad($posnr+1, 6);
                } else {
                    $line = str_pad("", 5).str_pad($posnr+1, 6);
                }
                $line .= str_pad($pos[0], 21, " ", STR_PAD_LEFT)
                    .str_pad($pos[1], 10, " ", STR_PAD_LEFT)
                    .str_pad($pos[2], 6, " ", STR_PAD_LEFT);
                $out .= $line."\n";
            }
        }
        $out .= "</pre>\n";
        return $out;
    }

    public function updateRanking($oldRanking, $newScores)
    {
        // Prepare new object for updated ranking
        $newRanking = [];
        foreach ($oldRanking as $oldRung) {
            $newRung = [];
            foreach ($oldRung as $score) {
                array_push($newRung, [$score[0], $score[1], 0]);
            }
            array_push($newRanking, $newRung);
        }
        // Sort scores so newcomers are seeded based on score
        $scores = sortScores($newScores);

        // Add the new scores to the ranking, but do not yet rerank
        foreach ($scores as $newScore) {
            // Try to find if this archer is known
            $known = false;
            foreach ($newRanking as &$rung) {
                for ($rungPlace = 0; $rungPlace < count($rung); $rungPlace++) {
                    if ($rung[$rungPlace][0] == $newScore[0]) {
                        // Found the archer!
                        $known = true;
                        if ($rung[$rungPlace][2] < $newScore[2]) {
                            $rung[$rungPlace] = $newScore;
                        }
                        break;
                    }
                }
                if ($known) {
                    break;
                }
            }
            unset($rung);

            // Archer wasn't known, add to end of ladder
            if (!$known) {
                if (count(end($newRanking)) < 3) {
                    array_push($newRanking[count($newRanking) - 1], $newScore);
                } else {
                    array_push($newRanking, [$newScore]);
                }
            }
        }

        // New scores added, now we can rerank
        foreach ($newRanking as &$rung) {
            $rung = sortRung($rung);
        }
        unset($rung);
        $update = [];
        foreach ($newRanking as $rung) {
            $newRung = [];
            for ($i = 0; $i < count($rung); $i++) {
                array_push($newRung, '');
            }
            array_push($update, $newRung);
        }

        // Determine promotions and demotions
        $max_demote = 0;
        for ($i = count($newRanking) - 1; $i >= 0; $i--) {
            for ($p = count($newRanking[$i]) - 1; $p >= 0; $p--) {
                if ($newRanking[$i][$p][2] == 0) {
                    if ($max_demote >= count($newRanking[$i])-$p) {
                        $update[$i][$p] = 'd';
                    }
                } else {
                    $max_demote += 1;
                    if ($i < count($newRanking) - 1 && $p == count($newRanking[$i]) - 1) {
                        if ($newRanking[$i][$p][2] < $newRanking[$i+1][0][2]) {
                            $update[$i][$p] = 'd';
                        }
                    }
                }
            }
        }

        // Apply demotions
        for ($i = count($update) - 2; $i >= 0; $i--) {
            for ($p = count($update[$i]) - 1; $p >= 0; $p--) {
                if ($update[$i][$p] == 'd') {
                    array_unshift($newRanking[$i+1], array_splice($newRanking[$i], $p, 1)[0]);
                }
            }
        }

        // Sort rungs internally
        foreach ($newRanking as &$rung) {
            $rung = sortRung($rung);
        }
        unset($rung);

        // Apply promotions
        for ($i = 0; $i < count($newRanking)-1; $i++) {
            while (count($newRanking[$i]) < 3) {
                for ($j = $i+1; $j < count($newRanking); $j++) {
                    if ($newRanking[$j][0][2] > 0) {
                        break;
                    }
                }
                array_push($newRanking[$i], array_splice($newRanking[$j], 0, 1)[0]);
            }
        }

        // Sort rungs internally
        foreach ($newRanking as &$rung) {
            $rung = sortRung($rung);
        }
        unset($rung);

        return $newRanking;
    }

    public function getAdjustedScore($row)
    {
        $class = $row['class'];
        $nines = $row['nines'];
        $target = $row['target'];
        $date = $row['date'];
        $score = $row['score'];

        if ($class == "Compound") {
            return $score - $nines;
        } elseif ($class == "Bare Bow" && $target == "40cm") {
            if (date('Y-m-d', strtotime($date)) <= date('Y-m-d', strtotime("2018-11-28"))) {
                // Until 2018-11-28 we used a 1.2 modifier.
                return (int)floor($score * 1.2 + 0.5);
            }

            return (int)floor($score * 1.3 + 0.5);
        }

        return $score;
    }
}
