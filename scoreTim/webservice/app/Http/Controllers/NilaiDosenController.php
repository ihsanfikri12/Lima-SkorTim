<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\nilaiDosen;


class NilaiDosenController extends Controller
{
    public function create(Request $request)
     {
        $nilaiDosen = new nilaiDosen;
        $nilaiDosen->KetepatanWaktu = $request->KetepatanWaktu;
        $nilaiDosen->Kelengkapan = $request->Kelengkapan;
        $nilaiDosen->KualitasHasil = $request->KualitasHasil;
        $nilaiDosen->TotalNilai = round(floatval(($request->KetepatanWaktu*(40/100))+($request->Kelengkapan*(30/100))+($request->KualitasHasil*(30/100))),2);
        $nilaiDosen->tim_id = $request->tim_id;
        $nilaiDosen->user_id = $request->user_id;
        $nilaiDosen->matkul_id = $request->matkul_id;
        $nilaiDosen->sprint_id = $request->sprint_id;
        $nilaiDosen->save();

        //  return $request->KetepatanWaktu;
        return $nilaiDosen;
     }
 
      //show all skor dosen
     public function index()
     {
         $nilaiDosen = nilaiDosen::all();
         return $nilaiDosen;
     }

     
 
     //show skor dosen by id
     public function show($id)
     {
        $matkul = $matakuliah = DB::table('mata_kuliah')->get();
        $nilaiDosen = nilaiDosen::where('tim_id',$id)->get();
        
        for($i=0;$i<count($nilaiDosen);$i++) {
           for($j=0;$j<count($matkul);$j++) {
               if($nilaiDosen[$i]->matkul_id === $matkul[$j]->id) {
                  $nilaiDosen[$i]->matkul = $matkul[$j]->nama;
               }
               else {continue;}    
           }
        }
      
        return $nilaiDosen;
     }

     public function showbyuser($id,$idTim)
     {
        $nilaiDosen = nilaiDosen::where('user_id',$id)->where('tim_id',$idTim)->get();
        $kelompok = DB::table('tims')->get();
        $matkul = DB::table('mata_kuliah')->where('user_id',$id)->get();
        $data = [$nilaiDosen,$kelompok,$matkul];
        return $data;
     }


    
     //update skor dosen
     public function update(Request $request, $id)
     {

         $nilaiDosen = nilaiDosen::find($id);
         $nilaiDosen->KetepatanWaktu = $request->KetepatanWaktu;
         $nilaiDosen->Kelengkapan = $request->Kelengkapan;
         $nilaiDosen->KualitasHasil = $request->KualitasHasil;
         $nilaiDosen->TotalNilai = ($request->KetepatanWaktu*(40/100))+($request->Kelengkapan*(30/100))+($request->KualitasHasil*(30/100));
         $nilaiDosen->tim_id = $request->tim_id;
         $nilaiDosen->user_id = $request->user_id;
         $nilaiDosen->matkul_id = $request->matkul_id;
         $nilaiDosen->sprint_id = $request->sprint_id;
         $nilaiDosen->save();

         return $nilaiDosen;
     }
 
     //delete skor dosen
     public function delete ($id) {
         $nilaiDosen = nilaiDosen::find($id);
         $nilaiDosen->delete();
 
         return $nilaiDosen;
     }

     public function lihatdosen () {
        $matakuliah = DB::table('mata_kuliah')->get();
        return $matakuliah;
        // return "kuy lah";
     }
}
