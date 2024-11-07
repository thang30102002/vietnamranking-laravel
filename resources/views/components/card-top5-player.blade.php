<a style="text-decoration: none;color:#21324C" href="{{ route('ranking.detail',['id' => $player->id]) }}">
    <div class="card-top5-player">
        <div class="card-top5-left">
            <span class="number-ranking">#{{ $top }}</span>
            <img class="img-player" src="{{ asset('images/fedor.webp') }}" alt="">
            <span class="name-player">{{ $player->name }}</span>
        </div>
        <div class="card-top5-right">
            <span>5000.000.000 VND</span>
        </div>
    </div>

</a>
