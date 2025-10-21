# Hướng dẫn khắc phục vấn đề Facebook Integration

## 🚨 Vấn đề: Tạo bài báo từ admin/news/create không đăng lên Facebook

### ✅ Đã khắc phục:

1. **Tích hợp Facebook vào AdminNewsController** - Controller xử lý màn hình admin/news/create
2. **Thêm logging chi tiết** - Theo dõi quá trình dispatch job
3. **Dispatch job sau DB::commit()** - Đảm bảo model đã được lưu

### 🧪 Cách test:

#### Bước 1: Kiểm tra Queue Worker
```bash
# Chạy queue worker
php artisan queue:work

# Hoặc chạy một lần
php artisan queue:work --once
```

#### Bước 2: Tạo bài báo mới
1. Truy cập: `/admin/news/create`
2. Điền thông tin bài báo
3. **Chọn status = "Published"** (quan trọng!)
4. Nhấn "Tạo bài viết"

#### Bước 3: Kiểm tra logs
```bash
# Xem logs mới nhất
Get-Content storage/logs/laravel.log -Tail 20

# Tìm logs Facebook
Get-Content storage/logs/laravel.log | Select-String "Facebook|Dispatching"
```

### 📋 Checklist khắc phục:

- [ ] **Queue worker đang chạy**: `php artisan queue:work`
- [ ] **Status = "Published"**: Bài báo phải có status published
- [ ] **Facebook API hoạt động**: Test connection thành công
- [ ] **Logs hiển thị**: Job được dispatch và xử lý
- [ ] **Bài viết trên Facebook**: Kiểm tra fanpage

### 🎯 Kết quả mong đợi:

Khi tạo bài báo với status = 'published':
1. ✅ **Log**: "Dispatching Facebook post job for news (AdminNewsController)"
2. ✅ **Job được thêm vào queue**
3. ✅ **Queue worker xử lý job**
4. ✅ **Facebook API được gọi**
5. ✅ **Bài viết xuất hiện trên fanpage**

### 🔧 Commands hữu ích:

```bash
# Xem jobs trong queue
php artisan queue:monitor

# Xóa tất cả jobs
php artisan queue:clear

# Xem failed jobs
php artisan queue:failed

# Retry failed jobs
php artisan queue:retry all

# Restart queue worker
php artisan queue:restart
```

### 🚨 Troubleshooting:

#### Lỗi "No jobs in queue"
- Kiểm tra status bài báo = "Published"
- Kiểm tra logs có "Dispatching Facebook post job" không

#### Lỗi "ModelNotFoundException"
- Đã khắc phục bằng cách dispatch sau DB::commit()
- Clear queue cũ: `php artisan queue:clear`

#### Facebook API lỗi
- Kiểm tra cấu hình trong `.env`
- Test connection tại `/admin/facebook/settings`

### 📊 Monitoring:

#### Kiểm tra jobs table:
```sql
SELECT * FROM jobs ORDER BY created_at DESC LIMIT 5;
```

#### Kiểm tra logs:
```bash
# Xem logs real-time
Get-Content storage/logs/laravel.log -Wait

# Tìm logs Facebook
Get-Content storage/logs/laravel.log | Select-String "Facebook"
```

### 🎉 Kết quả cuối cùng:

Sau khi khắc phục, khi tạo bài báo mới từ `/admin/news/create` với status = "Published":
1. ✅ Job được dispatch thành công
2. ✅ Queue worker xử lý job
3. ✅ Facebook API được gọi
4. ✅ Bài viết xuất hiện trên fanpage
5. ✅ Logs hiển thị thành công
