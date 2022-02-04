<?php
include 'connect.php';

include("getID3/getid3/getid3.php");
if(!$_SESSION["username"])
{
     header("location:login.php");
}

if(isset($_POST['did']))
{
  mysqli_query($con,"delete from particle where id = ".$_POST['did']."");
}
else if(isset($_POST['category_id']))
{
    
  $category_id=$_POST['category_id'];
  $theme_name=$_POST['theme_name'];
  $prefab_name=$_POST['prefab_name'];
  
  $milliseconds = round(microtime(true) * 1000);
  $ext = end((explode(".", $_FILES["thumbimg"]["name"])));
  $extt = end((explode(".", $_FILES["particle"]["name"])));
  $ext2 = end((explode(".", $_FILES["themeimg"]["name"])));
  
  $name=$milliseconds.".".$ext;
  $namee=$milliseconds.".".$extt;
  $name2=$milliseconds.".".$ext2;
  
  $thumb_path=getcwd()."/Images/particle/thumb/".$name;
  $thumb_url="http://$_SERVER[HTTP_HOST]"."/SpoofBit/Images/particle/thumb/".$name;
  
  $file_path=getcwd()."/Images/particle/files/".$namee;
  $file_url="http://$_SERVER[HTTP_HOST]"."/SpoofBit/Images/particle/files/".$namee;
  
  $img_path=getcwd()."/Images/particle/themes/".$name2;
  $img_url="http://$_SERVER[HTTP_HOST]"."/SpoofBit/Images/particle/themes/".$name2;


    move_uploaded_file($_FILES['thumbimg']['tmp_name'],$thumb_path);
    move_uploaded_file($_FILES['particle']['tmp_name'],$file_path);
    move_uploaded_file($_FILES['themeimg']['tmp_name'],$img_path);
 
  
     mysqli_query($con,"insert into particle values(0,".$category_id.",'".$theme_name."','".$prefab_name."','".$img_path."','".$img_url."','".$thumb_path."','".$thumb_url."','".$file_path."','".$file_url."')");

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
      <div class="card-header">Particles</div>
      <div class="card-body">


       <form name="myform" method="POST" enctype="multipart/form-data" action="save_particle.php">


        <div class="form-group">
          <label for="exampleInputEmail1">Particle Category</label>
          <select class="form-control" name="category_id" required="">

            <?php
            $cats=mysqli_query($con,"select * from particle_category");
            $first=0;
            while ($cat=mysqli_fetch_array($cats,MYSQLI_ASSOC)) {
            {
              if($first==0)
              {
                $first=1;
                ?>

                <option value="<?php echo $cat['category_id']; ?>" selected="selected"><?php echo $cat['category_name']; ?></option>
                <?php
              }else
              {
                ?>
                <option value="<?php echo $cat['category_id']; ?>"><?php echo $cat['category_name']; ?></option>
                <?php
              }
            }
          }
          ?>
        </select>
      </div>


<div class="form-group">
          <label for="exampleInputEmail1">Theme Name</label>
         
          <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" name="theme_name" required="" placeholder="Enter Theme Name">

      </div>
    
<div class="form-group">
          <label for="exampleInputEmail1">Prefab Name</label>
         
          <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" name="prefab_name" required="" placeholder="Enter Prefab Name">

      </div>
    

<div class="form-group">           
    <label for="exampleInputName">Theme Thumbnail</label>
      <div class="form-row">

        <div class="input-group">
          <span class="input-group-btn">
            <span class="btn btn-default btn-file">

              <?php
              if(isset($_REQUEST['uid']))
              {
                ?>
                Browse… <input type="file" id="imgInn" name="themeimg">
                <?php
              }
              else{
                ?>
                Browse… <input type="file" id="imgInn" name="themeimg" required="">
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

          <img id='img-uploaa' />
          <?php
        }
        else{
          ?>

          <img id='img-uploaa'/>
          <?php
        }
        ?>
      </div>
    </div>
    
    

     

    <div class="form-group">           
    <label for="exampleInputName">Particle Thumbnail</label>
      <div class="form-row">

        <div class="input-group">
          <span class="input-group-btn">
            <span class="btn btn-default btn-file">

              <?php
              if(isset($_REQUEST['uid']))
              {
                ?>
                Browse… <input type="file" id="imgInp" name="thumbimg">
                <?php
              }
              else{
                ?>
                Browse… <input type="file" id="imgInp" name="thumbimg" required="">
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
    <label for="exampleInputName">Particle</label>
      <div class="form-row">

        <div class="input-group">
          <span class="input-group-btn">
            <span class="btn btn-default btn-file">

              <?php
              if(isset($_REQUEST['uid']))
              {
                ?>
                Browse… <input type="file" id="imgInpp" name="particle">
                <?php
              }
              else{
                ?>
                Browse… <input type="file" id="imgInpp" name="particle" required="">
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

          <img id='img-uploadd' />
          <?php
        }
        else{
          ?>

          <img id='img-uploadd'/>
          <?php
        }
        ?>
      </div>
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
    <i class="fa fa-table"></i> Particle List</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align:center;">
          <thead>
            <tr>
              <th>id</th>
              <th>category_id</th>
              <th>Theme_name</th>
              <th>Prefab_name</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>id</th>
              <th>category_id</th>
              <th>Theme_name</th>
              <th>Prefab_name</th>
              <th>Delete</th>
            </tr>
          </tfoot>
          <tbody>

           <?php
           $query=mysqli_query($con,"select * from particle");
           if($query)
           {

            while ($row=mysqli_fetch_array($query,MYSQLI_ASSOC)) {


              ?>
              <tr>
                <td><?php echo $row["id"];  ?></td>
                <td><?php  echo $row["category_id"]; ?></td>
                <td><?php  echo $row["theme_name"]; ?></td>
                <td><?php  echo $row["prefab_name"]; ?></td>
              <td>
               <form action="save_particle.php" method="POST">
                <input type="hidden" name="did" value="<?php echo $row['id']; ?>">
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

