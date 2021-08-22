@extends('layouts.app')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Daftar Lokasi</h1>
    </div>
    {{-- <h2 class="section-title">Workers by location</h2>
      <p class="section-lead">This page is information Workers by location.</p>
    <div class="section" id="data_by_locations"></div> --}}
      <h2 class="section-title">List of Locations</h2>
      <p class="section-lead">This page is for managing locations.</p>
      <div class="justify-content-center">
      <div class="card">
        <div class="card-body">
          @if (session('message'))
              <div class="alert alert-success" role="alert">
                  {{ session('message') }}
              </div>
          @endif
          <form method="POST" action="{{route('locations.store')}}" class="needs-validation" novalidate="">
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
                <th>Status</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                  @if($locations != null)
                    @foreach($locations as $location)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$location->name}}</td>
                            <td>
                                @if($location->is_danger)
                                    <span class="badge badge-danger">Berbahaya</span>
                                @else
                                    <span class="badge badge-secondary">Normal</span>
                                @endif
                            </td>
                            
                            <td>
                                <form method="POST" action="{{route('locations.update')}}" class="needs-validation" novalidate="">
                                    @csrf
                                    @if($location->is_danger)
                                        <input type="hidden" name="status" value="0">
                                        <input type="hidden" name="id" value="{{$location->id}}">
                                        <button name="submit" type="submit" class="btn btn-success " tabindex="4">
                                            release
                                        </button>
                                    @else
                                        <input type="hidden" name="status" value="1">
                                        <input type="hidden" name="id" value="{{$location->id}}">
                                        <button name="submit" type="submit" class="btn btn-danger " tabindex="4">
                                            set to danger
                                        </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                  @else
                  {{__('Data tidak ada')}}
                  @endif
              </tbody>
            </table>
          </div>
        </div> 
      </div>
      </div>
  </section>
@endsection
