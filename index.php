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
				<hr>
				Tip percentage:
				<hr>
<?php

$custom_checked = ' checked="checked"';

for ($percent = 10; $percent < 25; $percent += 5) {

	$checked = '';
	if ((isValid($_POST["percentage"]) && $_POST["percentage"] == $percent / 100)) {
		$checked = ' checked="checked"';
		$custom_checked = "";
	}

	echo "<input id=\"{$percent}_percent\" type=\"radio\" name=\"percentage\" value=\".{$percent}\"" .
		"$checked" . ">{$percent}%";
}
?>
				<hr>
				<input id="custom_percent" type="radio"
				name="percentage" value="custom" <?php if (isValid($_POST["percentage"])) {
	echo $custom_checked;
}
?>>Custom: <input id="custom" type="text" name="custom_percent" value="<?php echo isValid($_POST["custom_percent"]) ? $_POST["custom_percent"] : '' ?>"> %
				<hr>
				Split: <input id="split" type="text" name="split_num" value="<?php echo isValid($_POST["split_num"]) ? $_POST["split_num"] : "1" ?>"> person(s)
				<hr>
				<input id="submit_button" type="submit">
			</form>
			<div id="results">
				<?php
if ("POST" === $_SERVER["REQUEST_METHOD"]) {
	if (!isValid($_POST["subtotal"], true, 0.01)) {
		display("Invalid subtotal");
	} else if (!isValid($_POST["percentage"])) {
		display("Please select a tip percentage");
	} else {
		$valid_custom_percentage = true;
		if ($_POST["percentage"] == "custom") {
			if (!isValid($_POST["custom_percent"], true)) {
				display("Invalid custom percentage");
				$valid_custom_percentage = false;
			} else {
				$_POST["percentage"] = $_POST["custom_percent"] / 100;
			}
		}

		if ($valid_custom_percentage) {

			$total = (1 + (double) $_POST["percentage"]) * $_POST["subtotal"];
			$tip = ($total - $_POST["subtotal"]);

			if (isValid($_POST["split_num"], true, 1.01) && $_POST["split_num"] % 1 == 0) {
				display("Tip: " . sprintf("$%0.2f", $tip) . "<hr>Total: " . sprintf("$%0.2f", $total) . "<hr>Tip each: " . sprintf("$%0.2f", ($tip / $_POST["split_num"])) . "<hr>Total each: " . sprintf("$%0.2f", ($total / $_POST["split_num"])));
			} else if (isValid($_POST["split_num"], true, 0.99) && $_POST["split_num"] % 1 == 0) {
				display("Tip: " . sprintf("$%0.2f", $tip) . "<hr>Total: " . sprintf("$%0.2f", $total));
			} else {
				display("Please enter a valid number of people");
			}
		}
	}
}

function display($message) {
	echo "<div class=\"results\"> <hr> $message";
}

function isValid(&$param, $numeric = false, $min = 0) {
	if ($numeric) {
		return (isset($param) && is_numeric($param) && $param >= $min);
	} else {
		return isset($param);
	}
}
?>
			</div>
		</div>
	</div>
</body>