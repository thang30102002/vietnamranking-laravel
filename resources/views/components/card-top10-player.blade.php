@php
    use App\Models\Player;
@endphp
<div class="card-top10-player">
    <div class="card-top10-left">
        <span class="number-ranking-top10">{{ $top }}</span>
        <span class="name-player">{{ $player->name }}</span>
    </div>
    <div class="card-top10-right">
        <span>{{ number_format(Player::get_money($player->id), 0, ',', '.') . ' VNĐ' }}</span>
    </div>
</div>
