@extends('layouts.app')
@section('content')
<section class="section">
  <div class="section-header">
      <div>
      <h1>Area </h1>
      </div>
      <!-- Breadcrumb -->
      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Home</a></div>
          <!-- <div class="breadcrumb-item">Page</div> -->
      </div>
  </div>
  Kalibrasi terakhir : <b>{{__($calibrated)}}</b> &nbsp; <a href="{{route('pcm.calibrate')}}" class="btn btn-success">Calibrate Now</a>
  
  <div class="section-body">
    @if ($message = Session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @elseif( $message = Session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <br>
      <div class="row">
        @foreach ($rooms as $key => $item)
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
              <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
              </div>
              <div class="card-wrap">
                  <div class="card-header">
                      <h4>Prob {{__($item)}}</h4>
                  </div>
                  <div class="card-body">
                    {{__($key)}}
                  </div>
              </div>
          </div>
      </div>
        @endforeach
         
      </div>
      {{-- <div class="row">
          <div class="col">
              <div class="card">
                  <div class="card-header">
                      <h4>{{ __('Dashboard') }}</h4>

                  </div>
                  <div class="card-body">

                  </div>
              </div>
          </div>
      </div> --}}
  </div>
</section>
@endsection
