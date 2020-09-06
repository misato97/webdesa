<?php

namespace App\Http\Controllers;

use App\Desa;
use App\Gallery;
use App\Surat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $surat = Surat::whereTampilkan(1)->get();
        $desa = Desa::find(1);
        $gallery = Gallery::where('slider', 1)->get();
        return view('index', compact('surat', 'desa', 'gallery'));
    }

    public function dashboard()
    {
        $surat = Surat::all();
        return view('dashboard', compact('surat'));
    }

    public function suratHarian(Request $request)
    {
        $date = $request->tanggal ? date('Y-m-d',strtotime($request->tanggal)) : date('Y-m-d');
        $surat = Surat::all();
        $data = array();
        foreach ($surat as $value) {
            $r = rand(0,255);
            $g = rand(0,255);
            $b = rand(0,255);
            if (count($value->cetakSurat) == 0) {
                $nilai = 0;
            } else {
                $nilai = 0;
                foreach ($value->cetakSurat as $cetakSurat) {
                    if (date('Y-m-d', strtotime($cetakSurat->created_at)) == $date) {
                        $nilai = $nilai + 1;
                    }
                }
            }

            array_push($data, [
                "label" => $value->nama,
                "data" => [$nilai],
                "backgroundColor" => "rgb({$r},{$g},{$b})",
            ]);
        }

        return response()->json($data);
    }

    public function suratBulanan(Request $request)
    {
        $date = $request->bulan ? date('Y-m',strtotime($request->bulan)) : date('Y-m');
        $surat = Surat::all();
        $data = array();
        foreach ($surat as $value) {
            $r = rand(0,255);
            $g = rand(0,255);
            $b = rand(0,255);
            if (count($value->cetakSurat) == 0) {
                $nilai = 0;
            } else {
                $nilai = 0;
                foreach ($value->cetakSurat as $cetakSurat) {
                    if (date('Y-m', strtotime($cetakSurat->created_at)) == $date) {
                        $nilai = $nilai + 1;
                    }
                }
            }

            array_push($data, [
                "label" => $value->nama,
                "data" => [$nilai],
                "backgroundColor" => "rgb({$r},{$g},{$b})",
            ]);
        }

        return response()->json($data);
    }

    public function suratTahunan(Request $request)
    {
        $date = $request->tahun ? $request->tahun : date('Y');
        $surat = Surat::all();
        $data = array();
        foreach ($surat as $value) {
            $r = rand(0,255);
            $g = rand(0,255);
            $b = rand(0,255);
            if (count($value->cetakSurat) == 0) {
                $nilai = 0;
            } else {
                $nilai = 0;
                foreach ($value->cetakSurat as $cetakSurat) {
                    if (date('Y', strtotime($cetakSurat->created_at)) == $date) {
                        $nilai = $nilai + 1;
                    }
                }
            }

            array_push($data, [
                "label" => $value->nama,
                "data" => [$nilai],
                "backgroundColor" => "rgb({$r},{$g},{$b})",
            ]);
        }

        return response()->json($data);
    }

    public function panduan()
    {
        $desa = Desa::find(1);
        return view('panduan', compact('desa'));
    }
}
