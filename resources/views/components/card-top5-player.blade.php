@php
    use App\Models\Player;
@endphp
<a class="" style="text-decoration: none;color:#21324C" href="{{ route('ranking.detail', ['id' => $player->id]) }}">
    <div class="card-top5-player animate__animated animate__slideInDown flex ">
        <div class="card-top5-left">
            <span class="number-ranking">#{{ $top }}</span>
            <img class="img-player" src="{{ asset('images/fedor.webp') }}" alt="">
        </div>
        <div class="card-top5-right ">
            <span class="name-player ">{{ $player->name }}</span>
            <span>{{ number_format(Player::get_money($player->id), 0, ',', '.') . ' VNĐ' }}</span>
        </div>
    </div>

</a>
