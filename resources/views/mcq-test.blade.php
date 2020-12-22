<!DOCTYPE html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
  <div class="container-fluid "  >
    <h2 class="text-center">Hi {{ Auth::user()->name }}</h2>
    <hr>
    <p >Note : <ul>
                <li>do not refresh page it will change the question. </li>
                <li>After completing answer click on submit button</li>
                <ul>
    </p>
    <hr>
    @if (Session::has('msg'))
        <div class="alert alert-success">

            <ul>
                <li>{{ Session::get('msg') }}</li>
            </ul>
        </div>
    @endif


    <div class="row">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
                <div class="row">
                    <br>
                    <form id="submit-quiz" class="form" action="submit-quiz" method="post">
                      {!! csrf_field() !!}
                    <?php $i=1; foreach ($data as $key => $value):
                      array_push($value['incorrect_answers'],$value['correct_answer']);
                      shuffle($value['incorrect_answers']);
                      ?>
                    <p id="question{{$key}}">Q.{{$i}} question:- {!! $value['question'] !!} </p>
                    <p id="category{{$key}}"> category:- {!! $value['category'] !!} </p>
                    <p id="difficulty{{$key}}">difficulty:- {!! $value['difficulty'] !!} </p>
                    <input type="radio" name="{{$key}}" value="{{$value['incorrect_answers'][0]}}"/> {{$value['incorrect_answers'][0]}}<br>
                    <input type="radio" name="{{$key}}"  value="{{$value['incorrect_answers'][1]}}"/> {{$value['incorrect_answers'][1]}}<br>
                    <input type="radio" name="{{$key}}"  value="{{$value['incorrect_answers'][2]}}"/> {{$value['incorrect_answers'][2]}}<br>
                    <input type="radio" name="{{$key}}"  value="{{$value['incorrect_answers'][3]}}"/> {{$value['incorrect_answers'][3]}}<br>
                    <hr>
                    <?php $i++; endforeach; ?>
                    <input type="submit" id="submitQuiz" class="btn btn-primary" value="Submit Quiz">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="alert alert-success">
                  {{ Session::get('msg') }}
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

</body>
</html>
<script>
$(document).ready(function(){
  var x =<?php echo !empty(Session::has('msg'))?Session::has('msg'):'2';?>;
  if(x==1){
    $('#myModal').modal('show');
    setTimeout(function() {
      window.location.href = 'login';
    }, 5000);
  }
});
</script>
