<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pendingCount = Notice::where('status', 'pending')->count();
        $approvedCount = Notice::where('status', 'approved')->count();
        $rejectedCount = Notice::where('status', 'rejected')->count();

        return view('admin.dashboard', compact('pendingCount', 'approvedCount', 'rejectedCount'));
    }

    public function notices()
    {
        $notices = Notice::with(['category', 'creator'])->latest()->get();
        return view('admin.notices.index', compact('notices'));
    }

    public function updateStatus(Request $request, Notice $notice)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $notice->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Notice status updated to ' . $validated['status']);
    }
}
