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
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
      
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Tambah Nilai Dosen</h3>
                </div>
                <!-- <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div> -->
              </div>
            </div>
            <div class="card-body">
              <form method="post" action="/skordosen/create/{{$id}}/{{$matkul}}">

              {{ csrf_field() }}
                <div class="pl-lg-4">
                  <div class="row">
                      <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-email">Nilai Ketepatan Waktu</label>
                            <input type="number" id="input-email" name = "KetepatanWaktu" class="form-control form-control-alternative">
                          </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name">Nilai Kualitas Hasil</label>
                          <input type="number" id="input-first-name" name="KualitasHasil" class="form-control form-control-alternative">
                        </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Nilai Kelengkapan</label>
                        <input type="number" id="input-email" name = "Kelengkapan" class="form-control form-control-alternative">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                          <label for="exampleFormControlSelect1">Sprint</label>
                          <select class="form-control" id="exampleFormControlSelect1" name="sprint">
                            @for($i = 1; $i<=10; $i++)
                            <option value={{$i}}>{{$i}}</option>
                            @endfor
                            <option value=11 >UTS</option>
                            <option value=12>UAS</option>
                          </select>
                        </div>
                    </div>
                  </div>

                    <div class="row">                   
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Kelompok</label>
                        <input type="number" id="input-first-name" name="idTim" class="form-control form-control-alternative">
                      </div>
                    </div>

                      
                    </div>
                
      
                    <button class="btn btn-dark ">Kirim</button>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
               
              </form>
            </div>
          </div>
        </div>
@stop
