<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Quản lý cơ thủ</title>
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
                <div class="row">
                    <div class="col-md-12 d-flex">
                        <div class="card card-table flex-fill">
                            <div class="card-header">
                                <h4 class="card-title float-left mt-2">Giải đấu</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Email</th>
                                                <th>Ngày đăng ký</th>
                                                <th>Tên</th>
                                                <th>Số điện thoại</th>
                                                <th>Giới tính</th>
                                                <th>Poin</th>
                                                <th>Hạng</th>
                                                <th>Căn cước công dân</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->player->id }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->created_at }}</td>
                                                    <td>{{ $user->player->name }}</td>
                                                    <td>{{ $user->player->phone }}</td>
                                                    <td>{{ $user->player->sex }}</td>
                                                    <td>{{ $user->player->point }}</td>
                                                    <td>{{ $user->player->player_ranking->ranking->name }}</td>
                                                    <td>{{ $user->player->cccd }}</td>
                                                    <td class=" text-blue-600"><a
                                                            href="{{ route('admin.showEditUser', ['id' => $user->id]) }}">Cập
                                                            nhật</a></td>
                                                    <td><button type="button" class="btn bg-red-500 text-white"
                                                            data-toggle="modal" data-target="#delete_match"
                                                            data-id="{{ $user->id }}">
                                                            Xóa
                                                        </button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="delete_match" class="modal fade" role="dialog" tabindex="-1" role="dialog"
        aria-labelledby="deleteMatchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center"> <img class=" m-auto"
                        src="{{ asset('images/adminTournament/sent.png') }}" alt="" width="50"
                        height="46">
                    <h3 class="delete_class">Bạn đồng ý xoá trận đấu<span id="tournamentName"></span>?</h3>
                    <div class="m-t-20 flex relative"> <a href="#" class="btn btn-white"
                            data-dismiss="modal">Huỷ</a>
                        <form action="{{ route('admin.deletePlayer') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" id="matchId" name="match_id" value="">
                            <button type="submit" class="btn btn-danger absolute right-[10px]">Xoá</button>
                        </form>
                    </div>
                </div>
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

</body>

</html>
