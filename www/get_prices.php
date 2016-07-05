
		<?php
			if(isset($_GET['category']))
			{
				include 'db.php';
				$id=$_GET['category'];
				$sel=mysql_query("select * from prices where category_id='$id'");
				while($row=mysql_fetch_array($sel))
				{
					echo "$row[prices]";
				}
			
			}
		?>
	