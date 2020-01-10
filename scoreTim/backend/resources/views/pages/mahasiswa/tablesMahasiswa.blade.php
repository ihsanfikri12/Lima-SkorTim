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
          <!-- Card stats -->
          <div class="row">
            
            <div class="col-xl-6 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Nilai</h5>
                      @if($data2) 
                      <span class="h2 font-weight-bold mb-0">{{$data2[0]->nilaiTim}}</span>
                      @else 
                      <span class="h2 font-weight-bold mb-0">Belum ada nilai</span>
                      @endif
                    </div>
                    <div class="col-auto">
                      <div class="dropdown">
                        
                      </div>
                    </div>
                  </div>
                  <!-- <p class="mt-3 mb-0 text-muted text-sm"> -->
                    <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span> -->
                    <!-- <span class="text-nowrap">Since last month</span> -->
                  </p>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
      <!-- Table -->
    
      <!-- Dark table -->
      <div class="row mt-5">
        <div class="col">
          <div class="card bg-default shadow">
            <div class="table-responsive">
              <table class="table align-items-center table-dark table-flush">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Sprint</th>
                    <th scope="col">Nilai Sprint</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($data as $data)
                  <tr>
                    <th scope="row">
                      <span class="mb-0 text-sm">Sprint {{$data->sprint_id}}</span>
                    </th>
                    <td>
                      {{$data->nilai}}
                    </td>
                    <td class="text-left">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="/skordosen/{{$data->tim_id}}/">Detail Nilai Dosen</a>
                          <a class="dropdown-item" href="/skorpoint/{{$data->tim_id}}">Detail Nilai Point</a>
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
