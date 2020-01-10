<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\View;
class SkorDosen extends Controller
{


    public function login() {
        $client = new Client(['base_uri' => "http://127.0.0.1:8000/api/lihatdosen"]);
        $request = $client->request('GET');
        $response = $request->getBody();
        $data = json_decode($response);
        return view('pages.login.loginDosen',['data'=>$data]);
        // return 'hahahaha';
    }

      //show all skow dosen
    public function show($id,$idTim){
        
        $client = new Client(['base_uri' => "http://127.0.0.1:8000/api/nilaidosen/$id/$idTim"]);
        $request = $client->request('GET');
        $response = $request->getBody();
        $data = json_decode($response);
        

        return view('pages.dosen.indexDosen',['data'=>$data[0],'kelompokAll'=>$data[1], 'matkul'=>$data[2],'id'=>$id]);
    }
    
    public function show2($id){
        
        $client = new Client(['base_uri' => "http://127.0.0.1:8000/api/nilaidosen/$id"]);
        $request = $client->request('GET');
        $response = $request->getBody();
        $data = json_decode($response);
        return view('pages.mahasiswa.detailDosen',['data'=>$data]);
        // return $data
    }

    

    public function createNilai($id, $matkul)
    {
        return view('pages.dosen.formDosen',['id'=>$id,'matkul'=>$matkul]);
    }
  
    //create skor dosen
    public function create(Request $request, $id, $matkul)
    {
            $KetepatanWaktu = $request->KetepatanWaktu;
            $Kelengkapan = $request->Kelengkapan;
            $KualitasHasil = $request->KualitasHasil;
            $tim_id = $request->idTim;
            $user_id = $id;
            $matkul_id = $matkul;
            $sprint_id = $request->sprint;
            
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', "http://127.0.0.1:8000/api/nilaidosen", [
                'form_params' => [
                    'KetepatanWaktu' => $KetepatanWaktu,
                    'Kelengkapan' => $Kelengkapan,
                    'KualitasHasil' => $KualitasHasil,
                    'sprint_id' => $sprint_id,
                    'user_id' => $user_id,
                    'tim_id' => $tim_id,
                    'matkul_id'=>$matkul_id,
            ]]);

        return redirect("/skordosen/$user_id/$tim_id");
    }

    
    public function ubahNilai($id)
    {   
        $client = new Client(['base_uri' => "http://127.0.0.1:8000/api/nilaidosen/$id"]);
        $request = $client->request('GET');
        $response = $request->getBody();
        $data = json_decode($response);
        
        return view('pages.dosen.editDosen',['data'=>$data]);
    }

    public function update(Request $request, $id, $user_id)
    {
        $KetepatanWaktu = $request->KetepatanWaktu;
        $Kelengkapan = $request->Kelengkapan;
        $KualitasHasil = $request->KualitasHasil;
        $tim_id = $request->idTim;
        $matkul_id = $request->matkul_id;
        $sprint_id = $request->sprint;
        
        $client = new \GuzzleHttp\Client();
        $response = $client->request('PUT', "http://127.0.0.1:8000/api/nilaidosen/$id", [
            'form_params' => [
                'KetepatanWaktu' => $KetepatanWaktu,
                'Kelengkapan' => $Kelengkapan,
                'KualitasHasil' => $KualitasHasil,
                'sprint_id' => $sprint_id,
                'user_id' => $user_id,
                'tim_id' => $tim_id,
                'matkul_id'=>$matkul_id,
         ]]);

         return redirect("/skordosen/$user_id/$tim_id");
    }

    public function delete ($id) {
        $client = new Client(['base_uri' => "http://127.0.0.1:8000/api/nilaidosen/$id"]);
        $request = $client->request('DELETE');
        
        $response = $request->getBody();
        $data = json_decode($response);
        
        return redirect("/skordosen/$data->user_id/$data->tim_id");
        
    }

}

