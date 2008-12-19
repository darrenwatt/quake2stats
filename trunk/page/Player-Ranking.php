<?php 
$playerscore = _dbquery ("SELECT * FROM stats where stat = 'total score' ORDER by figure DESC",MYSQL_ASSOC);
foreach ($playerscore as $score)
    {
        $plyscrs = _dbquery ("SELECT * FROM stats WHERE playername = '".$score['playername']."' ",MYSQL_ASSOC);   
        
foreach ($plyscrs as $ranking)
    {
     $output[$score['playername']][$ranking['stat']]=  $ranking['figure'] ;
     $output[$score['playername']]['name'] =  $ranking['playername'];
    }
    
    
    }

?>

<div >
    <h2><a name="Player-Ranking">Player Ranking</a></h2>
    <table class="main-stats">
    <tr>
          <th class=rank></th>
          <th>Player name</th>
          <th>Score</th>
          <th>No. of Kills</th>
          <th>No. of Deaths</th>
          <th> K:D</th> 
    </tr>      
    <?php $i=1;foreach ($output as $stats) {
     $goodmedals = _dbquery ("SELECT rank,stat FROM stats WHERE playername = '".$stats['name']."' AND rank < 4 AND figure > 0 AND points > 0 and good = 1 order by rank",MYSQL_ASSOC);
     $badmedals = _dbquery ("SELECT rank,stat FROM stats WHERE playername = '".$stats['name']."' AND rank < 4 AND figure > 0 AND points != 0 and good = 0 order by rank",MYSQL_ASSOC); ?>
        <tr>
            <td class=rank><?php echo _ordinalize($i,'rank');$i++ ?></td> 
            <td class=name style="text-align:left;">
                <?php _html_player_link($stats['name'],'','',true,true); ?>
            </td>
            <td class=kills><?php echo $stats['total score']; ?></td>
            <td class=kills><?php echo $stats['total kills']; ?></td>
            <td class=deaths><?php echo $stats['total deaths']; ?></td>
            <td class=kd><?php echo $stats['kill:death ratio']/10; ?></td>
        </tr>
    <?php } ?>
    </table>
</div>