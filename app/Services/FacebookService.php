<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Exception;

class FacebookService
{
    private $appId;
    private $appSecret;
    private $pageAccessToken;
    private $pageId;
    private $baseUrl = 'https://graph.facebook.com/v24.0';
    private $tokenService;

    public function __construct()
    {
        $this->appId = config('services.facebook.app_id');
        $this->appSecret = config('services.facebook.app_secret');
        $this->pageAccessToken = config('services.facebook.page_access_token');
        $this->pageId = config('services.facebook.page_id');
        $this->tokenService = new FacebookTokenService();
    }

    /**
     * Lấy access token hợp lệ (tự động refresh nếu cần)
     */
    private function getValidAccessToken()
    {
        try {
            // Thử lấy token từ cache trước
            $cachedToken = Cache::get('facebook_page_token');
            Log::info('Cached token', ['cachedToken' => $cachedToken]);
            if ($cachedToken && $this->tokenService->isTokenValid($cachedToken)) {
                Log::info('Using cached valid token');
                return $cachedToken;
            }

            // Nếu không có cache hoặc token không hợp lệ, refresh
            Log::info('Token invalid or not cached, refreshing...');
            $newToken = $this->tokenService->getValidToken('page', $this->pageId);
            
            if ($newToken) {
                Log::info('Token refreshed successfully');
                return $newToken;
            }

            // Fallback về token cũ
            Log::warning('Using fallback token');
            return $this->pageAccessToken;
        } catch (Exception $e) {
            Log::error('Error getting valid token', ['error' => $e->getMessage()]);
            return $this->pageAccessToken;
        }
    }

    /**
     * Đăng bài viết lên Facebook Page
     */
    public function postToPage($message, $link = null, $imageUrl = null)
    {
        Log::info('Posting to Facebook Page 123', ['message' => $message]);
        // Log::info('Posting to Facebook Page', ['message' => $message, 'link' => $link, 'imageUrl' => $imageUrl]);
        try {
            if (!$this->isConfigured()) {
                throw new Exception('Facebook API chưa được cấu hình đầy đủ');
            }

            // Lấy token hợp lệ
            $accessToken = $this->getValidAccessToken();
            Log::info('Access token', ['accessToken' => $accessToken]);

            $data = [
                'message' => $message,
                'access_token' => $accessToken
            ];

            // Tạm thời không gửi link để tránh lỗi URL localhost
            // if ($link) {
            //     $data['link'] = $link;
            // }

            // Thêm ảnh nếu có
            if ($imageUrl) {
                $data['url'] = $imageUrl;
            }

            $response = Http::post("{$this->baseUrl}/{$this->pageId}/feed", $data);

            if ($response->successful()) {
                $result = $response->json();
                Log::info('Facebook post successful', ['post_id' => $result['id']]);
                return $result;
            } else {
                Log::error('Facebook post failed', [
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
                throw new Exception('Không thể đăng bài lên Facebook: ' . $response->body());
            }

        } catch (Exception $e) {
            Log::error('Facebook API Error', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Đăng bài với ảnh
     */
    public function postWithImage($message, $imageUrl, $link = null)
    {
        Log::info('Posting with image 123', ['message' => $message, 'imageUrl' => $imageUrl, 'link' => $link]);
        try {
            if (!$this->isConfigured()) {
                throw new Exception('Facebook API chưa được cấu hình đầy đủ');
            }

            // Lấy token hợp lệ
            $accessToken = $this->getValidAccessToken();

            $data = [
                'caption' => $message,
                'url' => $imageUrl,
                'access_token' => $accessToken
            ];

            // Tạm thời không gửi link để tránh lỗi URL localhost
            // if ($link) {
            //     $data['link'] = $link;
            // }

            $response = Http::post("{$this->baseUrl}/{$this->pageId}/photos", $data);

            if ($response->successful()) {
                $result = $response->json();
                Log::info('Facebook photo post successful', ['post_id' => $result['id']]);
                return $result;
            } else {
                Log::error('Facebook photo post failed', [
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
                throw new Exception('Không thể đăng ảnh lên Facebook: ' . $response->body());
            }

        } catch (Exception $e) {
            Log::error('Facebook Photo API Error', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Lấy thông tin Page
     */
    public function getPageInfo()
    {
        try {
            if (!$this->isConfigured()) {
                throw new Exception('Facebook API chưa được cấu hình đầy đủ');
            }

            // Debug: Log thông tin cấu hình (không log token thật)
            Log::info('Facebook API Debug', [
                'page_id' => $this->pageId,
                'token_length' => strlen($this->pageAccessToken),
                'api_url' => "{$this->baseUrl}/{$this->pageId}"
            ]);

            $response = Http::get("{$this->baseUrl}/{$this->pageId}", [
                'fields' => 'id,name,access_token',
                'access_token' => $this->pageAccessToken
            ]);

            if ($response->successful()) {
                return $response->json();
            } else {
                $errorBody = $response->body();
                Log::error('Facebook API Error Response', [
                    'status' => $response->status(),
                    'body' => $errorBody
                ]);
                throw new Exception('Không thể lấy thông tin Page: ' . $errorBody);
            }

        } catch (Exception $e) {
            Log::error('Facebook Page Info Error', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Kiểm tra kết nối Facebook
     */
    public function testConnection()
    {
        try {
            // Kiểm tra token trước
            $tokenInfo = $this->validateToken();
            if (!$tokenInfo['valid']) {
                return [
                    'success' => false,
                    'error' => 'Token không hợp lệ: ' . $tokenInfo['error']
                ];
            }

            $pageInfo = $this->getPageInfo();
            return [
                'success' => true,
                'page_name' => $pageInfo['name'] ?? 'Unknown',
                'page_id' => $pageInfo['id'] ?? 'Unknown'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Kiểm tra token có hợp lệ không
     */
    public function validateToken()
    {
        try {
            if (!$this->isConfigured()) {
                return [
                    'valid' => false,
                    'error' => 'Facebook API chưa được cấu hình đầy đủ'
                ];
            }

            // Kiểm tra token bằng cách gọi API me
            $response = Http::get("{$this->baseUrl}/me", [
                'access_token' => $this->pageAccessToken
            ]);

            if ($response->successful()) {
                return [
                    'valid' => true,
                    'user_info' => $response->json()
                ];
            } else {
                $errorBody = $response->body();
                return [
                    'valid' => false,
                    'error' => 'Token không hợp lệ: ' . $errorBody
                ];
            }
        } catch (Exception $e) {
            return [
                'valid' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Kiểm tra xem Facebook API đã được cấu hình chưa
     */
    public function isConfigured()
    {
        return !empty($this->appId) && 
               !empty($this->appSecret) && 
               !empty($this->pageAccessToken) && 
               !empty($this->pageId);
    }

    /**
     * Tạo message cho bài viết tin tức
     */
    public function createNewsMessage($news)
    {
        $message = "📰 " . $news->title . "\n\n";
        
        if ($news->excerpt) {
            $message .= $news->excerpt . "\n\n";
        }
        
        $message .= "🔗 Đọc thêm tại: " . route('news.show', $news->slug);
        
        if ($news->category) {
            $message .= "\n\n📂 Danh mục: " . $news->category->name;
        }
        
        return $message;
    }
}
