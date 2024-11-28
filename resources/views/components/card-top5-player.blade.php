@php
    use App\Models\Player;
@endphp
<a class=" " style="text-decoration:none;color:#21324C" href="{{ route('ranking.detail', ['id' => $player->id]) }}">
    <div class=" h-[90%] card-top5-player animate__animated animate__slideInDown grid grid-cols-[10%_30%_60%]">
        <span class="number-ranking sm:text-[3rem] 2xl:text-[5rem]">#{{ $top }}</span>
        <img class="img-player p-[5px]" src="{{ asset('images/players/'.$player->img.'') }}" alt="">
        <div class="card-top5-right w-[54%] md:w-[65%] 2xl:w-[75%] grid sm:grid-rows-2 md:grid-cols-2 md:grid-rows-1 h-full">
            <span class="name-player flex items-center text-[#21324C] sm:text-[1.5rem] 2xl:text-[2rem]">{{ $player->name }}</span>
            <span class=" md:text-right text-left sm:text-[1.5rem] flex md:items-center 2xl:absolute 2xl:top-0 2xl:bottom-0 2xl:right-2">{{ number_format(Player::get_money($player->id), 0, ',', '.') . ' VNĐ' }}</span>
        </div>
    </div>

</a>
