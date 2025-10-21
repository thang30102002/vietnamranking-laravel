<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FacebookService;
use Illuminate\Support\Facades\Log;

class FacebookController extends Controller
{
    protected $facebookService;

    public function __construct(FacebookService $facebookService)
    {
        $this->facebookService = $facebookService;
    }

    /**
     * Hiển thị trang cài đặt Facebook
     */
    public function settings()
    {
        $connectionStatus = $this->facebookService->testConnection();
        
        return view('admin.facebook.settings', compact('connectionStatus'));
    }

    /**
     * Test kết nối Facebook
     */
    public function testConnection()
    {
        try {
            $result = $this->facebookService->testConnection();
            
            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Kết nối Facebook thành công!',
                    'data' => $result
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Kết nối Facebook thất bại: ' . $result['error']
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Facebook connection test failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi test kết nối: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Đăng bài test lên Facebook
     */
    public function testPost()
    {
        try {
            $message = "🧪 Bài viết test từ VietNamPool\n\n";
            $message .= "Đây là bài viết test để kiểm tra kết nối Facebook API.\n";
            $message .= "Thời gian: " . now()->format('d/m/Y H:i:s');
            
            $result = $this->facebookService->postToPage($message);
            
            return response()->json([
                'success' => true,
                'message' => 'Đăng bài test thành công!',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            Log::error('Facebook test post failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Đăng bài test thất bại: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Test queue job
     */
    public function testQueue()
    {
        try {
            // Tạo một news test để dispatch job
            $news = new \App\Models\News();
            $news->id = 999999; // Fake ID for testing
            $news->title = 'Test News for Queue';
            $news->slug = 'test-news-for-queue';
            $news->content = 'Test content';
            $news->excerpt = 'Test excerpt';
            $news->status = 'published';
            $news->author_id = 1; // Default admin user for testing
            
            // Dispatch job
            \App\Jobs\PostToFacebookJob::dispatch($news);
            
            return response()->json([
                'success' => true,
                'message' => 'Job đã được dispatch thành công! Kiểm tra logs để xem kết quả.'
            ]);
        } catch (\Exception $e) {
            Log::error('Queue test failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Test queue thất bại: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Test direct Facebook post (không qua queue)
     */
    public function testDirectPost()
    {
        try {
            $message = "🧪 Bài viết test trực tiếp từ VietNamPool\n\n";
            $message .= "Đây là bài viết test để kiểm tra Facebook API trực tiếp.\n";
            $message .= "Thời gian: " . now()->format('d/m/Y H:i:s');
            
            $result = $this->facebookService->postToPage($message);
            
            return response()->json([
                'success' => true,
                'message' => 'Đăng bài trực tiếp thành công!',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            Log::error('Direct Facebook post failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Đăng bài trực tiếp thất bại: ' . $e->getMessage()
            ]);
        }
    }
}
