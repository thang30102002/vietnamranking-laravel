@php
    use App\Models\Player;
@endphp
<a class=" min-h-[77px]" style="text-decoration:none;color:#21324C"
    href="{{ route('ranking.detail', ['id' => $player->id]) }}">
    <div class=" h-full card-top5-player animate__animated animate__slideInDown grid grid-cols-[10%_30%_60%] min-h-24">
        <span class="number-ranking text-[1.5rem] sm:text-[3rem] 2xl:text-[5rem]">#{{ $top }}</span>
        @php
            $file_name = 'players/' . $player->id . '/' . $player->img;
        @endphp
        @if (Storage::disk('public')->exists($file_name))
            <img class="img-player p-[5px] overflow-hidden" src="{{ Storage::url($file_name) }}" alt='Ảnh cơ thủ'>
        @else
            <img class="img-player p-[5px] overflow-hidden" src="{{ asset('images/players/player.webp') }}" style="width:100%" alt="Ảnh cơ thủ">
        @endif
        <div
            class=" pl-[10px] card-top5-right w-[54%] md:w-[65%] 2xl:w-[75%] grid sm:grid-rows-2 md:grid-cols-2 md:grid-rows-1 h-full">
            <span
                class="name-player flex items-center text-[#21324C] text-[1rem] sm:text-[1.5rem] 2xl:text-[2rem]">{{ $player->name }}-{{ $player->player_ranking->ranking->name }}</span>
            <div
                class=" grid md:text-right text-left text-[1rem] sm:text-[1.5rem] md:items-center 2xl:absolute 2xl:top-0 2xl:bottom-0 2xl:right-2">
                <span>{{ $player->point }} point</span>
                <span>{{ number_format($player->player_money->money, 0, ',', '.') . ' VNĐ' }}</span>
            </div>
        </div>
    </div>

</a>
