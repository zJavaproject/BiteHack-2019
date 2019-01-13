<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>DayTripper</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script src="main.js"></script>
</head>
<body>
    <div class="cookies"></div>
    <div id="content">
        <header>
            
        </header>

        <div id="search-box">
            <div id="search">
                <form action="search.php" method="get">
                    Miasto: <input type="text" name="miasto">
                    Rodzaj planu: <select name="rodzaj">
                        <option value="fun">rozrywkowy</option>
                        <option value="nature">blisko natury</option>
                        <option value="art">art</option>
						<option value="night">nocne życie</option>
                        <option value="beauty">SPA tour</option>
						<option value="shopaholic">zakupoholik</option>
						<option value="religion">strefa sacrum</option>
						<option value="monuments">historyczny</option>
                    </select>							
                    Rodzaj posiłku: <select name="rodzajposilku">
                        <option value="brak">brak posiłku</option>
                        <option value="standardowy">standardowy</option>
                        <option value="wegetarianski">wegetariański</option>
                        <option value="weganski">wegański</option>
                        <option value="dietetyczny">dietetyczny</option>
                    </select><br/>
					Transport: <select name="transport">
						<option value="pieszo">pieszo</option>
						<option value="samochod">samochód</option>
						<option value="rower">rower</option>
					</select>
                    Początek: <input type="time" name="start" value="<?php $current_time=date('H:i');
						echo date('H:i'); ?>" />
                    Koniec: <input type="time" name="end" value="<?php echo date('H:i', strtotime($current_time. ' + 7 hour')); ?>" />
                    <input type="submit" value="Wyszukaj">
                </form>
            </div>
        </div>
    </div>
    <div id="footer-box">
                <p>Copyright 2019 by zJava-Project</p>
                <p>Background photo by <a href="https://unsplash.com/@rawpixel">rawpixel</a> on <a href="https://unsplash.com/">Unsplash</a></p>
            </div>
</body>
</html>