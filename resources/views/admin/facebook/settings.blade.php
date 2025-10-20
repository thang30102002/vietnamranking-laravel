@extends('layouts.admin')

@section('title', 'Cài đặt Facebook - VietNamPool')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fab fa-facebook"></i> Cài đặt Facebook
                    </h3>
                </div>
                <div class="card-body">
                    <!-- Connection Status -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="alert alert-{{ $connectionStatus['success'] ? 'success' : 'danger' }}" role="alert">
                                <h5 class="alert-heading">
                                    <i class="fas fa-{{ $connectionStatus['success'] ? 'check-circle' : 'exclamation-triangle' }}"></i>
                                    Trạng thái kết nối Facebook
                                </h5>
                                @if($connectionStatus['success'])
                                    <p class="mb-0">
                                        <strong>Kết nối thành công!</strong><br>
                                        Page: {{ $connectionStatus['page_name'] ?? 'Unknown' }}<br>
                                        Page ID: {{ $connectionStatus['page_id'] ?? 'Unknown' }}
                                    </p>
                                @else
                                    <p class="mb-0">
                                        <strong>Kết nối thất bại!</strong><br>
                                        {{ $connectionStatus['error'] ?? 'Vui lòng kiểm tra cấu hình Facebook API' }}
                                    </p>
                                    
                                    @if(strpos($connectionStatus['error'] ?? '', 'Object with ID') !== false)
                                        <div class="mt-3">
                                            <h6><i class="fas fa-exclamation-triangle"></i> Có thể do:</h6>
                                            <ul class="mb-0">
                                                <li><strong>Page ID không đúng:</strong> Kiểm tra lại FACEBOOK_PAGE_ID trong file .env</li>
                                                <li><strong>Page Access Token không có quyền:</strong> Token cần có quyền truy cập Page này</li>
                                                <li><strong>Page không tồn tại hoặc bị xóa:</strong> Kiểm tra Page có còn hoạt động không</li>
                                                <li><strong>Token đã hết hạn:</strong> Tạo lại Page Access Token mới</li>
                                            </ul>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Configuration Instructions -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Hướng dẫn cấu hình Facebook API</h5>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-info">
                                        <h6><i class="fas fa-info-circle"></i> Các bước cấu hình:</h6>
                                        <ol>
                                            <li>Truy cập <a href="https://developers.facebook.com/" target="_blank">Facebook Developers</a></li>
                                            <li>Tạo một Facebook App mới</li>
                                            <li>Thêm Facebook Login và Pages API vào app</li>
                                            <li>Lấy App ID và App Secret</li>
                                            <li>Tạo Page Access Token với quyền <code>pages_manage_posts</code></li>
                                            <li>Cập nhật các biến môi trường trong file <code>.env</code></li>
                                        </ol>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Biến môi trường cần cấu hình:</h6>
                                            <pre class="bg-light p-3"><code>FACEBOOK_APP_ID=your_app_id
