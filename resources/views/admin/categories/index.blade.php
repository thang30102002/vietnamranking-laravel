<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Quản lý danh mục - Admin</title>
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
                                <li class="breadcrumb-item"><a href="{{ route('admin.news.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Quản lý danh mục</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Danh sách danh mục</h4>
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary float-right">
                                    <i class="fa fa-plus"></i> Tạo danh mục mới
                                </a>
                            </div>
                            <div class="card-body">
                                @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                                @endif

                                @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                                @endif

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Danh mục</th>
                                                <th>Danh mục cha</th>
                                                <th>Mô tả</th>
                                                <th>Màu sắc</th>
                                                <th>Số tin tức</th>
                                                <th>Trạng thái</th>
                                                <th>Thứ tự</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>
                                                    <strong>{{ $category->name }}</strong>
                                                    <br><small class="text-muted">{{ $category->slug }}</small>
                                                    @if($category->parent)
                                                        <br><small class="text-info">Cấp: {{ $category->level + 1 }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($category->parent)
                                                        <span class="badge badge-info">
                                                            <i class="{{ $category->parent->icon ?: 'fas fa-folder' }}"></i> {{ $category->parent->name }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-success">Danh mục gốc</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($category->description)
                                                        {{ Str::limit($category->description, 50) }}
                                                    @else
                                                        <span class="text-muted">Không có mô tả</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="color-preview" style="width: 20px; height: 20px; background-color: {{ $category->color }}; border-radius: 3px; margin-right: 8px;"></div>
                                                        <span class="text-muted">{{ $category->color }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info">{{ $category->news_count }} tin tức</span>
                                                </td>
                                                <td>
                                                    @if($category->is_active)
                                                        <span class="badge badge-success">Hoạt động</span>
                                                    @else
                                                        <span class="badge badge-secondary">Tạm dừng</span>
                                                    @endif
                                                </td>
                                                <td>{{ $category->sort_order }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.categories.toggle-status', $category->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm {{ $category->is_active ? 'btn-secondary' : 'btn-success' }}" 
                                                                    title="{{ $category->is_active ? 'Tạm dừng' : 'Kích hoạt' }}">
                                                                <i class="fa {{ $category->is_active ? 'fa-pause' : 'fa-play' }}"></i>
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline;" 
                                                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                                    {{ $category->hasNews() ? 'disabled title="Không thể xóa danh mục có tin tức"' : '' }}>
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="10" class="text-center py-4">
                                                    <i class="fa fa-folder-open" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                                                    <h5>Chưa có danh mục nào</h5>
                                                    <p>Tạo danh mục đầu tiên để bắt đầu!</p>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                
                                @if($categories->hasPages())
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $categories->links() }}
                                </div>
                                @endif
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