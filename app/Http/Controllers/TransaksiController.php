<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use Illuminate\Pagination\Paginator;
use App\Models\Transaksi;
use App\Models\MataKuliah;
use Illuminate\Support\Arr;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil data semester dan tahun krs
        $tahun_ajaran = Transaksi::tahun_ajaran(auth()->user()->id);
        $tahun_ajaran_sekarang = null;
        $semester = $tahun_ajaran->toArray()[0]['semester'];
        //mengambil data tahun ajaran sekarang
        if($tahun_ajaran != null){
            if(((int)date('m')>6 && $tahun_ajaran->toArray()[0]['semester']%2==0) || ((int)date('m')<=6 && $tahun_ajaran->toArray()[0]['semester']%2!=0) || (date('Y') != $tahun_ajaran->toArray()[0]['tahun_ajaran'])){
                $tahun = $tahun_ajaran->toArray()[0]['tahun_ajaran'];
                if((int)date('m')<=6){
                    $nilai = TransaksiController::selisih((integer) date('Y'),(integer)$tahun_ajaran->toArray()[0]['tahun_ajaran'],0,$tahun_ajaran->toArray()[0]['semester']);
                    $tahun_ajaran_sekarang = [
                        'semester' => $nilai,
                        'tahun_ajaran' => (integer) date('Y')
                    ];
                }
                else {
                    $nilai = TransaksiController::selisih((integer) date('Y'),(integer)$tahun_ajaran->toArray()[0]['tahun_ajaran'],1,$tahun_ajaran->toArray()[0]['semester']);
                    $tahun_ajaran_sekarang = [
                        'semester' => $nilai,
                        'tahun_ajaran' => (integer) date('Y')
                    ];
                }
                $semester = $nilai;
            }
        }else {
            if((int)date('m')<=6){
                $tahun_ajaran_sekarang= [
                    'semester' => 1,
                    'tahun_ajaran' => (integer)date('Y')
                ];
            }
            else {
                $tahun_ajaran_sekarang = [
                    'semester' => 1,
                    'tahun_ajaran' => (integer) date('Y'),
                ];
            }
        }
        return view('mahasiswa.krs',[
            'tahun_ajarans' => $tahun_ajaran,
            'tahun_ajaran_sekarang' => $tahun_ajaran_sekarang,
            'semester' => $semester
        ]);
    }
    private function selisih($tahun_sekarang,$tahun_terakhir,$semester_sekarang,$semester_terakhir){
        while(!($tahun_sekarang == $tahun_terakhir && $semester_terakhir%2 == $semester_sekarang)){
            $semester_terakhir++;
            if($semester_terakhir % 2 == 0){
                $tahun_terakhir++;
            }
        }
        return $semester_terakhir;
    }
    public function krsMahasiswa(){
        // dd(request()->semester);
        $krs = MataKuliah::krsMahasiswa(auth()->user()->id)->where('transaksis.semester','=',request()->semester)->get();
        return json_encode($krs);
    }

    public function tambahKrs(){
        $is_genap = 0;
        if((int)date('m')>6){
            $is_genap=1;
        }
        $matkuls = MataKuliah::where('prodi','=',auth()->user()->program_studi)
                ->whereRaw('semester%2='.(string)$is_genap)
                ->orderBy('semester')
                ->paginate(8);
        Paginator::useBootstrap();
        return view('mahasiswa.tambah_krs',compact('matkuls'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function simpanKrs()
    {
        if(isset(request()->listKrs)){
            foreach(explode(',',request()->listKrs) as $krs){
                Transaksi::create([
                    'tahun_ajaran' => date('Y'),
                    'semester' => (int)request()->semesterKrs,
                    'mahasiswa_id' => auth()->user()->id,
                    'mata_kuliah_id' => (int)$krs,
                    'nilai' => 'Tunda',
                    'status' => 'Belum Disetujui'
                ]);
            }
        }
        return redirect()->route('krs');
    }
    public function khs(){
        $tahun_ajarans = Transaksi::select('tahun_ajaran','semester')
                        ->where('mahasiswa_id','=',auth()->user()->id)
                        ->where('status','=','Disetujui')
                        ->groupBy('tahun_ajaran','transaksis.semester')
                        ->orderBy('transaksis.semester','desc')
                        ->get();
        return view('mahasiswa.khs',[
            "tahun_ajarans" => $tahun_ajarans
        ]);
    }
    public function khsMahasiswa(){
        $khs = Transaksi::khs(auth()->user()->id,[
            'kode',
            'nama_mata_kuliah',
            'nilai',
            'transaksis.tahun_ajaran',
            'transaksis.semester'
        ])->where('transaksis.semester','=',request()->semester);
        
        return json_encode($khs->get());
    }
    public function hapusKrs($id){
        Transaksi::find($id)->delete();
        return redirect()->route('krs');
    }
    public function detailKrs($id){
        $matkul = Transaksi::find($id)->matkul;
        return view('mahasiswa.detail_krs',compact('matkul'));
    }
}
