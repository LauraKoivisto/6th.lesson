

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
		<a class="navbar-brand" href="#">Brand</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

		<ul class="nav navbar-nav">

		<li class="active">
			<a href="app.php">

				Make your list

			</a>
		</li>

		<li>
			<a href="table.php">
				Your list
			</a>
		</li>

		</ul>

	</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>

<div class="container">


<h2 class="text-center">Grocery List</h2>
<h3 class="text-center">What you need to buy</h3>

<form>
	<div class="row">
		<div class="col-md-3 col-sm-6">
			<div class="form-group">
<form method="get">
	<label for="buy">Buy:* <label>
	<input type="text" name="buy"><br><br>
</div>
</div>
</div>



<div class="row">
<div class="col-md-3 col-sm-6">
		<div class="form-group">
	<label for="budget">Budget: <label>
	<input type="text" name="budget"><br><br>
</div>
</div>
</div>

	<!-- This is the save button-->

<h4>Press the heart and add it to the list</h4>
<button type="submit" class="btn btn-danger btn-circle btn-xl"><i class="glyphicon glyphicon-heart"></i></button>


	<br><br>

	</html>

	<?php require_once("header.php"); ?>
	<?php
		// require another php file
		// ../../../ => 3 folders back
		require_once("../config.php");
		$everything_was_okay = true;
		//*********************
		// TO field validation
		//*********************
		if(isset($_GET["buy"])){ //if there is ?to= in the URL
			if(empty($_GET["buy"])){ //if it is empty
				$everything_was_okay = false; //empty
				echo "Please enter the item <br>"; // yes it is empty
			}else{
				echo "Buy: ".$_GET["buy"]."<br>"; //no it is not empty
			}
		}else{
			$everything_was_okay = false; // do not exist
		}
		//check if there is variable in the URL
		if(isset($_GET["budget"])){

			//only if there is message in the URL
			//echo "there is message";

			//if its empty
			if(empty($_GET["budget"])){
				//it is empty
				$everything_was_okay = false;
				echo "Please enter the budget <br>";
			}else{
				//its not empty
				echo "Budget: ".$_GET["budget"]."<br>";
			}

		}else{
			//echo "there is no such thing as message";
			$everything_was_okay = false;
		}



		/***********************
		**** SAVE TO DB ********
		***********************/

		// ? was everything okay
		if($everything_was_okay == true){

			echo "Added to list ";


			//connection with username and password
			//access username from config
			//echo $db_username;

			// 1 servername
			// 2 username
			// 3 password
			// 4 database
			$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_laukoi");

			$stmt = $mysql->prepare("INSERT INTO Grocery_list (item_1, budget) VALUES (?,?)");

			//echo error
			echo $mysql->error;

			// we are replacing question marks with values
			// s - string, date or smth that is based on characters and numbers
			// i - integer, number
			// d - decimal, float

			//for each question mark its type with one letter
			$stmt->bind_param("ss", $_GET["buy"], $_GET["budget"]);

			//save


			if($stmt->execute()){
				echo "saved sucessfully";
			}else{
				echo $stmt->error;
			}


		}


	?>
