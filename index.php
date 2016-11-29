<head>
	<title>Chris Coraggio's Tip Calculator</title>

	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div id="content">
		<div id="container">
			<h2>Tip Calculator</h2>
			<form method="post" action="index.php">
				Bill subtotal: $
				<input id="subtotal" name="subtotal" type="text" value="<?php echo isset($_POST["subtotal"]) ? $_POST["subtotal"] : '' ?>">
				<br>
				Tip percentage:
				<br>
<?php

for ($percent = 10; $percent < 25; $percent += 5) {

	$checked = '';
	if ((isset($_POST["percentage"]) && $_POST["percentage"] == $percent / 100)) {
		$checked = ' checked="checked"';
	}

	echo "<input id=\"{$percent}_percent\" type=\"radio\" name=\"percentage\" value=\".{$percent}\"" .
		"$checked" . ">{$percent}%";
}
?>
				<br>
				<input id="submit_button" type="submit">
			</form>
			<div id="results">
				<?php
if ("POST" === $_SERVER["REQUEST_METHOD"]) {
	if ($_POST["subtotal"] <= 0 || !is_numeric($_POST["subtotal"])) {
		echo "<div class=\"results\"> <br> Invalid subtotal";
	} else if (!isset($_POST["percentage"])) {
		echo "<div class=\"results\"> <br> Please select a tip percentage";
	} else {
		$total = (1 + (double) $_POST["percentage"]) * $_POST["subtotal"];
		$tip = ($total - $_POST["subtotal"]);
		echo "<div class=\"results\"> <br>Tip: $" . sprintf("%0.2f", $tip) . "<br>Total: $" . sprintf("%0.2f", $total);
	}
}
?>
			</div>
		</div>
	</div>
</body>