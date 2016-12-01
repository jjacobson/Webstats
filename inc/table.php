<?php

switch ($_GET['order']) {
    case 'swords':
        $order = 'mcmmo_skills.swords';
        break;
    case 'taming':
        $order = 'mcmmo_skills.taming';
        break;
    case 'repair':
        $order = 'mcmmo_skills.repair';
        break;
    case 'archery':
        $order = 'mcmmo_skills.archery';
        break;
    case 'axes':
        $order = 'mcmmo_skills.axes';
        break;
    case 'acrobatics':
        $order = 'mcmmo_skills.acrobatics';
        break;
    case 'unarmed':
        $order = 'mcmmo_skills.unarmed';
        break;
    case 'survived':
        $order = 'Stats3_waves_survived.value';
        break;
    case 'kills':
        $order = 'Stats3_monsters_killed.value';
        break;
    case 'won':
        $order = 'Stats3_games_won.value';
        break;
    case 'played':
        $order = 'Stats3_games_played.value';
        break;
    case 'bosses':
        $order = 'Stats3_bosses_killed.value';
        break;
    default:
        $order = 'mcmmo_skills.swords';
}
$query = mysqli_query($con, "SELECT
    mcmmo_users.user,
    mcmmo_skills.swords,
    mcmmo_skills.taming,
    mcmmo_skills.repair,
    mcmmo_skills.archery,
    mcmmo_skills.axes,
    mcmmo_skills.acrobatics,
    mcmmo_skills.unarmed,
    Stats3_waves_survived.value AS survived,
    Stats3_monsters_killed.value AS killed,
    Stats3_games_won.value AS won,
    Stats3_games_played.value AS played,
    Stats3_bosses_killed.value AS bosses
FROM
    mcmmo_users
        INNER JOIN
    mcmmo_skills ON mcmmo_users.id = mcmmo_skills.user_id
        LEFT JOIN
    Stats3_players ON Stats3_players.uuid = mcmmo_users.uuid
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
ORDER BY $order DESC LIMIT $show_result");
$page_nums = mysqli_num_rows($query);

if ($page_nums >= 1) {
	echo "<table class=\"ui celled striped table\">";
	echo "<tr>";
    echo "<td></td>";
	echo "<td><b>" . $_name['player'] . "</b></td>";
    echo "<td><a href='?table&order=swords'><b>" . $_name['swords'] . "</b></a></td>";
	echo "<td><a href='?table&order=taming'><b>" . $_name['taming'] . "</b></a></td>";
	echo "<td><a href='?table&order=repair'><b>" . $_name['repair'] . "</b></a></td>";
	echo "<td><a href='?table&order=archery'><b>" . $_name['archery'] . "</b></a></td>";
	echo "<td><a href='?table&order=axes'><b>" . $_name['axes'] . "</b></a></td>";
	echo "<td><a href='?table&order=acrobatics'><b>" . $_name['acrobatics'] . "</b></a></td>";
	echo "<td><a href='?table&order=unarmed'><b>" . $_name['unarmed'] . "</b></a></td>";
    echo "<td><a href='?table&order=survived'><b>" . $_name['survived'] . "</b></a></td>";
    echo "<td><a href='?table&order=kills'><b>" . $_name['kills'] . "</b></a></td>";
    echo "<td><a href='?table&order=won'><b>" . $_name['won'] . "</b></a></td>";
    echo "<td><a href='?table&order=played'><b>" . $_name['played'] . "</b></a></td>";
    echo "<td><a href='?table&order=bosses'><b>" . $_name['bosses'] . "</b></a></td>";
	echo "</tr>";
	while ($obj = mysqli_fetch_object($query)) {
        $waves_survived = (is_null($obj->survived)) ? '0' : $obj->survived;
        $monsters_killed = (is_null($obj->killed)) ? '0' :  $obj->killed;
        $games_won = (is_null($obj->won)) ? '0' :  $obj->won;
        $games_played = (is_null($obj->played)) ? '0' :  $obj->played;
        $bosses_killed = (is_null($obj->bosses)) ? '0' :  $obj->bosses;
		echo "<tr>";
		echo "";
        echo "<td><center><img src='http://crafatar.com/avatars/". $obj->user ."?helm&size=22' width='25' height='25' ></center></td>";
		echo "<td><a href='?player=" . $obj->user . "'>" . $obj->user . "</a> </td>";
		echo "<td>" . $obj->swords . " </td>";
		echo "<td>" . $obj->taming . " </td>";
		echo "<td>" . $obj->repair . " </td>";
		echo "<td>" . $obj->archery . " </td>";
		echo "<td>" . $obj->axes . " </td>";
		echo "<td>" . $obj->acrobatics . " </td>";
		echo "<td>" . $obj->unarmed . " </td>";
        echo "<td>" . $waves_survived . " </td>";
        echo "<td>" . $monsters_killed . " </td>";
        echo "<td>" . $games_won . " </td>";
        echo "<td>" . $games_played . " </td>";
        echo "<td>" . $bosses_killed . " </td>";
		echo "</tr>";
	}
}

echo "</table>";
?>