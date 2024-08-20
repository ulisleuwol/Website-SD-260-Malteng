<?php

namespace App\Http\Controllers\Back;

use Carbon\Carbon;
use App\Models\Agenda;
use App\Models\Kegiatan;
use App\Models\Prestasi;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\FilterService;

class DashboardController extends Controller
{

    public function __construct(private FilterService $filterService)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $filter = $request->query('filter', 'today');
        $user_id = auth()->user()->id;


        $kegiatan_count = $this->filterService->applyDateFilter(Kegiatan::where('user_id', $user_id), $filter)->count();
        $agenda_count = $this->filterService->applyDateFilter(Agenda::where('user_id', $user_id), $filter)->count();
        $prestasi_count = $this->filterService->applyDateFilter(Prestasi::where('user_id', $user_id), $filter)->count();
        $pengumuman_count = $this->filterService->applyDateFilter(Pengumuman::where('user_id', $user_id), $filter)->count();


        $kegiatan = Kegiatan::select('title', 'description', 'slug', 'image')
            ->where('user_id', auth()->user()->id)
            ->where('date_time', '>', Carbon::now())
            ->latest()
            ->take(4)
            ->get();

        $agenda = Agenda::select('title', 'location', 'slug', 'date_time')
            ->where('user_id', auth()->user()->id)
            ->where('date_time', '>', Carbon::now())
            ->latest()
            ->take(4)
            ->get();

        $prestasi = Prestasi::select('title', 'description', 'jenis', 'slug')
            ->where('user_id', auth()->user()->id)
            ->latest()
            ->take(4)
            ->get();

        $breadcrumbs = [
            ['name' => 'Dashboard'],
        ];

        return view('back.dashboard', [
            'title' => 'Dashboard',
            'breadcrumbs' => $breadcrumbs,
            'filter' => $filter,
            'kegiatan' => $kegiatan,
            'agenda' => $agenda,
            'prestasi' => $prestasi,
            'kegiatan_count' => $kegiatan_count,
            'prestasi_count' => $prestasi_count,
            'agenda_count'  => $agenda_count,
            'pengumuman_count'  => $pengumuman_count,
            'activeFilter' => $filter,
        ]);
    }
}
