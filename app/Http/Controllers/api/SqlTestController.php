<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

class SqlTestController extends Controller
{
    /**
     * calculate untuk nilaiRT
     */
    public function calculateNilaiRT()
    {
        $results = DB::table('nilai')
            ->select('nama', 'nisn', 'nama_pelajaran', 'skor')
            ->where('materi_uji_id', '=', 7)
            ->where('nama_pelajaran', 'not like', 'Pelajaran Khusus')
            ->get();



        $groupedResults = $results->groupBy(function ($item) {
            return $item->nama . '-' . $item->nisn;
        })->map(function ($group) {
            $first = $group->first();
            return [
                'nama' => $first->nama,
                'nisn' => $first->nisn,
                'pelajaran' => $group->mapWithKeys(function ($item) {
                    return [strtolower($item->nama_pelajaran) => $item->skor];
                })->sortKeys()->toArray(),
            ];
        })->values();

        return response()->json($groupedResults);
    }

    /**
     * calculate untuk nilaiST
     */
    public function calculateNilaiST()
    {
        $results = DB::table('nilai')
            ->select(
                'nama',
                'nisn',
                'nama_pelajaran',
                'skor',
                'pelajaran_id',
                DB::raw('CASE 
                    WHEN pelajaran_id = 44 THEN skor * 41.67
                    WHEN pelajaran_id = 45 THEN skor * 29.67
                    WHEN pelajaran_id = 46 THEN skor * 100
                    WHEN pelajaran_id = 47 THEN skor * 23.81
                    ELSE skor
                END as calculated_skor'),
            )
            ->where('materi_uji_id', '=', 4)
            ->get();
        
        $groupedResults = $results->groupBy(function ($item) {
            return $item->nama . '-' . $item->nisn;
        })->map(function ($group) {
            $first = $group->first();
            return [
            'nama' => $first->nama,
            'nisn' => $first->nisn,
            'listNilai' => $group->mapWithKeys(function ($item) {
                return [strtolower($item->nama_pelajaran) => $item->calculated_skor];
            })->sortKeys()->toArray(),
            'total' => $group->sum('calculated_skor')
            ];
        })->values()->sortByDesc('total');

        return response()->json($groupedResults);
    }
}
