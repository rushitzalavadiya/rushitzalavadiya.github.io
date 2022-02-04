<?php
include 'connect.php';
if(!$_SESSION["username"])
{
     header("location:login.php");
}


if(isset($_POST['did']))
{
  mysqli_query($con,"delete from sound_category where category_id = ".$_POST['did']."");
}
else if(isset($_POST['category_name']))
{
  $category_name=$_POST['category_name'];
  mysqli_query($con,"insert into sound_category values(0,'".$category_name."',0)");
}


/*
$cats=mysqli_query($con,"select * from video_category");
if(mysqli_num_rows($cats)>0)
{
  while ($cat=mysqli_fetch_array($cats,MYSQLI_ASSOC)) {

    $category=array();
    $category['Cat_Id']=(int)$cat['Cat_Id'];
    $category['Category_Name']=$cat['Category_Name'];
    $category['Icon_path']=$cat['Icon_path'];
    $category['Icon_url']=$cat['Icon_url'];
    $category['status']=(int)$cat['status'];

    array_push($response['result'],$category);  
  }
}
*/
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


       <form name="myform" method="POST" enctype="multipart/form-data" action="save_sound_category.php">



        <div class="form-group">
          <label for="exampleInputEmail1">Category Name</label>
          <?php
          if(isset($_REQUEST['uid']))
          {

           ?>
           <input type="hidden" name="uid" value="<?php echo $main['Cat_Id']; ?>" />
           <input class="form-control" id="exampleInputEmail1" type="text" value="<?php  echo $main['Category_Name']; ?>" aria-describedby="emailHelp"  name="category_name" placeholder="Enter Category Name">

           <?php
         }
         else
         {
          ?>
          <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" name="category_name" required="" placeholder="Enter Category Name">

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
    <i class="fa fa-table"></i> Sound Category List</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align:center;">
          <thead>
            <tr>
              <th>category_id</th>
              <th>category_name</th>
              <th>Delete Category</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>category_id</th>
              <th>category_name</th>
              <th>Delete Category</th>
            </tr>
          </tfoot>
          <tbody>

           <?php
           $query=mysqli_query($con,"select * from sound_category");
           if($query)
           {

            while ($row=mysqli_fetch_array($query,MYSQLI_ASSOC)) {


              ?>
              <tr>
                <td><?php echo $row["category_id"];  ?></td>
                <td><?php  echo $row["category_name"]; ?></td>
              <!--   <td><a href="save_video_category.php?uaid=<?php echo $row['Cat_Id']; ?>">Edit</td>
 -->
                 <td>
                   <form action="save_sound_category.php" method="POST">
                    <input type="hidden" name="did" value="<?php echo $row['category_id']; ?>">
                    <input type="submit" name="delete" value="Delete">
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

