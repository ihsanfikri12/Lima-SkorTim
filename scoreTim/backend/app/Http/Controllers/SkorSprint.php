<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class SkorSprint extends Controller
{

    public function login() {
        return view('pages.login.login');
    }

    public function loginMahasiswa() {
        $client = new Client(['base_uri' => "http://127.0.0.1:8000/api/lihatmahasiswa"]);
        $request = $client->request('GET');
        $response = $request->getBody();
        $data = json_decode($response);
        return view('pages.login.loginMahasiswa',['data'=>$data]);
        // return $data;
    }


    //show all skor sprint
    public function index()
    {
        $client = new Client(['base_uri' => 'http://127.0.0.1:8000/api/skorsprint']);
        $request = $client->request('GET');
        // $response = json_decode($request->getBody());
        // echo $response[0]->id;
        $response = $request->getBody();
        return view('pages.tablesMahasiswa');
    }

    // Tambah nilai sprint
    public function create(Request $request)
    {
        $client = new Client(['base_uri' => 'http://127.0.0.1:8000/api/skorpoint']);
        $request = $client->request('GET');
        // $response = json_decode($request->getBody());
        // echo $response[0]->id;
        $response = json_decode($request->getBody());

        // foreach($response as $point) {
        //     if($point->sprint )
        // }
        

        $nilaiPoint = $request->nilaiPoint;
        $nilaiDosen = $request->nilaiDosen;
        $nilaiSprint = $request->nilaiSprint;
        $idSkorPoint = $request->idSkorPoint;
        $idSkorDosen = $request->idSkorDosen;
        $idTim = $request->idTim;

        
        $response = $client->request('POST', "http://127.0.0.1:8000/api/skorpoint", [
            'form_params' => [
                'point' => $point,
                'status' => $status,
                'keterangan' => $keterangan,
                'idUser' => $idUser,
                'idTim' => $idTim,
         ]]);

         return "data berhasil dibuat";
    }


    //show skor point by id    
    public function show($id)
    {
        $client = new Client(['base_uri' => "http://127.0.0.1:8000/api/nilaisprint/$id"]);
        $request = $client->request('GET');
        $response = $request->getBody();
        $data = json_decode($response);
        return view('pages.mahasiswa.tablesMahasiswa', ['data'=>$data[0],'data2'=>$data[1]]);
        return $data;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function edit(r $r)
    {
        //
    }


     //update point
    // public function update(Request $request, $id)
    // {
    //     $point = $request->point;
    //     $status = $request->status;
    //     $keterangan = $request->keterangan;
    //     $idUser = $request->idUser;
    //     $idTim = $request->idTim;

    //     $client = new \GuzzleHttp\Client();
    //     $response = $client->request('PUT', "http://127.0.0.1:8000/api/skorpoint/$id", [
    //         'form_params' => [
    //             'point' => $point,
    //             'status' => $status,
    //             'keterangan' => $keterangan,
    //             'idUser' => $idUser,
    //             'idTim' => $idTim,
    //      ]]);

    //      return "data berhasil dibuat";
    // }

    // public function delete($id)
    // {
    //     $client = new Client(['base_uri' => "http://127.0.0.1:8000/api/skorpoint/$id"]);
    //     $request = $client->request('DELETE');
    //     return "data berhasil didelete";
    // }
}
