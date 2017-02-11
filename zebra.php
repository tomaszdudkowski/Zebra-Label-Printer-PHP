<!DOCTYPE html>
<html>
<head>
<style>
p {
	color: red;
}
</style>
</head>
<body>

<?php

if(isset($_POST["ip"]) && isset($_POST["port"])) {
	$ip = $_POST["ip"];
	$port = $_POST["port"];
	
	if(isset($_POST["textbox"])) {
		$daneDoDruku = $_POST["textbox"];
		if(empty($_POST["textbox"])) {
			echo "<p>Brak danych do druku...</p>";
		} else {
			try {
				$poloczenie = pfsockopen("$ip", $port);
				fputs($poloczenie, $daneDoDruku);
				fclose($poloczenie);
		
				echo "<p>Wydrukowalem</p>";
			} catch (Exception $e) {
				echo "Blad: ", $e->getMessage(), "\n";
			}
		}
	}
} else {
	echo "<p>Drukarka podlaczona.</p>";
}
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<h1>ZPL Print.</h1>
IP:<input type="text" name="ip" value="192.168.1.120"><br><br>
PORT:<input type="text" name="port" value="9100"><br><br>
CODE:<br>
<textarea rows="20" cols="150" name="textbox">
^XA
^FO50,50^ADN,36,20^FDHello World^FS
^XZ</textarea>
<input type="submit">
</form>
</body>
</html>