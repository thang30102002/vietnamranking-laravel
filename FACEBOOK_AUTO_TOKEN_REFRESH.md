# 🔄 Hệ thống tự động refresh Facebook Access Token

## 🎯 Mục tiêu

Tự động refresh Facebook access token khi hết hạn để đảm bảo hệ thống hoạt động liên tục.

## ✅ Các phương pháp đã triển khai

### **1. 🔧 FacebookTokenService**

#### **A. Core Features:**
- ✅ **Long-lived token exchange** - Chuyển đổi short-lived thành long-lived
- ✅ **Page access token** - Lấy page access token từ user token
- ✅ **Token validation** - Kiểm tra token còn hiệu lực
- ✅ **Auto refresh** - Tự động refresh khi cần
- ✅ **Caching** - Cache token để tối ưu performance

#### **B. Key Methods:**
```php
// Lấy long-lived token
$longLivedToken = $tokenService->getLongLivedToken($shortLivedToken);

// Lấy page access token
$pageToken = $tokenService->getPageAccessToken($userToken, $pageId);

// Kiểm tra token hợp lệ
$isValid = $tokenService->isTokenValid($accessToken);

// Tự động refresh
$newToken = $tokenService->autoRefreshToken($currentToken, $pageId);

// Lấy token hợp lệ (từ cache hoặc refresh)
$validToken = $tokenService->getValidToken('page', $pageId);
```

### **2. 📅 Scheduled Tasks**

#### **A. Daily Token Check:**
```php
// routes/console.php
Schedule::command('facebook:refresh-token')->daily();
```

#### **B. Manual Refresh Command:**
```bash
# Kiểm tra và refresh token
php artisan facebook:refresh-token

# Force refresh (ngay cả khi token còn hợp lệ)
php artisan facebook:refresh-token --force
```

### **3. 🔗 Webhook Integration**

#### **A. Webhook Endpoints:**
```php
// Xác minh webhook
GET /facebook/webhook

// Nhận thông báo từ Facebook
POST /facebook/webhook

// Test webhook
GET /facebook/webhook/test
```

#### **B. Webhook Configuration:**
1. **Facebook App Settings** → **Webhooks**
2. **Callback URL**: `https://yourdomain.com/facebook/webhook`
3. **Verify Token**: Set trong config
4. **Subscribe to**: Page access token changes

### **4. 🚀 Auto-Integration với FacebookService**

#### **A. Automatic Token Refresh:**
```php
// FacebookService tự động sử dụng token hợp lệ
$facebookService = new FacebookService();
$result = $facebookService->postToPage($message, $link, $imageUrl);
```

#### **B. Fallback Mechanism:**
- ✅ **Cache first** - Ưu tiên token từ cache
- ✅ **Auto refresh** - Tự động refresh nếu cần
- ✅ **Fallback** - Sử dụng token cũ nếu refresh thất bại
- ✅ **Error handling** - Xử lý lỗi gracefully

## 🔧 Cấu hình

### **1. 📝 Environment Variables:**
```env
# Facebook App Configuration
FACEBOOK_APP_ID=your_app_id
FACEBOOK_APP_SECRET=your_app_secret
FACEBOOK_PAGE_ACCESS_TOKEN=your_page_token
FACEBOOK_PAGE_ID=your_page_id
FACEBOOK_WEBHOOK_VERIFY_TOKEN=your_verify_token
```

### **2. ⚙️ Config File:**
```php
// config/services.php
'facebook' => [
    'app_id' => env('FACEBOOK_APP_ID'),
    'app_secret' => env('FACEBOOK_APP_SECRET'),
    'page_access_token' => env('FACEBOOK_PAGE_ACCESS_TOKEN'),
    'page_id' => env('FACEBOOK_PAGE_ID'),
    'webhook_verify_token' => env('FACEBOOK_WEBHOOK_VERIFY_TOKEN'),
],
```

### **3. 🗄️ Cache Configuration:**
```php
// Token được cache 60 ngày
Cache::put('facebook_page_token', $token, now()->addDays(60));
```

## 📊 Workflow

### **1. 🔄 Token Refresh Process:**
```
1. Check cached token
   ↓
2. Validate token
   ↓
3. If invalid → Refresh token
   ↓
4. Get long-lived token
   ↓
5. Get page access token
   ↓
6. Cache new token
   ↓
7. Use new token
```

