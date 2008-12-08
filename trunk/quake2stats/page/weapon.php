<?php
$weaponname = str_replace('-',' ',str_replace('.html','',$pathparams[1]));  
?>
<?php 
//list all weapons
$allweapons = _dbquery("SELECT DISTINCT weapon FROM log WHERE target != 'self';",MYSQL_ASSOC);
?>
<ul class=submenu>
<?php foreach ($allweapons as $allweapon) { ?>
    <li><?php _html_link('Weapons',$allweapon['weapon']) ?></li>
<?php } ?>
</ul>
<img style="float:right" src="<?php echo PATH.'images/gunicons/'.str_replace(' ','-',$weaponname)?>.png">   

<h3><?php _page_name($pathparams) ?></h3>



<?php $weaponstat = _dbquery ("SELECT who,action, COUNT(*) FROM log WHERE weapon = '".$weaponname."' AND action = 'kill' GROUP BY who ORDER By COUNT(*) DESC",MYSQL_ASSOC); ?>
    <?php if (count($weaponstat) > 0) {   ?>
    <table class=main-stats>
        <tr>
            <th>Player Name</th>
            <th>Kills with <?php echo $weaponname; ?></th>
        </tr>
        <?php  foreach($weaponstat as $stat) { ?>
        <tr class=name>
            <td><?php _html_link('Player',$stat['who']) ?></td>
            <td><?php echo $stat['COUNT(*)'] ?></td>
        </tr>
        <?php } ?>
    </table>
    <?php } else {  ?>
    <h5>No ones has killed any one with the <?php echo $weaponname ?> yet free bonus points to be had</h5>
    <?php } ?>
