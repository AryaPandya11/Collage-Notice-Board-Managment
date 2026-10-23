<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\Category;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    public function facultyDashboard()
    {
        $notices = Notice::where('created_by', Auth::id())->latest()->get();
        return view('faculty.dashboard', compact('notices'));
    }

    public function studentDashboard(Request $request)
    {
        $query = Notice::with(['category', 'attachments'])
            ->where('status', 'approved')
            ->where(function($q) {
                $q->whereNull('expiry_date')
                  ->orWhere('expiry_date', '>=', now()->toDateString());
            });

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $notices = $query->latest()->get();
        $categories = Category::all();

        return view('student.dashboard', compact('notices', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('faculty.notices.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'expiry_date' => 'nullable|date|after_or_equal:today',
            'file.*' => 'nullable|file|max:10240',
        ]);

        $notice = Notice::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'created_by' => Auth::id(),
            'status' => 'pending',
            'expiry_date' => $validated['expiry_date'] ?? null,
        ]);

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $path = $file->store('attachments', 'public');
                Attachment::create([
                    'notice_id' => $notice->id,
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('faculty.dashboard')->with('success', 'Notice created and is pending approval.');
    }

    public function edit(Notice $notice)
    {
        if ($notice->created_by !== Auth::id()) {
            abort(403);
        }
        $categories = Category::all();
        return view('faculty.notices.edit', compact('notice', 'categories'));
    }

    public function update(Request $request, Notice $notice)
    {
        if ($notice->created_by !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'expiry_date' => 'nullable|date|after_or_equal:today',
        ]);

        $notice->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'expiry_date' => $validated['expiry_date'] ?? null,
        ]);

        return redirect()->route('faculty.dashboard')->with('success', 'Notice updated successfully.');
    }

    public function destroy(Notice $notice)
    {
        if ($notice->created_by !== Auth::id()) {
            abort(403);
        }

        foreach ($notice->attachments as $attachment) {
            Storage::disk('public')->delete($attachment->file_path);
            $attachment->delete();
        }

        $notice->delete();

        return redirect()->route('faculty.dashboard')->with('success', 'Notice deleted successfully.');
    }

    public function show(Notice $notice)
    {
        $isOwnerOrAdmin = Auth::user()->role === 'admin' || $notice->created_by === Auth::id();
        $isApprovedAndValid = $notice->status === 'approved' && (!$notice->expiry_date || $notice->expiry_date >= now()->toDateString());

        if (!$isOwnerOrAdmin && !$isApprovedAndValid) {
            abort(404);
        }

        return view('student.notices.show', compact('notice'));
    }

    public function downloadAttachment(Attachment $attachment)
    {
        $notice = $attachment->notice;
        $isOwnerOrAdmin = Auth::user()->role === 'admin' || $notice->created_by === Auth::id();
        $isApprovedAndValid = $notice->status === 'approved' && (!$notice->expiry_date || $notice->expiry_date >= now()->toDateString());

        if (!$isOwnerOrAdmin && !$isApprovedAndValid) {
            abort(403);
        }

        return Storage::disk('public')->download($attachment->file_path);
    }
}
