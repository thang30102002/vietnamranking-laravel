<?php

namespace App\Jobs;

use App\Models\News;
use App\Services\FacebookService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Exception;

class PostToFacebookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $news;
    protected $facebookService;

    /**
     * Create a new job instance.
     */
    public function __construct(News $news)
    {
        $this->news = $news;
        $this->facebookService = app(FacebookService::class);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Kiểm tra model có tồn tại không
            if (!$this->news || !$this->news->exists) {
                Log::error('News model not found or does not exist', [
                    'news_id' => $this->news->id ?? 'unknown'
                ]);
                return;
            }

            Log::info('Starting Facebook post for news', ['news_id' => $this->news->id, 'title' => $this->news->title]);

            // Kiểm tra xem Facebook API đã được cấu hình chưa
            if (!$this->facebookService->isConfigured()) {
                Log::warning('Facebook API not configured, skipping post');
                return;
            }

            // Tạo message cho bài viết
            $message = $this->facebookService->createNewsMessage($this->news);
            
            // Tạo link đến bài viết (sử dụng URL thật thay vì localhost)
            $link = config('app.url') . route('news.show', $this->news->slug, false);
            
            // Tạo URL ảnh nếu có (sử dụng URL thật)
            $imageUrl = null;
            if ($this->news->image) {
                $imageUrl = config('app.url') . '/storage/news/' . $this->news->image;
            }

            // Đăng bài lên Facebook
            // Tạm thời không gửi link để tránh lỗi URL
            if ($imageUrl) {
                // Đăng bài với ảnh (không có link)
                $result = $this->facebookService->postWithImage($message, $imageUrl);
            } else {
                // Đăng bài thường (không có link)
                $result = $this->facebookService->postToPage($message);
            }

            Log::info('Facebook post successful', [
                'news_id' => $this->news->id,
                'facebook_post_id' => $result['id'] ?? 'unknown'
            ]);

        } catch (Exception $e) {
            Log::error('Facebook post failed', [
                'news_id' => $this->news->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Có thể thêm logic để retry hoặc thông báo lỗi
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(Exception $exception): void
    {
        Log::error('Facebook post job failed permanently', [
            'news_id' => $this->news->id,
            'error' => $exception->getMessage()
        ]);
    }
}
