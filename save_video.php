<?php
include 'connect.php';

if(!$_SESSION["username"])
{
     header("location:login.php");
}

if(isset($_POST['did']))
{
  mysqli_query($con,"delete from videos where Id = ".$_POST['did']."");
}
else if(isset($_POST['Theme_Name'])&&isset($_FILES['Thumnail']))
{
  $Cat_Id=$_POST['Cat_Id'];
  
  $Theme_Id=$_POST['Theme_Id'];
  $Theme_Name=$_POST['Theme_Name'];
  $Icon=$_FILES['Thumnail'];
  $GameobjectName=$_POST['GameobjectName'];
  $Sound_Id=$_POST['Sound_Id'];

  $sounds=mysqli_query($con,"select * from sounds where id=".$Sound_Id."");
  $sound=mysqli_fetch_array($sounds,MYSQLI_ASSOC);

  $milliseconds = round(microtime(true) * 1000);
  $name=$milliseconds.".jpg";

  $Icon_path=getcwd()."/Images/video_images/".$name;
  $Icon_url="http://$_SERVER[HTTP_HOST]"."/SpoofBit/Images/video_images/".$name;

  move_uploaded_file($_FILES['Thumnail']['tmp_name'],$Icon_path);

  mysqli_query($con,"insert into videos values(0,".$Cat_Id.",".$Theme_Id.",'".$Theme_Name."','".$Icon_path."','".$Icon_url."','".$sound['sound_name']."','".$sound['sound_full_url']."',".$sound['sound_size'].",".$GameobjectName.",0,0)");

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
      <div class="card-header">Videos</div>
      <div class="card-body">


       <form name="myform" method="POST" enctype="multipart/form-data" action="save_video.php">


        <div class="form-group">
          <label for="exampleInputEmail1">Video Category</label>
          <select class="form-control" name="Cat_Id" required="">

            <?php
            $cats=mysqli_query($con,"select * from video_category");
            $first=0;
            while ($cat=mysqli_fetch_array($cats,MYSQLI_ASSOC)) {
            {
              if($first==0)
              {
                $first=1;
                ?>

                <option value="<?php echo $cat['Cat_Id']; ?>" selected="selected"><?php echo $cat['Category_Name']; ?></option>
                <?php
              }else
              {
                ?>
                <option value="<?php echo $cat['Cat_Id']; ?>"><?php echo $cat['Category_Name']; ?></option>
                <?php
              }
            }
          }
          ?>
        </select>
      </div>

 <div class="form-group">
        <label for="exampleInputEmail1">Theme ID</label>
        <?php
        if(isset($_REQUEST['uid']))
        {

         ?>
         <input class="form-control" id="exampleInputEmail1" type="text" value="<?php  echo $main['Theme_Id']; ?>" aria-describedby="emailHelp"  name="Theme_Id" placeholder="Enter Theme ID">

         <?php
       }
       else
       {
        ?>
        <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" name="Theme_Id" required="" placeholder="Enter Theme ID">

        <?php
      }
      ?>
    </div>
    

      <div class="form-group">
        <label for="exampleInputEmail1">Theme Name</label>
        <?php
        if(isset($_REQUEST['uid']))
        {

         ?>
         <input type="hidden" name="uid" value="<?php echo $main['Id']; ?>" />
         <input class="form-control" id="exampleInputEmail1" type="text" value="<?php  echo $main['Category_Name']; ?>" aria-describedby="emailHelp"  name="Theme_Name" placeholder="Enter Theme Name">

         <?php
       }
       else
       {
        ?>
        <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" name="Theme_Name" required="" placeholder="Enter Theme Name">

        <?php
      }
      ?>
    </div>

    <div class="form-group">            <label for="exampleInputName">Thumbnail</label>
      <div class="form-row">

        <div class="input-group">
          <span class="input-group-btn">
            <span class="btn btn-default btn-file">

              <?php
              if(isset($_REQUEST['uid']))
              {

                ?>

                Browse… <input type="file" id="imgInp" name="Thumnail">
                <?php
              }
              else{
                ?>

                Browse… <input type="file" id="imgInp" name="Thumnail" required="">
                <?php
              }
              ?>

            </span>
          </span>
          <input type="text" class="form-control" readonly>
        </div>
        <?php
        if(isset($_REQUEST['uid']))
        {

          ?>

          <img id='img-upload' />
          <?php
        }
        else{
          ?>

          <img id='img-upload'/>
          <?php
        }
        ?>
      </div>
    </div>

    <div class="form-group">
          <label for="exampleInputEmail1">Sound</label>
          <select class="form-control" name="Sound_Id" required="">

            <?php
            $sounds=mysqli_query($con,"select * from sounds");
            $first=0;
            while ($sound=mysqli_fetch_array($sounds,MYSQLI_ASSOC)) {
            {
              if($first==0)
              {
                $first=1;
                ?>

                <option value="<?php echo $sound['id']; ?>" selected="selected"><?php echo $sound['sound_name']; ?></option>
                <?php
              }else
              {
                ?>
                <option value="<?php echo $sound['id']; ?>"><?php echo $sound['sound_name']; ?></option>
                <?php
              }
            }
          }
          ?>
        </select>
      </div>

 <div class="form-group">
        <label for="exampleInputEmail1">Gameobject Name</label>
        <?php
        if(isset($_REQUEST['uid']))
        {

         ?>
         <input type="hidden" name="uid" value="<?php echo $main['Id']; ?>" />
         <input class="form-control" id="exampleInputEmail1" type="text" value="<?php  echo $main['Category_Name']; ?>" aria-describedby="emailHelp"  name="GameobjectName" placeholder="Enter Gameobject Name">

         <?php
       }
       else
       {
        ?>
        <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" name="GameobjectName" required="" placeholder="Enter Gameobject Name">

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
    <i class="fa fa-table"></i> Video List</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align:center;">
          <thead>
            <tr>
              <th>Id</th>
              <th>Cat_Id</th>
              <th>Theme_Name</th>
              <th>Thumnail_Url</th>
              <th>SoundName</th>
              <th>GameobjectName</th>
              <th>Delete Video</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
               <th>Id</th>
              <th>Cat_Id</th>
              <th>Theme_Name</th>
              <th>Thumnail_Url</th>
              <th>SoundName</th>
              <th>GameobjectName</th>
              <th>Delete Video</th>
            </tr>
          </tfoot>
          <tbody>

           <?php
           $query=mysqli_query($con,"select * from videos");
           if($query)
           {

            while ($row=mysqli_fetch_array($query,MYSQLI_ASSOC)) {


              ?>
              <tr>
                <td><?php echo $row["Id"];  ?></td>
                <td><?php  echo $row["Cat_Id"]; ?></td>
                <td><?php  echo $row["Theme_Name"]; ?></td>

                <td><?php  echo $row["Thumnail_Url"]; ?></td>
                <td><?php  echo $row["SoundName"]; ?></td>
                <td><?php  echo $row["GameobjectName"]; ?></td>
              <!--   <td><a href="save_video_category.php?uaid=<?php echo $row['Cat_Id']; ?>">Edit</td>
              -->
              <td>
               <form action="save_video.php" method="POST">
                <input type="hidden" name="did" value="<?php echo $row['Id']; ?>">
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

