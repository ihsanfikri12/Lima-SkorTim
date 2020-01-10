<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\nilaiSprint;
use App\nilaiTim;

class NilaiSprintController extends Controller
{
     //show index
     public function index () {
        return nilaiSprint::all();
    }

    public function lihatmahasiswa () {
        return DB::table('tims')->get();
        
    }

    public function show($id)
    {
        $nilaiTim = DB::table('nilai_tims')->where('tim_id',$id)->get();
        $nilaiSprint = nilaiSprint::where('tim_id',$id)->get();
        $data = [$nilaiSprint,$nilaiTim];
        return $data;
    }

    //index (create data) 
    public function create (request $request) {
        $nilaiSprint = new nilaiSprint;
        $nilaiSprint->nilai = $request->nilai;
        $nilaiSprint->tim_id = $request->tim_id;
        $nilaiSprint->sprint_id = $request->sprint_id;
        $nilaiSprint->save();

        return $nilaiSprint;
    }

    //index (update data) 
    public function update (request $request, $id) {
        $nilai = $request->nilai;
        $tim_id = $request->tim_id;
        $sprint_id = $request->sprint_id;
        

        $nilaiSprint = nilaiSprint::find($id);
        $nilaiSprint->nilai = $nilai;
        $nilaiSprint->tim_id = $tim_id;
        $nilaiSprint->sprint_id = $sprint_id;
        $nilaiSprint->save();

        return $nilaiSprint;
    }

    public function delete ($id) {
        $nilaiSprint = nilaiSprint::find($id);
        $nilaiSprint->delete();

        return "Data Berhasil di delete" ;
    }
}
