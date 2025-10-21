# Hướng dẫn khắc phục vấn đề Queue

## Vấn đề: Tạo bài báo mới nhưng không thấy call API Facebook

### 🔍 Nguyên nhân có thể:

1. **Queue worker chưa chạy** - Jobs được dispatch nhưng không được xử lý
2. **Cấu hình queue chưa đúng** - Queue connection không đúng
3. **Jobs table chưa tồn tại** - Database chưa có bảng jobs
4. **Logging không hiển thị** - Không thấy logs trong Laravel

### 🛠️ Cách khắc phục:

#### Bước 1: Kiểm tra cấu hình Queue

Kiểm tra file `.env`:
```env
QUEUE_CONNECTION=database
```

#### Bước 2: Tạo bảng jobs (nếu chưa có)

```bash
php artisan queue:table
php artisan migrate
```

#### Bước 3: Chạy Queue Worker

**Cách 1: Chạy thủ công (cho test)**
```bash
php artisan queue:work
```

**Cách 2: Chạy với timeout**
```bash
php artisan queue:work --tries=3 --timeout=60
```

**Cách 3: Chạy trong background (production)**
```bash
nohup php artisan queue:work --daemon > storage/logs/queue.log 2>&1 &
```

#### Bước 4: Kiểm tra Jobs trong Database

```sql
SELECT * FROM jobs ORDER BY created_at DESC LIMIT 10;
```

#### Bước 5: Kiểm tra Logs

```bash
tail -f storage/logs/laravel.log
```

### 🧪 Test Queue

1. **Truy cập**: `/admin/facebook/settings`
2. **Nhấn "Test Queue"** để kiểm tra
3. **Kiểm tra logs** để xem job có được xử lý không

### 📋 Commands hữu ích:

```bash
# Xem jobs đang chờ
php artisan queue:monitor

# Xóa tất cả jobs
php artisan queue:clear

# Restart queue worker
php artisan queue:restart

# Xem failed jobs
php artisan queue:failed

# Retry failed jobs
php artisan queue:retry all
```

### 🔧 Cấu hình Production:

#### Windows (XAMPP):
```bash
# Tạo batch file start-queue.bat
@echo off
cd C:\xampp\htdocs\vietnamranking-laravel
php artisan queue:work --tries=3 --timeout=60
pause
```

#### Linux/Mac:
```bash
# Tạo systemd service
sudo nano /etc/systemd/system/laravel-queue.service
```

### 🚨 Troubleshooting:

#### Lỗi "Table 'jobs' doesn't exist"
```bash
php artisan queue:table
php artisan migrate
```

#### Lỗi "Connection refused"
- Kiểm tra database connection
- Đảm bảo MySQL đang chạy

#### Jobs không được xử lý
- Kiểm tra queue worker có đang chạy không
- Kiểm tra logs để xem lỗi
- Restart queue worker

### 📊 Monitoring:

#### Kiểm tra jobs table:
```sql
SELECT 
    id, 
    queue, 
    payload, 
    attempts, 
    created_at,
    available_at
FROM jobs 
ORDER BY created_at DESC;
```

#### Kiểm tra failed_jobs table:
```sql
SELECT * FROM failed_jobs ORDER BY failed_at DESC;
```

### ✅ Checklist:

- [ ] Queue connection = 'database' trong .env
- [ ] Bảng jobs đã được tạo
- [ ] Queue worker đang chạy
- [ ] Facebook API đã cấu hình đúng
- [ ] Test queue thành công
- [ ] Logs hiển thị job được dispatch và xử lý

### 🎯 Kết quả mong đợi:

Khi tạo bài báo mới với status = 'published':
1. Log hiển thị: "Dispatching Facebook post job for news"
2. Job được thêm vào bảng jobs
3. Queue worker xử lý job
4. Facebook API được gọi
5. Bài viết được đăng lên Facebook
6. Log hiển thị: "Facebook post successful"
