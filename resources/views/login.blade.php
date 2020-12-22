<!DOCTYPE html>
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{asset('js/guest-login.js')}}" type="text/javascript" ></script>

<link href="{{asset('css/login.css')}}" rel="stylesheet">
</head>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Icon -->
    <div class="fadeIn first">
      <h3 class="text-center text-info marginTop">Welcome</h3>
    </div>
    <br>
    <!-- Login Form -->
    <form id="admin-login" class="form" action="login" method="post">
      @if (count($errors) > 0)
         <div class="alert alert-danger">
             <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
       @endif

       @if ($message = Session::get('success'))
           <div class="alert alert-success alert-block">
               <button type="button" class="close" data-dismiss="alert">×</button>
               <strong>{{ $message }}</strong>
           </div>
       @endif
       @if ($message = Session::get('error'))
           <div class="alert alert-danger alert-block">
               <button type="button" class="close" data-dismiss="alert">×</button>
               <strong>{{ $message }}</strong>
           </div>
       @endif
       {!! csrf_field() !!}
      <input type="text" id="username" class="fadeIn second inputText" name="name" placeholder="user name">
      <input type="password" id="password" class="fadeIn third inputText" name="password" placeholder="password">
      <input type="text" hidden id="login_flag_admin" class="fadeIn third inputText" name="login_flag" value="admin">
      <input type="submit" class="fadeIn fourth inputButton" value="Log In">
    </form>
    <!-- Remind Passowrd -->
    <div id="formFooter">
      <input type="button" data-toggle="modal" data-target="#exampleModal" class="fadeIn fourth guestButton" value="Guest Login">
    </div>

  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <label for="email" class="text-info">Please Enter Name:</label><br>
        <input type="text" id="guest_username" class="fadeIn second inputText" name="guest_username" placeholder="user name">
        <input type="text" hidden id="login_flag" class="fadeIn second inputText" name="login_flag" value="guest">
        <br>
        <span id="success-msg" style="color:green;"></span>
        <span id="error-msg" style="color:red;"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="guest_login_button" class="btn btn-primary" onclick="guestLogin()">Enter Quiz</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
