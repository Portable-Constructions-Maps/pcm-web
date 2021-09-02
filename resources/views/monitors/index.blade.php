@extends('layouts.app')
@section('content')
<section class="section">
  <div class="section-header">
      <div>
      <h1>Monitor </h1>
      </div>
  </div>
  <div class="section-body">
    <div class="row">
        @foreach ($data as $item => $key)
        <div class="col-md-4">
            <div class="card card-hero">
              <div class="card-header">
                <div class="card-icon">
                  <i class="far fa-question-circle"></i>
                </div>
                <h4></h4>
                <div class="card-description"></div>
              </div>
              <div class="card-body">
                <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
                    @foreach ($item as $worker)
                    <li class="media">
                        <img alt="image" class="mr-3 rounded-circle" width="50" src="src="{{ Auth::user()->avatar ?: 'https://ui-avatars.com/api/?size=96&name='.(Auth::user()->name ? substr(Auth::user()->name, 0, 1) : '?') }}">
                        <div class="media-body">
                          <div class="media-title">{{$worker['device_name']}}</div>
                          <div class="text-job text-muted">{{$worker['timestamp']}}</div>
                        </div>
                        <div class="media-progressbar">
                          <div class="progress-text">{{$worker['accuracy']}}</div>
                          <div class="progress" data-height="6" style="height: 6px;">
                            <div class="progress-bar bg-primary" data-width="{{$worker['accuracy']}}" style="width: {{$worker['accuracy']}};"></div>
                          </div>
                        </div>
                        <div class="media-cta">
                          <a href="#" class="btn btn-outline-warning">Peringatkan</a>
                        </div>
                      </li>
                    @endforeach
                </ul>
              </div>
            </div>
          </div>
        @endforeach
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-md" id="tworker">
                <thead>
                <tr>        
                    <th>#</th>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Akurasi</th>
                    <th>Aktif(min)</th>
                    <th>Waktu</th>
                </tr>
                </thead>
                </table>
            </div>
        </div>
    </div>
  </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
@endsection
