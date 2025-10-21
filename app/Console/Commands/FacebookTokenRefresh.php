<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FacebookTokenService;

class FacebookTokenRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facebook:refresh-token {--force : Force refresh even if token is valid}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh Facebook access token if expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Facebook token refresh...');
        
        try {
            $facebookTokenService = new FacebookTokenService();
            
            if ($this->option('force')) {
                $this->info('Force refresh enabled...');
                $this->forceRefreshToken($facebookTokenService);
            } else {
                $this->info('Checking token validity...');
                $facebookTokenService->scheduledTokenCheck();
            }
            
            $this->info('Token refresh completed successfully!');
        } catch (\Exception $e) {
            $this->error('Error refreshing token: ' . $e->getMessage());
            return 1;
        }
        
        return 0;
    }

    /**
     * Force refresh token
     */
    private function forceRefreshToken(FacebookTokenService $service)
    {
        try {
            $pageId = config('services.facebook.page_id');
            $currentToken = config('services.facebook.page_access_token');
            
            if (!$currentToken) {
                $this->error('No page access token found in config');
                return;
            }

            $this->info('Force refreshing token...');
            $newToken = $service->autoRefreshToken($currentToken, $pageId);
            
            if ($newToken) {
                $this->info('Token refreshed successfully!');
                $this->info('New token: ' . substr($newToken, 0, 10) . '...');
                
                // Có thể lưu vào config file
                if ($service->saveTokenToConfig($newToken, 'page')) {
                    $this->info('Token saved to config file');
                } else {
                    $this->warn('Could not save token to config file');
                }
            } else {
                $this->error('Failed to refresh token');
            }
        } catch (\Exception $e) {
            $this->error('Error force refreshing token: ' . $e->getMessage());
        }
    }
}