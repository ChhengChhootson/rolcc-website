<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = Activity::with(['causer', 'subject'])
            ->when($request->causer, fn($q) => $q->where('causer_id', $request->causer))
            ->when($request->log_name, fn($q) => $q->where('log_name', $request->log_name))
            ->when($request->from, fn($q) => $q->whereDate('created_at', '>=', $request->from))
            ->when($request->to, fn($q) => $q->whereDate('created_at', '<=', $request->to))
            ->latest()
            ->paginate(30);

        return view('admin.activity-logs.index', compact('logs'));
    }
}
