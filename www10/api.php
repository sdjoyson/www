<?php
	header('Access-Control-Allow-Orgin : *');

	$db = mysqli_connect("localhost", "root", ""); 
	mysqli_select_db($db, "phone"); 


	if(isset($_GET['type']))
	{
		if($_GET['type'] == 'login')
		{
		$username2 = $_GET['username1'];
		$password2 = $_GET['password1'];
		$sql = "select * from login where username = '".$username2."' and password = '".$password2."'";
		$retval = mysqli_query($db, $sql);
		$res = mysqli_num_rows($retval);


		if($res>0)
		{
			// $resipes = array();
			$recipe=mysqli_fetch_array($retval,MYSQLI_ASSOC);
			{
				// $resipes[] = array('user'=>$recipe);
				
				echo $recipe['username'];
			}

			// $output = json_encode(array('users'=>$resipes));
			// echo $output;
		}
		else
		{
			echo 'Incorrect username and password';
		}
	 }
	}		
	else
		{
			echo 'Not successfully';
		}
	

