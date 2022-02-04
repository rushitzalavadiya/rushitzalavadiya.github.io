<?php
include 'connect.php';

if(!$_SESSION["username"])
{
     header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>MusicBeat</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  
  <script type="text/javascript" src="functions.js"></script>
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top" onload="app_notify('notify_data','app_notify','show','0','0','0')">
  <div class="container-fluid" >
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Notifications</div>
      <div class="card-body">


       <form name="myform" method="POST" enctype="multipart/form-data" >

         <div class="form-group">
          <label for="exampleInputEmail1">Title</label>

          <input class="form-control" id="title" type="text" aria-describedby="emailHelp" name="title" required="" placeholder="Enter Title">
        </div>



        <div class="form-group">
          <label for="exampleInputEmail1">Message</label>

          <input class="form-control" id="message" type="text" aria-describedby="emailHelp" name="message" required="" placeholder="Enter Message">
        </div>



      </div>
      <div class="form-group">
        <div class="form-row">
        </div>
      </div>
     <button type="button" class="btn btn-primary btn-block" name="delete" onclick="app_notify('notify_data','app_notify','insert',document.getElementById('title').value,document.getElementById('message').value,'0')">Insert</button>
      <a href="index.php" class="btn btn-primary btn-block" style="color:#fff;">Home</a>

    </form>

  </div>
</div>
<br />
<div class="card mb-3">
  <div class="card-header" >
    <i class="fa fa-table"></i> App Notifications</div>
    <div class="card-body">
      <div class="table-responsive" id="notify_data">

      </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
  </div>


</div>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- File Upload JavaScript-->

<script src="js/file-upload.js"></script>

</body>

</html>

