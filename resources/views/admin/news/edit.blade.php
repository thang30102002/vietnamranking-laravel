<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chỉnh sửa tin tức - Admin</title>
    <link rel="icon" href="{{ asset('images/VietNamPool.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/feathericon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .upload-area:hover {
            border-color: #007bff !important;
            background-color: #f8f9fa;
        }
        .image-preview {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
        }
        .preview-item {
            position: relative;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
        }
        .preview-item img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }
        .preview-item .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255, 0, 0, 0.8);
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            cursor: pointer;
            font-size: 12px;
        }
        .preview-item .image-info {
            padding: 8px;
            font-size: 12px;
            background: #f8f9fa;
        }
        .drag-over {
            border-color: #007bff !important;
            background-color: #e3f2fd !important;
        }
        .content-editor {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }
        .editor-toolbar {
            background: #f8f9fa;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .editor-toolbar .btn {
            border-radius: 4px;
            font-size: 12px;
        }
        .image-insert-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .image-insert-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 8px;
            width: 80%;
            max-width: 600px;
        }
        .image-insert-content h3 {
            margin-top: 0;
            color: #333;
        }
        .image-insert-content .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .image-insert-content .close:hover {
            color: #000;
        }
        .image-selection {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
            margin: 15px 0;
            max-height: 300px;
            overflow-y: auto;
        }
        .image-option {
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 5px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
        }
        .image-option:hover {
            border-color: #007bff;
            background-color: #f8f9fa;
        }
        .image-option.selected {
            border-color: #007bff;
            background-color: #e3f2fd;
        }
        .image-option img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }
        .image-option .image-name {
            font-size: 11px;
            margin-top: 5px;
            word-break: break-all;
        }
    </style>
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
                                <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">Tin tức</a></li>
                                <li class="breadcrumb-item active">Chỉnh sửa</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Chỉnh sửa tin tức</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="form-group mb-3">
                                        <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                               id="title" name="title" value="{{ old('title', $news->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="excerpt" class="form-label">Tóm tắt</label>
                                        <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                                  id="excerpt" name="excerpt" rows="3" 
                                                  placeholder="Tóm tắt ngắn gọn về bài viết...">{{ old('excerpt', $news->excerpt) }}</textarea>
                                        @error('excerpt')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="content" class="form-label">Nội dung <span class="text-danger">*</span></label>
                                        <div class="content-editor">
                                            <div class="editor-toolbar mb-2">
                                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatText('bold')">
                                                    <i class="fa fa-bold"></i> Đậm
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatText('italic')">
                                                    <i class="fa fa-italic"></i> Nghiêng
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatText('underline')">
                                                    <i class="fa fa-underline"></i> Gạch chân
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="insertLineBreak()">
                                                    <i class="fa fa-level-down"></i> Xuống dòng
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="insertBulletList()">
                                                    <i class="fa fa-list-ul"></i> Danh sách
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="insertNumberedList()">
                                                    <i class="fa fa-list-ol"></i> Đánh số
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-info" onclick="insertSeparator()">
                                                    <i class="fa fa-minus"></i> Phân cách
                                                </button>
                                            </div>
                                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                                      id="content" name="content" rows="10" required 
                                                      placeholder="Nhập nội dung bài viết...">{{ old('content', $news->content) }}</textarea>
                                        </div>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Sử dụng các nút trên để định dạng văn bản. Enter để xuống dòng mới.</div>
                                    </div>

                                    @if($news->image)
                                    <div class="form-group mb-3">
                                        <label class="form-label">Hình ảnh hiện tại</label>
                                        <div>
                                            <img src="{{ Storage::url('news/' . $news->image) }}" alt="{{ $news->title }}" 
                                                 style="max-width: 200px; max-height: 200px; border-radius: 5px;">
                                        </div>
                                    </div>
                                    @endif

                                    <div class="form-group mb-3">
                                        <label for="image" class="form-label">Hình ảnh chính mới</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                               id="image" name="image" accept="image/*">
                                        <div class="form-text">Chọn hình ảnh chính mới cho bài viết (JPEG, PNG, JPG, GIF, WebP - Tối đa 2MB)</div>
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Multiple Images Upload Section -->
                                    <div class="form-group mb-3">
                                        <label class="form-label">Hình ảnh bổ sung</label>
                                        <div class="image-upload-section">
                                            <div class="upload-area" id="uploadArea" style="border: 2px dashed #ddd; padding: 20px; text-align: center; border-radius: 8px; cursor: pointer; transition: all 0.3s;">
                                                <div class="upload-content">
                                                    <i class="fa fa-cloud-upload fa-3x text-muted mb-3"></i>
                                                    <p class="mb-2">Kéo thả ảnh vào đây hoặc click để chọn</p>
                                                    <p class="text-muted small">Hỗ trợ: JPG, PNG, GIF, WebP (tối đa 2MB mỗi ảnh)</p>
                                                </div>
                                                <input type="file" id="imageUpload" name="content_images[]" multiple 
                                                       accept="image/*" class="d-none">
                                            </div>
                                            <div id="imagePreview" class="image-preview mt-3"></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="category_id" class="form-label">Danh mục</label>
                                                <select class="form-control @error('category_id') is-invalid @enderror" 
                                                        id="category_id" name="category_id">
                                                    <option value="">Chọn danh mục...</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" 
                                                        {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
                                                        @if($category->parent)
                                                            &nbsp;&nbsp;&nbsp;&nbsp;└─ 
                                                        @endif
                                                        {{ $category->name }}
                                                        @if($category->parent)
                                                            <small class="text-muted">({{ $category->parent->name }})</small>
                                                        @endif
                                                    </option>
                                                @endforeach
                                                </select>
                                                @error('category_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                                        <select class="form-control @error('status') is-invalid @enderror" 
                                                id="status" name="status" required>
                                            <option value="draft" {{ old('status', $news->status) == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                                            <option value="published" {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>Xuất bản</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Cập nhật bài viết
                                        </button>
                                        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                                            <i class="fa fa-arrow-left"></i> Quay lại
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Insert Modal -->
    <div id="imageInsertModal" class="image-insert-modal">
        <div class="image-insert-content">
            <span class="close" onclick="closeImageModal()">&times;</span>
            <h3>Chọn ảnh để chèn</h3>
            <div class="image-selection" id="imageSelection">
                <!-- Images will be populated here -->
            </div>
            <div class="text-center mt-3">
                <button type="button" class="btn btn-primary" onclick="insertSelectedImage()">
                    <i class="fa fa-check"></i> Chèn ảnh
                </button>
                <button type="button" class="btn btn-secondary" onclick="closeImageModal()">
                    <i class="fa fa-times"></i> Hủy
                </button>
            </div>
        </div>
    </div>

    <!-- Simple Image Upload Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('imageUpload');
        const previewContainer = document.getElementById('imagePreview');
        window.uploadedImages = [];

        // Click to upload
        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        // File input change
        fileInput.addEventListener('change', handleFiles);

        // Drag and drop
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('drag-over');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('drag-over');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('drag-over');
            const files = e.dataTransfer.files;
            handleFiles({ target: { files } });
        });

        function handleFiles(event) {
            const files = Array.from(event.target.files);
            
            files.forEach(file => {
                if (file.type.startsWith('image/')) {
                    if (file.size > 2 * 1024 * 1024) {
                        alert(`File ${file.name} quá lớn. Kích thước tối đa là 2MB.`);
                        return;
                    }
                    
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const imageData = {
                            file: file,
                            url: e.target.result,
                            id: Date.now() + Math.random()
                        };
                        window.uploadedImages.push(imageData);
                        displayPreview(imageData);
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert(`File ${file.name} không phải là hình ảnh.`);
                }
            });
        }

        function displayPreview(imageData) {
            const previewItem = document.createElement('div');
            previewItem.className = 'preview-item';
            previewItem.dataset.id = imageData.id;
            
            previewItem.innerHTML = `
                <img src="${imageData.url}" alt="${imageData.file.name}">
                <button type="button" class="remove-btn" onclick="removeImage(${imageData.id})">×</button>
                <div class="image-info">
                    <div><strong>${imageData.file.name}</strong></div>
                    <div>${(imageData.file.size / 1024).toFixed(1)} KB</div>
                </div>
            `;
            
            previewContainer.appendChild(previewItem);
        }

        // Remove image function
        window.removeImage = function(imageId) {
            window.uploadedImages = window.uploadedImages.filter(img => img.id != imageId);
            const previewItem = document.querySelector(`[data-id="${imageId}"]`);
            if (previewItem) {
                previewItem.remove();
            }
        };

        // Update content with image placeholders
        function updateContentWithImages() {
            const contentTextarea = document.getElementById('content');
            let content = contentTextarea.value;
            
            // Add image placeholders to content
            window.uploadedImages.forEach((img, index) => {
                const placeholder = `\n\n[IMAGE_${index + 1}: ${img.file.name}]\n\n`;
                if (!content.includes(placeholder)) {
                    content += placeholder;
                }
            });
            
            contentTextarea.value = content;
        }

        // Update content before form submit
        document.querySelector('form').addEventListener('submit', function() {
            updateContentWithImages();
        });
    });

    // Global variables for image insertion
    let selectedImageForInsert = null;
    let cursorPosition = 0;

    // Function to insert image at cursor position
    function insertImageAtCursor() {
        const contentTextarea = document.getElementById('content');
        cursorPosition = contentTextarea.selectionStart;
        
        // Show modal with available images
        showImageModal();
    }

    // Function to show image modal
    function showImageModal() {
        const modal = document.getElementById('imageInsertModal');
        const imageSelection = document.getElementById('imageSelection');
        
        // Clear previous content
        imageSelection.innerHTML = '';
        
        // Debug information
        console.log('Show image modal called');
        console.log('window.uploadedImages:', window.uploadedImages);
        console.log('Length:', window.uploadedImages ? window.uploadedImages.length : 'undefined');
        
        // Add uploaded images to selection
        const uploadedImages = window.uploadedImages || [];
        
        if (uploadedImages.length === 0) {
            imageSelection.innerHTML = '<p class="text-muted">Chưa có ảnh nào được upload. Vui lòng upload ảnh trước.</p>';
        } else {
            console.log('Found', uploadedImages.length, 'images');
            uploadedImages.forEach((img, index) => {
                const imageOption = document.createElement('div');
                imageOption.className = 'image-option';
                imageOption.dataset.index = index;
                imageOption.onclick = () => selectImageForInsert(index);
                
                imageOption.innerHTML = `
                    <img src="${img.url}" alt="${img.file.name}">
                    <div class="image-name">${img.file.name}</div>
                `;
                
                imageSelection.appendChild(imageOption);
            });
        }
        
        modal.style.display = 'block';
    }

    // Function to select image for insertion
    function selectImageForInsert(index) {
        // Remove previous selection
        document.querySelectorAll('.image-option').forEach(option => {
            option.classList.remove('selected');
        });
        
        // Add selection to clicked option
        const selectedOption = document.querySelector(`[data-index="${index}"]`);
        selectedOption.classList.add('selected');
        
        selectedImageForInsert = index;
    }

    // Function to insert selected image
    function insertSelectedImage() {
        if (selectedImageForInsert === null) {
            alert('Vui lòng chọn ảnh để chèn.');
            return;
        }
        
        const contentTextarea = document.getElementById('content');
        const uploadedImages = window.uploadedImages || [];
        const selectedImage = uploadedImages[selectedImageForInsert];
        
        if (selectedImage) {
            // Create image placeholder
            const imagePlaceholder = `\n\n[IMAGE_${selectedImageForInsert + 1}: ${selectedImage.file.name}]\n\n`;
            
            // Insert at cursor position
            const content = contentTextarea.value;
            const beforeCursor = content.substring(0, cursorPosition);
            const afterCursor = content.substring(cursorPosition);
            
            contentTextarea.value = beforeCursor + imagePlaceholder + afterCursor;
            
            // Update cursor position
            const newPosition = cursorPosition + imagePlaceholder.length;
            contentTextarea.setSelectionRange(newPosition, newPosition);
            contentTextarea.focus();
        }
        
        closeImageModal();
    }

    // Function to close image modal
    function closeImageModal() {
        const modal = document.getElementById('imageInsertModal');
        modal.style.display = 'none';
        selectedImageForInsert = null;
    }

    // Function to insert line break
    function insertLineBreak() {
        const contentTextarea = document.getElementById('content');
        const cursorPos = contentTextarea.selectionStart;
        const content = contentTextarea.value;
        
        const beforeCursor = content.substring(0, cursorPos);
        const afterCursor = content.substring(cursorPos);
        
        contentTextarea.value = beforeCursor + '\n\n' + afterCursor;
        
        // Update cursor position
        const newPosition = cursorPos + 2;
        contentTextarea.setSelectionRange(newPosition, newPosition);
        contentTextarea.focus();
    }

    // Function to insert separator
    function insertSeparator() {
        const contentTextarea = document.getElementById('content');
        const cursorPos = contentTextarea.selectionStart;
        const content = contentTextarea.value;
        
        const beforeCursor = content.substring(0, cursorPos);
        const afterCursor = content.substring(cursorPos);
        
        contentTextarea.value = beforeCursor + '\n\n---\n\n' + afterCursor;
        
        // Update cursor position
        const newPosition = cursorPos + 6;
        contentTextarea.setSelectionRange(newPosition, newPosition);
        contentTextarea.focus();
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('imageInsertModal');
        if (event.target === modal) {
            closeImageModal();
        }
    }
    </script>

    <script src="{{ asset('js/adminTournament/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/adminTournament/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/adminTournament/popper.min.js') }}"></script>
    <script src="{{ asset('js/adminTournament/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/adminTournament/Chart.bundle.js') }}"></script>
    <script src="{{ asset('js/adminTournament/chart.js') }}"></script>
    <script src="{{ asset('js/adminTournament/app.js') }}"></script>
    
    <!-- Simple textarea styling and formatting functions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('content');
            if (textarea) {
                textarea.style.minHeight = '400px';
                textarea.style.fontFamily = 'Arial, sans-serif';
                textarea.style.fontSize = '14px';
                textarea.style.lineHeight = '1.6';
                textarea.style.padding = '15px';
                textarea.style.border = '1px solid #ddd';
                textarea.style.borderRadius = '5px';
                textarea.style.resize = 'vertical';
            }
        });

        // Format text functions
        function formatText(type) {
            const textarea = document.getElementById('content');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);
            
            let formattedText = '';
            switch(type) {
                case 'bold':
                    formattedText = `**${selectedText}**`;
                    break;
                case 'italic':
                    formattedText = `*${selectedText}*`;
                    break;
                case 'underline':
                    formattedText = `__${selectedText}__`;
                    break;
            }
            
            const newText = textarea.value.substring(0, start) + formattedText + textarea.value.substring(end);
            textarea.value = newText;
            
            // Set cursor position after the formatted text
            const newCursorPos = start + formattedText.length;
            textarea.setSelectionRange(newCursorPos, newCursorPos);
            textarea.focus();
        }

        function insertLineBreak() {
            const textarea = document.getElementById('content');
            const cursorPos = textarea.selectionStart;
            const content = textarea.value;
            
            const beforeCursor = content.substring(0, cursorPos);
            const afterCursor = content.substring(cursorPos);
            
            textarea.value = beforeCursor + '\n\n' + afterCursor;
            
            const newPosition = cursorPos + 2;
            textarea.setSelectionRange(newPosition, newPosition);
            textarea.focus();
        }

        function insertBulletList() {
            const textarea = document.getElementById('content');
            const cursorPos = textarea.selectionStart;
            const content = textarea.value;
            
            const beforeCursor = content.substring(0, cursorPos);
            const afterCursor = content.substring(cursorPos);
            
            textarea.value = beforeCursor + '\n• ' + afterCursor;
            
            const newPosition = cursorPos + 3;
            textarea.setSelectionRange(newPosition, newPosition);
            textarea.focus();
        }

        function insertNumberedList() {
            const textarea = document.getElementById('content');
            const cursorPos = textarea.selectionStart;
            const content = textarea.value;
            
            const beforeCursor = content.substring(0, cursorPos);
            const afterCursor = content.substring(cursorPos);
            
            textarea.value = beforeCursor + '\n1. ' + afterCursor;
            
            const newPosition = cursorPos + 4;
            textarea.setSelectionRange(newPosition, newPosition);
            textarea.focus();
        }

        function insertSeparator() {
            const textarea = document.getElementById('content');
            const cursorPos = textarea.selectionStart;
            const content = textarea.value;
            
            const beforeCursor = content.substring(0, cursorPos);
            const afterCursor = content.substring(cursorPos);
            
            textarea.value = beforeCursor + '\n\n---\n\n' + afterCursor;
            
            const newPosition = cursorPos + 6;
            textarea.setSelectionRange(newPosition, newPosition);
            textarea.focus();
        }
    </script>
</body>

</html>