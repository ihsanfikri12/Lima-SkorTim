<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nilaiTim;

class NilaiTimController extends Controller
{
     //show index
     public function index () {
        return nilaiTim::all();
    }

    public function show($id)
    {
        $nilaiTim = nilaiTim::find($id);
        return $nilaiTim;
    }


    //index (create data) 
    public function create (request $request) {
        $nilaiTim = new nilaiTim;
        $nilaiTim->nilaiTim = $request->nilaiTim;
        $nilaiTim->tim_id = $request->tim_id;
        $nilaiTim->save();

        return $nilaiTim;
    }


    //index (update data) 
    public function update (request $request, $id) {

        $nilaiTim = $request->nilaiTim;
        $tim_id = $request->tim_id;

        $nilaiTim = nilaiTim::find($id);
        $nilaiTim->nilaiTim = $nilaiTim == null ? $nilaiTim->nilaiTim:$nilaiTim;
        $nilaiTim->tim_id = $tim_id  == null ? $nilaiTim->tim_id:$tim_id;
        $nilaiTim->save();

        return $nilaiTim;

        
    }

    public function delete ($id) {
        $nilaiTim = nilaiTim::find($id);
        $nilaiTim->delete();

        return "Data Berhasil di delete" ;
    }
}
