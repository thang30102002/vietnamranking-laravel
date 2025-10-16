<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Quản lý tin tức - Admin</title>
    <link rel="icon" href="{{ asset('images/VietNamPool.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/feathericon.min.css') }}">
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
        <x-admin.menu />
        <x-admin.sidebar />
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12 mt-5">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
                                <li class="breadcrumb-item active">Quản lý tin tức</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card board1 fill">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <div>
                                        <h3 class="card_widget_header">{{ $totalNews }}</h3>
                                        <h6 class="text-muted pt-3">Tổng tin tức</h6>
                                    </div>
                                    <div class="dash-widget-icon">
                                        <i class="fa fa-newspaper-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card board2 fill">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <div>
                                        <h3 class="card_widget_header">{{ $publishedNews }}</h3>
                                        <h6 class="text-muted pt-3">Đã xuất bản</h6>
                                    </div>
                                    <div class="dash-widget-icon">
                                        <i class="fa fa-check-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card board3 fill">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <div>
                                        <h3 class="card_widget_header">{{ $draftNews }}</h3>
                                        <h6 class="text-muted pt-3">Bản nháp</h6>
                                    </div>
                                    <div class="dash-widget-icon">
                                        <i class="fa fa-edit"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card board4 fill">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <div>
                                        <h3 class="card_widget_header">{{ $totalCategories }}</h3>
                                        <h6 class="text-muted pt-3">Danh mục</h6>
                                    </div>
                                    <div class="dash-widget-icon">
                                        <i class="fa fa-folder"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thao tác nhanh</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-block">
                                            <i class="fa fa-plus"></i> Tạo tin tức mới
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('admin.categories.create') }}" class="btn btn-success btn-block">
                                            <i class="fa fa-folder-plus"></i> Tạo danh mục mới
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('admin.news.index') }}" class="btn btn-info btn-block">
                                            <i class="fa fa-list"></i> Quản lý tin tức
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('admin.categories.index') }}" class="btn btn-warning btn-block">
                                            <i class="fa fa-tags"></i> Quản lý danh mục
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent News -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tin tức gần đây</h4>
                                <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-primary float-right">Xem tất cả</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tiêu đề</th>
                                                <th>Danh mục</th>
                                                <th>Trạng thái</th>
                                                <th>Ngày tạo</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($recentNews as $article)
                                            <tr>
                                                <td>
                                                    <strong>{{ Str::limit($article->title, 40) }}</strong>
                                                </td>
                                                <td>
                                                    @if($article->category)
                                                        <span class="badge" style="background-color: {{ $article->category->color }}; color: white;">
                                                            <i class="{{ $article->category->icon ?: 'fas fa-folder' }}"></i> {{ $article->category->name }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-secondary">Chưa phân loại</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($article->status == 'published')
                                                        <span class="badge badge-success">Đã xuất bản</span>
                                                    @else
                                                        <span class="badge badge-warning">Bản nháp</span>
                                                    @endif
                                                </td>
                                                <td>{{ $article->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.news.edit', $article->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Chưa có tin tức nào</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Categories Overview -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Danh mục</h4>
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-primary float-right">Quản lý</a>
                            </div>
                            <div class="card-body">
                                @forelse($categories as $category)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="category-icon" style="background-color: {{ $category->color }}; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                                        <i class="{{ $category->icon ?: 'fas fa-folder' }}" style="color: white; font-size: 14px;"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">{{ $category->name }}</h6>
                                        <small class="text-muted">{{ $category->news_count }} tin tức</small>
                                    </div>
                                    <div>
                                        @if($category->is_active)
                                            <span class="badge badge-success">Hoạt động</span>
                                        @else
                                            <span class="badge badge-secondary">Tạm dừng</span>
                                        @endif
                                    </div>
                                </div>
                                @empty
                                <p class="text-center text-muted">Chưa có danh mục nào</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News by Category Chart -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Phân bố tin tức theo danh mục</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($categories as $category)
                                    <div class="col-md-2 mb-3">
                                        <div class="text-center">
                                            <div class="category-chart" style="background-color: {{ $category->color }}; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;">
                                                <i class="{{ $category->icon ?: 'fas fa-folder' }}" style="color: white; font-size: 20px;"></i>
                                            </div>
                                            <h6>{{ $category->name }}</h6>
                                            <span class="badge badge-primary">{{ $category->news_count }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/adminTournament/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/adminTournament/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/adminTournament/popper.min.js') }}"></script>
    <script src="{{ asset('js/adminTournament/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/adminTournament/Chart.bundle.js') }}"></script>
    <script src="{{ asset('js/adminTournament/chart.js') }}"></script>
    <script src="{{ asset('js/adminTournament/app.js') }}"></script>
</body>

</html>
