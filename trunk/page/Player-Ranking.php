<?php 
$playerranking = _dbquery ("SELECT who, action, COUNT(*) FROM log WHERE action = 'kill' GROUP BY who  ORDER BY COUNT(*) DESC",MYSQL_ASSOC);
?>
<div >
    <h2><a name="Player-Ranking">Player Ranking</a></h2>
    <table class="main-stats">
    <tr>
          <th class=rank>Rank</th>
          <th>Player name</th>
          <th>No. of Kills</th>
          <th>No. of Deaths</th>
          <th> K:D</th>  
    </tr>      
    <?php $rank=1; foreach ($playerranking as $stats) { ?>
        <tr>
            <td class=rank><?php echo $rank;$rank++; ?></td>
            <td class=name><?php _html_link('Player',$stats['who']);?></td>
            <td class=kills><?php echo $stats['COUNT(*)']; ?></td>
    <?php $playerdeaths = _dbquery ("SELECT target, action, COUNT(*) FROM log WHERE action = 'kill' and target = '".$stats['who']."' GROUP BY target,who  ORDER BY COUNT(*) DESC",MYSQL_ASSOC); ?>               
            <td class=deaths><?php echo $playerdeaths[0]['COUNT(*)']; ?>
            <td class=kd><?php echo round($stats['COUNT(*)']/$playerdeaths[0]['COUNT(*)'],1)?></td>
        </tr>
    <?php } ?>
    </table>
</div>