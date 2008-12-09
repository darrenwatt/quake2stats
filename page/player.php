<?php 
$playername = str_replace('%7B','{',str_replace('%7D','}',str_replace('-',' ',str_replace('.html','',$pathparams[1]))));  
?>
<h3><?php _gravatar($playername);echo $playername; ?></h3>

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
        <td class=kills><?php echo $player_stats[$playername]['total score']['figure'];?></td>
        <td class=kills><?php echo $player_stats[$playername]['total kills']['figure'];?></td>
        <td class=kills><?php echo $player_stats[$playername]['total deaths']['figure'];?></td> 
        <td class=kills><?php echo $player_stats[$playername]['total suicides']['figure'];?></td> 
        <td class=kills><?php echo $player_stats[$playername]['kill:death ratio']['figure']/10 ;?></td>
        <td class=kills><?php echo $player_stats[$playername]['Killstreak']['figure'];?></td>  
        <td class=kills><?php echo $player_stats[$playername]['Deathstreak']['figure'];?></td>  
    </tr>
</table>
<?php if ( $player_stats[$playername]['awards']) {   ?>
        <table class="sortable main-stats">
        <thead><tr><th>Medal</th><th>Awards</th><th>Bonus</th></tr></thead>
            <?php foreach ( $player_stats[$playername]['awards'] as $award ) { ?>
            <tr>
               <td class=rank><?php echo _ordinalize($award['rank']) ?></td> 
               <td class=name><?php _html_link('Awards',$award['name']) ?></td>
               <td class=kills><?php _outputstat($award['points']) ?></td> 
            </tr>
            <?php } ?>
        </table>
<?php } ?>
<?php if ($player_stats[$playername]['action']) { ?>     
<table class="sortable main-stats">
    <thead>
    <tr><th>Player name</th><th>Killed</th><th>Killed By</th></tr>
    </thead>
    <?php foreach ( $player_stats[$playername]['action'] as $otherplayer ) { ?>
    <tr>
        <td class=name><?php _html_link('Player',$otherplayer['name']);?></td>
        <td class=kills><?php _outputstat($otherplayer['killed']);?></td> 
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
        <td class=kills><?php _outputstat($maps['kills']) ?></td> 
        <td class=kills><?php _outputstat($maps['deaths']) ?></td> 
        <td class=kills><?php _outputstat($maps['suicides']) ?></td> 
    </tr>
    <?php } ?>
</table>
<?php } ?>