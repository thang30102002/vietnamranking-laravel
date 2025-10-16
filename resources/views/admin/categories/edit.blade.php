<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Chỉnh sửa danh mục - Admin</title>
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
                                <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Danh mục</a></li>
                                <li class="breadcrumb-item active">Chỉnh sửa</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Chỉnh sửa danh mục</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name', $category->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="description" class="form-label">Mô tả</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="4" 
                                                  placeholder="Mô tả ngắn gọn về danh mục...">{{ old('description', $category->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="color" class="form-label">Màu sắc</label>
                                                <div class="input-group">
                                                    <input type="color" class="form-control form-control-color" 
                                                           id="color" name="color" value="{{ old('color', $category->color) }}">
                                                    <input type="text" class="form-control @error('color') is-invalid @enderror" 
                                                           id="color-text" value="{{ old('color', $category->color) }}" 
                                                           placeholder="#21324C" pattern="^#[0-9A-Fa-f]{6}$">
                                                </div>
                                                @error('color')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="parent_id" class="form-label">Danh mục cha</label>
                                        <select class="form-control @error('parent_id') is-invalid @enderror" 
                                                id="parent_id" name="parent_id">
                                            <option value="">Chọn danh mục cha (để trống nếu là danh mục gốc)</option>
                                            @foreach($parentCategories as $parent)
                                                <option value="{{ $parent->id }}" 
                                                    {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                                    {{ $parent->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="sort_order" class="form-label">Thứ tự sắp xếp</label>
                                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                                       id="sort_order" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}" 
                                                       min="0" step="1">
                                                @error('sort_order')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <div class="form-check mt-4">
                                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                                           value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_active">
                                                        Kích hoạt danh mục
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Cập nhật danh mục
                                        </button>
                                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                                            <i class="fa fa-arrow-left"></i> Quay lại
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Xem trước danh mục</h4>
                            </div>
                            <div class="card-body">
                                <div class="preview-category" id="preview-category">
                                    <div class="preview-content">
                                        <h6 class="preview-name">{{ $category->name }}</h6>
                                        <p class="preview-description">{{ $category->description ?: 'Mô tả danh mục sẽ hiển thị ở đây' }}</p>
                                    </div>
                                </div>
                                
                                <div class="category-info mt-3">
                                    <h6>Thông tin danh mục:</h6>
                                    <ul class="list-unstyled">
                                        <li><strong>Slug:</strong> <code>{{ $category->slug }}</code></li>
                                        <li><strong>Ngày tạo:</strong> {{ $category->created_at->format('d/m/Y H:i') }}</li>
                                        <li><strong>Cập nhật:</strong> {{ $category->updated_at->format('d/m/Y H:i') }}</li>
                                        <li><strong>Số tin tức:</strong> {{ $category->news_count }} bài viết</li>
                                    </ul>
                                </div>
                                
                                <div class="icon-examples mt-3">
                                    <h6>Gợi ý icon:</h6>
                                    <div class="icon-grid">
                                        <span class="icon-item" data-icon="fas fa-trophy"><i class="fas fa-trophy"></i> Giải đấu</span>
                                        <span class="icon-item" data-icon="fas fa-user"><i class="fas fa-user"></i> Cơ thủ</span>
                                        <span class="icon-item" data-icon="fas fa-cog"><i class="fas fa-cog"></i> Kỹ thuật</span>
                                        <span class="icon-item" data-icon="fas fa-calendar"><i class="fas fa-calendar"></i> Sự kiện</span>
                                        <span class="icon-item" data-icon="fas fa-newspaper"><i class="fas fa-newspaper"></i> Tin tức</span>
                                        <span class="icon-item" data-icon="fas fa-star"><i class="fas fa-star"></i> Nổi bật</span>
                                    </div>
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

    <style>
    .preview-category {
        display: flex;
        align-items: center;
        padding: 1rem;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        background: #f8f9fa;
    }

    .preview-icon {
        width: 50px;
        height: 50px;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.2rem;
    }

    .preview-content h6 {
        margin-bottom: 0.5rem;
        color: #21324C;
    }

    .preview-content p {
        margin: 0;
        color: #666;
        font-size: 0.9rem;
    }

    .category-info {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
    }

    .category-info h6 {
        color: #21324C;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .category-info ul {
        margin: 0;
        font-size: 0.9rem;
    }

    .category-info li {
        margin-bottom: 0.25rem;
    }

    .category-info code {
        background: #e9ecef;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.8rem;
    }

    .icon-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
    }

    .icon-item {
        display: flex;
        align-items: center;
        padding: 0.5rem;
        border: 1px solid #e9ecef;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.8rem;
    }

    .icon-item:hover {
        background: #f8f9fa;
        border-color: #21324C;
    }

    .icon-item i {
        margin-right: 0.5rem;
        color: #21324C;
    }

    .form-control-color {
        width: 50px;
        height: 50px;
        border: none;
        border-radius: 8px;
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('name');
        const descriptionInput = document.getElementById('description');
        const colorInput = document.getElementById('color');
        const colorTextInput = document.getElementById('color-text');
        const iconInput = document.getElementById('icon');
        
        const previewName = document.querySelector('.preview-name');
        const previewDescription = document.querySelector('.preview-description');
        const previewIcon = document.querySelector('.preview-icon i');
        const previewCategory = document.getElementById('preview-category');
        
        // Update preview when inputs change
        function updatePreview() {
            previewName.textContent = nameInput.value || 'Tên danh mục';
            previewDescription.textContent = descriptionInput.value || 'Mô tả danh mục sẽ hiển thị ở đây';
            previewIcon.className = iconInput.value || 'fas fa-folder';
            previewIcon.parentElement.style.backgroundColor = colorInput.value || '#21324C';
        }
        
        // Event listeners
        nameInput.addEventListener('input', updatePreview);
        descriptionInput.addEventListener('input', updatePreview);
        iconInput.addEventListener('input', updatePreview);
        colorInput.addEventListener('input', function() {
            colorTextInput.value = this.value;
            updatePreview();
        });
        colorTextInput.addEventListener('input', function() {
            if (this.value.match(/^#[0-9A-Fa-f]{6}$/)) {
                colorInput.value = this.value;
                updatePreview();
            }
        });
        
        // Icon examples click
        document.querySelectorAll('.icon-item').forEach(item => {
            item.addEventListener('click', function() {
                iconInput.value = this.dataset.icon;
                updatePreview();
            });
        });
    });
    </script>
</body>

</html>