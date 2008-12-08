<?php
$playersrankedbyweapon = _dbquery("SELECT who, action, weapon, COUNT(*) FROM log WHERE action = 'kill' GROUP BY weapon,who  ORDER BY COUNT(*) DESC LIMIT 50",MYSQL_ASSOC);
?>
<div > 
    <h2><a name="Players-Ranked-by-Weapon">Players Ranked by Weapon Top 50</a></h2>
    <table class="main-stats">
        <tr>
              <th class=rank>Rank</th>
              <th>Player name</th>
              <th>Weapon</th>
              <th >No. of Kills</th>
        </tr>      
    <?php $rank=1; foreach ($playersrankedbyweapon as $stats) { ?>
        <tr>
            <td class=rank><?php echo $rank;$rank++; ?></td>
            <td class=name><?php _html_link('Player',$stats['who']);?></td>
            <td class=weapon><?php _html_link('Weapon',$stats['weapon']); ?></td>
            <td class=kills><?php echo $stats['COUNT(*)']; ?></td>
        </tr>
    <?php } ?>
    </table>
</div>