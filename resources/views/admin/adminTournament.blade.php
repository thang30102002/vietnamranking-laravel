<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Quản lý cơ thủ</title>
    <link rel="icon" href="{{ asset('images/VietNamPool.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('images/adminTournament/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/feathericon.min.css') }}">
    <link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
    <link rel="stylesheet" href="{{ asset('plugins/adminTournament/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
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
                            <div class="top-nav-search">
                                <form method="GET" action="{{ route('admin.showUser') }}">
                                    <input class="form-control" type="text" name="search"
                                        placeholder="Tìm kiếm người dùng" value="{{ request()->query('search') }}">
                                    <button class="btn" type="submit"><i class="fa fa-search"
                                            aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex">
                        <div class="card card-table flex-fill">

                            <div class="card-header">
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->admin_tournament->id }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->created_at }}</td>
                                                        <td>{{ $user->admin_tournament->name }}</td>
                                                        <td>{{ $user->admin_tournament->phone }}</td>
                                                        <td class=" text-blue-600"><a
                                                                href="{{ route('admin.showEditUser', ['id' => $user->id]) }}">Cập
                                                                nhật</a></td>
                                                        <td class=" text-blue-600"><button id="btnModalChangePassUser" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#ChangePassUserModal" class="dropdown-item p-0" data-id="{{ $user->id }}"
                                                    aria-hidden="true">Thay
                                                    đổi mật khẩu</button></td>
                                                        <td><button type="button" class="btn bg-red-500 text-white"
                                                                data-toggle="modal" data-target="#delete_match"
                                                                data-id="{{ $user->id }}">
                                                                Xóa
                                                            </button></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $users->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
            <!-- Modal change password-->
            <div class="modal fade" id="ChangePassUserModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog h-full content-center w-[302px] sm:w-full m-auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title text-[15px] sm:text-[19px]" id="exampleModalLabel">Thay đổi mật khẩu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body max-h-[500px] overflow-y-auto text-[13px] sm:text-[18px]">
                            <form method="POST" action="{{ route('ranking.change_password_user')}}" >
                                @csrf
                                <div class="col-md-4 mb-3 w-full">
                                    <div class="form-group">
                                        <label>Mật khẩu mới</label>
                                        <input class="form-control" type="password" name="password"
                                            placeholder="Nhập mật khẩu mới" />
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div class="col-md-4 w-full">
                                    <div class="form-group">
                                        <label>Nhập lại mật khẩu</label>
                                        <input class="form-control" type="password" name="password_confirmation"
                                            placeholder="Nhập lại mật khẩu mới" />
                                    </div>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="userID" id="userID" value="">
                            <button type="submit" class="btn bg-[#21324C] text-white">Cập nhật</button>
                        </div>
                        </form>
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
                        <h3 class="delete_class">Bạn đồng ý xoá người dùng<span id="tournamentName"></span>?</h3>
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
        <script src="{{ asset('js/adminTournament/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('js/adminTournament/popper.min.js') }}"></script>
        <script src="{{ asset('js/adminTournament/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/adminTournament/bootstrap.min.js') }}"></script>
        <script src="{{ asset('plugins/adminTournament/raphael/raphael.min.js') }}"></script>
        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="{{ asset('js/adminTournament/chart.morris.js') }}"></script>
        <script src="{{ asset('js/adminTournament/script.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#delete_match').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget); 
                    var matchId = button.data('id'); 
                    // Cập nhật nội dung modal
                    var modal = $(this);
                    modal.find('#matchId').val(matchId);
                });
            });

            $(document).ready(function() {
                $('#ChangePassUserModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget); 
                    var userId = button.data('id'); 
                    // Cập nhật nội dung modal
                    var modal = $(this);
                    modal.find('#userID').val(userId);
                });
            });
        </script>

</body>

</html>
