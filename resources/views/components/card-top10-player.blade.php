@php
    use App\Models\Player;
@endphp
<<<<<<< Updated upstream
<div class="card-top10-player">
    <div class="card-top10-left">
        <span class="number-ranking-top10">{{ $top }}</span>
        <span class="name-player">{{ $player->name }}</span>
    </div>
    <div class="card-top10-right">
        <span>{{ number_format(Player::get_money($player->id), 0, ',', '.') . ' VNĐ' }}</span>
    </div>
</div>
=======
<a href="{{ route('ranking.detail', ['id' => $player->id]) }}">
    <div class="card-top10-player relative">
        <div class="card-top10-left">
            <span class="number-ranking-top10 2xl:text-[2.5rem]">#{{ $top }}</span>
            <span
                class="name-player text-[0.7rem] 2xl:text-[1rem]">{{ $player->name }}-{{ $player->player_ranking->ranking->name }}</span>
        </div>
        <div class="card-top10-right absolute right-0">
            <span
                class=" text-[0.7rem] 2xl:text-[1rem]">{{ number_format(Player::get_money($player->id), 0, ',', '.') . ' VNĐ' }}</span>
        </div>
    </div>
</a>
>>>>>>> Stashed changes
