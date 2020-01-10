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
  
            <div class="card-header border-0">
            <div class="dropdown">

                <button class="btn btn-info btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Pilih Kelompok 
                </button>
              
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach ($kelompok as $kelompok)
                  <a class="dropdown-item" href="/skorpoint/{{$id}}/{{$kelompok->id}}/">{{$kelompok->nama}} {{$kelompok->semester}}</a>
                @endforeach
                </div>
                @if($data) 
              <div class="dropdown d-inline m-3">
                <button class="btn btn-info btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Masukan Point
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"></a>
                  <a class="dropdown-item" href="/skorpoint/create/{{$id}}">Masukan Point Baru</a>
                </div>
              </div>
              @endif
             
              </div>
            </div>
            <div class="card-header border-0">
            @if ($data && $id) 
              <h3 class="mb-0 text-dark"> Kelompok {{$data[0]->tim_id}}</h3>
            @elseif (!$data && $id)
              <h3 class="mb-0 text-dark"> Kelompok belum diberi point</h3>
            @else 
            <h3 class="mb-0 text-dark"> User tidak terdaftar</h3>
            @endif  
            </div>
            <h3></h3>
            <div class="table-responsive">
              <table class="table align-items-center table-dark table-flush">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Sprint</th>
                    <th scope="col">Point</th>
                    <th scope="col">Status</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Action</th>
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
                      {{$data->point}} 
                    </td>
                    <td>
                      {{$data->status}} 
                    </td>
                    <td>
                      {{$data->keterangan}}
                    </td>
                    <td class="text-right"> 
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> 
                          <a class="dropdown-item" href="/skorpoint/ubah/{{$data->id}}">Edit Point</a> 
                          <form action="/skorpoint/{{$data->id}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                          <button class="dropdown-item">Delete Point</button> 
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
