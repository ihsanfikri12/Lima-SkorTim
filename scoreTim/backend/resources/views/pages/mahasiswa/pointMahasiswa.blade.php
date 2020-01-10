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
     
    </div>
    <div class="container-fluid mt--7">
      <!-- Table -->
      
      <!-- Dark table -->
      <div class="row mt-5">
        <div class="col">
          <div class="card shadow">
           
  
            <div class="table-responsive">
              <table class="table align-items-center table-dark">
                <thead class="text-white">
                  <tr>
                    <th scope="col">Sprint</th>
                    <th scope="col">Point</th>
                    <th scope="col">Status</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($data as $data)
                  <tr>
                    <td>
                      {{$data->sprint_id}} 
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
                   
                  
                  </tr>
                  @endforeach    
                </tbody>
              </table>
              
            </div>
          </div>
        </div>
      
@stop
