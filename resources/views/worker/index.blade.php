@extends('layouts.app')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Daftar Pekerja</h1>
    </div>
    <div class="section">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
              <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
              </div>
              <div class="card-wrap">
                  <div class="card-header">
                      <h4></h4>
                  </div>
                  <div class="card-body">
                  </div>
              </div>
          </div>
      </div>
    </div>
    <div class="section-body">
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
                <th>Aktif(min)</th>
                <th>Waktu</th>
              </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>#</th>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Aktif(min)</th>
                    <th>Waktu</th>
                  </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      </div>
    </div>
  </section>
@endsection
