<?php
use App\Exports\RekapExport;
use App\Services\RekapService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request, RekapService $rekap)
    {
        [$from, $to] = $this->periode($request);

        return view('admin.reports.index', [
            'rekap' => $rekap->build($from, $to),
            'from'  => $from,
            'to'    => $to,
        ]);
    }

    public function export(Request $request, RekapService $rekap, string $format)
    {
        [$from, $to] = $this->periode($request);
        $data = $rekap->build($from, $to);

        return match ($format) {
            'csv'  => Excel::download(new RekapExport($data), 'rekap.csv'),
            'xlsx' => Excel::download(new RekapExport($data), 'rekap.xlsx'),
            'pdf'  => Pdf::loadView('admin.reports.pdf', compact('data', 'from', 'to'))
                          ->download('rekap.pdf'),
        };
    }

    private function periode(Request $request): array
    {
        $v = $request->validate([
            'from' => ['nullable', 'date'],
            'to'   => ['nullable', 'date', 'after_or_equal:from'],
        ]);

        return [
            $v['from'] ?? now()->startOfMonth()->toDateString(),
            $v['to']   ?? now()->toDateString(),
        ];
    }
}