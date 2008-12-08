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
    <h3>Home</h3>
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
    <?php $i=1;foreach ($output as $stats) { ?>
        <tr>
            <td class=rank><?php echo _ordinalize($i);$i++ ?></td> 
            <td class=name style="text-align:left;"><?php _html_link('Player',$stats['name']);?></td>
            <td class=kills><?php echo $stats['total score']; ?></td>
            <td class=kills><?php echo $stats['total kills']; ?></td>
            <td class=deaths><?php echo $stats['total deaths']; ?></td>
            <td class=kd><?php echo $stats['kill:death ratio']/10; ?></td>
        </tr>
    <?php } ?>
    </table>
</div>