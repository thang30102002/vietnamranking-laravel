<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Quản lý tin tức</title>
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
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
</head>

<body>
    <div class="main-wrapper">

        <x-notification />
        <x-admin.menu />
        <x-admin.sidebar />
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="mt-5">
                                <h4 class="card-title float-left mt-2">Tất cả tin tức</h4> <a
                                    href="{{ route('news.showCreate') }}"
                                    class="btn btn-primary float-right veiwbutton">Tạo bài viết</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body booking_card">
                                <div class="table-responsive">

                                    <table class="datatable table-stripped table table-hover table-center mb-0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên tiêu đề</th>
                                                <th>Slug</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($news as $news_row)
                                                <tr>
                                                    <td>{{ $news_row->id }}</td>
                                                    <td>{{ $news_row->title }}</td>
                                                    <td>{{ $news_row->slug }}</td>
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-action"> <a href="#"
                                                                class="action-icon dropdown-toggle"
                                                                data-toggle="dropdown" aria-expanded="false"><i
                                                                    class="fa fa-bars" aria-hidden="true"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-right"> <a
                                                                    class="dropdown-item"
                                                                    href="{{ route('news.showEdit', ['id' => $news_row->id]) }}"><i
                                                                        class="fa fa-pencil-square-o"
                                                                        aria-hidden="true"></i> Chỉnh sửa</a> <a
                                                                    class="dropdown-item" href="#"
                                                                    data-toggle="modal" data-target="#delete_asset"
                                                                    data-id="{{ $news_row->id }}"
                                                                    data-name="{{ $news_row->slug }}"><i
                                                                        class="fa fa-trash" aria-hidden="true"></i>
                                                                    Xoá</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (count($news) == 0)
                    <p class=" text-center">Không có tin tức nào được tạo</p>
                @endif
            </div>
            <div id="delete_asset" class="modal fade delete-modal" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center"> <img class=" m-auto"
                                src="{{ asset('images/adminTournament/sent.png') }}" alt="" width="50"
                                height="46">
                            <h3 class="delete_class">Bạn đồng ý xoá bài viết <span id="tournamentName"></span>?</h3>
                            <div class="m-t-20 flex relative"> <a href="#" class="btn btn-white"
                                    data-dismiss="modal">Huỷ</a>
                                <form id="deleteForm" action="#" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger absolute right-[10px]">Xoá</button>
                                </form>

                            </div>
                        </div>
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
            $('#delete_asset').on('show.bs.modal', function(event) {

                var button = $(event.relatedTarget); // Nút kích hoạt modal
                var id = button.data('id'); // Lấy ID giải đấu
                var name = button.data('name'); // Lấy tên giải đấu

                // Cập nhật nội dung modal
                var modal = $(this);
                modal.find('#tournamentName').text(name); // Hiển thị tên giải đấu

                // Cập nhật URL action trong form
                var form = modal.find('#deleteForm');
                form.attr('action', '/news/' + id);
            });
        });
    </script>
</body>

</html>
