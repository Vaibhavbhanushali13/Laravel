<!DOCTYPE html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" >

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
  <div class="container-fluid "  >
    <h2 class="text-center">Hi {{ Auth::user()->name }}</h2>
    <p class="text-center">
      <a href="logout">
        Logout Here
      </a>
    </p>
    <hr>
  <table id="product_datatable" class="table table-striped table-bordered nowrap" style="width:100%">
  <thead>
      <tr>
          <th>Name</th>
          <th>Score</th>
          <th>Created at</th>
      </tr>
  </thead>
  <tbody>
    <?php if(isset($data) && !empty($data)){
      foreach ($data as $key => $value) {
      ?>
      <tr>
          <td>{{$value['name']}}</td>
          <td>{{$value['score']}}</td>
          <td>{{date('Y-m-d h:i:s', strtotime($value['created_at']))}}</td>
          </td>
      </tr>
      <?php }} ?>
  </tbody>
  </div>

  </body>
</html>
<script>
//dataTables
$(document).ready(function() {
    $('#product_datatable').DataTable(
      {
        "scrollX": true
      }
    );
} );
</script>
