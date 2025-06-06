﻿<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Quản lý giải đấu</title>
    <link rel="icon" href="{{ asset('images/VietNamPool.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('images/adminTournament/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/feathericon.min.css') }}">
    <link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
    <link rel="stylesheet" href="{{ asset('plugins/adminTournament/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    @php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
    @endphp
    <div class="main-wrapper">

        <x-notification />
        <x-admin-tournament.menu />
        <x-admin-tournament.sidebar />
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="mt-5">
                                <h4 class="card-title float-left mt-2">Tất cả giải đấu</h4> <a
                                    href="{{ route('adminTournament.addtournament') }}"
                                    class="btn btn-primary float-right veiwbutton">Tạo giải đấu</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body booking_card">
                                <div class="table-responsive">
                                    <div class=" text-right mb-3">
                                        <input type="text" id="searchInput" placeholder="Tìm kiếm..."
                                            class=" sm:w-[30%] w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                                            oninput="searchTable()" />
                                    </div>
                                    <table class="datatable table table-stripped table-hover table-center mb-0" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>Tên</th>
                                                <th>Thể loại</th>
                                                <th>Thời gian bắt đầu</th>
                                                <th>Địa điểm thi đấu</th>
                                                <th>Lệ phí</th>
                                                <th>Hạng</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tournaments as $tournament)
                                                <tr  onclick="window.location='{{ route('adminTournament.showEditTournament', ['id' => $tournament->id]) }}'" class="cursor-pointer hover:bg-gray-100">
                                                    <td>{{ $tournament->name }}</td>
                                                    <td>{{ $tournament->tournament_game_type->game_type->name }}</td>
                                                    <td>{{ Carbon::parse($tournament->start_date )->isoFormat('dddd, D / M / YYYY')}}</td>
                                                    <td>{{ $tournament->address }}</td>
                                                    <td>{{ number_format($tournament->fees, 0, ',', '.') . ' VNĐ' }}
                                                    </td>
                                                    <td>
                                                        @foreach ($tournament->ranking_tournament as $ranking)
                                                            {{ $ranking->ranking->name }}
                                                        @endforeach
                                                    </td>
                                                    @if ($tournament->status == 0)
                                                        <td>
                                                            <div class="actions"> <a href="#"
                                                                    class="btn btn-sm text-orange-400 bg-orange-200 mr-2">Chưa
                                                                    phê duyệt</a>
                                                            </div>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <div class="actions"> <a href="#"
                                                                    class="btn btn-sm bg-success-light mr-2">Đã
                                                                    duyệt</a>
                                                            </div>
                                                        </td>
                                                    @endif

                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-action"> <a href="#"
                                                                class="action-icon dropdown-toggle"
                                                                data-toggle="dropdown" aria-expanded="false"><i
                                                                    class="fa fa-bars" aria-hidden="true"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-right"> <a
                                                                    class="dropdown-item"
                                                                    href="{{ route('adminTournament.showEditTournament', ['id' => $tournament->id]) }}"><i
                                                                        class="fa fa-pencil-square-o"
                                                                        aria-hidden="true"></i> Chỉnh sửa</a> <a
                                                                    class="dropdown-item" href="#"
                                                                    data-toggle="modal" data-target="#delete_asset"
                                                                    data-id="{{ $tournament->id }}"
                                                                    data-name="{{ $tournament->name }}"><i
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
                @if (count($tournaments) == 0)
                    <p class=" text-center">Không có giải đấu nào được tạo</p>
                @endif
            </div>
            <div id="delete_asset" class="modal fade delete-modal" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center"> <img class=" m-auto"
                                src="{{ asset('images/adminTournament/sent.png') }}" alt="" width="50"
                                height="46">
                            <h3 class="delete_class">Bạn đồng ý xoá giải đấu <span id="tournamentName"></span>?</h3>
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
    {{-- <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}
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
                form.attr('action', '/adminTournament/' + id);
            });
        });
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
</body>

</html>
