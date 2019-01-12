<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>TITLE</title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml;
	charset=UTF-8" />
</head>
<body>

	<form action="get_data.php" method="get">
		Miasto: <input type="text" name="miasto">
		Rodzaj: <select name="rodzaj">
			<option value="nowoczesna">nowoczesna</option>
			<option value="klasyczna">klasyczna</option>
			<option value="historyczna">historyczna</option>
			<option value="koscioly">kościoły</option>
		</select>
		Rodzaj posiłku: <select name="rodzajposilku">
			<option value="brak">Brak posiłku</option>
			<option value="standardowy">standardowy</option>
			<option value="wegetarianski">wegetariański</option>
			<option value="weganski">wegański</option>
			<option value="dietetyczny">dietetyczny</option>
		</select>
		Początek: <input type="time" name="start" value="<?php echo date('H:i'); ?>" />
		Koniec: <input type="time" name="end" value="<?php echo date('H:i'); ?>" />
		<input type="submit" value="Wyszukaj">
	</form>

</body>
</html>


