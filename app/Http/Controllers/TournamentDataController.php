<?php

namespace App\Http\Controllers;

use App\Models\TournamentData;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class TournamentDataController extends Controller
{
    /**
     * Lưu dữ liệu tournament vào database
     */
    public function save(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'tournament_id' => 'required|integer|exists:tournaments,id',
            'tournament_data' => 'required|array',
            'players' => 'required|array',
            'tournament_type' => 'required|string|in:ranking,free',
            'status' => 'nullable|string|in:active,completed,cancelled'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $tournamentData = TournamentData::updateOrCreate(
                ['tournament_id' => $request->tournament_id],
                [
                    'tournament_data' => $request->tournament_data,
                    'players' => $request->players,
                    'tournament_type' => $request->tournament_type,
                    'status' => $request->status ?? 'active',
                    'last_updated' => now()
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Tournament data saved successfully',
                'data' => $tournamentData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save tournament data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Lấy dữ liệu tournament từ database
     */
    public function get(Request $request, $tournamentId): JsonResponse
    {
        try {
            $tournamentData = TournamentData::where('tournament_id', $tournamentId)->first();

            if (!$tournamentData) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tournament data not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'tournament_data' => $tournamentData->tournament_data,
                    'players' => $tournamentData->players,
                    'tournament_type' => $tournamentData->tournament_type,
                    'status' => $tournamentData->status,
                    'last_updated' => $tournamentData->last_updated,
                    'created_at' => $tournamentData->created_at,
                    'updated_at' => $tournamentData->updated_at
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve tournament data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Xóa dữ liệu tournament
     */
    public function delete(Request $request, $tournamentId): JsonResponse
    {
        try {
            $tournamentData = TournamentData::where('tournament_id', $tournamentId)->first();

            if (!$tournamentData) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tournament data not found'
                ], 404);
            }

            $tournamentData->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tournament data deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete tournament data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cập nhật trạng thái tournament
     */
    public function updateStatus(Request $request, $tournamentId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,completed,cancelled'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $tournamentData = TournamentData::where('tournament_id', $tournamentId)->first();

            if (!$tournamentData) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tournament data not found'
                ], 404);
            }

            $tournamentData->update([
                'status' => $request->status,
                'last_updated' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Tournament status updated successfully',
                'data' => $tournamentData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update tournament status',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
