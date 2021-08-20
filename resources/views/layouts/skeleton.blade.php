<!DOCTYPE html>
<html lang="en">
<head>


  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title', 'Home') &mdash; {{ config('app.name') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
  @stack('stylesheet')
</head>

<body>
<div id="app">
  @yield('app')
</div>
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script> --}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script> --}}
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
<script type="text/javascript">
function getWorkerByLocation(){
  var hostApi = '{{route('api.rooms.by_location')}}';
  var card = document.getElementById("data_by_locations");
  var bgDanger = "bg-danger"
  $.ajax({
    url: hostApi,
    method : "GET",
    type : "json",
    success : function(data){
      data.forEach(element => {
        console.log(element.locations)
        if(!element.is_danger){
          bgDanger = "bg-primary"
        }
        card.innerHTML = (
          " <div class='row'>" +
            "<div class='col-lg-3 col-md-6 col-sm-6 col-12'>"+
             " <div class='card card-statistic-1'>"+
                  "<div class='card-icon "+bgDanger+"'>"+
                     "<i class='far fa-user'></i>"+
                 " </div>"+
                 " <div class='card-wrap'>"+
                     " <div class='card-header'>"+
                          "<h4>"+element.locations+"</h4>"+
                     " </div>"+
                     " <div class='card-body'>"
                      +element.total+
                    " Pekerja </div>"+
               "   </div>"+
            "  </div>"+
      "</div>")
      });
    }
  })
}
function getWorker(){
  var hostApi = '{{route('worker.show.json')}}';
  var i = 1;
  var table = $("#tworker").DataTable({
    ajax : {
      url : hostApi,
      type: POST,
      dataSrc : (json) => {
        return json.data.map((row, index) => {
          row.index = index + 1
          return row
        })
      },
    },
    columns : [
      {"data": "index"},
      {"data" : "worker"},
      {"data" : "location"},
      {"data" : "probability"},
      {"data" : "active_mins"},
      {"data" : "timestamp"}
    ]
  });
  setInterval(() => {
    table.ajax.reload()
  }, 1000)
}
setInterval(getWorkerByLocation,1000)
getWorker()
</script>
@stack('javascript')
</body>
</html>
