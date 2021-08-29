@extends('layouts.app')
@section('content')
<section class="section">
  <div class="section-header">
      <div>
      <h1>Monitor </h1>
      </div>
      <!-- Breadcrumb -->
      {{-- <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Home</a></div>
          <!-- <div class="breadcrumb-item">Page</div> -->
      </div> --}}
  </div>
  <div class="section-body">
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
@endsection