### **2. 📅 Scheduled Process:**
```
Daily Schedule:
1. Check token validity
2. If expired → Refresh
3. Log results
4. Continue normal operation
```

### **3. 🔗 Webhook Process:**
```
Facebook Notification:
1. Receive webhook
2. Parse token change
3. Update cached token
4. Log change
5. Continue operation
```

## 🎯 Benefits

### **1. 🚀 Automation:**
- ✅ **No manual intervention** - Không cần can thiệp thủ công
- ✅ **Continuous operation** - Hoạt động liên tục
- ✅ **Error prevention** - Ngăn ngừa lỗi token hết hạn
- ✅ **Seamless experience** - Trải nghiệm mượt mà

### **2. 🔧 Technical Benefits:**
- ✅ **Caching** - Tối ưu performance
- ✅ **Fallback** - Cơ chế dự phòng
- ✅ **Error handling** - Xử lý lỗi tốt
- ✅ **Logging** - Ghi log chi tiết

### **3. 📱 User Experience:**
- ✅ **Reliable posting** - Đăng bài đáng tin cậy
- ✅ **No interruptions** - Không bị gián đoạn
- ✅ **Transparent** - Hoạt động trong suốt
- ✅ **Professional** - Chuyên nghiệp

## 🧪 Testing

### **1. 🔍 Manual Testing:**
```bash
# Test token refresh
php artisan facebook:refresh-token

# Test webhook
curl -X GET "https://yourdomain.com/facebook/webhook/test"

# Test with force refresh
php artisan facebook:refresh-token --force
```

### **2. 📊 Monitoring:**
```bash
# Check logs
tail -f storage/logs/laravel.log | grep "Facebook"

# Check cache
php artisan cache:get facebook_page_token
```

### **3. 🔗 Webhook Testing:**
```bash
# Test webhook verification
curl -X GET "https://yourdomain.com/facebook/webhook?hub_mode=subscribe&hub_verify_token=your_token&hub_challenge=test"

# Test webhook handling
curl -X POST "https://yourdomain.com/facebook/webhook" -H "Content-Type: application/json" -d '{"object":"page","entry":[{"changes":[{"field":"access_token","value":"new_token"}]}]}'
```

## 🚨 Troubleshooting

### **1. ❌ Common Issues:**

#### **A. Token Expired:**
```
Error: "Invalid OAuth access token"
Solution: Run php artisan facebook:refresh-token
```

#### **B. Webhook Not Working:**
```
Error: "Webhook verification failed"
Solution: Check verify token in config
```

#### **C. Cache Issues:**
```
Error: "Token not found in cache"
Solution: Clear cache and refresh token
```

### **2. 🔧 Debug Commands:**
```bash
# Check token validity
php artisan tinker
>>> app(App\Services\FacebookTokenService::class)->isTokenValid('your_token')

# Clear cache
php artisan cache:clear

# Check scheduled tasks
php artisan schedule:list
```

## 📝 Usage Examples

### **1. 🔄 Automatic Usage:**
```php
// FacebookService tự động xử lý token refresh
$facebookService = new FacebookService();
$result = $facebookService->postToPage($message, $link, $imageUrl);
```

### **2. 🛠️ Manual Usage:**
```php
// Manual token refresh
$tokenService = new FacebookTokenService();
$newToken = $tokenService->autoRefreshToken($currentToken, $pageId);
```

### **3. 📅 Scheduled Usage:**
```bash
# Add to crontab
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

## 🎉 Kết quả

### **Hệ thống auto-refresh token giờ đây:**
- ✅ **Tự động** - Không cần can thiệp thủ công
- ✅ **Đáng tin cậy** - Hoạt động ổn định
- ✅ **Hiệu quả** - Tối ưu performance
- ✅ **Chuyên nghiệp** - Trông chuyên nghiệp
- ✅ **Dễ bảo trì** - Dễ bảo trì và debug

### **Lợi ích chính:**
- ✅ **No downtime** - Không bị downtime
- ✅ **Automatic** - Tự động hoàn toàn
- ✅ **Reliable** - Đáng tin cậy
- ✅ **Scalable** - Có thể mở rộng
- ✅ **Professional** - Chuyên nghiệp

**Facebook token giờ đây tự động refresh! 🔄✨**
