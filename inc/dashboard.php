<?php
echo "<div class=\"ui cards\">";
$i = 0;

while ($i <= 12) {
    switch ($i) {
        case 0:
            $name = $_name['survived'];
            $category = "survived";
            break;

        case 1:
            $name = $_name['kills'];
            $category = "kills";
            break;

        case 2:
            $name = $_name['won'];
            $category = "won";
            break;

        case 3:
            $name = $_name['played'];
            $category = "played";
            break;

        case 4:
            $name = $_name['bosses'];
            $category = "bosses";
            break;

        case 5:
            $name = $_name['power'];
            $category = "power_total";
            break;

        case 6:
            $name = $_name['taming'];
            $category = "taming";
            break;

        case 7:
            $name = $_name['repair'];
            $category = "repair";
            break;

        case 8:
            $name = $_name['unarmed'];
            $category = "unarmed";
            break;

        case 9:
            $name = $_name['archery'];
            $category = "archery";
            break;

        case 10:
            $name = $_name['swords'];
            $category = "swords";
            break;

        case 11:
            $name = $_name['axes'];
            $category = "axes";
            break;

        case 12:
            $name = $_name['acrobatics'];
            $category = "acrobatics";
            break;
    }

    $query = mysqli_query($con, "SELECT
    mcmmo_users.user,
    mcmmo_skills.taming,
    mcmmo_skills.repair,
    mcmmo_skills.unarmed,
    mcmmo_skills.archery,
    mcmmo_skills.swords,
    mcmmo_skills.axes,
    mcmmo_skills.acrobatics,
    (mcmmo_skills.taming + mcmmo_skills.repair + mcmmo_skills.unarmed + mcmmo_skills.archery + mcmmo_skills.swords + mcmmo_skills.axes + mcmmo_skills.acrobatics) AS power_total,
    Stats3_waves_survived.value AS survived,
    Stats3_monsters_killed.value AS kills,
    Stats3_games_won.value AS won,
    Stats3_games_played.value AS played,
    Stats3_bosses_killed.value AS bosses
FROM
    mcmmo_users
        LEFT JOIN
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
ORDER BY $category DESC
LIMIT 5");

    $stats_query = mysqli_query($stat_con);

    $num_url = mysqli_num_rows($query);
    echo "  <div class=\"card\">";
    echo "    <div class=\"content\">";
    echo "      <div class=\"header\">Top 5: $name</div>";
    echo "      <div class=\"description\">";
    echo "<table class='ui table'>";
    echo "  <thead>";
    echo "    <tr>";
    echo "      <th>" . $_name['name'] . "</th>";
    echo "      <th>" . $_name['level'] . "</th>";
    echo "    </tr>";
    echo "  </thead>";
    echo "  <tbody>";
    echo "    <tr>";
    while ($obj = mysqli_fetch_object($query)) {
        $user = $obj->user;
        switch ($i) {
            case 0:
                $level = $obj->survived;
                $name = $name['survived'];
                break;

            case 1:
                $level = $obj->kills;
                $name = $name['kills'];
                break;

            case 2:
                $level = $obj->won;
                $name = $name['won'];
                break;

            case 3:
                $level = $obj->played;
                $name = $name['played'];
                break;

            case 4:
                $level = $obj->bosses;
                $name = $name['bosses'];
                break;

            case 5:
                $level = $obj->power_total;
                $name = $name['power'];
                break;

            case 6:
                $level = $obj->taming;
                $name = $name['taming'];
                break;

            case 7:
                $level = $obj->repair;
                $name = $name['repair'];
                break;

            case 8:
                $level = $obj->unarmed;
                $name = $name['unarmed'];
                break;

            case 9:
                $level = $obj->archery;
                $name = $name['archery'];
                break;

            case 10:
                $level = $obj->swords;
                $name = $name['swords'];
                break;

            case 11:
                $level = $obj->axes;
                $name = $name['axes'];
                break;

            case 12:
                $level = $obj->acrobatics;
                $name = $name['acrobatics'];
                break;

        }

        $data = (is_null($level)) ? '0' : $level;

        echo "      <td><img src='http://crafatar.com/avatars/" . $user . "?helm&size=22'> <a href='?player=" . $user . "'>" . $user . "</a> </td>";
        echo "      <td>$data</td>";
        echo "    </tr>";
    }

    echo "  </tbody>";
    echo "</table>";
    echo "      </div>";
    echo "    </div>";
    echo "    <div class=\"extra content\">";
    echo "    </div>";
    echo "  </div>";
    $i++;
}