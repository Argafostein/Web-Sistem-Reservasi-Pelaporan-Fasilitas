<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PetugasLaporanController extends Controller
{
    public function antrianLaporan()
    {
        $activeReports = Report::with([
            'user',
            'facility',
            'logs.user',
        ])
            ->whereIn('status', ['pending'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view(
            'petugas.antrian-laporan',
            compact('activeReports')
        );
    }

    public function updateReportStatus(
        Request $request,
        Report $report
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'processing',
                    'resolved',
                    'rejected',
                ]),
            ],
            'resolution_note' => [
                Rule::requiredIf(
                    in_array(
                        $request->input('status'),
                        ['resolved', 'rejected']
                    )
                ),
                'nullable',
                'string',
                'max:2000',
            ],
        ], [
            'status.required' => 'Status laporan wajib dipilih.',
            'status.in' => 'Status laporan tidak valid.',
            'resolution_note.required' =>
                'Catatan penyelesaian atau alasan penolakan wajib diisi.',
            'resolution_note.max' =>
                'Catatan maksimal 2000 karakter.',
        ]);

        DB::transaction(function () use ($report, $validated) {
            $report = Report::where(
                'report_id',
                $report->report_id
            )
                ->lockForUpdate()
                ->firstOrFail();

            $oldStatus = $report->status;
            $status = $validated['status'];

            $note = in_array(
                $status,
                ['resolved', 'rejected'],
                true
            )
                ? trim($validated['resolution_note'])
                : null;

            $report->status = $status;

            if ($status === 'pending') {
                $report->processed_at = null;
                $report->resolved_at = null;
                $report->rejected_at = null;
                $report->resolution_note = null;
            } elseif ($status === 'processing') {
                $report->processed_at ??= now();
                $report->resolved_at = null;
                $report->rejected_at = null;
                $report->resolution_note = null;
            } elseif ($status === 'resolved') {
                $report->processed_at ??= now();
                $report->resolved_at = now();
                $report->rejected_at = null;
                $report->resolution_note = $note;
            } elseif ($status === 'rejected') {
                $report->processed_at ??= now();
                $report->resolved_at = null;
                $report->rejected_at = now();
                $report->resolution_note = $note;
            }

            $report->save();

            // Catat jika status berubah atau catatannya diperbarui.
            if (
                $oldStatus !== $status ||
                in_array($status, ['resolved', 'rejected'], true)
            ) {
                ReportLog::create([
                    'report_id' => $report->report_id,
                    'user_id' => Auth::user()->user_id,
                    'action' => 'status_updated',
                    'old_status' => $oldStatus,
                    'new_status' => $status,
                    'note' => $note,
                ]);
            }
        });

        return back()->with(
            'success',
            'Status laporan berhasil diperbarui.'
        );
    }
    
    public function history()
    {
        $reports = Report::with([
            'user',
            'facility',
            'logs' => function ($query) {
                $query->with('user')
                    ->orderByDesc('created_at');
            },
        ])
            ->whereIn('status', ['resolved', 'rejected', 'processing'])
            ->orderByDesc('updated_at')
            ->get();

        return view(
            'petugas.riwayat-laporan',
            compact('reports')
        );
    }

}
