<?php

if(isset($search)) {

    $search = mysqli_escape_string($con, $_GET['search']);
    $search_query = mysqli_query($con, "SELECT * FROM `mcmmo_users` WHERE `user` like '%$search%'");
    $search_nums = mysqli_num_rows($search_query);

    if ($search_nums < 1) {
        echo $_name['player_not_found'];
    }

    if ($search_nums > 1) {
        echo $_name['more_results'] . "<br /><br />";
        while ($obj = mysqli_fetch_object($search_query)) {
            echo "<a href='?player=" . $obj->user . "'> " . $obj->user . " </a><br />";
        }
    }
}

if ($search_nums == 1 OR isset($player)) {
	while ($obj = mysqli_fetch_object($search_query)) {
		$player = $obj->user;
	}

	$query = mysqli_query($con, "SELECT mcmmo_users.user, mcmmo_skills.taming, mcmmo_skills.mining, mcmmo_skills.woodcutting, mcmmo_skills.repair, mcmmo_skills.unarmed, mcmmo_skills.alchemy, mcmmo_skills.herbalism, mcmmo_skills.excavation, mcmmo_skills.archery, mcmmo_skills.swords, mcmmo_skills.axes, mcmmo_skills.acrobatics, mcmmo_skills.fishing FROM mcmmo_users INNER JOIN mcmmo_skills ON mcmmo_users.id=mcmmo_skills.user_id WHERE mcmmo_users.user='$player' ");
	$num_url = mysqli_num_rows($query);
	while ($obj = mysqli_fetch_object($query)) {
		$taming = $obj->taming;
		$mining = $obj->mining;
		$woodcutting = $obj->woodcutting;
		$repair = $obj->repair;
		$unarmed = $obj->unarmed;
		$herbalism = $obj->herbalism;
		$excavation = $obj->excavation;
		$archery = $obj->archery;
		$swords = $obj->swords;
		$axes = $obj->axes;
		$acrobatics = $obj->acrobatics;
		$fishing = $obj->fishing;
		$alchemy = $obj->alchemy;
	}

	echo "<div class='ui grid'>";
	echo "<div class='two wide column'></div>";
	echo "<div class='four wide column'>";
	echo "<span><b>" . $_name['player'] . ": </b>" . $player . "</span>";
    echo "<br/><br/><br/>";
	echo "<img src='https://crafatar.com/renders/body/$player?scale=6'>";
	echo "</div>";
	echo "<div class='four wide column'>";
	echo "<h1>" . $_name['level'] . ":</h1>";
	echo "<table class=\"ui celled striped table\">";
	echo "<tr>";
	echo "  <td>" . $_name['taming'] . "</td>";
	echo "  <td>$taming</td>";
	echo "</tr>";
	echo "<tr>";
	echo "  <td>" . $_name['repair'] . "</td>";
	echo "  <td>$repair</td>";
	echo "</tr>";
	echo "<tr>";
	echo "  <td>" . $_name['unarmed'] . "</td>";
	echo "  <td>$unarmed</td>";
	echo "</tr>";
	echo "<tr>";
	echo "  <td>" . $_name['archery'] . "</td>";
	echo "  <td>$archery</td>";
	echo "</tr>";
	echo "<tr>";
	echo "  <td>" . $_name['swords'] . "</td>";
	echo "  <td>$swords</td>";
	echo "</tr>";
	echo "<tr>";
	echo "  <td>" . $_name['axes'] . "</td>";
	echo "  <td>$axes</td>";
	echo "</tr>";
	echo "<tr>";
	echo "  <td>" . $_name['acrobatics'] . "</td>";
	echo "  <td>$acrobatics</td>";
	echo "</tr>";
	echo "</table>";
	echo "</div>";

	$query = mysqli_query($con, "SELECT
    Stats3_waves_survived.value AS survived,
    Stats3_monsters_killed.value AS killed,
    Stats3_games_won.value AS won,
    Stats3_games_played.value AS played,
    Stats3_bosses_killed.value AS bosses
FROM
    Stats3_players
        LEFT JOIN
    Stats3_monsters_killed ON Stats3_monsters_killed.uuid = Stats3_players.uuid
        LEFT JOIN
    Stats3_games_won ON Stats3_games_won.uuid = Stats3_players.uuid
        LEFT JOIN
    Stats3_games_played ON Stats3_games_played.uuid = Stats3_players.uuid
        LEFT JOIN
    Stats3_bosses_killed ON Stats3_bosses_killed.uuid = Stats3_players.uuid
        LEFT JOIN
    Stats3_waves_survived ON Stats3_waves_survived.uuid = Stats3_players.uuid
WHERE
    Stats3_players.name = '$player'");
	$num_url = mysqli_num_rows($query);
	while ($obj = mysqli_fetch_object($query)) {
		$waves_survived = (is_null($obj->survived)) ? '0' : $obj->survived;
		$monsters_killed = (is_null($obj->killed)) ? '0' :  $obj->killed;
		$games_won = (is_null($obj->won)) ? '0' :  $obj->won;
		$games_played = (is_null($obj->played)) ? '0' :  $obj->played;
		$bosses_killed = (is_null($obj->bosses)) ? '0' :  $obj->bosses;
	}

	echo "<div class='four wide column'>";
	echo "<h1>" . $_name['mobarena'] . ":</h1>";
	echo "<table class=\"ui celled striped table\">";
	echo "<tr>";
	echo "  <td>" . $_name['kills'] . "</td>";
	echo "  <td>$monsters_killed</td>";
	echo "</tr>";
	echo "<tr>";
	echo "  <td>" . $_name['played'] . "</td>";
	echo "  <td>$games_played</td>";
	echo "</tr>";
	echo "<tr>";
	echo "  <td>" . $_name['survived'] . "</td>";
	echo "  <td>$waves_survived</td>";
	echo "</tr>";
	echo "<tr>";
	echo "  <td>" . $_name['won'] . "</td>";
	echo "  <td>$games_won</td>";
	echo "</tr>";
	echo "<tr>";
	echo "  <td>" . $_name['bosses'] . "</td>";
	echo "  <td>$bosses_killed</td>";
	echo "</tr>";
	echo "</table>";
	echo "</div>";
	echo "</div>";


}