<?php
include 'connect.php';
if(!$_SESSION["username"])
{
     header("location:login.php");
}
if(isset($_POST['upid']))
{
  $message=$_POST['message'];
  $status=$_POST['status'];
  $url=$_POST['url'];
  $version_code=$_POST['version_code'];
  $appid=$_POST['appid'];
  $banner=$_POST['banner'];
  $inter=$_POST['inter'];
  $reward=$_POST['reward'];
  $native=$_POST['native'];
  
  mysqli_query($con,"update app_info set message='".$message."',status=".$status.",url='".$url."',version_code=".$version_code.",appid='".$appid."',banner='".$banner."',inter='".$inter."',reward='".$reward."',native='".$native."' where id=".$_POST['upid']."");
}

$mains=mysqli_query($con,"select * from app_info");
$main=mysqli_fetch_array($mains,MYSQLI_ASSOC);
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
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top" >
  <div class="container-fluid" >
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Sound Category</div>
      <div class="card-body">


       <form name="myform" method="POST" enctype="multipart/form-data" action="app_info.php">



        <div class="form-group">
          <label for="exampleInputEmail1">Message</label>
          <?php
          if(isset($_REQUEST['uid']))
          {

           ?>
           <input type="hidden" name="upid" value="<?php echo $main['id']; ?>" />
           <input class="form-control" id="exampleInputEmail1" type="text" value="<?php  echo $main['message']; ?>" aria-describedby="emailHelp"  name="message" placeholder="Enter Message">
           <?php
         }
         else
         {
          ?>
          <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" name="message" required="" placeholder="Enter Message">
          <?php
        }
        ?>
      </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Status</label>
          <?php
          if(isset($_REQUEST['uid']))
          {

           ?>
           <input class="form-control" id="exampleInputEmail1" type="text" value="<?php  echo $main['status']; ?>" aria-describedby="emailHelp"  name="status" placeholder="Enter Status">
           <?php
         }
         else
         {
          ?>
          <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" name="status" required="" placeholder="Enter Status">
          <?php
        }
        ?>
      </div>

       <div class="form-group">
          <label for="exampleInputEmail1">Url</label>
          <?php
          if(isset($_REQUEST['uid']))
          {

           ?>
           <input class="form-control" id="exampleInputEmail1" type="text" value="<?php  echo $main['url']; ?>" aria-describedby="emailHelp"  name="url" placeholder="Enter Url">
           <?php
         }
         else
         {
          ?>
          <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" name="url" required="" placeholder="Enter Url">
          <?php
        }
        ?>
      </div>

      <div class="form-group">
          <label for="exampleInputEmail1">Version Code</label>
          <?php
          if(isset($_REQUEST['uid']))
          {

           ?>
           <input class="form-control" id="exampleInputEmail1" type="text" value="<?php  echo $main['version_code']; ?>" aria-describedby="emailHelp"  name="version_code" placeholder="Enter Version Code">
           <?php
         }
         else
         {
          ?>
          <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" name="version_code" required="" placeholder="EnterVersion Code">
          <?php
        }
        ?>
      </div>


 <div class="form-group">
          <label for="exampleInputEmail1">AppID</label>
          <?php
          if(isset($_REQUEST['uid']))
          {

           ?>
           <input class="form-control" id="exampleInputEmail1" type="text" value="<?php  echo $main['appid']; ?>" aria-describedby="emailHelp"  name="appid" placeholder="Enter AppID">
           <?php
         }
         else
         {
          ?>
          <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" name="appid" required="" placeholder="Enter AppID">
          <?php
        }
        ?>
      </div>

     <div class="form-group">
          <label for="exampleInputEmail1">Banner Ad</label>
          <?php
          if(isset($_REQUEST['uid']))
          {

           ?>
           <input class="form-control" id="exampleInputEmail1" type="text" value="<?php  echo $main['banner']; ?>" aria-describedby="emailHelp"  name="banner" placeholder="Enter Banner Ad">
           <?php
         }
         else
         {
          ?>
          <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" name="banner" required="" placeholder="Enter Banner Ad">
          <?php
        }
        ?>
      </div>

       <div class="form-group">
          <label for="exampleInputEmail1">Inter Ad</label>
          <?php
          if(isset($_REQUEST['uid']))
          {

           ?>
           <input class="form-control" id="exampleInputEmail1" type="text" value="<?php  echo $main['inter']; ?>" aria-describedby="emailHelp"  name="inter" placeholder="Enter Inter Ad">
           <?php
         }
         else
         {
          ?>
          <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" name="inter" required="" placeholder="Enter Inter Ad">
          <?php
        }
        ?>
      </div>

       <div class="form-group">
          <label for="exampleInputEmail1">Reward Ad</label>
          <?php
          if(isset($_REQUEST['uid']))
          {

           ?>
           <input class="form-control" id="exampleInputEmail1" type="text" value="<?php  echo $main['reward']; ?>" aria-describedby="emailHelp"  name="reward" placeholder="Enter Reward Ad">
           <?php
         }
         else
         {
          ?>
          <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" name="reward" required="" placeholder="Enter Reward Ad">
          <?php
        }
        ?>
      </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Native Ad</label>
          <?php
          if(isset($_REQUEST['uid']))
          {

           ?>
           <input class="form-control" id="exampleInputEmail1" type="text" value="<?php  echo $main['native']; ?>" aria-describedby="emailHelp"  name="native" placeholder="Enter Reward Ad">
           <?php
         }
         else
         {
          ?>
          <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" name="native" required="" placeholder="Enter Native Ad">
          <?php
        }
        ?>
      </div>



    </div>
    <div class="form-group">
      <div class="form-row">
      </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block" name="submit">Insert/Update</button>
    <a href="index.php" class="btn btn-primary btn-block" style="color:#fff;">Home</a>

  </form>

</div>
</div>
<br />
<div class="card mb-3">
  <div class="card-header" >
    <i class="fa fa-table"></i> App Info</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align:center;">
          <thead>
            <tr>
              <th>id</th>
              <th>message</th>
              <th>url</th>

              <th>version_code</th>
              <th>appid</th>
              <th>banner</th>

              <th>inter</th>
              <th>reward</th>
              <th>native</th>
              <th>Update</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>id</th>
              <th>message</th>
              <th>url</th>

              <th>version_code</th>
              <th>appid</th>
              <th>banner</th>
              
              <th>inter</th>
              <th>reward</th>
              <th>native</th>
              <th>Update</th>
            </tr>
          </tfoot>
          <tbody>

           <?php
           $query=mysqli_query($con,"select * from app_info");
           if($query)
           {

            while ($row=mysqli_fetch_array($query,MYSQLI_ASSOC)) {


              ?>
              <tr>
                <td><?php echo $row["id"];  ?></td>
                <td><?php  echo $row["message"]; ?></td>

                <td><?php  echo $row["url"]; ?></td>
                <td><?php  echo $row["version_code"]; ?></td>
                <td><?php  echo $row["appid"]; ?></td>
                <td><?php  echo $row["banner"]; ?></td>
                <td><?php  echo $row["inter"]; ?></td>
                <td><?php  echo $row["reward"]; ?></td>
                <td><?php  echo $row["native"]; ?></td>
              <!--   <td><a href="save_video_category.php?uaid=<?php echo $row['Cat_Id']; ?>">Edit</td>
 -->
                 <td>
                   <form action="app_ads_info.php" method="POST">
                    <input type="hidden" name="uid" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="delete" value="Update">
                  </form>
                </td>

              </tr>
              <?php
            }
          }
          ?>
        </tbody>
      </table>
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

