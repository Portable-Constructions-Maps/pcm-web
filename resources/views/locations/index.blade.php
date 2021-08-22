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
                <label for="name">Area name</label>
                <input id="name" type="text" class="form-control" name="name" autofocus="">
              </div>
              <div class="form-group col-4">
                <label for="org">Organization ID</label>
                <input id="org" type="text" class="form-control" name="org" placeholder="{{auth()->user()->org}}" readonly>
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
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
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
