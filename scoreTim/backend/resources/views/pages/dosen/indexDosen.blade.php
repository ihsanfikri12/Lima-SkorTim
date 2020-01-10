<!--

=========================================================
* Argon Dashboard - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->

@extends('layouts.default')
@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">

        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
      <!-- Table -->
      
      <!-- Dark table -->
      <div class="row mt-5">
        <div class="col">
          <div class="card shadow">
            <div class= d-inline>
            <div class="dropdown m-3">
                <button class="btn btn-info btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Pilih Kelompok
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach ($kelompokAll as $kelompokAll)
                  <a class="dropdown-item" href="/skordosen/{{$id}}/{{$kelompokAll->id}}/">{{$kelompokAll->nama}} {{$kelompokAll->semester}}</a>
                @endforeach
                </div>
              </div>
              @if($matkul) 
              <div class="dropdown d-inline m-3">
                <button class="btn btn-info btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Masukan Nilai
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"></a>
                  <a class="dropdown-item" href="/skordosen/create/{{$id}}/{{$matkul[0]->id}}">Masukan Nilai Baru</a>
                </div>
              </div>
               
              
              @endif
              </div>


             
            
            <div class="card-header border-0">
            @if ($data) 
              <h3 class="mb-0 text-dark"> Kelompok {{$data[0]->tim_id}}</h3>
            @elseif($matkul)
              <h3 class="mb-0 text-dark"> Nilai belum dimasukan</h3>
            @else 
            <h3 class="mb-0 text-dark"> User tidak terdaftar sebagai dosen</h3>
            @endif  
            </div>
           
            <div class="table-responsive">
              <table class="table align-items-center table-dark table-flush">
                <thead class="text-white">
                  <tr>
                    <th scope="col">Sprint</th>
                    <th scope="col">Nilai Ketepatan Waktu</th>
                    <th scope="col"> Nilai Kelengkapan Proyek</th>
                    <th scope="col"> Nilai Kualitas Hasil Proyek</th>
                    <th scope="col"> Total Nilai</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($data as $data)
                  <tr>
                    <td>
                      @if ($data->sprint_id==11)
                      UTS
                      @elseif ($data->sprint_id==12)
                      UAS
                      @else
                      {{$data->sprint_id}}
                      @endif
                    </td>
                    <td>
                      {{$data->KetepatanWaktu}} 
                    </td>
                    <td>
                      {{$data->Kelengkapan}}
                    </td>
                    <td>
                      <span class="badge badge-dot mr-4">
                      {{$data->KualitasHasil}}
                      </span>
                    </td>
                    <td>
                    {{$data->TotalNilai}}
                    </td>
                    
                    <td class="text-right"> 
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="/skorpoint/{{$data->tim_id}}/{{$data->user_id}}">Lihat Point</a>
                          <a class="dropdown-item" href="/skordosen/ubah/{{$data->id}}/{{$data->user_id}}">Edit Nilai</a>
                          <form action="/skordosen/{{$data->id}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="dropdown-item">Delete Nilai</button>
                          </form>
                          
                        </div>
                      </div>
                    </td> 
                  </tr>
                  @endforeach    
                </tbody>
              </table>
              
            </div>
          </div>
        </div>
      
@stop
