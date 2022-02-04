<?php
include 'connect.php';
if($_POST['page']=='app_notify')
{   
	if($_POST['work']=='delete')
	{
		mysqli_query($con,"delete from notify where id=".$_POST['did']."");
	}else if($_POST['work']=='insert')
	{
		date_default_timezone_set('Asia/Kolkata'); 

		$apiKey = "AIzaSyBpk_6cYjjI_ZiiCSbpcLz2t0J-aYkZYMs";
		$registrationIDs=array();
		$url = 'https://fcm.googleapis.com/fcm/send';
		$message=$_POST['message'];
		$title=$_POST['title'];


		mysqli_query($con,"insert into notify values(0,'".$title."','".$message."','".date("d-m-Y H:i:s")."')");

		$regs=mysqli_query($con,"select * from users");
		while ($reg=mysqli_fetch_array($regs,MYSQLI_ASSOC)) {
			array_push($registrationIDs,$reg['token']);
		}

		$fields = array(
			'registration_ids' => $registrationIDs,
			'data' => array( "text" => $message,"title" => $title),
		);

		$headers = array(
			'Authorization: key=' . $apiKey,
			'Content-Type: application/json'
		);

		$ch = curl_init();

    // Set the URL, number of POST vars, POST data
		curl_setopt( $ch, CURLOPT_URL, $url);
		curl_setopt( $ch, CURLOPT_POST, true);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields));

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $fields));

    // Execute post
		$result = curl_exec($ch);

    // Close connection
		curl_close($ch);

	}
	?>
	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align:center;">
		<thead>
			<tr>
				<th>id</th>
				<th>message</th>
				<th>Time</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>id</th>
				<th>message</th>
				<th>Time</th>
				<th>Delete</th>
			</tr>
		</tfoot>
		<tbody>

			<?php
			$query=mysqli_query($con,"select * from notify");
			if($query)
			{
				while ($row=mysqli_fetch_array($query,MYSQLI_ASSOC)) {
					?>
					<tr>
						<td><?php echo $row["id"];  ?></td>
						<td><?php  echo $row["message"]; ?></td>
						<td><?php  echo $row["ntime"]; ?></td>
						<td>
							<form method="POST">
								<input type="hidden" name="did" value="<?php echo $row['id']; ?>">
								<button type="button" name="delete" onclick="app_notify('notify_data','app_notify','delete','0','0','<?php  echo $row['id']; ?>')">Delete</button>
							</form>
						</td>
					</tr>
					<?php
				}
			}
			?>
		</tbody>
	</table>
	<?php
}
?>