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
        switch (true) {
            case ($point >= 50 && $point < 150):
                // update hạng G
                $player->player_ranking->ranking_id = 8;
                break;

            case ($point >= 150 && $point < 250):
                // update hạng F
                $player->player_ranking->ranking_id = 7;
                break;

            case ($point >= 250 && $point < 400):
                // update hạng E
                $player->player_ranking->ranking_id = 6;
                break;

            case ($point >= 400 && $point < 600):
                // update hạng D
                $player->player_ranking->ranking_id = 5;
                break;

            case ($point >= 600 && $point < 900):
                // update hạng C
                $player->player_ranking->ranking_id = 4;
                break;

            case ($point >= 900 && $point < 1200):
                // update hạng B
                $player->player_ranking->ranking_id = 3;
                break;

            case ($point >= 1200 && $point < 1500):
                // update hạng A
                $player->player_ranking->ranking_id = 2;
                break;

            case ($point >= 1500):
                // update hạng CN
                $player->player_ranking->ranking_id = 1;
                break;

            default:
                // update hạng H
                $player->player_ranking->ranking_id = 9;
                break;
        }
        $player->player_ranking->save();
    }
}
