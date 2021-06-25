<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title', 'Home') &mdash; {{ config('app.name') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
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
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script> --}}

<script type="text/javascript">
function getWorkerByLocation(){
  var hostApi = "http://10.50.0.20:8000/api/by_location/json";
  $.ajax({
    url: hostApi,
    method : "GET",
    type : "json",
    success : function(data){
      // array.forEach(element => {
      //   console.log(data[element])
      // });
      console.log(data)
    }
  })
}
function getWorker(){
  var hostApi = "http://10.50.0.20:8000/worker/show/json";
  var i = 1;
  var table = $("#tworker").DataTable({
    ajax : {
      url : hostApi,
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
      {"data" : "active_mins"},
      {"data" : "timestamp"}
    ]
  });
  setInterval(() => {
    table.ajax.reload()
  }, 1000)
}
getWorkerByLocation()
getWorker()
</script>
@stack('javascript')
</body>
</html>
