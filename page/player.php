<?php 
$playername = str_replace('%7B','{',str_replace('%7D','}',str_replace('-',' ',str_replace('.html','',$pathparams[1]))));  
?>
<h3><?php echo $playername; ?></h3>

<table class=main-stats>
    <thead>
    <tr><th>Score</th><th>Kills</th><th>Deaths</th><th>Suicides</th><th>K:D</th></tr>
    </thead>
    <tr>
        <td><?php echo $player_stats[$playername]['score'];?></td>
        <td><?php echo $player_stats[$playername]['total kills']['figure'];?></td>
        <td><?php echo $player_stats[$playername]['total deaths']['figure'];?></td> 
        <td><?php echo $player_stats[$playername]['total suicides']['figure'];?></td> 
        <td><?php echo $player_stats[$playername]['k2d']['figure']/10 ;?></td>
    </tr>
</table>     
<table class="sortable main-stats">
    <thead>
    <tr><th>Player name</th><th>Killed</th><th>Killed By</th></tr>
    </thead>
    <?php foreach ( $player_stats[$playername]['action'] as $otherplayer ) { ?>
    <tr>
        <td><?php _html_link('Player',$otherplayer['name']);?></td>
        <td><?php _outputstat($otherplayer['killed']);?></td> 
        <td><?php _outputstat($otherplayer['killedby']);?></td> 
    </tr>
    <?php } ?>
</table>
<table class="sortable main-stats">

    <thead><tr><th>Map name</th><th>Kills</th><th>Deaths</th><th>Suicides</th></tr></thead>
    <?php foreach ( $player_stats[$playername]['map'] as $maps ) { ?>
    <tr>
        <td><?php _html_link('Map',$maps['name']) ?></td>
        <td><?php _outputstat($maps['kills']) ?></td> 
        <td><?php _outputstat($maps['deaths']) ?></td> 
        <td><?php _outputstat($maps['suicides']) ?></td> 
    </tr>
    <?php } ?>
</table>
<?php if ( $player_stats[$playername]['awards']) {   ?>
        <table class="sortable main-stats">
        <thead><tr><th>Award</th><th>Medal</th><th>Bonus</th></tr></thead>
            <?php foreach ( $player_stats[$playername]['awards'] as $award ) { ?>
            <tr>
               <td><?php _html_link('award',$award['name']) ?></td>
               <td><?php echo _ordinalize($award['rank']) ?></td> 
               <td><?php _outputstat($award['points']) ?></td> 
            </tr>
            <?php } ?>
        </table>
<?php } ?>
<?php        
foreach ($guns as $gun)
    {
     $gunkills[] = $player_stats[$playername]['total '.$gun.' kills']['figure'] ;  
    }
 print_r ($gunkills);
$piChart = new gPieChart;
$piChart->width = 500;
$piChart->height = 350;

$piChart->addDataSet($gunkills);
$piChart->valueLabels = $guns;
$piChart->dataColors = array("ff3344", "11ff11", "22aacc", "3333aa");
$piChart->set3D(true);



?>
<h2>Pie Chart</h2>
<center>
<img src="<?php print $piChart->getUrl();  ?>" /> <br> pie chart using the gPieChart class.
 <?php
$barChart = new gGroupedBarChart;
$barChart->width = 500;
$barChart->height = 500;

$barChart->addDataSet($gunkills);
 $barChart->valueLabels = array("first", "second", "third","fourth");  
$barChart->dataColors = array("ff3344", "11ff11", "22aacc", "3333aa");
?>
<h2>Grouped Bar Chart</h2>
<img src="<?php print $barChart->getUrl();  ?>" /> <br> grouped bar chart using the gGroupedBarChart class.
</center>   
    <pre><?php print_r($player_stats) ?></pre>
