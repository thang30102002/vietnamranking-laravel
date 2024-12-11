@php
    use Carbon\Carbon;
@endphp
<div class="antialiased font-sans animate__animated animate__slideInUp">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-center">
            <div class="w-full">
                <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                    <div class="bg-cover bg-center h-56 p-4"
                        style="background-image: url({{ asset('images/organizer/bi-a.jpg') }})">
                        <div class="flex justify-end">
                            <svg class="h-6 w-6 text-white fill-current" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12.76 3.76a6 6 0 0 1 8.48 8.48l-8.53 8.54a1 1 0 0 1-1.42 0l-8.53-8.54a6 6 0 0 1 8.48-8.48l.76.75.76-.75zm7.07 7.07a4 4 0 1 0-5.66-5.66l-1.46 1.47a1 1 0 0 1-1.42 0L9.83 5.17a4 4 0 1 0-5.66 5.66L12 18.66l7.83-7.83z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div id="information{{ $organizer->id }}"
                        class="content-wrapper relative overflow-hidden max-h-[150px]">
                        <div class="p-4">
                            <p class="uppercase tracking-wide text-sm font-bold text-gray-700">{{ $organizer->name }}
                            </p>
                            <p class="text-1xl text-gray-900"><span class="font-bold">Thể loại:
                                </span>{{ $organizer->tournament_game_type->game_type->name }}</p>
                            <p class="text-1xl text-gray-900"><span class="font-bold">Hạng:</span>
                                @foreach ($organizer->ranking_tournament as $ranking_tournament)
                                    {{ $ranking_tournament->ranking->name }}
                                @endforeach
                            </p>
                            <p class="text-1xl text-gray-900"><span class="font-bold">Lệ phí:</span>
                                <span class="">{{ number_format($organizer->fees, 0, ',', '.') . ' VNĐ' }}</span>
                            </p>
                            <p class="text-1xl text-gray-900"><span class="font-bold">Thời gian:</span>
                                {{ Carbon::parse($organizer->start_date)->locale('vi')->isoFormat('D [tháng] M [năm] YYYY') }}
                            </p>
                            <p class="text-1xl text-gray-900"><span class="font-bold">Địa điểm:</span>
                                {{ $organizer->address }}</p>
                            <p class="text-1xl text-gray-900"><span class="font-bold">Số lượng:</span>
                                {{ $organizer->number_players }}</p>
                            <p class="text-1xl text-gray-900"><span class="font-bold">Quán quân:</span>
                                {{ number_format($organizer->tournament_top_money[0]->money, 0, ',', '.') . ' VNĐ' }}
                            </p>
                            <p class="text-1xl text-gray-900"><span class="font-bold">Á quân:</span>
                                {{ number_format($organizer->tournament_top_money[1]->money, 0, ',', '.') . ' VNĐ' }}
                            </p>
                            <p class="text-1xl text-gray-900"><span class="font-bold">Giải 3:</span>
                                {{ number_format($organizer->tournament_top_money[2]->money, 0, ',', '.') . ' VNĐ' }}
                            </p>
                        </div>

                        <div class="px-4 pt-3 pb-4 border-t border-gray-300 bg-gray-100">
                            <div class="text-xs uppercase font-bold text-gray-600 tracking-wide">Đơn vị tổ chức</div>
                            <div class="flex items-center pt-2">
                                <div class="bg-cover bg-center w-10 h-10 rounded-full mr-3"
                                    style="background-image: url(https://images.unsplash.com/photo-1500522144261-ea64433bbe27?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=751&q=80)">
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">{{ $organizer->admin_tournament->name }}</p>
                                    <p class="text-sm text-gray-700">{{ preg_replace('/(\d{4})(\d{3})(\d{3})/', '$1 $2 $3', $organizer->admin_tournament->phone) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="w-full" id="toggleButton{{ $organizer->id }}">Xem thêm</button>
                    <a id="registerTournament{{ $organizer->id }}"
                        href={{ route('ranking.register_tournament', ['tournament_id' => $organizer->id]) }}
                        class=" block text-center w-full bg-[#E3353E] text-[1rem] font-bold text-white p-2">Đăng ký
                        ngay</a>
                </div>
            </div>
        </div>
    </div>
</div>
