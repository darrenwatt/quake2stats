<?php
$weaponname = str_replace('-',' ',str_replace('.html','',$pathparams[1]));  
?>
<?php 
//list all weapons
$allweapons = _dbquery("SELECT DISTINCT weapon FROM log WHERE target != 'self';",MYSQL_ASSOC);
if ($pathparams[1] != 'index.html') {
?>
<img style="float:right" src="<?php echo PATH.'images/gunicons/'.str_replace(' ','-',$weaponname)?>.png"> 
<?php } ?>
<h3><?php _page_name($pathparams) ?></h3> 
<ul class=submenu>
<?php foreach ($allweapons as $allweapon) { ?>
    <li><?php _html_link('Weapons',$allweapon['weapon']) ?></li>
<?php } ?>
</ul>
  



<?php if ($pathparams[1] == 'index.html') { ?>
<?php
$playersrankedbyweapon = _dbquery("SELECT who, action, weapon, COUNT(*) FROM log WHERE action = 'kill' GROUP BY weapon,who  ORDER BY COUNT(*) DESC LIMIT 50",MYSQL_ASSOC);
?>
    <h2><a name="Players-Ranked-by-Weapon">Players Ranked by Weapon Top 50</a></h2>
    <table class="main-stats">
     <thead><tr><th >Rank</th><th>Player name</th><th>Weapon</th><th>No. of Kills</th></tr></thead>     
    <?php $rank=1; foreach ($playersrankedbyweapon as $stats) { ?>
        <tr>
            <td class=rank><?php echo _ordinalize($rank);$rank++; ?></td>
            <td class=name><?php _html_link('Player',$stats['who']);?></td>
            <td class=weapon><?php _html_link('Weapons',$stats['weapon']); ?></td>
            <td class=kills><?php echo $stats['COUNT(*)']; ?></td>
        </tr>
    <?php } ?>
    </table>
<?php } else { ?>    

<?php $weaponstat = _dbquery ("SELECT who,action, COUNT(*) FROM log WHERE weapon = '".$weaponname."' AND action = 'kill' GROUP BY who ORDER By COUNT(*) DESC",MYSQL_ASSOC); ?>
    <?php if (count($weaponstat) > 0) {   ?>
    <table class="main-stats sortable">
        <thead><tr><th class=rank>Rank</th><th>Player Name</th><th>Kills with <?php echo $weaponname; ?></th></tr></thead>
        <?php $i=1; foreach($weaponstat as $stat) { ?>
        <tr class=name>
            <td class=rank><?php echo _ordinalize($i); $i++ ?></td>
            <td class=name><?php _html_link('Player',$stat['who']) ?></td>
            <td class=kills><?php echo $stat['COUNT(*)'] ?></td>
        </tr>
        <?php } ?>
    </table>
    <?php } else {  ?>
    <h5>No ones has killed any one with the <?php echo $weaponname ?> yet free bonus points to be had</h5>
    <?php } ?>


<?php } ?>
<small>note: To gain an award currently the minimum number of kills with each weapon is 5</small>