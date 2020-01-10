<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\nilaiPoint;

class NilaiPointController extends Controller
{

    public function lihatasdos()
    {
        $asdos = DB::table('user2')->where('status','asdos')->get();
        return $asdos;
        // return "muehehehe";
    }
    
      //index (create data) 
    public function create (request $request) {
        $nilaiPoint = new nilaiPoint;
        $nilaiPoint->point = $request->point;
        $nilaiPoint->status = $request->status;
        $nilaiPoint->keterangan = $request->keterangan;
        $nilaiPoint->tim_id = $request->tim_id;
        $nilaiPoint->user_id = $request->user_id;
        $nilaiPoint->sprint_id = $request->sprint_id;
        $nilaiPoint->save();

        return $nilaiPoint;
    }

    //index (update data) 
    public function update (request $request, $id) {
        $point = $request->point;
        $status = $request->status;
        $keterangan = $request->keterangan;
        $tim_id = $request->tim_id;
        $user_id = $request->user_id;
        $sprint_id = $request->sprint_id;
        

        $nilaiPoint = nilaiPoint::find($id);
        $nilaiPoint->point = $point==null ? $nilaiPoint->point:$point ;
        $nilaiPoint->status = $status==null ?$nilaiPoint->status:$status;
        $nilaiPoint->keterangan = $keterangan==null ? $nilaiPoint->keterangan:$keterangan;
        $nilaiPoint->tim_id = $tim_id;
        $nilaiPoint->user_id = $user_id;
        $nilaiPoint->sprint_id = $sprint_id;
        $nilaiPoint->save();

        return  $nilaiPoint;
    }
    
    public function showData($user_id,$tim_id)
    {
        $nilaiPoint = nilaiPoint::where('user_id',$user_id)->where('tim_id',$tim_id)->get();
        $kelompok = DB::table('tims')->get();
        $data = [$nilaiPoint,$kelompok];
        return $data;
    }

    public function show($id)
    {
        $nilaiPoint = nilaiPoint::where('tim_id',$id)->get();
        return $nilaiPoint;
        // return "muehehehe";
    }
    public function delete ($id) {
        $nilaiPoint = nilaiPoint::find($id);
        $nilaiPoint->delete();

        return  $nilaiPoint;
    }
}