FACEBOOK_APP_SECRET=your_app_secret
FACEBOOK_PAGE_ACCESS_TOKEN=your_page_token
FACEBOOK_PAGE_ID=your_page_id</code></pre>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Quyền cần thiết:</h6>
                                            <ul>
                                                <li><code>pages_manage_posts</code> - Đăng bài lên Page</li>
                                                <li><code>pages_read_engagement</code> - Đọc thông tin Page</li>
                                                <li><code>pages_show_list</code> - Xem danh sách Pages</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Debug Information -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <i class="fas fa-bug"></i> Thông tin Debug
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Cấu hình hiện tại:</h6>
                                            <ul class="list-unstyled">
                                                <li><strong>App ID:</strong> {{ config('services.facebook.app_id') ? 'Đã cấu hình' : 'Chưa cấu hình' }}</li>
                                                <li><strong>App Secret:</strong> {{ config('services.facebook.app_secret') ? 'Đã cấu hình' : 'Chưa cấu hình' }}</li>
                                                <li><strong>Page Access Token:</strong> {{ config('services.facebook.page_access_token') ? 'Đã cấu hình' : 'Chưa cấu hình' }}</li>
                                                <li><strong>Page ID:</strong> {{ config('services.facebook.page_id') ?: 'Chưa cấu hình' }}</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Hướng dẫn khắc phục:</h6>
                                            <ol class="small">
                                                <li>Kiểm tra file <code>.env</code> có đầy đủ thông tin</li>
                                                <li>Đảm bảo Page ID đúng (không có dấu cách, ký tự đặc biệt)</li>
                                                <li>Tạo lại Page Access Token với đủ quyền</li>
                                                <li>Kiểm tra Page có còn hoạt động không</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Test Actions -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Kiểm tra kết nối</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-primary btn-block" id="testConnection">
                                                <i class="fas fa-plug"></i> Test kết nối
                                            </button>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-success btn-block" id="testPost">
                                                <i class="fab fa-facebook"></i> Đăng bài test
                                            </button>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-warning btn-block" id="testQueue">
                                                <i class="fas fa-tasks"></i> Test Queue
                                            </button>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-info btn-block" id="testDirect">
                                                <i class="fas fa-bolt"></i> Test trực tiếp
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div id="testResults" class="mt-3" style="display: none;">
                                        <div class="alert" role="alert">
                                            <div id="testMessage"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Tính năng tự động đăng bài</h5>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-success">
                                        <h6><i class="fas fa-check-circle"></i> Tính năng đã được kích hoạt:</h6>
                                        <ul class="mb-0">
                                            <li>Tự động đăng bài lên Facebook khi tạo bài viết mới với trạng thái "Published"</li>
                                            <li>Tự động đăng bài khi cập nhật bài viết từ "Draft" thành "Published"</li>
                                            <li>Đăng bài bất đồng bộ thông qua Queue để không ảnh hưởng đến hiệu suất</li>
                                            <li>Bao gồm ảnh, tiêu đề, tóm tắt và link đến bài viết</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Test Connection
    document.getElementById('testConnection').addEventListener('click', function() {
        const button = this;
        const originalText = button.innerHTML;
        
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang kiểm tra...';
        button.disabled = true;
        
        fetch('{{ route("admin.facebook.test-connection") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            showTestResult(data.success, data.message, data.data);
        })
        .catch(error => {
            showTestResult(false, 'Lỗi: ' + error.message);
        })
        .finally(() => {
            button.innerHTML = originalText;
            button.disabled = false;
        });
    });
    
    // Test Post
    document.getElementById('testPost').addEventListener('click', function() {
        const button = this;
        const originalText = button.innerHTML;
        
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang đăng bài...';
        button.disabled = true;
        
        fetch('{{ route("admin.facebook.test-post") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            showTestResult(data.success, data.message, data.data);
        })
        .catch(error => {
            showTestResult(false, 'Lỗi: ' + error.message);
        })
        .finally(() => {
            button.innerHTML = originalText;
            button.disabled = false;
        });
    });
    
    // Test Queue
    document.getElementById('testQueue').addEventListener('click', function() {
        const button = this;
        const originalText = button.innerHTML;
        
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang test queue...';
        button.disabled = true;
        
        fetch('{{ route("admin.facebook.test-queue") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            showTestResult(data.success, data.message, data.data);
        })
        .catch(error => {
            showTestResult(false, 'Lỗi: ' + error.message);
        })
        .finally(() => {
            button.innerHTML = originalText;
            button.disabled = false;
        });
    });
    
    // Test Direct
    document.getElementById('testDirect').addEventListener('click', function() {
        const button = this;
        const originalText = button.innerHTML;
        
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang test trực tiếp...';
        button.disabled = true;
        
        fetch('{{ route("admin.facebook.test-direct") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            showTestResult(data.success, data.message, data.data);
        })
        .catch(error => {
            showTestResult(false, 'Lỗi: ' + error.message);
        })
        .finally(() => {
            button.innerHTML = originalText;
            button.disabled = false;
        });
    });
    
    function showTestResult(success, message, data = null) {
        const resultsDiv = document.getElementById('testResults');
        const messageDiv = document.getElementById('testMessage');
        const alert = resultsDiv.querySelector('.alert');
        
        alert.className = 'alert ' + (success ? 'alert-success' : 'alert-danger');
        
        let content = '<strong>' + (success ? 'Thành công!' : 'Thất bại!') + '</strong><br>' + message;
        
        if (data && success) {
            if (data.page_name) {
                content += '<br><small>Page: ' + data.page_name + '</small>';
            }
            if (data.id) {
                content += '<br><small>Post ID: ' + data.id + '</small>';
            }
        }
        
        messageDiv.innerHTML = content;
        resultsDiv.style.display = 'block';
    }
});
</script>
@endsection
