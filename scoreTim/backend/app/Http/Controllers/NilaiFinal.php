<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class NilaiFinal extends Controller
{
       //show index
    public function index () {
        $client = new Client(['base_uri' => 'http://127.0.0.1:8000/api/skorfinal']);
        $request = $client->request('GET');
        $response = $request->getBody();
        return $response;
    }

    public function show($id)
    {
        $client = new Client(['base_uri' => "http://127.0.0.1:8000/api/skorfinal/$id"]);
        $request = $client->request('GET');
        $response = $request->getBody();
        $data = json_decode($response);
        return view('pages.tablesMahasiswa2', ['data'=>$data] );
    }

    // public function edit($matkul) {
    //     $client = new Client(['base_uri' => "http://127.0.0.1:8000/api/skorfinal/create/$matkul"]);
    //     $request = $client->request('GET');
    //     $response = $request->getBody();
    //     $data = json_decode($response);
    //     return view('pages.createFinal', ['data'=>$data]);
    // }

    public function create2($matkul,$uts) {
            return view('pages.createFinal', ['matkul'=>$matkul,'uts'=>$uts]);
        }

    //index (create data) 
    public function create (request $request) {

        $client = new Client(['base_uri' => "http://127.0.0.1:8000/api/skorfinal/lihat/$request->idTim"]);
        $req = $client->request('GET');
        $res = $req->getBody();
        $data = json_decode($res);
        $data2 = $data[0]->id;

        $matkul = $request->matkul;
        $finalNilaiSprint = $request->finalNilaiSprint;
        $nilaiUts = $request->nilaiUts;
        $nilaiUas = $request->nilaiUas;
        $finalSkorTim = $request->finalSkorTim;
        $idTim = $request->idTim;

        if($data==null) {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', "http://127.0.0.1:8000/api/skorfinal", [
                'form_params' => [
                    'matkul' => strtoupper($matkul),
                    'finalNilaiSprint' => $finalNilaiSprint,
                    'nilaiUts' => $nilaiUts,
                    'nilaiUas' => $nilaiUas,
                    'finalSkorTim' => $finalSkorTim,
                    'idTim' => $idTim,
            ]]);
        } else {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('PUT', "http://127.0.0.1:8000/api/skorfinal/$data2", [
                'form_params' => [
                    
                    'nilaiUts' => $nilaiUts,
                    'nilaiUas' => $nilaiUas,
                    'idTim' => $idTim,
         ]]);
        }
        return redirect("/skorfinal/$data2");
        
    }

    //index (update data) 
    public function update (request $request, $id) {

        $finalNilaiSprint = $request->finalNilaiSprint;
        $nilaiUts = $request->nilaiUts;
        $nilaiUas = $request->nilaiUas;
        $finalSkorTim = $request->finalSkorTim;
        $idTim = $request->idTim;
        

        $client = new \GuzzleHttp\Client();
        $response = $client->request('PUT', "http://127.0.0.1:8000/api/skorfinal/$id", [
            'form_params' => [
                'finalNilaiSprint' => $finalNilaiSprint,
                'nilaiUts' => $nilaiUts,
                'nilaiUas' => $nilaiUas,
                'finalSkorTim' => $finalSkorTim,
                'idTim' => $idTim,
         ]]);

        return "data berhasil diupdate";

        
    }

    public function delete ($id) {
        $client = new Client(['base_uri' => "http://127.0.0.1:8000/api/skordosen/$id"]);
        $request = $client->request('DELETE');
        return "data berhasil didelete";
    }

    
}
