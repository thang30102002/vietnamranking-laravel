<a class="" style="text-decoration: none;color:#21324C" href="{{ route('ranking.detail', ['id' => $player->id]) }}">
    <div class="card-top5-player animate__animated animate__slideInDown">
        <div class="card-top5-left">
            <span class="number-ranking">#{{ $top }}</span>
            <img class="img-player" src="{{ asset('images/fedor.webp') }}" alt="">
            <span class="name-player ">{{ $player->name }}</span>
        </div>
        <div class="card-top5-right">

            <span>{{ $player->achievement[0]->tournament_top_money->money }} VND</span>
        </div>
    </div>
   
</a>
