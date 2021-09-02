@extends('layouts.app')
@section('content')
<section class="section">
  <div class="section-header">
      <div>
      <h1>Monitor </h1>
      </div>
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
  </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
@endsection
