<?php
echo "<header>";
echo "<link rel='stylesheet' href='css/style.css'>";
echo "<title>" . $_name['page_title'] . "</title>";
echo "</header>";
echo "<div style=\"margin: 1% 5%; \">";
$dashboard = $_GET['dashboard'];
$table = $_GET['table'];
$player = $_GET['player'];
$search = $_GET['search'];
echo "<h1>" . $_name['web_title'] . "</h1>";
echo "<div class='ui grid'>";
echo "<div class='thirteen wide column'>";
echo "<div class=\"ui menu\">";

if (isset($dashboard)) {
	echo "<a href=\"?dashboard\" class=\"active item\">";
}
else {
	echo "<a href=\"?dashboard\" class=\"item\">";
}

echo "<img src='img/dashboard.png' style='float: left; margin-right: 3px;'>" . $_name['dashboard'] . "";
echo "</a>";

if (isset($table)) {
	echo "<a href=\"?table\" class=\"item active\">";
}
else {
	echo "<a href=\"?table\" class=\"item\">";
}

echo "<img src='img/playerlist.png' style='float: left; margin-right: 3px;'>" . $_name['playerlist'] . "";
echo "</a>";
echo "</div>";
echo "</div>";
echo "<div class='two wide column'>";
echo "<div class=\"suchfunktion\">";
echo "<form action=\"\" method=\"GET\">";
echo "<input type=\"text\" name=\"search\" placeholder=\"" . $_name['search'] . "\" > ";
echo "</form>";
echo "</div>";
echo "</div>";
echo "</div>";