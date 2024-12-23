<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Quản lý giải đấu</title>
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
    @vite('resources/css/app.css')
</head>

<body>
    <div class="main-wrapper">
        <x-notification /> 
        <x-admin.menu />
        <x-admin.sidebar />
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12 mt-5">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Trang chủ</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class=" grid sm:grid-cols-3 gap-4">
                    <div class="">
                        <div class="card board1 fill">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <div>
                                        <h3 class="card_widget_header">{{ count($players) }}</h3>
                                        <h6 class="text-muted pt-3">Người tham gia</h6>
                                    </div>
                                    <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-user-plus">
                                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="8.5" cy="7" r="4"></circle>
                                                <line x1="20" y1="8" x2="20" y2="14">
                                                </line>
                                                <line x1="23" y1="11" x2="17" y2="11">
                                                </line>
                                            </svg></span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="card board1 fill">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <div>
                                        <h3 class="card_widget_header">{{ count($admin_tournaments) }}</h3>
                                        <h6 class="text-muted pt-3">Đơn vị tổ chức giải</h6>
                                    </div>
                                    <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-dollar-sign">
                                                <line x1="12" y1="1" x2="12" y2="23">
                                                </line>
                                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                            </svg></span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="card board1 fill">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <div>
                                        <h3 class="card_widget_header">{{ count($tournaments) }}</h3>
                                        <h6 class="text-muted pt-3">Giải đấu</h6>
                                    </div>
                                    <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-file-plus">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                </path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="12" y1="18" x2="12" y2="12">
                                                </line>
                                                <line x1="9" y1="15" x2="15" y2="15">
                                                </line>
                                            </svg></span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.update') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 d-flex">
                            <div class="card card-table flex-fill">
                                <div class="card-header">
                                    <h4 class="card-title float-left mt-2">Giải đấu</h4>
                                    <button type="submit" class="btn btn-primary float-right veiwbutton">Cập nhật
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Tên</th>
                                                    <th>Đơn vị tổ chức</th>
                                                    <th>Thể loại</th>
                                                    <th>Hạng tham gia</th>
                                                    <th>Số lượng người tham gia</th>
                                                    <th>Ngày bắt đầu</th>
                                                    <th>Địa điểm thi đấu</th>
                                                    <th>Lệ phí</th>
                                                    <th>Số người đã đăng ký</th>
                                                    <th>Quán quân</th>
                                                    <th>Á quân</th>
                                                    <th>Giải 3</th>
                                                    <th>Trạng thái</th>
                                                    <th>Duyệt</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tournaments as $tournament)
                                                    <tr class="{{ $tournament->status == 0 ? 'bg-yellow-100' : '' }}">
                                                        <td class="text-nowrap">
                                                            <div>{{ $tournament->id }}</div>
                                                        </td>
                                                        <td class="text-nowrap">
                                                            <div>{{ $tournament->name }}</div>
                                                        </td>
                                                        <td class="text-nowrap">
                                                            <div>{{ $tournament->admin_tournament->name }}</div>
                                                        </td>
                                                        <td class="text-nowrap">
                                                            <div>
                                                                {{ $tournament->tournament_game_type->game_type->name }}
                                                            </div>
                                                        </td>
                                                        <td class="text-nowrap">
                                                            <div>
                                                                @foreach ($tournament->ranking_tournament as $ranking)
                                                                    {{ $ranking->ranking->name }}
                                                                @endforeach
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div>{{ $tournament->number_players }}</div>
                                                        </td>
                                                        <td class="text-nowrap">
                                                            <div>{{ $tournament->start_date }}</div>
                                                        </td>
                                                        <td class="text-nowrap">
                                                            <div>{{ $tournament->address }}</div>
                                                        </td>
                                                        <td class="text-nowrap">
                                                            <div>
                                                                {{ number_format($tournament->fees, 0, ',', '.') . ' VNĐ' }}
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div>{{ count($tournament->player_registed_tournament) }}
                                                            </div>
                                                        </td>
                                                        <td class="text-nowrap">
                                                            <div>
                                                                {{ number_format($tournament->tournament_top_money[0]->money, 0, ',', '.') . ' VNĐ' }}
                                                            </div>
                                                        </td>
                                                        <td class="text-nowrap">
                                                            <div>
                                                                {{ number_format($tournament->tournament_top_money[1]->money, 0, ',', '.') . ' VNĐ' }}
                                                            </div>
                                                        </td>
                                                        <td class="text-nowrap">
                                                            <div>
                                                                {{ number_format($tournament->tournament_top_money[2]->money, 0, ',', '.') . ' VNĐ' }}
                                                            </div>
                                                        </td>

                                                        <td class="text-nowrap">
                                                            @if ($tournament->tournament_end == 0)
                                                                <div>Chưa bắt đầu</div>
                                                            @elseif ($tournament->tournament_end == 1)
                                                                <div>Đang diễn ra</div>
                                                            @else
                                                                <div>Đã kết thúc</div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <select class="form-control w-[100px]" id="sel1"
                                                                name="status[]">
                                                                <option value="0"
                                                                    {{ $tournament->status == 0 ? 'selected' : '' }}>
                                                                    Chờ xét duyệt</option>
                                                                <option value="1"
                                                                    {{ $tournament->status == 1 ? 'selected' : '' }}>
                                                                    Duyệt</option>
                                                            </select>
                                                        </td>
                                                        <input type="hidden" name="tournament_id[]" value="{{ $tournament->id }}">
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

</body>

</html>
