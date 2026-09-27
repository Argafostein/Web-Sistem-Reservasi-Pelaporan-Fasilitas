<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Menampilkan form laporan.
     */
    public function create()
    {
        $facilities = Facility::where('status', 'available')->get();

        return view('report', compact('facilities'));
    }


    /**
     * Menyimpan laporan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'facility_id' => 'required|exists:facilities,facility_id',
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        // Upload foto jika ada
        if ($request->hasFile('image')) {

            $validated['image'] = $request
                ->file('image')
                ->store('reports', 'public');
        }


        // User yang sedang login
        $validated['user_id'] = Auth::id();

        // Status awal laporan
        $validated['status'] = 'pending';


        Report::create($validated);


        return redirect()
            ->route('lapor')
            ->with('success', 'Laporan berhasil dikirim.');
    }


    /**
     * Menampilkan riwayat laporan milik user.
     */
    public function history()
    {
        $reports = Report::where('user_id', Auth::id())
            ->with('facility')
            ->latest()
            ->get();

        return view('riwayat-laporan', compact('reports'));
    }


    /**
     * Menampilkan detail laporan.
     */
    public function show(Report $report)
    {
        // User hanya boleh melihat laporan miliknya sendiri
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }

        $report->load('facility');

        return view('detail-laporan', compact('report'));
    }
}