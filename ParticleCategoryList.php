<?php
include 'connect.php';

	$response=array();
	$response['data']=array();

	$category=mysqli_query($con,"select * from particle_category");

	if(mysqli_num_rows($category)>0)
	{
		$response['flag']=true;
		$response['message']="Sucess";
		$response['code']= 10;

		while($record=mysqli_fetch_array($category,MYSQLI_ASSOC))
		{
			$cat=array();
			$cat['category_id']=(int)$record['category_id'];
			$cat['category_name']=$record['category_name'];
			$cat['icon_url']=$record['icon_url'];
			$cat['position']=(int)$record['position'];

			$cat['particles']=array();


			$videos=mysqli_query($con,"select * from particle where category_id=".$record['category_id']."");
			while($vidrecord=mysqli_fetch_array($videos,MYSQLI_ASSOC))
			{
					$video=array();
					$video['id']=(int)$vidrecord['id'];
					$video['category_id']=(int)$vidrecord['category_id'];
					$video['theme_name']=$vidrecord['theme_name'];
					$video['prefab_name']=$vidrecord['prefab_name'];
					$video['theme_url']=$vidrecord['theme_url'];
					$video['thumb_url']=$vidrecord['thumb_url'];
					$video['particle_url']=$vidrecord['particle_url'];
					array_push($cat['particles'],$video);
			}

			
			array_push($response['data'],$cat);
		}
	}else{
		$response['flag']=false;
		$response['message']="Failure";
		$response['code']= 0;
		

	}

	echo json_encode($response);


?>