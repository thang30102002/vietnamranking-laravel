<div class="top-10-player">
    @php
        $top = 6;
    @endphp
    @foreach ($players_top_6_from_15 as $player)
        <x-card-top10-player :player="$player" :top="$top" />
        @php
            $top++;
        @endphp
    @endforeach
</div>
