<div class="top-5-player grid grid-rows-5 gap-2 min-h-[500px]">
    @php
        $top = 1;
    @endphp
    @foreach ($players_top_5 as $player)
        <x-card-top5-player :player="$player" :top="$top" />
        @php
            $top++;
        @endphp
    @endforeach
</div>
