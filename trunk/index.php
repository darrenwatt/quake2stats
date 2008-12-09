<?php
include ('config.php'); 

   // stuff for working out what page we're trying to display!
   if (PATH == '/') { $pathparams = substr($_SERVER['REQUEST_URI'],1); } else { $pathparams = str_replace(PATH,'',$_SERVER['REQUEST_URI']); }
 
   if ($_GET['debug'] == 'true') { echo $pathparams.'<br>';print_r($_SERVER['REQUEST_URI']); }
   $pathparams = explode('/',$pathparams);
   if ($_GET['debug'] == 'true') { print_r($pathparams); }  
   switch ($pathparams[0]){
        case "page":
            if (empty($pathparams[1])) {$page = 'page/Player-Ranking.php';} else {
            $page = 'page/'.str_replace('.html','.php',$pathparams[1]);
           
            }
        break;
        case "Player":
        $page = 'page/player.php';
        break;
        case "Weapons":
        $page = 'page/weapon.php';
        break;
        case "Map":
        $page = 'page/map.php';
        break;
        case "Awards":
        $page = 'page/awards.php';
        break;
        default:
        $page = 'page/Player-Ranking.php';
         
        } 
        
        if ($_GET['debug'] == 'true') { echo $page; }
/// load all stats data into array This may be a stupid thing to do 
$all_player_stats = _dbquery("SELECT * from stats",MYSQL_ASSOC);
foreach ($all_player_stats as $sta)
    {
       $player_stats[$sta['playername']]['name']=$sta['playername']; 
       $player_stats[$sta['playername']][$sta['stat']]['figure']=$sta['figure'];
       $player_stats[$sta['playername']][$sta['stat']]['rank']=$sta['rank'];
       $player_stats[$sta['playername']][$sta['stat']]['points']=$sta['points'];
       
       if ($sta['rank'] <4 && $sta['stats'] != 'total deaths' && $sta['stats'] != 'total score' && $sta['points'] != 0)
        {
         $player_stats[$sta['playername']]['awards'][$sta['stat']]['name']=$sta['stat'];
         $player_stats[$sta['playername']]['awards'][$sta['stat']]['rank']=$sta['rank'];
         $player_stats[$sta['playername']]['awards'][$sta['stat']]['figure']=$sta['figure'];  
         $player_stats[$sta['playername']]['awards'][$sta['stat']]['points']=$sta['points'];
        }
       if ( $sta['stats'] == 'total score')
        {
         $player_stats[$sta['playername']]['score']=$sta['points']; 
        }
       $mapkills = _dbquery("SELECT map,COUNT(*) FROM `log` WHERE who = '".$sta['playername']."' AND action = 'kill' group by map",MYSQL_ASSOC);
       if ($mapkills) {
        foreach ($mapkills as $mapkill)
            {
             // Fudge set up all to be zero then overright if theres a value to go in.  
             $player_stats[$sta['playername']]['map'][$mapkill['map']]['kills']=$mapkill['COUNT(*)'];   
             $player_stats[$sta['playername']]['map'][$mapkill['map']]['name']=$mapkill['map'];
            }         }
       $mapdeaths = _dbquery("SELECT map,COUNT(*) FROM `log` WHERE target = '".$sta['playername']."' AND action = 'kill' group by map",MYSQL_ASSOC);
       if($mapdeaths) {
        foreach ($mapdeaths as $mapdeath)
            {
             $player_stats[$sta['playername']]['map'][$mapdeath['map']]['deaths']=$mapdeath['COUNT(*)']; 
             $player_stats[$sta['playername']]['map'][$mapdeath['map']]['name']=$mapdeath['map'];
            } } 
       $mapsuicides = _dbquery("SELECT map,COUNT(*) FROM `log` WHERE who = '".$sta['playername']."' AND action = 'suicide' group by map",MYSQL_ASSOC);
       if($mapsuicides) {
        foreach ($mapsuicides as $mapsuicide)
            {
             $player_stats[$sta['playername']]['map'][$mapsuicide['map']]['suicides']=$mapsuicide['COUNT(*)'];   
             $player_stats[$sta['playername']]['map'][$mapsuicide['map']]['name']=$mapsuicide['map']; 
            } }  
       $killedplayers = _dbquery("SELECT target,COUNT(*) FROM `log` WHERE who = '".$sta['playername']."' AND action = 'kill' group by target",MYSQL_ASSOC);
       if($killedplayers) {
        foreach ($killedplayers as $killedplayer)
            {
             $player_stats[$sta['playername']]['action'][$killedplayer['target']]['killed']=$killedplayer['COUNT(*)'];
             $player_stats[$sta['playername']]['action'][$killedplayer['target']]['name']=$killedplayer['target'];   
            } }
       $killedbyplayers = _dbquery("SELECT who,COUNT(*) FROM `log` WHERE target = '".$sta['playername']."' AND action = 'kill' group by who",MYSQL_ASSOC);
       if($killedbyplayers) {
        foreach ($killedbyplayers as $killedbyplayer)
            {
             $player_stats[$sta['playername']]['action'][$killedbyplayer['who']]['killedby']=$killedbyplayer['COUNT(*)'];   
             $player_stats[$sta['playername']]['action'][$killedbyplayer['who']]['name']=$killedbyplayer['who'];    
            } }
    }       
   
include('header.php');
?>
<div id="content">
<?php
  if ($_GET['debug'] == 'true') { echo $page.'<br>'; print_r($pathparams); }  
 include($page); ?>
</div>
<?php include('footer.php'); ?>
