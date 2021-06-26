@extends('layouts.app')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Daftar Pekerja</h1>
    </div>
    <h2 class="section-title">Workers by location</h2>
      <p class="section-lead">This page is information Workers by location.</p>
    <div class="section" id="data_by_locations"></div>
      <h2 class="section-title">List of Workers</h2>
      <p class="section-lead">This page is for managing Workers.</p>
      <div class="justify-content-center">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
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
          </div>
        </div>
      </div>
      </div>
  </section>
@endsection
