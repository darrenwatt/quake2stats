<h3><?php _page_name($pathparams) ?></h3>   
<?php
 $allawards = _dbquery("SELECT * FROM stats WHERE rank < 3 AND rank > 0 AND points != 0 ORDER by rank,points DESC;",MYSQL_ASSOC); 
?>
<table class="sortable main-stats">
<thead><tr><th>Player Name</th><th>Award</th><th>Medal</th><th>Bonus</th></tr></thead>
 <?php foreach (  $allawards as $award ) {?>
    <tr>
        <td><?php _html_link('Player',$award['playername']) ?></td> 
       <td><?php _html_link('Awards',$award['stat']) ?></td>
       <td><?php echo _ordinalize($award['rank']) ?></td> 
       <td><?php _outputstat($award['points']) ?></td> 
    </tr> 
 <?php } ?>
 </table>   