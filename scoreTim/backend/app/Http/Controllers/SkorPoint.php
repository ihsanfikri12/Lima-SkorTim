<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class SkorPoint extends Controller
{

    public function loginAsdos() {
        $client = new Client(['base_uri' => "http://127.0.0.1:8000/api/lihatasdos"]);
        $request = $client->request('GET');
        $response = $request->getBody();
        $data = json_decode($response);
        return view('pages.login.loginAsdos',['data'=>$data]);
        // return $data;
    }

    //show all skor point
    public function index()
    {
        $client = new Client(['base_uri' => 'http://127.0.0.1:8000/api/skorpoint']);
        $request = $client->request('GET');
        $response = $request->getBody();
        return $response;
    }

    public function createPoint($user_id)
    {
        return view('pages.point.formPoint',['id'=>$user_id]);
    }

    // Tambah nilai point
    public function create(Request $request, $id)
    {
        // $point = $request->point;
        $status = $request->status;
        if($status == "penambahan") {
            $point = 2.5;
        } else if ($status == "pengurangan") {
            $point = -2.5;
        }
        $keterangan = $request->keterangan;
        $sprint_id = $request->sprint;
        $tim_id = $request->tim_id;
        $user_id = $id;

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', "http://127.0.0.1:8000/api/nilaipoint", [
            'form_params' => [
                'status' => $status,
                'keterangan' => $keterangan,
                'point' => $point,
                'sprint_id' => $sprint_id,
                'user_id' => $user_id,
                'tim_id' => $tim_id,
         ]]);

        //  echo $status;
         return redirect("/skorpoint/$user_id/$tim_id");
    }

    public function show2($tim_id)
    {
        $client = new Client(['base_uri' => "http://127.0.0.1:8000/api/nilaipoint/$tim_id"]);
        $request = $client->request('GET');  
        $response = $request->getBody();
        $data = json_decode($response);
        return view('pages.mahasiswa.pointMahasiswa',['data'=>$data]);
        // return $data;
    }


    public function show($user_id,$tim_id)
    {
        $client = new Client(['base_uri' => "http://127.0.0.1:8000/api/nilaipoint/$user_id/$tim_id"]);
        $request = $client->request('GET');  
        $response = $request->getBody();
        $data = json_decode($response);
        return view('pages.point.tablesPointAll',['data'=>$data[0],'kelompok'=>$data[1], 'id'=>$user_id]);
        
    }

    public function ubahNilai($id)
    {   
        $client = new Client(['base_uri' => "http://127.0.0.1:8000/api/nilaipoint/$id"]);
        $request = $client->request('GET');
        $response = $request->getBody();
        $data = json_decode($response);
        
        // return view('pages.editPoint');
        return view('pages.point.editPoint', ['data'=>$data]);
       
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */


     //update point
    public function update(Request $request, $id)
    {
        $status = $request->status;
        if($status == "penambahan") {
            $point = 2.5;
        } else if ($status == "pengurangan") {
            $point = -2.5;
        }
        $keterangan = $request->keterangan;
        $sprint_id = $request->sprint_id;
        $user_id = $request->user_id;
        $tim_id = $request->tim_id;
 

        $client = new \GuzzleHttp\Client();
        $response = $client->request('PUT', "http://127.0.0.1:8000/api/nilaipoint/$id", [
            'form_params' => [
                'point' => $point,
                'status' => $status,
                'keterangan' => $keterangan,
                'sprint_id' => $sprint_id,
                'user_id' => $user_id,
                'tim_id' => $tim_id
         ]]);

         return redirect("/skorpoint/$user_id/$tim_id");

    }

    public function delete ($id) {
        $client = new Client(['base_uri' => "http://127.0.0.1:8000/api/nilaipoint/$id"]);
        $request = $client->request('DELETE');

        $response = $request->getBody();
        $data = json_decode($response);
        
        return redirect("/skorpoint/$data->user_id/$data->tim_id");
        
    }
}
