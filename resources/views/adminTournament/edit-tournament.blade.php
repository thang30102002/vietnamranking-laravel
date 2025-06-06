<!DOCTYPE html>
<html lang="en">

<head>
    @php
        use App\Models\Player;
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Chỉnh sửa giải đấu</title>
    <link rel="icon" href="{{ asset('images/VietNamPool.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('images/adminTournament/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/adminTournament/fontawesome.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    {{-- <link rel="stylesheet" href="{{ asset('css/adminTournament/all.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/adminTournament/feathericon.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
    <link rel="stylesheet" href="{{ asset('plugins/adminTournament/morris/morris.css') }}">

    {{-- <link rel="stylesheet" href="assets/css/style.css"> </head> --}}
    <link rel="stylesheet" href="{{ asset('css/adminTournament/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- @vite('resources/css/app.css') --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bracket {
            display: grid;
            grid-template-columns: repeat(9, 1fr);
            /* grid-template-rows: repeat(94, 8px); */
            grid-gap: 2px 6px;
            grid-auto-flow: column;
            margin: 20px auto;
            width: 1200px;
            overflow-y: scroll;

            @media (min-width:1400px) {
                grid-template-columns: repeat(11, 1fr);
                width: 1400px;
            }
        }

        .region {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* grid-template-rows: repeat(46, 8px); */
            grid-gap: 2px 6px;
            grid-auto-flow: column;
        }

        .region-1 {
            grid-column: 1 / span 4;
            grid-row: 1 / span 47;
        }

        .final-four {
            grid-column: 4 / span 3;
            grid-row: 45 / span 6;

            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(6, 8px);
            grid-gap: 2px 6px;
            grid-auto-flow: column;

            @media (min-width:1400px) {
                grid-column: 5 / span 3;
            }
        }

        .region-2 {
            grid-column: 1 / span 4;
            grid-row: 49 / span 47
        }

        .region-3 {
            grid-column: -5 / span 4;
            grid-row: 1 / span 47;
        }

        .region-4 {
            grid-column: -5 / span 4;
            grid-row: 49 / span 47
        }


        ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .team {
            background-color: white;
            font-size: 11px;
            height: 18px;
            line-height: 18px;
            padding: 0 5px;
        }

        .team-top {
            margin-bottom: 2px;
        }

        .winner {
            background-color: #005eb8;
            color: white;
        }

        .matchup {
            grid-column: span 1;
            grid-row: span 4;
            box-shadow: 1px 1px 10px rgba(0, 0, 0, .5);
        }

        .matchup-1,
        .matchup-9 {
            grid-column: span 1;
            grid-row: span 4;
        }

        .matchup-2,
        .matchup-10 {
            grid-row: 7 / span 4;
        }

        .matchup-3,
        .matchup-11 {
            grid-row: 13 / span 4;
        }

        .matchup-4,
        .matchup-12 {
            grid-row: 19 / span 4;
        }

        .matchup-5,
        .matchup-13 {
            grid-row: 25 / span 4;
        }

        .matchup-6,
        .matchup-14 {
            grid-row: 31 / span 4;
        }

        .matchup-7,
        .matchup-15 {
            grid-row: 37 / span 4;
        }

        .matchup-8,
        .matchup-16 {
            grid-row: 43 / span 4;
        }

        .matchup-17,
        .matchup-25 {
            grid-column: -2/span 1;
            grid-row: 1/span 4;
        }

        .matchup-18,
        .matchup-26 {
            grid-column: -2/span 1;
            grid-row: 7/span 4;
        }

        .matchup-19,
        .matchup-27 {
            grid-column: -2/span 1;
            grid-row: 13/span 4;
        }

        .matchup-20,
        .matchup-28 {
            grid-column: -2/span 1;
            grid-row: 19/span 4;
        }

        .matchup-21,
        .matchup-29 {
            grid-column: -2/span 1;
            grid-row: 25/span 4;
        }

        .matchup-22,
        .matchup-30 {
            grid-column: -2/span 1;
            grid-row: 31/span 4;
        }

        .matchup-23,
        .matchup-31 {
            grid-column: -2/span 1;
            grid-row: 37/span 4;
        }

        .matchup-24,
        .matchup-32 {
            grid-column: -2/span 1;
            grid-row: 43/span 4;
        }

        .matchup-33,
        .matchup-37 {
            grid-column: 2 / span 1;
            grid-row: 4 / span 4;
        }

        .matchup-34,
        .matchup-38 {
            grid-column: 2 / span 1;
            grid-row: 16 / span 4;
        }

        .matchup-35,
        .matchup-39 {
            grid-column: 2 / span 1;
            grid-row: 28 / span 4;
        }

        .matchup-36,
        .matchup-40 {
            grid-column: 2 / span 1;
            grid-row: 40 / span 4;
        }

        .matchup-41,
        .matchup-45 {
            grid-column: -3 / span 1;
            grid-row: 4 / span 4;
        }

        .matchup-42,
        .matchup-46 {
            grid-column: -3 / span 1;
            grid-row: 16 / span 4;
        }

        .matchup-43,
        .matchup-47 {
            grid-column: -3 / span 1;
            grid-row: 28 / span 4;
        }

        .matchup-44,
        .matchup-48 {
            grid-column: -3 / span 1;
            grid-row: 40 / span 4;
        }

        .matchup-49,
        .matchup-51 {
            grid-column: 3 / span 1;
            grid-row: 10 / span 4;
        }

        .matchup-50,
        .matchup-52 {
            grid-column: 3 / span 1;
            grid-row: 34 / span 4;
        }

        .matchup-53,
        .matchup-55 {
            grid-column: -4 / span 1;
            grid-row: 10 / span 4;
        }

        .matchup-54,
        .matchup-56 {
            grid-column: -4 / span 1;
            grid-row: 34 / span 4;
        }

        .matchup-57,
        .matchup-58 {
            grid-column: 4 / span 1;
            grid-row: 22 / span 4;
        }

        .matchup-59,
        .matchup-60 {
            grid-column: -5 / span 1;
            grid-row: 22 / span 4;
        }

        .matchup-61 {
            grid-column: 1 / span 1;
            grid-row: 2/ span 4;
        }

        .matchup-62 {
            grid-column: 3 / span 1;
            grid-row: 2/ span 4;
        }

        .championship {
            grid-column: 2 / span 1;
            grid-row: 1/ span 4;

            .team {
                height: 28px;
                line-height: 28px;
            }
        }
    </style>
</head>

<body>

    <div class="main-wrapper">
        <x-notification />
        <x-admin-tournament.menu />
        <x-admin-tournament.sidebar />
        <div class="page-wrapper">
            <div class="content container-fluid w-[95%] bg-white m-auto">
            <div class=" text-right px-4"><a href="{{ route('adminTournament.bracket', ['id_tournament' => $tournament->id]) }}" class="btn btn-primary ml-2 mt-4">Sơ đồ nhánh thì đấu</a></div>
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
                                        <label for="">Số lượng người tham gia</label><br />
                                        <select class="form-control" name="number_player">
                                            <option value="16"
                                                {{ $tournament->number_players == 16 ? 'selected' : '' }}>
                                                16</option>
                                            <option value="32"
                                                {{ $tournament->number_players == 32 ? 'selected' : '' }}>
                                                32</option>
                                            <option value="64"
                                                {{ $tournament->number_players == 64 ? 'selected' : '' }}>
                                                64</option>
                                            <option value="128"
                                                {{ $tournament->number_players == 128 ? 'selected' : '' }}>
                                                128</option>
                                            <option value="256"
                                                {{ $tournament->number_players == 256 ? 'selected' : '' }}>
                                                256</option>
                                        </select>
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
                                        <input class="form-control" type="text" name="money_top_1"
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
                    <div class=" text-right px-4"><button type="submit" class="btn btn-primary ml-2 mt-4">Lưu thông tin giải đấu</button></div>
                </form>
            </div>
            <div class="p-[30px] w-[95%] bg-white mt-[20px] mx-auto">
                <div class="">
                    <form method="POST" action="{{ route('adminTournament.addPlayerRegister', ['id_tournament' => $tournament->id]) }}" class=" flex">
                        @csrf
                        <div class="sm:w-[30%] w-full">
                            <input type="text" id="addPLayer" name="email" placeholder="Thêm email cơ thủ..."
                            class=" w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300" /><br>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <button type="submit" class="btn btn-primary ml-1">Thêm</button>
                    </form>
                </div>
                <form action="{{ route('adminTournament.updatePlayerRegisted', ['id' => $tournament->id]) }}" method="POST">
                    @csrf
                    <h3 class="sm:page-title mt-5 text-[17px mb-[10px]">Danh sách người chơi đã đăng ký:
                        {{ count($player_registed) }} người đã đăng ký</h3>
                    
                    <div class=" text-right mb-3">
                        <input type="text" id="searchInput" placeholder="Tìm kiếm..."
                            class=" sm:w-[30%] w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                            oninput="searchTable()" />
                    </div>
                    @if (count($player_registed) == 0)
                        <h1 class=" text-center text-[13px] mt-[60px]">Chưa có người chơi nào đăng ký giải đấu
                        </h1>
                    @else
                        <div class=" overflow-y-auto max-h-[500px]">
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
                                                    <option value="1" {{ $player->status == 1 || $player->status == 2 ? 'selected' : '' }}>
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
                    <div class=" text-right px-4"><button type="submit" class="btn btn-primary ml-2 mt-4">Cập nhật thông trạng thái người chơi</button></div>
                </form>
            </div>
            
            <div class="p-[30px] w-[95%] bg-white mt-[20px] mx-auto">
                <h3 class="sm:page-title mt-5 text-[17px mb-[10px]">Danh sách người chơi đạt giải</h3>
                <form action="{{ route('adminTournament.updatePlayerWin', ['id' => $tournament->id]) }}" method="POST">
                    @csrf
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
                        <x-input-error :messages="$errors->get('top1')" class="mt-2" />
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
                        <x-input-error :messages="$errors->get('top2')" class="mt-2" />
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
                        <x-input-error :messages="$errors->get('top3.0')" class="mt-2" />
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
                        <x-input-error :messages="$errors->get('top3.1')" class="mt-2" />
                        <p
                            class="hidden text-red-400 {{ $tournament->tournament_end == 2 && count($tournament->tournament_top_money[2]->achievements) == 0 ? 'block' : '' }}">
                            Vui lòng cập nhật giải thưởng khi trận đấu kết thúc.</p>
                    </div>
                    <div class=" text-right px-4"><button type="submit" class="btn btn-primary ml-2 mt-4">Cập nhật người chơi đạt giải</button></div>
                </form>
            </div>
            {{-- <div class="p-[30px] w-[95%] bg-white mt-[20px] mx-auto">
                <div>
                    <h3>Danh sách trận đấu</h3>
                    <form method="POST" action="{{ route('adminTournament.addMatches') }}">
                        @csrf
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Vòng đấu</label>
                                    <div class=" grid grid-cols-3">
                                        <select class="form-control" id="round" name="round">
                                            @for ($i = 2; $i <= $tournament->number_players; $i *= 2)
                                                <option value="{{ $i }}"
                                                    {{ old('round') == $i ? 'selected' : '' }}>
                                                    Vòng {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cơ thủ 1</label>
                                    <input type="email" name="player_1" value="{{ old('player_1') }}"
                                        class="search-input w-full py-[6px] px-[12px] text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Nhập email người tham gia" />
                                    <div
                                        class="search-results mt-3 bg-white border border-gray-300 rounded-lg shadow-lg hidden">
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('player_1')" class="mt-2" />
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cơ thủ 2</label>
                                    <input type="email" name="player_2" value="{{ old('player_2') }}"
                                        class="search-input w-full py-[6px] px-[12px] text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Nhập email người tham gia" />
                                    <div
                                        class="search-results mt-3 bg-white border border-gray-300 rounded-lg shadow-lg hidden">
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('player_2')" class="mt-2" />
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Vị trí thi đấu</label>
                                    <input type="number" name="location"
                                        class="search-input w-full py-[6px] px-[12px] text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        value="{{ old('location') }}" placeholder="Nhập số bàn thi đấu" />
                                </div>
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>
                            <input type="hidden" name="tournament_id" value="{{ $tournament->id }}">
                        </div>
                        <div class=" text-right px-4 py-4"><button type="submit" class="btn btn-primary ">Thêm trận
                                đấu</button></div>
                    </form>
                </div>
                <div class=" overflow-auto">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Vòng đấu</th>
                                <th scope="col">Cơ thủ 1 </th>
                                <th scope="col">Cơ thủ 2</th>
                                <th scope="col">Vị trí thi đấu</th>
                                <th scope="col">Cơ thủ thắng trận</th>
                                <th scope="col">Tỉ số trận đấu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $stt = 1;
                            @endphp
                            @foreach ($matches as $match)
                                @php
                                    $player_match_1 = Player::find($match->player_id_1);
                                    $player_match_2 = Player::find($match->player_id_2);
                                    if ($match->player_id_win != null) {
                                        $player_win = Player::find($match->player_id_win);
                                    }
                                @endphp
                                <tr class="{{ $match->player_id_win == null ? 'bg-yellow-100' : '' }}">
                                    <th scope="row">{{ $stt }}</th>
                                    <td>{{ $match->round }}</td>
                                    <td>{{ $player_match_1->name }} -
                                        {{ $player_match_1->player_ranking->ranking->name }}</td>
                                    <td>{{ $player_match_2->name }} -
                                        {{ $player_match_2->player_ranking->ranking->name }}</td>
                                    <td>Bàn số {{ $match->location }} </td>
                                    <td>{{ $match->player_id_win == null ? 'Chưa có kết quả' : $player_win->name }}
                                    </td>
                                    @php
                                        $point = $match->point_1 . '-' . $match->point_2;
                                    @endphp
                                    <td>{{ $match->player_id_win == null ? 'Chưa có kết quả' : $point }}
                                    </td>
                                    <td><a href="{{ route('adminTournament.showEditMatches', ['id' => $match->id, 'tournament_id' => $tournament->id]) }}"
                                            class="btn btn-primary">
                                            Cập nhật
                                        </a></td>
                                    <td><button type="button" class="btn bg-red-500 text-white" data-toggle="modal"
                                            data-target="#delete_match" data-id="{{ $match->id }}">
                                            Xóa
                                        </button></td>
                                </tr>
                                @php
                                    $stt++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> --}}

        </div>
    </div>
    <div id="delete_match" class="modal fade    " role="dialog" tabindex="-1" role="dialog"
        aria-labelledby="deleteMatchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center"> <img class=" m-auto"
                        src="{{ asset('images/adminTournament/sent.png') }}" alt="" width="50"
                        height="46">
                    <h3 class="delete_class">Bạn đồng ý xoá trận đấu<span id="tournamentName"></span>?</h3>
                    <div class="m-t-20 flex relative"> <a href="#" class="btn btn-white"
                            data-dismiss="modal">Huỷ</a>
                        <form action="{{ route('adminTournament.deleteMatch') }}" method="POST">
                            @csrf
                            <input type="hidden" id="matchId" name="match_id" value="">
                            <button type="submit" class="btn btn-danger absolute right-[10px]">Xoá</button>
                        </form>
                    </div>
                </div>
            </div>
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
    @if (session('scroll_to_input'))
        <script>
            console.log('asdfasdf');
            
            window.onload = function() {
                const input = document.getElementById("addPLayer");
                if (input) {
                    input.scrollIntoView({ behavior: "smooth", block: "center" });
                    input.focus();
                }
            };
        </script>
    @endif
</body>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
<script>
    $(document).ready(function() {
        $('#delete_match').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Nút kích hoạt modal
            var matchId = button.data('id'); // Lấy ID giải đấu

            // Cập nhật nội dung modal
            var modal = $(this);
            modal.find('#matchId').val(matchId);
        });
    });
</script>
//hodel khi thêm cơ thủ



</html>
