<?php require_once("header.php"); ?>
<?php
	// table.php

	//getting our config
	require_once("../config.php");

	//create connection
	$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_laukoi");


	/*
		IF THERE IS ?DELETE=ROW_ID in the url
	*/
	if(isset($_GET["delete"])){

		echo "Deleting row with id:".$_GET["delete"];

		// NOW() = current date-time
		$stmt = $mysql->prepare("UPDATE Grocery_list SET deleted=NOW() WHERE id = ?");

		echo $mysql->error;

		//replace the ?
		$stmt->bind_param("i", $_GET["delete"]);

		if($stmt->execute()){
			echo "deleted successfully";
		}else{
			echo $stmt->error;
		}

		//closes the statement, so others can use connection
		$stmt->close();

	}






	//SQL sentence
	$stmt = $mysql->prepare("SELECT id, item_1, budget FROM Grocery_list WHERE deleted IS NULL ORDER BY created DESC LIMIT 10");

	//WHERE deleted IS NULL show only those that are not deleted

	//if error in sentence
	echo $mysql->error;

	//variables for data for each row we will get
	$stmt->bind_result($id, $item_1, $budget);

	//query
	$stmt->execute();

	$table_html = "";

	//add smth to string .=
	$table_html .= "<table class=table table-'>";
		$table_html .= "<tr>";
			$table_html .= "<th>ID</th>";
			$table_html .= "<th>Your Item</th>";
			$table_html .= "<th>How much</th>";
			$table_html .= "<th>Delete ?</th>";
		$table_html .= "</tr>";

	// GET RESULT
	//we have multiple rows
	while($stmt->fetch()){

		//DO SOMETHING FOR EACH ROW
		//echo $id." ".$message."<br>";
		$table_html .= "<tr>"; //start new row
			$table_html .= "<td>".$id."</td>"; //add columns
			$table_html .= "<td>".$item_1."</td>";
			$table_html .= "<td>".$budget."</td>";
			$table_html .= "<td>
			<a class='btn btn-danger'
								href='?delete=".$id."'>Away!</a>
							</td>";



		$table_html .= "</tr>"; //end row
	}
	$table_html .= "</table>";




?>



		<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#">Grocery list</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

		  <ul class="nav navbar-nav">

			<li>
				<a href="app.php">
					Forgot something?
				</a>
			</li>


			<li class="active" >
				<a href="table.php">
					List
				</a>
			</li>

		  </ul>

		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">

		<h1> This is what you need to buy </h1>

	<?php echo $table_html; ?>

	</div>







  </body>
 </html>

 <?php require_once("header.php"); ?>
 <?php
 	// table.php

 	//getting our config
 	require_once("../config.php");

 	//create connection
 	$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_laukoi");


 	/*
 		IF THERE IS ?DELETE=ROW_ID in the url
 	*/
 	if(isset($_GET["delete"])){

 		echo "Deleting row with id:".$_GET["delete"];

 		// NOW() = current date-time
 		$stmt = $mysql->prepare("UPDATE Grocery_list SET deleted=NOW() WHERE id = ?");

 		echo $mysql->error;

 		//replace the ?
 		$stmt->bind_param("i", $_GET["delete"]);

 		if($stmt->execute()){
 			echo "deleted successfully";
 		}else{
 			echo $stmt->error;
 		}

 		//closes the statement, so others can use connection
 		$stmt->close();

 	}






 	//SQL sentence
 	$stmt = $mysql->prepare("SELECT id, item_1, budget FROM Grocery_list WHERE deleted IS NULL ORDER BY created DESC LIMIT 10");

 	//WHERE deleted IS NULL show only those that are not deleted

 	//if error in sentence
 	echo $mysql->error;

 	//variables for data for each row we will get
 	$stmt->bind_result($id, $item_1, $budget);

 	//query
 	$stmt->execute();

 	$table_html = "";

 	//add smth to string .=
 	$table_html .= "<table class=table table-'>";
 		$table_html .= "<tr>";
 			$table_html .= "<th>ID</th>";
 			$table_html .= "<th>Your Item</th>";
 			$table_html .= "<th>How much</th>";
 			$table_html .= "<th>Delete ?</th>";
 		$table_html .= "</tr>";

 	// GET RESULT
 	//we have multiple rows
 	while($stmt->fetch()){

 		//DO SOMETHING FOR EACH ROW
 		//echo $id." ".$message."<br>";
 		$table_html .= "<tr>"; //start new row
 			$table_html .= "<td>".$id."</td>"; //add columns
 			$table_html .= "<td>".$item_1."</td>";
 			$table_html .= "<td>".$budget."</td>";
 			$table_html .= "<td>
 			<a class='btn btn-danger'
 								href='?delete=".$id."'>Away!</a>
 							</td>";



 		$table_html .= "</tr>"; //end row
 	}
 	$table_html .= "</table>";




 ?>
