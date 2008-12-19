<?php 
$playername = str_replace('%7B','{',str_replace('%7D','}',str_replace('-',' ',str_replace('.html','',$pathparams[1]))));  
_html_player_link($playername,'<h3>','</h3>',true,true,'40');               
?>
<table class=main-stats>
    <thead>
    <tr>
        <th><a href='#' title="Score = Kills - Suicides + Bonus">Score</a></th>
        <th>Kills</th>
        <th>Deaths</th>
        <th>Suicides</th>
        <th>K:D</th>
        <th>Kill streak</th>
        <th>Death streak</th>
    </tr>
    </thead>
    <tr>
        <td class=kills><?php if (isset($player_stats[$playername]['total score']['figure'])) { echo $player_stats[$playername]['total score']['figure']; } else {?>0<?php } ?></td>
        <td class=kills><?php if (isset($player_stats[$playername]['total kills']['figure'])) { echo $player_stats[$playername]['total kills']['figure']; } else {?>0<?php } ?></td>
        <td class=kills><?php if (isset($player_stats[$playername]['total deaths']['figure'])) { echo $player_stats[$playername]['total deaths']['figure']; } else {?>0<?php } ?></td> 
        <td class=kills><?php if (isset($player_stats[$playername]['total suicides']['figure'])) { echo $player_stats[$playername]['total suicides']['figure']; } else {?>0<?php } ?></td> 
        <td class=kills><?php if (isset($player_stats[$playername]['kill:death ratio']['figure'])) { echo $player_stats[$playername]['kill:death ratio']['figure']/10 ; } else {?>0<?php } ?></td>
        <td class=kills><?php if (isset($player_stats[$playername]['Killstreak']['figure'])) { echo $player_stats[$playername]['Killstreak']['figure']; } else {?>0<?php } ?></td>  
        <td class=kills><?php if (isset($player_stats[$playername]['Deathstreak']['figure'])) { echo $player_stats[$playername]['Deathstreak']['figure']; } else {?>0<?php } ?></td>  
    </tr>
</table>
<?php if (isset($player_stats[$playername]['awards'])) {   ?>
        <table class="sortable main-stats">
        <thead><tr><th>Medal</th><th>Awards</th><th>Bonus</th></tr></thead>
            <?php foreach ( $player_stats[$playername]['awards'] as $award ) { ?>
            
            <tr>
               <td class=rank><?php if ($award['points']< 0) { echo _ordinalizebad($award['rank']); } else { echo _ordinalize($award['rank']);} ?></td> 
               <td class=name><?php _html_link('Awards',$award['name']) ?></td>
               <td class=kills><?php _outputstat($award['points']) ?></td> 
            </tr>
            <?php } ?>
        </table>
<?php } ?>
<?php if (isset($player_stats[$playername]['action'])) { ?>     
<table class="sortable main-stats">
    <thead>
    <tr><th>Player name</th><th>Killed</th><th>Killed By</th></tr>
    </thead>
    <?php foreach ( $player_stats[$playername]['action'] as $otherplayer ) { ?>
    <tr>
        <td class=name><?php _html_player_link($otherplayer['name'],'','',true,true); ?></td>
        <?php if (!isset($otherplayer['killed'])) { $otherplayer['killed'] = 0; } ?> 
        <td class=kills><?php _outputstat($otherplayer['killed']);?></td>
        <?php if (!isset($otherplayer['killedby'])) { $otherplayer['killedby'] = 0; } ?>  
        <td class=kills><?php _outputstat($otherplayer['killedby']);?></td> 
    </tr>
    <?php } ?>
</table>
<?php } ?>
<?php if($player_stats[$playername]['map']) { ?>
<table class="sortable main-stats">

    <thead><tr><th>Map name</th><th>Kills</th><th>Deaths</th><th>Suicides</th></tr></thead>
    <?php foreach ( $player_stats[$playername]['map'] as $maps ) { ?>
    <tr>
        <td class=name><?php _html_link('Map',$maps['name']) ?></td>
        <?php if (!isset($maps['kills'])) { $maps['kills'] = 0; } ?> 
        <td class=kills><?php _outputstat($maps['kills']) ?></td> 
        <?php if (!isset($maps['deaths'])) { $maps['deaths'] = 0; } ?> 
        <td class=kills><?php _outputstat($maps['deaths']) ?></td>
        <?php if (!isset($maps['suicides'])) { $maps['suicides'] = 0; } ?> 
        <td class=kills><?php _outputstat($maps['suicides']) ?></td> 
    </tr>
    <?php } ?>
</table>
<?php } ?>