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
    <table class="sortable main-stats">
    <thead>
    <tr>
          <th class=rank></th>
          <th>Player name</th>
          <th>Score</th>
          <th>No. of Kills</th>
          <th>No. of Deaths</th>
          <th> K:D</th>  
    </tr>
    </thead>      
    <?php foreach ($output as $stats) { ?>
        <tr>
            <td class=rank></td> 
            <td class=name style="text-align:left;"><?php _html_link('Player',$stats['name']);?></td>
            <td class=kills><?php echo $stats['total score']; ?></td>
            <td class=kills><?php echo $stats['total kills']; ?></td>
            <td class=deaths><?php echo $stats['total deaths']; ?></td>
            <td class=kd><?php echo $stats['k2d']/10; ?></td>
        </tr>
    <?php } ?>
    </table>
</div>