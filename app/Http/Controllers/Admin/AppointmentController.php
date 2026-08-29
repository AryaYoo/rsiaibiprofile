<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with('doctor')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('poli')) {
            $query->where('tujuan_poli', $request->poli);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('no_telp', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_pendaftaran', 'like', '%' . $request->search . '%');
            });
        }

        $appointments = $query->paginate(15)->withQueryString();

        $statusCounts = Appointment::toBase()->selectRaw("
            COALESCE(SUM(CASE WHEN status = 'menunggu' THEN 1 ELSE 0 END), 0) as menunggu,
            COALESCE(SUM(CASE WHEN status = 'dikonfirmasi' THEN 1 ELSE 0 END), 0) as dikonfirmasi,
            COALESCE(SUM(CASE WHEN status = 'dibatalkan' THEN 1 ELSE 0 END), 0) as dibatalkan
        ")->first();

        $totalMenunggu     = (int) ($statusCounts->menunggu ?? 0);
        $totalDikonfirmasi = (int) ($statusCounts->dikonfirmasi ?? 0);
        $totalDibatalkan   = (int) ($statusCounts->dibatalkan ?? 0);
        $poliList          = Appointment::whereNotNull('tujuan_poli')->where('tujuan_poli', '!=', '')->distinct()->pluck('tujuan_poli');

        return view('admin.appointments.index', compact(
            'appointments', 'totalMenunggu', 'totalDikonfirmasi', 'totalDibatalkan', 'poliList'
        ));
    }

    public function show(Appointment $appointment)
    {
        $appointment->load('doctor');

        return view('admin.appointments.show', compact('appointment'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status'         => 'required|in:menunggu,dikonfirmasi,dibatalkan',
            'catatan_admin'  => 'nullable|string',
        ]);

        $appointment->update([
            'status'        => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->route('admin.appointments.show', $appointment)
            ->with('success', 'Status janji berhasil diperbarui.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('admin.appointments.index')
            ->with('success', 'Data janji berhasil dihapus.');
    }
}
