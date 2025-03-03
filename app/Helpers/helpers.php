<?php

use App\Models\Player;

if (! function_exists('updateRanking')) {
    /**
     * Định dạng số điện thoại
     *
     * @param int $id
     * @return void
     */

    function updateRanking($id)
    {
        $player = Player::find($id);
        $point = $player->point;
        
        foreach (Player::POINT_RANKING as $key => $value) {
            if ($point == $key) {
                $player->player_ranking->ranking_id = $value;
                break;
            }
        }
        $player->player_ranking->save();
    }
}
