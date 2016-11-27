<head>
	<title>Chris Coraggio's Tip Calculator</title>

	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div id="content">
		<div id="container">
			<h2>Tip Calculator</h2>
			<form method="post" action="form.php">
				Bill subtotal: $
				<input id="subtotal" type="text">
				<br>
				Tip percentage:
				<br>
<?php
for ($percent = 10; $percent < 25; $percent += 5) {
	echo "<input id=\"{$percent}_percent\" type=\"radio\" name=\"percentage\" value=\"{$percent}%\">{$percent}%";
}
?>
				<br>
				<input id="submit_button" type="submit">
			</form>
		</div>
	</div>
</body>