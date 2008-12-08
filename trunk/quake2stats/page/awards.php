<h3><?php _page_name($pathparams) ?></h3>
<?php
//list all awards
$allawards = _dbquery("SELECT DISTINCT stat FROM stats",MYSQL_ASSOC);
?>
<ul>
<?php foreach ($allawards as $allaward) { ?>
    <li><?php _html_link('Awards',$allaward['stat']) ?></li>
<?php } ?>
</ul>

<?php if ($pathparams[1] == 'index.html') { ?>    
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
<?php } else { // specific awards
$award = str_replace('.html','',str_replace('-',' ',$pathparams[1]));
$awards = _dbquery("SELECT * FROM stats where stat = '".$award."' AND points !=0 ORDER by rank",MYSQL_ASSOC);
?>
    <table class="sortable main-stats">
    <thead><tr><th>Player Name</th><th>Medal</th><th>Bonus</th></tr></thead>
    <?php foreach ($awards as $award) { ?>
    <tr>
        <td><?php _html_link('Player',$award['playername']) ?></td>
        <td><?php echo _ordinalize($award['rank']) ?></td>
        <td><?php echo $award['points'] ?></td>
    </tr>
    <?php } ?>  
    </table>
<?php } ?>