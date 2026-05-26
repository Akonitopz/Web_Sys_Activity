<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;

class AuditLogApiController extends Controller
{
    public function index()
    {
        $logs = AuditLog::with('user')
            ->latest()
            ->get();

        return response()->json($logs);
    }
}