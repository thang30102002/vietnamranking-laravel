@php
    use App\Models\Player;
@endphp
<a href="{{ route('posts.getPlayerPost', ['id' => $player->user->id]) }}">
    <div class="card-top10-player relative">
        <div class="card-top10-left">
            <span class="number-ranking-top10 text-[0.7rem] sm:text-[1rem] 2xl:text-[2.5rem]">#{{ $top }}</span>
        </div>
        <div class="card-top10-right flex flex-col">
            <span
                class="name-player text-[#fff] text-[0.7rem] sm:text-[1rem]">{{ $player->name }}-{{ $player->player_ranking->ranking->name }}</span>
            <span
                class=" text-[0.7rem] sm:text-[1rem] text-right">{{ number_format($player->player_money->money, 0, ',', '.') . ' VNĐ' }}</span>
        </div>
    </div>
</a>
