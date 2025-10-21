# Hướng dẫn cấu hình Facebook API

## Bước 1: Tạo Facebook App

1. Truy cập [Facebook Developers](https://developers.facebook.com/)
2. Đăng nhập bằng tài khoản Facebook của bạn
3. Nhấn "My Apps" → "Create App"
4. Chọn "Business" làm loại app
5. Điền thông tin:
   - App Name: VietNamPool
   - App Contact Email: your-email@example.com
   - Business Account: (tùy chọn)

## Bước 2: Cấu hình App

1. Trong App Dashboard, chọn "Add Product"
2. Thêm các sản phẩm sau:
   - **Facebook Login**: Để xác thực
   - **Pages**: Để quản lý Page

## Bước 3: Lấy App Credentials

1. Vào **Settings** → **Basic**
2. Copy **App ID** và **App Secret**

## Bước 4: Tạo Page Access Token

### Cách 1: Sử dụng Graph API Explorer
1. Truy cập [Graph API Explorer](https://developers.facebook.com/tools/explorer/)
2. Chọn app của bạn
3. Chọn "Get User Access Token"
4. Chọn các quyền: `pages_manage_posts`, `pages_read_engagement`, `pages_show_list`
5. Nhấn "Generate Access Token"
6. Copy token và đổi thành Page Access Token

### Cách 2: Sử dụng Facebook Login
1. Tạo một trang đăng nhập Facebook
2. Sau khi đăng nhập, lấy User Access Token
3. Gọi API để lấy Page Access Token

## Bước 5: Lấy Page ID

1. Truy cập trang Facebook của bạn
2. Vào **About** → **Page Info**
3. Copy **Page ID** (số ở cuối URL hoặc trong Page Info)

## Bước 6: Cấu hình trong Laravel

Thêm các biến sau vào file `.env`:

```env
FACEBOOK_APP_ID=your_facebook_app_id
FACEBOOK_APP_SECRET=your_facebook_app_secret
FACEBOOK_PAGE_ACCESS_TOKEN=your_facebook_page_access_token
FACEBOOK_PAGE_ID=your_facebook_page_id
```

## Bước 7: Cấu hình Queue (Tùy chọn)

Để xử lý đăng bài bất đồng bộ, cấu hình queue trong `.env`:

```env
QUEUE_CONNECTION=database
```

Sau đó chạy:
```bash
php artisan queue:table
php artisan migrate
php artisan queue:work
```

## Bước 8: Kiểm tra cấu hình

1. Truy cập `/admin/facebook/settings`
2. Nhấn "Test kết nối" để kiểm tra
3. Nhấn "Đăng bài test" để thử nghiệm

## Quyền cần thiết

- `pages_manage_posts`: Đăng bài lên Page
- `pages_read_engagement`: Đọc thông tin Page
- `pages_show_list`: Xem danh sách Pages

## Lưu ý quan trọng

1. **Page Access Token** có thể hết hạn, cần gia hạn định kỳ
2. Đảm bảo Page của bạn đã được xác minh (nếu cần)
3. Kiểm tra chính sách của Facebook về việc đăng bài tự động
4. Test kỹ trước khi sử dụng trong môi trường production

## Xử lý lỗi thường gặp

### Lỗi "Object with ID 'xxx' does not exist"
**Nguyên nhân:**
- Page ID không đúng hoặc không tồn tại
- Page Access Token không có quyền truy cập Page
- Page đã bị xóa hoặc không còn hoạt động
- Token đã hết hạn

**Cách khắc phục:**
1. **Kiểm tra Page ID:**
   - Truy cập trang Facebook của bạn
   - Vào Settings → Page Info
   - Copy Page ID chính xác (chỉ số, không có ký tự đặc biệt)

2. **Tạo lại Page Access Token:**
   - Vào [Graph API Explorer](https://developers.facebook.com/tools/explorer/)
   - Chọn app của bạn
   - Chọn "Get User Access Token"
   - Chọn quyền: `pages_manage_posts`, `pages_read_engagement`, `pages_show_list`
   - Sau khi có User Access Token, gọi API để lấy Page Access Token

3. **Kiểm tra Page còn hoạt động:**
   - Đảm bảo Page không bị xóa
   - Kiểm tra Page có bị hạn chế không

### Lỗi "Invalid Access Token"
- Kiểm tra lại Page Access Token
- Đảm bảo token chưa hết hạn
- Kiểm tra quyền của token

### Lỗi "Page not found"
- Kiểm tra Page ID
- Đảm bảo Page Access Token có quyền truy cập Page đó

### Lỗi "Insufficient permissions"
- Kiểm tra các quyền đã được cấp
- Đảm bảo Page Access Token có đủ quyền cần thiết

## Cách lấy Page ID chính xác

1. **Từ URL Facebook:**
   - Truy cập trang Facebook của bạn
   - URL sẽ có dạng: `https://www.facebook.com/your-page-name`
   - Hoặc: `https://www.facebook.com/pages/your-page/123456789`

2. **Từ Page Settings:**
   - Vào Settings → Page Info
   - Tìm "Page ID" trong thông tin cơ bản

3. **Sử dụng Graph API:**
   - Gọi API: `https://graph.facebook.com/me/accounts?access_token=YOUR_TOKEN`
   - Tìm Page ID trong danh sách trả về
