<?php 
	//set default values
	if (!isset($meal_cost)) { $meal_cost = ''; } 
    if (!isset($tip)) { $tip = ''; } 
    if (!isset($tax)) { $years = ''; } 

    // get the data from the form
    $meal_cost = filter_input(INPUT_POST, 'meal_cost',
        FILTER_VALIDATE_FLOAT);
    $tip = filter_input(INPUT_POST, 'tip',
        FILTER_VALIDATE_FLOAT);
    $tax = filter_input(INPUT_POST, 'tax',
        FILTER_VALIDATE_FLOAT);

    $meal_error = "";

    //sense if form has been submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		//if any of filters returned fals (invalid input)
		if (!$meal_cost || !$tip || !$tax){
			$meal_error = "Is that even a number? Invalid input, please try again.";
		} else if ($meal_cost < 0 || $tip < 0 || $tax < 0){
			$meal_error = "Input must be non-negative.";
		} else { //input is correct
			//clear any leftover error msgs
			$meal_error = "";

			$total = $meal_cost + $tip + $tax;

			if ($total < 20) {
				$price_quality = "Good price!";
			} else if ($total < 40) {
				$price_quality = "Reasonably priced";
			} else { //price is over $40
				$price_quality = "This is pricey";
			}

			$total_formatted = '$'.number_format($total, 2);
		}
	}


?>
<!doctype html>
<html>
<head>
	<title>ITC240 HW6</title>
	<style type="text/css">
		html {
			background-color: gainsboro;
		}
		body {
			font-family: calibri;
			width: 75%;
			margin: 0 auto;
			background-color: white;
			padding: 2em;
		}

	</style>
</head>
<body>
	<h1>ITC240: HW6</h1>
	<form method="post">
		<h2>Total Meal Cost</h2>
		<label>Meal Cost: <input type="text" name="meal_cost"/></label><br/>
		<label>Tip: <input type="text" name="tip"/> </label><br/>
		<label>Tax: <input type="text" name="tax"></label><br/>
		<label>Total: <span><?php echo $total_formatted ?></span></label><br/>
		<label>Price Quality: <span><?php echo $price_quality ?></span></label><br/>
		<span><?php echo $meal_error ?></span><br/>
		<input type="submit" value="submit"/>

	</form>

	<div>
		<h2>Random Number Practice:</h2>
		<p>
		<?php
			$randNum = rand(5,7);
			for ($i = 0; $i < 10; $i++){
				echo $i;
				if ($i == $randNum){
					echo " is your random number.";
				} 
				echo "<br/>";
			}
		 ?>
		</p>
	</div>

</body>

</html>
