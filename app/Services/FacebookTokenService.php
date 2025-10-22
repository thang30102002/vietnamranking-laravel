<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Exception;

class FacebookTokenService
{
    private $appId;
    private $appSecret;
    private $baseUrl = 'https://graph.facebook.com/v24.0';

    public function __construct()
    {
        $this->appId = config('services.facebook.app_id');
        $this->appSecret = config('services.facebook.app_secret');
    }

    /**
     * Lấy long-lived access token từ short-lived token
     */
    public function getLongLivedToken($shortLivedToken)
    {
        Log::info('Getting long-lived token', ['shortLivedToken' => $shortLivedToken]);
        try {
            $response = Http::get($this->baseUrl . '/oauth/access_token', [
                'grant_type' => 'fb_exchange_token',
                'client_id' => $this->appId,
                'client_secret' => $this->appSecret,
                'fb_exchange_token' => $shortLivedToken
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['access_token'];
            }

            throw new Exception('Không thể lấy long-lived token: ' . $response->body());
        } catch (Exception $e) {
            Log::error('Error getting long-lived token', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Lấy page access token từ user access token
     */
    public function getPageAccessToken($longLivedToken, $user_id)
    {
        try {
            $response = Http::get($this->baseUrl . "/{$user_id}/accounts", [
                'access_token' => $longLivedToken
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['data'][0]['access_token'];
            }

            throw new Exception('Không thể lấy page access token: ' . $response->body());
        } catch (Exception $e) {
            Log::error('Error getting page access token', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Kiểm tra token có còn hiệu lực không
     */
    public function isTokenValid($accessToken)
    {
        try {
            $response = Http::get($this->baseUrl . '/me', [
                'access_token' => $accessToken
            ]);

            return $response->successful();
        } catch (Exception $e) {
            Log::error('Error checking token validity', ['error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Lấy thông tin token (expires_in, etc.)
     */
    public function getTokenInfo($accessToken)
    {
        try {
            $response = Http::get($this->baseUrl . '/debug_token', [
                'input_token' => $accessToken,
                'access_token' => $this->appId . '|' . $this->appSecret
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            throw new Exception('Không thể lấy thông tin token: ' . $response->body());
        } catch (Exception $e) {
            Log::error('Error getting token info', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Tự động refresh token nếu cần
     */
    public function autoRefreshToken($currentToken, $pageId = null)
    {
        try {
            // Kiểm tra token có còn hiệu lực không
            if ($this->isTokenValid($currentToken)) {
                Log::info('Token vẫn còn hiệu lực');
                return $currentToken;
            }

            Log::info('Token đã hết hạn, bắt đầu refresh...');

            // Lấy long-lived token từ .env thông qua config
            $longLivedToken = config('services.facebook.user_access_token_long_lived');
            Log::info('Long-lived token', ['longLivedToken' => $longLivedToken]);
            
            // Nếu có pageId, lấy page access token
            if ($pageId) {
                $user_id = config('services.facebook.user_id');
                // method getPageAccessToken nhận (token, pageId)
                $pageToken = $this->getPageAccessToken($longLivedToken, $user_id);
                
                // Cache token mới
                Cache::put('facebook_page_token', $pageToken, now()->addDays(60));
                
                return $pageToken;
            }

            // Cache token mới
            Cache::put('facebook_user_token', $longLivedToken, now()->addDays(60));
            
            return $longLivedToken;
        } catch (Exception $e) {
            Log::error('Error auto-refreshing token', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Lấy token từ cache hoặc refresh nếu cần
     */
    public function getValidToken($tokenType = 'page', $pageId = null)
    {
        $cacheKey = $tokenType === 'page' ? 'facebook_page_token' : 'facebook_user_token';
        $cachedToken = Cache::get($cacheKey);

        if ($cachedToken && $this->isTokenValid($cachedToken)) {
            Log::info('Using cached token');
            return $cachedToken;
        }

        Log::info('Cached token invalid or expired, refreshing...');
        
        // Lấy token hiện tại từ config
        $currentToken = $tokenType === 'page' 
            ? config('services.facebook.page_access_token')
            : config('services.facebook.user_access_token');

        if (!$currentToken) {
            throw new Exception("Không tìm thấy {$tokenType} access token trong config");
        }

        return $this->autoRefreshToken($currentToken, $pageId);
    }

    /**
     * Lưu token mới vào config file (cần quyền write)
     */
    public function saveTokenToConfig($token, $tokenType = 'page')
    {
        try {
            $configFile = config_path('services.php');
            $config = file_get_contents($configFile);
            
            $key = $tokenType === 'page' ? 'page_access_token' : 'user_access_token';
            $pattern = "/'{$key}'\s*=>\s*'[^']*'/";
            $replacement = "'{$key}' => '{$token}'";
            
            $newConfig = preg_replace($pattern, $replacement, $config);
            
            if ($newConfig !== $config) {
                file_put_contents($configFile, $newConfig);
                Log::info("Đã cập nhật {$tokenType} token vào config");
                return true;
            }
            
            return false;
        } catch (Exception $e) {
            Log::error('Error saving token to config', ['error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Webhook để nhận thông báo token refresh từ Facebook
     */
    public function handleWebhook($data)
    {
        try {
            if (isset($data['object']) && $data['object'] === 'page') {
                foreach ($data['entry'] as $entry) {
                    if (isset($entry['changes'])) {
                        foreach ($entry['changes'] as $change) {
                            if ($change['field'] === 'access_token') {
                                Log::info('Facebook access token changed', ['change' => $change]);
                                // Xử lý thay đổi token
                                $this->handleTokenChange($change);
                            }
                        }
                    }
                }
            }
        } catch (Exception $e) {
            Log::error('Error handling webhook', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Xử lý thay đổi token từ webhook
     */
    private function handleTokenChange($change)
    {
        try {
            $newToken = $change['value'];
            
            // Lưu token mới
            Cache::put('facebook_page_token', $newToken, now()->addDays(60));
            
            // Có thể lưu vào database hoặc config file
            Log::info('Token updated from webhook', ['new_token' => substr($newToken, 0, 10) . '...']);
        } catch (Exception $e) {
            Log::error('Error handling token change', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Scheduled job để kiểm tra và refresh token
     */
    public function scheduledTokenCheck()
    {
        try {
            Log::info('Running scheduled token check...');
            
            $pageId = config('services.facebook.page_id');
            $currentToken = config('services.facebook.page_access_token');
            
            if (!$currentToken) {
                Log::warning('No page access token found in config');
                return;
            }

            // Kiểm tra token
            if (!$this->isTokenValid($currentToken)) {
                Log::info('Token invalid, attempting refresh...');
                
                // Thử refresh token
                $newToken = $this->autoRefreshToken($currentToken, $pageId);
                
                if ($newToken) {
                    Log::info('Token refreshed successfully');
                } else {
                    Log::error('Failed to refresh token');
                }
            } else {
                Log::info('Token is still valid');
            }
        } catch (Exception $e) {
            Log::error('Error in scheduled token check', ['error' => $e->getMessage()]);
        }
    }
}
