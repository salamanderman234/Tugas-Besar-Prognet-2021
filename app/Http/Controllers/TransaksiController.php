<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use Illuminate\Pagination\Paginator;
use App\Models\Transaksi;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use Illuminate\Support\Arr;

class TransaksiController extends Controller
{
    //validasi untuk tambah dan juga edit
    private static $validate =[
        'tahun_ajaran' => 'required|numeric',
        'semester' => 'required|numeric',
        'mata_kuliah_id' => 'required|numeric',
        'nilai' =>  'required',
        'status' => 'required',
    ];

    ////////////////////////  FUNGSI PADA MAHASISWA ////////////////////////////////////////

    //menampilkan halaman krs dan juga mengambil data semester
    public function index()
    {
        //mengambil data semester dan tahun krs
        $tahun_ajaran = Transaksi::tahun_ajaran(auth()->user()->id);
        $tahun_ajaran_sekarang = null;
        $semester = 1;
        //mengambil data tahun ajaran sekarang
        if(!empty($tahun_ajaran->toArray())){
            $semester = $tahun_ajaran->toArray()[0]['semester'];
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
        if(count($tahun_ajaran->toArray())>2){
            $ips = TransaksiController::ipk([['semester'=>$tahun_ajaran->toArray()[1]['semester']]],1);
            $maksimal_sks = $ips > 3.0 ? 20 : 16;
        }else {
            $maksimal_sks = 20;
        }
        
        return view('user.krs',[
            'tahun_ajarans' => $tahun_ajaran,
            'tahun_ajaran_sekarang' => $tahun_ajaran_sekarang,
            'semester' => $semester,
            'maksimal_sks'=>$maksimal_sks
        ]);
    }

    //fungsi untuk menampilkan selisih semester sampai sekarang 
    private static function selisih($tahun_sekarang,$tahun_terakhir,$semester_sekarang,$semester_terakhir){
        while(!($tahun_sekarang == $tahun_terakhir && $semester_terakhir%2 == $semester_sekarang)){
            $semester_terakhir++;
            if($semester_terakhir % 2 == 0){
                $tahun_terakhir++;
            }
        }
        return $semester_terakhir;
    }

    //fungsi untuk menampilkan krs mahasiswa (AJAX)
    public function krsMahasiswa(){
        $krs = MataKuliah::krsMahasiswa(auth()->user()->id)->where('status','!=','Dibatalkan')->where('transaksis.semester','=',request()->semester)->get();
        return json_encode($krs);
    }

    //fungsi untuk menampilkan krs yang dapat ditambahkan mahasiswa
    public function tambahKrs(){
        $is_genap = 0;
        if((int)date('m')>6){
            $is_genap=1;
        }
        //mengambil mata kuliah yang sudah diajukan
        $matkuls_sudah_ada = array_column(Transaksi::select('mata_kuliah_id')->where('mahasiswa_id',auth()->user()->id)->where('tahun_ajaran',date('y'))->where('status','Belum Disetujui')->get()->toArray(),'mata_kuliah_id');
        $matkuls = MataKuliah::where('prodi','=',auth()->user()->program_studi)
                ->whereRaw('semester%2='.(string)$is_genap)
                ->whereNotIn('id',$matkuls_sudah_ada)
                ->orderBy('semester')
                ->paginate(8);
        Paginator::useBootstrap();
        return view('user.tambah_krs',compact('matkuls'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //fungsi untuk menyimpan krs yang telah diajukan
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
        return redirect()->route('krs')->with([
            'jenis_pesan'=>'success',
            'pesan'=>'Mata Kuliah Berhasil Ditambahkan !'
        ]);
    }

    //fungsi untuk menampilkan khs mahasiswa
    public function khs(){
        $tahun_ajarans = Transaksi::select('tahun_ajaran','semester')
                        ->where('mahasiswa_id','=',auth()->user()->id)
                        ->where('status','=','Disetujui')
                        ->groupBy('tahun_ajaran','transaksis.semester')
                        ->orderBy('transaksis.semester','desc')
                        ->get();
        $ipk = TransaksiController::ipk($tahun_ajarans->toArray(),0);
        return view('user.khs',[
            "tahun_ajarans" => $tahun_ajarans,
            "ipk" => round($ipk,1)
        ]);
    }

    //fungsi untuk menampilkan ipk
    private static function ipk(array $semester, $isIps){
        $list_nilai = ['A'=>4,'B'=>3,'C'=>2,'D'=>1,'E'=>0,];
        $nilai = 0;
        $total_sks = 0;
        foreach(array_column($semester,'semester') as $data){
            $khs = Transaksi::khs(auth()->user()->id,['nilai','sks'])
                             ->where('transaksis.semester','=',$data)->get()
                             ->toArray();
            foreach($khs as $nilaisks){
                if($nilaisks['nilai'] != 'tunda'){
                    $nilai += $list_nilai[$nilaisks['nilai']] * $nilaisks['sks'];
                    $total_sks += $nilaisks['sks'];
                }
            }
            if($isIps){
                break;
            }
        }
        if($total_sks > 0){
            $nilai /= $total_sks;
        }
        return $nilai;
    }

    //fungsi untuk menampilkan khs mahasiswa (AJAX)
    public function khsMahasiswa(){
        $khs = Transaksi::khs(auth()->user()->id,[
            'transaksis.id',
            'kode',
            'nama_mata_kuliah',
            'nilai',
            'sks',
            'transaksis.tahun_ajaran',
            'transaksis.semester'
        ])->where('transaksis.semester','=',request()->semester);
        
        return json_encode($khs->get());
    }

    public function detailKhs($id){
        $matkul = Transaksi::find($id)->matkul;
        return view('user.detail_khs',compact('matkul'));
    }

    //fungsi untuk menghapus krs 
    public function hapusKrs($id){
        $transaksi = Transaksi::find($id);
        $transaksi->status = "Dibatalkan";
        $transaksi->save();
        return redirect()->route('krs')->with([
            'jenis_pesan'=>'danger',
            'pesan'=>'Mata Kuliah Berhasil Dihapus !'
        ]);
    }

    //fungsi untuk menampilkan detail dari krs
    public function detailKrs($id){
        $matkul = Transaksi::find($id)->matkul;
        return view('user.detail_krs',compact('matkul'));
    }

    ////////////////////   AKHIR DARI FUNGSI PADA MAHASISWA   ////////////////////////////
    //                                                                                 //
    ////////////////////          FUNGSI PADA ADMIN          ////////////////////////////

    //fungsi untuk menampilkan seluruh data transaksi
    public function semua_transaksi(){
        $transaksis = Transaksi::where('id','!=',0);
        if(request()->search){
            $transaksis ->where('status','LIKE','%'.request()->search.'%')
                        ->orWhere('mahasiswa_id',request()->search);
        }
        $transaksis = $transaksis->orderBy('mahasiswa_id')->paginate(8);
        Paginator::useBootstrap();
        return view('transaksi.daftar_transaksi',compact('transaksis'));
    }

    //fungsi untuk menampilkan view edit transaksi
    public function edit_transaksi($id){
        $transaksi = Transaksi::find($id);
        return view('transaksi.edit_transaksi',compact('transaksi'));
    }

    //fungsi untuk menyimpan perubahan yang dilakukan pada transaksi
    public function simpanedit($id){
        $transaksi = Transaksi::find($id);
        request()->validate(TransaksiController::$validate);
        if (MataKuliah::where('id', request()->mata_kuliah_id)->exists() and
        MataKuliah::find(request()->mata_kuliah_id)->prodi == 
        Mahasiswa::find(request()->mahasiswa_id)->program_studi ) {
            $transaksi->tahun_ajaran = request()->tahun_ajaran;
            $transaksi->semester = request()->semester;
            $transaksi->mata_kuliah_id = request()->mata_kuliah_id;
            $transaksi->nilai = request()->nilai;
            $transaksi->status = request()->status;
            $transaksi->save();
            return redirect()->route('daftar_transaksi')->with([
                'jenis_pesan'=>'success',
                'pesan'=>'Transaksi Berhasil Diubah !'
            ]);
        }
        return back()->with([
            'jenis_pesan'=>'danger',
            'pesan'=>'Mata Kuliah Tidak Ditemukan atau Tidak Sesuai'
        ]);
    }

    //fungsi untuk menghapus transaksi
    public function hapus($id){
        Transaksi::find($id)->delete();
        return redirect()->route('daftar_transaksi')->with([
            'jenis_pesan'=>'danger',
            'pesan'=>'Transaksi Berhasil Dihapus'
        ]);
    }

    //fungsi menampilkan view tambah transaksi
    public function tambah_transaksi(){
        return view('transaksi.tambah_transaksi');
    }

    // fungsi untuk menyimpan transaksi yang akan ditambahkan
    public function simpantambah(){
        request()->validate(TransaksiController::$validate);
        if (MataKuliah::where('id', request()->mata_kuliah_id)->exists() and
        Mahasiswa::where('id', request()->mahasiswa_id)->exists() and
        MataKuliah::find(request()->mata_kuliah_id)->prodi == 
        Mahasiswa::find(request()->mahasiswa_id)->program_studi ) {
            Transaksi::create([
                'tahun_ajaran'=>request()->tahun_ajaran,
                'semester'=>request()->semester,
                'mahasiswa_id'=>request()->mahasiswa_id,
                'mata_kuliah_id'=>request()->mata_kuliah_id,
                'nilai'=>request()->nilai,
                'status'=>request()->status
            ]);
            return redirect()->route('daftar_transaksi')->with([
                'jenis_pesan'=>'success',
                'pesan'=>'Data Berhasil Ditambahkan !'
            ]);
        }
        return redirect()->route('tambah_transaksi')->with([
            'jenis_pesan'=>'danger',
            'pesan'=>'Data Tidak Ditemukan !'
        ]);
    }
    ///////////////////////////  AKHIR DARI FUNGSI ADMIN  ////////////////////////////////////
}
