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
  Kalibrasi terakhir : <b>{{__($calibrated)}}</b> &nbsp; <a href="{{route('pcm.calibrate')}}" class="btn btn-success" id="btnCalibrate">Calibrate Now</a>

  <div class="section-body">
    <br>
      <div class="row">
        @foreach ($rooms as $item)
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
              <div class="card-icon {{$item['is_danger'] ? 'bg-danger' : 'bg-primary' }}">
                 <i class="fas fa-map-pin"></i>
              </div>
              <div class="card-wrap">
                  <div class="card-header">
                      <h4>Accuracy {{__(sprintf("%.1f", $item['probability']*100)."%")}}</h4>

                  </div>
                  <div class="card-body">
                    {{__($item['name'])}}
                  </div>

                  <div class="card-footer text-right">

                      @if($item['is_danger'])
                        <form action="{{route('pcm.undanger')}}" method="post">
                            @csrf
                          <div class="custom-control custom-switch">
                              <input type="checkbox" value="{{$item['name']}}" id="customSwitch{{ $item['name'] }}" class="custom-control-input" name="room" onChange="this.form.submit()" {{ $item['is_danger'] ? 'checked' : '' }}>
                              <input type="hidden" value="{{$item['name']}}" name="room">
                              <label class="custom-control-label" for="customSwitch{{ $item['name'] }}">
                                @if ($item['is_danger'])
                                Berbahaya
                                @else
                                Aman
                              @endif</label>
                          </div>
                        </form>
                      @else
                        <form action="{{route('pcm.danger')}}" method="post">
                            @csrf
                          <div class="custom-control custom-switch">
                            <input type="checkbox" value="{{$item['name']}}" class="custom-control-input" id="customSwitch{{ $item['name'] }}" name="room" onChange="this.form.submit()" {{ $item['is_danger'] ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customSwitch{{ $item['name'] }}"> 
                                @if ($item['is_danger'])
                                Berbahaya
                                @else
                                Aman
                              @endif</label></label>
                          </div>
                        </form>
                      @endif
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
<script>
    var hostApi = "http:/localhost:8000/danger";
@if(Session::has('success'))
    iziToast.success({
        title: 'Sukses',
        message: {{__(Session::get('success'))}},
        position: 'topRight'
    });
@endif
@if(Session::has('error'))
    iziToast.error({
        title: 'Gagal',
        message: {{__(Session::get('error'))}} ,
        position: 'topRight'
    });
@endif
</script>
@endsection
