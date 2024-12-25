<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Chỉnh sửa giải đấu</title>
    <link rel="icon" href="{{ asset('images/VietNamPool.png') }}" type="image/x-icon">
    {{-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png"> --}}
    <link rel="stylesheet" href="{{ asset('images/adminTournament/favicon.png') }}">

    {{-- <link rel="stylesheet" href="assets/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/adminTournament/bootstrap.min.css') }}">

    {{-- <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/adminTournament/fontawesome.min.css') }}">
    {{-- <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/adminTournament/all.min.css') }}">
    {{-- <link rel="stylesheet" href="assets/css/feathericon.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/adminTournament/feathericon.min.css') }}">

    <link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
    {{-- <link rel="stylesheet" href="assets/plugins/morris/morris.css"> --}}
    <link rel="stylesheet" href="{{ asset('plugins/adminTournament/morris/morris.css') }}">

    {{-- <link rel="stylesheet" href="assets/css/style.css"> </head> --}}
    <link rel="stylesheet" href="{{ asset('css/adminTournament/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- @vite('resources/css/app.css') --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="main-wrapper">

        <x-notification />
        <x-admin-tournament.menu />
        <x-admin-tournament.sidebar />
        <div class="page-wrapper">
            <div class="content container-fluid w-[95%] bg-white m-auto">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title mt-5 text-[15px]">Chỉnh sửa giải đấu</h3>
                        </div>
                    </div>
                </div>
                <form action="{{ route('adminTournament.editTournament', ['id' => $tournament->id]) }}" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            @csrf
                            @method('PUT')
                            <div class="row formtype">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tên giải đấu</label>
                                        <input class="form-control" type="text" name="name"
                                            placeholder="Nhập tên giải đấu" value="{{ $tournament->name }}">
                                    </div>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Thể loại</label>
                                        <select class="form-control" id="sel1" name="type">
                                            @foreach ($game_types as $game_type)
                                                <option value="{{ $game_type->id }}"
                                                    {{ $tournament->tournament_game_type->game_type_id == $game_type->id ? 'selected' : '' }}>
                                                    {{ $game_type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Số lượng người tham gia</label>
                                        <input class="form-control" type="number" name="number_player"
                                            placeholder="Nhập số lượng người tham gia"
                                            value={{ $tournament->number_players }}>
                                    </div>
                                    <x-input-error :messages="$errors->get('number_player')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Thời gian bắt đầu</label>
                                        <input class="form-control" type="datetime-local" name="date_start"
                                            value={{ \Carbon\Carbon::parse($tournament->start_date)->format('Y-m-d\TH:i') }}>
                                    </div>
                                    <x-input-error :messages="$errors->get('date_start')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Địa điểm thi đấu</label>
                                        <input class="form-control" type="text" name="address"
                                            placeholder="Nhập địa điểm thi đấu" value="{{ $tournament->address }}" />
                                        {{-- <textarea name="address" rows="5">{{ $tournament->address }}</textarea> --}}
                                    </div>
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Lệ phí tham gia</label>
                                        <input class="form-control " type="number" name="fees"
                                            placeholder="Nhập lệ phí tham gia" value={{ $tournament->fees }}>
                                    </div>
                                    <x-input-error :messages="$errors->get('fees')" class="mt-2" />
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tiền thưởng vô địch (VND)</label>
                                        <input class="form-control" type="number" name="money_top_1"
                                            placeholder="Nhập số tiền thưởng hạng 1"
                                            value={{ $tournament->tournament_top_money[0]->money }}>
                                    </div>
                                    <x-input-error :messages="$errors->get('money_top_1')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tiền thưởng á quân (VND)</label>
                                        <input class="form-control" type="number" name="money_top_2"
                                            placeholder="Nhập số tiền thưởng hạng 2"
                                            value={{ $tournament->tournament_top_money[1]->money }}>
                                    </div>
                                    <x-input-error :messages="$errors->get('money_top_2')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tiền thưởng hạng 3 (VND)</label>
                                        <input class="form-control" type="number" name="money_top_3"
                                            placeholder="Nhập số tiền hạng 3"
                                            value={{ $tournament->tournament_top_money[2]->money }}>
                                    </div>
                                    <x-input-error :messages="$errors->get('money_top_3')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Hạng người chơi được tham gia</label>
                                        <div class=" grid grid-cols-3">
                                            @foreach ($rankings as $ranking)
                                                <div class=" flex items-baseline space-x-4">
                                                    <input class="" type="checkbox" name="ranking[]"
                                                        value={{ $ranking->id }}
                                                        {{ in_array($ranking->id, $ranking_tournaments) ? 'checked' : '' }}>
                                                    <label for="ranking">{{ $ranking->name }}</label><br>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('ranking')" class="mt-2" />
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Quán quân</label>
                                        <input type="email" name="top1"
                                            {{ $tournament->tournament_end != 2 ? 'disabled' : '' }}
                                            value="{{ count($tournament->tournament_top_money[0]->achievements) != 0 ? $tournament->tournament_top_money[0]->achievements[0]->player->user->email : '' }}"
                                            class="search-input w-full py-[6px] px-[12px] text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="Nhập email người tham gia" />
                                        <div
                                            class="search-results mt-3 bg-white border border-gray-300 rounded-lg shadow-lg hidden">
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('money_top_3')" class="mt-2" />
                                    <p
                                        class="hidden text-red-400 {{ $tournament->tournament_end == 2 && count($tournament->tournament_top_money[0]->achievements) == 0 ? 'block' : '' }}">
                                        Vui lòng cập nhật giải thưởng khi trận đấu kết thúc.</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Á quân</label>
                                        <input type="email" name="top2"
                                            {{ $tournament->tournament_end != 2 ? 'disabled' : '' }}
                                            value="{{ count($tournament->tournament_top_money[1]->achievements) != 0 ? $tournament->tournament_top_money[1]->achievements[0]->player->user->email : '' }}"
                                            class="search-input w-full py-[6px] px-[12px] text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="Nhập email người tham gia" />
                                        <div
                                            class="search-results mt-3 bg-white border border-gray-300 rounded-lg shadow-lg hidden">
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('money_top_3')" class="mt-2" />
                                    <p
                                        class="hidden text-red-400 {{ $tournament->tournament_end == 2 && count($tournament->tournament_top_money[1]->achievements) == 0 ? 'block' : '' }}">
                                        Vui lòng cập nhật giải thưởng khi trận đấu kết thúc.</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Hạng 3 </label>
                                        <input type="email" name="top3[]"
                                            {{ $tournament->tournament_end != 2 ? 'disabled' : '' }}
                                            value="{{ count($tournament->tournament_top_money[2]->achievements) != 0 ? $tournament->tournament_top_money[2]->achievements[0]->player->user->email : '' }}"
                                            class="search-input w-full py-[6px] px-[12px] text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="Nhập email người tham gia" />
                                        <div
                                            class="search-results mt-3 bg-white border border-gray-300 rounded-lg shadow-lg hidden">
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('money_top_3')" class="mt-2" />
                                    <p
                                        class="hidden text-red-400 {{ $tournament->tournament_end == 2 && count($tournament->tournament_top_money[2]->achievements) == 0 ? 'block' : '' }}">
                                        Vui lòng cập nhật giải thưởng khi trận đấu kết thúc.</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Hạng 3</label>
                                        <input type="email" name="top3[]"
                                            {{ $tournament->tournament_end != 2 ? 'disabled' : '' }}
                                            value="{{ count($tournament->tournament_top_money[2]->achievements) > 1 ? $tournament->tournament_top_money[2]->achievements[1]->player->user->email : '' }}"
                                            class="search-input w-full py-[6px] px-[12px] text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="Nhập email người tham gia" />
                                        <div
                                            class="search-results mt-3 bg-white border border-gray-300 rounded-lg shadow-lg hidden">
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('money_top_3')" class="mt-2" />
                                    <p
                                        class="hidden text-red-400 {{ $tournament->tournament_end == 2 && count($tournament->tournament_top_money[2]->achievements) == 0 ? 'block' : '' }}">
                                        Vui lòng cập nhật giải thưởng khi trận đấu kết thúc.</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Trạng thái giải đấu</label>
                                        <select class="form-control" id="sel1" name="tournament_end">
                                            <option value="0"
                                                {{ $tournament->tournament_end == 0 ? 'selected' : '' }}>
                                                Chưa bắt đầu</option>
                                            <option value="1"
                                                {{ $tournament->tournament_end == 1 ? 'selected' : '' }}>
                                                Đang diễn ra</option>
                                            <option value="2"
                                                {{ $tournament->tournament_end == 2 ? 'selected' : '' }}>
                                                Đã kết thúc</option>
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('tournament_end')" class="mt-2" />
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
            <div class="p-[30px] w-[95%] bg-white mt-[20px] mx-auto">
                <h3 class="sm:page-title mt-5 text-[17px mb-[10px]">Danh sách người chơi đã đăng ký: {{count($player_registed)}} người đã đăng ký</h3>
                <div class=" text-right mb-3">
                    <input type="text" id="searchInput" placeholder="Tìm kiếm..."
                        class=" sm:w-[30%] w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                        oninput="searchTable()" />
                </div>
                @if (count($player_registed) == 0)
                    <h1 class=" text-center text-[13px] mt-[60px]">Chưa có người chơi nào đăng ký giải đấu
                    </h1>
                @else
                    <div class=" overflow-auto">
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Hạng</th>
                                    <th scope="col">Giới tính</th>
                                    <th scope="col">Trạng thái</th>
                                    {{-- <th scope="col">Giải</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $stt = 1;
                                @endphp
                                @foreach ($player_registed as $player)
                                    <tr class="{{ $player->status == 0 ? 'bg-yellow-100' : '' }}">
                                        <th scope="row">{{ $stt }}</th>
                                        <td>{{ $player->player->name }}</td>
                                        <td>{{ $player->player->user->email }}</td>
                                        <td>{{ $player->player->phone }}
                                        </td>
                                        <td>{{ $player->player->player_ranking->ranking->name }}</td>
                                        <td>{{ $player->player->sex }}</td>
                                        <input type="hidden" name="player_id[]" value="{{ $player->player->id }}">
                                        <td><select class="form-control" id="sel1" name="status[]">
                                                <option value="0" {{ $player->status == 0 ? 'selected' : '' }}>
                                                    Chờ xét duyệt</option>
                                                <option value="1" {{ $player->status == 1 ? 'selected' : '' }}>
                                                    Thành công</option>
                                            </select></td>
                                        <td><a type="button"
                                                href="{{ route('adminTournament.showEditPlayer', ['id' => $player->player->id]) }}"
                                                class="btn btn-primary buttonedit">Cập
                                                nhật
                                            </a></td>
                                    </tr>
                                    @php
                                        $stt++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary buttonedit ml-2 mt-4">Lưu thay đổi</button>
            </form>
        </div>
    </div>


    <script src="assets/js/jquery-3.5.1.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/raphael/raphael.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="assets/js/script.js"></script>
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'

            });
        });
    </script>
</body>
<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
{{-- <script src="assets/js/jquery-3.5.1.min.js"></script> --}}
<script src="{{ asset('js/adminTournament/jquery-3.5.1.min.js') }}"></script>


{{-- <script src="assets/js/popper.min.js"></script> --}}
<script src="{{ asset('js/adminTournament/popper.min.js') }}"></script>
{{-- <script src="assets/js/bootstrap.min.js"></script> --}}
<script src="{{ asset('js/adminTournament/bootstrap.min.js') }}"></script>

{{-- <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script> --}}
<script src="{{ asset('js/adminTournament/bootstrap.min.js') }}"></script>

{{-- <script src="assets/plugins/raphael/raphael.min.js"></script> --}}
<script src="{{ asset('plugins/adminTournament/raphael/raphael.min.js') }}"></script>

<script src="assets/plugins/morris/morris.min.js"></script>
{{-- <script src="assets/js/chart.morris.js"></script> --}}
<script src="{{ asset('js/adminTournament/chart.morris.js') }}"></script>

{{-- <script src="assets/js/script.js"></script> --}}
<script src="{{ asset('js/adminTournament/script.js') }}"></script>

<script>
    const openFilter = document.getElementById('openFilter');
    const filter = document.getElementById('filter');
    const bgFilter = document.getElementById('bgFilter');
    const close_Filter = document.getElementById('closeFilter');

    openFilter.addEventListener('click', function() {
        filter.classList.remove('hidden');
        bgFilter.classList.remove('hidden');
    });
    close_Filter.addEventListener('click', function() {
        filter.classList.add('hidden');
        bgFilter.classList.add('hidden');
    });
</script>

<script>
    function formatMoney(input) {
        // Loại bỏ ký tự không phải số
        let value = input.value.replace(/[^0-9]/g, '');
        // Định dạng thành tiền tệ Việt Nam
        input.value = new Intl.NumberFormat('vi-VN').format(value);
    }
</script>

<script>
    function searchTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('dataTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) { // Bỏ qua hàng tiêu đề
            const cells = rows[i].getElementsByTagName('td');
            let match = false;

            for (let j = 0; j < cells.length; j++) {
                const cellText = cells[j].textContent || cells[j].innerText;
                if (cellText.toLowerCase().includes(filter)) {
                    match = true;
                    break;
                }
            }

            rows[i].style.display = match ? '' : 'none';
        }
    }
</script>
<script>
    @php
        $emails = [];
        foreach ($tournament->player_registed_tournament as $played) {
            if ($played->status == 1) {
                $emails[] = $played->player->user->email;
            }
        }
    @endphp
    // Mảng chứa dữ liệu email từ PHP (hoặc dữ liệu bạn muốn tìm kiếm)
    const searchData = <?php echo json_encode($emails); ?>;

    // Lấy tất cả các ô input có class là 'search-input'
    const searchInputs = document.querySelectorAll('.search-input');

    searchInputs.forEach(searchInput => {
        const searchResults = searchInput.nextElementSibling; // Lấy thẻ div chứa kết quả tìm kiếm

        // Function để render các kết quả tìm kiếm
        function renderSearchResults(filteredData) {
            // Xóa kết quả cũ
            searchResults.innerHTML = '';

            // Nếu không có kết quả tìm kiếm, hiển thị thông báo "No results"
            if (filteredData.length === 0) {
                searchResults.innerHTML = `<div class="p-3 text-gray-500">Không tìm thấy người chơi</div>`;
                searchResults.classList.remove('hidden');
                return;
            }

            // Duyệt qua mảng dữ liệu và hiển thị mỗi kết quả
            filteredData.forEach(result => {
                const resultItem = document.createElement('div');
                resultItem.classList.add('p-3', 'border-t', 'border-gray-200', 'hover:bg-gray-50',
                    'cursor-pointer');
                resultItem.textContent = result;

                // Thêm sự kiện click vào mỗi kết quả
                resultItem.addEventListener('click', function() {
                    // Khi click vào kết quả, tự động điền vào input
                    searchInput.value = result;

                    // Ẩn kết quả sau khi chọn
                    searchResults.classList.add('hidden');
                });

                // Thêm phần tử kết quả vào danh sách
                searchResults.appendChild(resultItem);
            });

            // Hiển thị kết quả tìm kiếm
            searchResults.classList.remove('hidden');
        }

        // Sự kiện input để lọc dữ liệu
        searchInput.addEventListener('input', function() {
            const query = searchInput.value.toLowerCase();
            const filteredData = searchData.filter(item =>
                item.toLowerCase().includes(query)
            );
            renderSearchResults(filteredData);
        });
    });
</script>

</html>
