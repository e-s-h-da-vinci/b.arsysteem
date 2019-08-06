<?php
namespace App\Repositories;

use App\Models\Bow;
use App\Models\BowUse;

class BowRepository
{
    public function getAllUsedBows()
    {
        return BowUse::with('bow')->orderBy('updated_at', 'DESC')->limit(20)->get();
    }

    public function getUsedBows($id)
    {
        return BowUse::where(['user_id' => $id])->with('bow')->orderBy('updated_at', 'DESC')->limit(20)->get();
    }

    public function getBows()
    {
        return Bow::all();
    }

    public function addBowUse($id, $bow_id)
    {
        $use = new BowUse();
        $use->user_id = $id;
        $use->bows_id = $bow_id;
        return $use->save();
    }
}
