<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\FacebookTokenService;
use Illuminate\Support\Facades\Log;

class FacebookWebhookController extends Controller
{
    private $tokenService;

    public function __construct()
    {
        $this->tokenService = new FacebookTokenService();
    }

    /**
     * Xác minh webhook từ Facebook
     */
    public function verify(Request $request)
    {
        $hubMode = $request->get('hub_mode');
        $hubVerifyToken = $request->get('hub_verify_token');
        $hubChallenge = $request->get('hub_challenge');

        $verifyToken = config('services.facebook.webhook_verify_token');

        if ($hubMode === 'subscribe' && $hubVerifyToken === $verifyToken) {
            Log::info('Facebook webhook verified successfully');
            return response($hubChallenge, 200);
        }

        Log::warning('Facebook webhook verification failed', [
            'hub_mode' => $hubMode,
            'hub_verify_token' => $hubVerifyToken,
            'expected_token' => $verifyToken
        ]);

        return response('Forbidden', 403);
    }

    /**
     * Xử lý webhook từ Facebook
     */
    public function handle(Request $request)
    {
        try {
            $data = $request->all();
            
            Log::info('Facebook webhook received', ['data' => $data]);

            // Xử lý thay đổi token
            $this->tokenService->handleWebhook($data);

            return response('OK', 200);
        } catch (\Exception $e) {
            Log::error('Error handling Facebook webhook', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return response('Internal Server Error', 500);
        }
    }

    /**
     * Test webhook endpoint
     */
    public function test()
    {
        try {
            Log::info('Testing Facebook webhook...');
            
            // Test token service
            $this->tokenService->scheduledTokenCheck();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Facebook webhook test completed'
            ]);
        } catch (\Exception $e) {
            Log::error('Facebook webhook test failed', ['error' => $e->getMessage()]);
            
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}