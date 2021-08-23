@extends('layouts.app')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Daftar Pekerja</h1>
    </div>
    {{-- <h2 class="section-title">Workers by location</h2>
      <p class="section-lead">This page is information Workers by location.</p>
    <div class="section" id="data_by_locations"></div> --}}
      <h2 class="section-title">List of Workers</h2>
      <p class="section-lead">This page is for managing Workers.</p>
      <div class="justify-content-center">
      <div class="card">
        <div class="card-body">
          @if (session('message'))
              <div class="alert alert-success" role="alert">
                  {{ session('message') }}
              </div>
          @endif
          <form method="POST" action="{{route('worker.store')}}" class="needs-validation" novalidate="">
            @csrf
            <div class="row">
              <div class="form-group col-6">
                <label for="name">Asign to</label>
                <input id="name" type="text" class="form-control" name="name" autofocus="">
              </div>
              <div class="form-group col-4">
                <label for="uuid">Device ID</label>
                <input id="uuid" type="text" class="form-control" name="uuid" placeholder="scan qrcode">
              </div>
              <div class="form-group col-2">
                <label for="submit">Action</label>
                <button name="submit" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                  Add
                </button>
              </div>
            </div>
          </form>
          <div class="table-responsive">
            <table class="table table-striped table-md" id="tworker">
              <thead>
              <tr>        
                <th>#</th>
                <th>Nama</th>
                <th>Device ID</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                @if($workers['status'])
                  @foreach($workers['data'] as $worker)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$worker['name']}}</td>
                      <td>{{$worker['uuid']}}</td>
                      <td>
                        <form method="POST" action="{{route('worker.trigger')}}" class="needs-validation" novalidate="">
                          @csrf
                          @if($worker['is_trigger'])
                            <input type="hidden" name="status" value="0">
                            <input type="hidden" name="uuid" value="{{$worker['uuid']}}">
                            <button name="submit" type="submit" class="btn btn-warning " tabindex="4">
                                Alarm
                            </button>
                          @else 
                            <input type="hidden" name="status" value="1">
                            <input type="hidden" name="uuid" value="{{$worker['uuid']}}">
                            <button name="submit" type="submit" class="btn btn-primary " tabindex="4">
                                Release
                          @endif
                        </form>
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
          {{-- <div class="table-responsive">
            <table class="table table-striped table-md" id="tworker">
              <thead>
              <tr>        
                <th>#</th>
                <th>Nama</th>
                <th>Lokasi</th>
                <th>Probability</th>
                <th>Aktif(min)</th>
                <th>Waktu</th>
              </tr>
              </thead>
            </table>
          </div> --}}
        </div> 
      </div>
      </div>
  </section>
@endsection
