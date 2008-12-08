<?php
$filename = 'g:\wamp\www\q2stats\test.log';
$db_user = "root"; // Username
$db_pass = ""; // Password
$db_database = "q2stats"; // Database Name
$db_host = "localhost"; // Server Hostname
$guns = array('Blaster','Shotgun','Super Shotgun','Machinegun','Chaingun','Grenade Launcher','Rocket Launcher','Hyperblaster','Railgun','BFG10K','Hand Grenade','Telefrag','Grappling Hook');
$scores = array (
        'total Blaster kills' =>            array ( '1' => 15, '2' => 10, '3' => 5 ),
        'total Shotgun kills' =>            array ( '1' => 5, '2' => 2, '3' => 1 ),
        'total Super Shotgun kills' =>      array ( '1' => 5, '2' => 2, '3' => 1 ),
        'total Machinegun kills' =>         array ( '1' => 5, '2' => 2, '3' => 1 ),
        'total Chaingun kills' =>           array ( '1' => 5, '2' => 2, '3' => 1 ),
        'total Grenade Launcher kills' =>   array ( '1' => 5, '2' => 2, '3' => 1 ),
        'total Rocket Launcher kills' =>    array ( '1' => 5, '2' => 2, '3' => 1 ),
        'total Hyperblaster kills' =>       array ( '1' => 5, '2' => 2, '3' => 1 ),
        'total Railgun kills' =>            array ( '1' => 5, '2' => 2, '3' => 1 ),
        'total BFG10K kills' =>             array ( '1' => 5, '2' => 2, '3' => 1 ),
        'total Hand Grenade kills' =>       array ( '1' => 25, '2' => 15, '3' => 7 ),
        'total Telefrag kills' =>           array ( '1' => 50, '2' => 30, '3' => 15 ),
        'total Grappling Hook kills' =>     array ( '1' => 50, '2' => 30, '3' => 15 ),
        'total suicides' =>                 array ( '1' => -50, '2' => -30, '3' => -15 ),
        'total kills' =>                    array ( '1' => 25, '2' => 15, '3' => 7 ),  
        );

/*############ My SQL Functions  ###############*/

function  _dbconnect() 
        {
        global $db_user;
        global $db_pass;
        global $db_database;
        global $db_host;
        $link = mysql_connect($db_host, $db_user, $db_pass);
        if (!$link) { die('Not connected : ' . mysql_error()); }
        $db_selected = mysql_select_db($db_database, $link);
        if (!$db_selected) { die ('Can\'t use '.$db_database.' : ' . mysql_error()); }        
        }

//_dbupdate executes a SQL statement, i.e for UPDATE, DROP etc statements.
function _dbupdate ($sql)
        {
        _dbconnect();
        $result = mysql_query($sql);
        if (!$result) {
            die("\n ".'<br><font color="red"><b>Invalid query:</b></font> ' . mysql_error());
                    }
        mysql_close();
        }

// _dbquery returns an array from a SELECT statement (OLD NON ZEND)    
function _isitindb ($sql)
        {
         // Connect to the database
         _dbconnect();
         $result = mysql_query($sql);
         $num_rows = mysql_num_rows($result);
         if ($num_rows > 0) {
            return true; } else {
            return false;
            }
        
        }

function _dbquery ($sql,$type=MYSQL_ASSOC,$print=false)  // type MYSQL_ASSOC , MYSQL_NUM , MYSQL_BOTH
        {
        _dbconnect();
        $query = mysql_query($sql);
        $i=0;
        while ($results = mysql_fetch_array($query,$type))
            {
            $output[$i]=$results;
            $i++;
            }
        
        if ($print == true)
            {
            echo '<pre>';
            print_r($output);
            echo '</pre>';
            }
        return $output;
        if ($_GET['debug'] =='true') { echo '<span class="debug">Debug! '.$sql.'</span>'; };
        mysql_close();
        }
/*############ End of MYSQL Functions  ###############*/

$handle = fopen($filename, "r");
$lines = file($filename);
fclose($handle);
$i=0;$gameid=0;$added=0;
foreach ($lines as $line => $item)
    {
        $line++;
    $lineitem=explode("\\t",preg_replace("/\t/","\\t",$item));  // Explode on Tab!
    //print_r($lineitem);echo '<br>';
    switch ($lineitem[2]){
      case "Map":
        $game['Map']=trim($lineitem[3]);
        break;
      case "LogDate":
        $game['LogDate']=trim($lineitem[3]);
        break;
      case "LogTime":
       $game['LogTime']=trim($lineitem[3]);
        break; 
      case "Kill":     
        $databaseline[$i]=array('gamedate' => $game['LogDate'],
                            'gametime' => $game['LogTime'],
                            'map'      => $game['Map'],
                            'timeindex'=> $lineitem[5],
                            'action'   => 'Kill',
                            'who'      => $lineitem[0], 
                            'target'   => $lineitem[1],
                            'weapon'   => $lineitem[3],
                            );
                          
       $checksql="SELECT `id` FROM `log` WHERE `gamedate` = '".mysql_escape_string($databaseline[$i]['gamedate'])."' AND `gametime` = '".mysql_escape_string($databaseline[$i]['gametime'])."' AND `map` = '".mysql_escape_string($databaseline[$i]['map'])."' AND `target` = '".mysql_escape_string($databaseline[$i]['target'])."' AND `who` = '".mysql_escape_string($databaseline[$i]['who'])."' AND `timeindex` = '".mysql_escape_string($databaseline[$i]['timeindex'])."';";
        if (!_isitindb($checksql)) 
            { 
             $addsql="INSERT INTO `".$db_database."`.`log` ( `id` , `gamedate` , `gametime` , `map` , `timeindex` , `action` , `who` , `target` ,  `weapon` )
             VALUES ( NULL , '".mysql_escape_string($databaseline[$i]['gamedate'])."', '".mysql_escape_string($databaseline[$i]['gametime'])."', '".mysql_escape_string($databaseline[$i]['map'])."', '".mysql_escape_string($databaseline[$i]['timeindex'])."', '".$databaseline[$i]['action']."', '".mysql_escape_string($databaseline[$i]['who'])."', '".mysql_escape_string($databaseline[$i]['target'])."', '".mysql_escape_string($databaseline[$i]['weapon'])."');  ";
           _dbupdate ($addsql);
            $added++;
            } 
        break;
      case "Suicide":
        $databaseline[$i]=array('gamedate' => $game['LogDate'],
                            'gametime' => $game['LogTime'],
                            'map'      => $game['Map'], 
                            'timeindex'=> $lineitem[5], 
                            'action'   => 'Suicide',
                            'who'      => $lineitem[0], 
                            'target'   => 'Self',
                            'weapon'   => $lineitem[3],  
                            ); 
        
        $checksql="SELECT `id` FROM `log` WHERE `gamedate` = '".mysql_escape_string($databaseline[$i]['gamedate'])."' AND `gametime` = '".mysql_escape_string($databaseline[$i]['gametime'])."' AND `map` = '".mysql_escape_string($databaseline[$i]['map'])."' AND `target` = '".mysql_escape_string($databaseline[$i]['target'])."' AND `who` = '".mysql_escape_string($databaseline[$i]['who'])."' AND `timeindex` = '".mysql_escape_string($databaseline[$i]['timeindex'])."';";
        if (!_isitindb($checksql))
            { 
            $addsql="INSERT INTO `".$db_database."`.`log` ( `id` , `gamedate` , `gametime` , `map` , `timeindex` , `action` , `who` , `target` ,  `weapon` )
            VALUES ( NULL , '".mysql_escape_string($databaseline[$i]['gamedate'])."', '".mysql_escape_string($databaseline[$i]['gametime'])."', '".mysql_escape_string($databaseline[$i]['map'])."', '".mysql_escape_string($databaseline[$i]['timeindex'])."', '".$databaseline[$i]['action']."', '".mysql_escape_string($databaseline[$i]['who'])."', '".mysql_escape_string($databaseline[$i]['target'])."', '".mysql_escape_string($databaseline[$i]['weapon'])."');  ";
            _dbupdate ($addsql);
            $added++;
            }
            
        break;

       } 
       $i++;         
     }

// deprecated include ('awardsupdate.php'); 
?>
Added <?php echo $added ?>
<?php
//stats table update
$statsallplayers = _dbquery("SELECT DISTINCT who FROM log",MYSQL_ASSOC);
_dbupdate("DELETE FROM `stats`");
foreach ($statsallplayers as $player)
    {
     //run through and get each players total kills etc.
     
     $kills = _dbquery("SELECT action, COUNT(*) FROM log WHERE who = '".$player['who']."' AND action = 'Kill' GROUP BY action  ORDER BY COUNT(*) DESC",MYSQL_ASSOC);
     $kills = $kills[0]['COUNT(*)']+1;
     $kills = $kills -1; // stupid thing to make null entries 0 not null
     _dbupdate("INSERT INTO `".$db_database."`.`stats` (`playername`, `stat`, `figure`) VALUES ( '".mysql_escape_string($player['who'])."','total kills','".$kills."');");
     $killsforscore[$player['who']] = $kills;
     $suicides = _dbquery("SELECT action, COUNT(*) FROM log WHERE who = '".$player['who']."' AND action = 'Suicide' GROUP BY action  ORDER BY COUNT(*) DESC",MYSQL_ASSOC);
     $suicides   = $suicides[0]['COUNT(*)']+1;
     $suicides   = $suicides -1;
     _dbupdate("INSERT INTO `".$db_database."`.`stats` (`playername`, `stat`, `figure`) VALUES ( '".mysql_escape_string($player['who'])."','total suicides','".$suicides."');");
     $suicidesforscore[$player['who']]= $suicides;
     
     
     $deaths = _dbquery("SELECT action, COUNT(*) FROM log WHERE target = '".$player['who']."' GROUP BY action",MYSQL_ASSOC);
     $deaths = $deaths[0]['COUNT(*)']+1;
     $deaths = $deaths -1;
     _dbupdate("INSERT INTO `".$db_database."`.`stats` (`playername`, `stat`, `figure`) VALUES ( '".mysql_escape_string($player['who'])."','total deaths','".$deaths."');");
     if ($deaths > 0) { $k2d =  round($kills/$deaths,1)*10; } else { $k2d = 0; }
     _dbupdate("INSERT INTO `".$db_database."`.`stats` (`playername`, `stat`, `figure`) VALUES ( '".mysql_escape_string($player['who'])."','k2d','".$k2d."');");
     
     foreach ($guns as $gun)
        {
         $gunkills = _dbquery("SELECT action, COUNT(*) FROM log WHERE who = '".$player['who']."' AND action = 'Kill' AND weapon = '".$gun."' GROUP BY action",MYSQL_ASSOC);
         $gunkills = $gunkills[0]['COUNT(*)']+1;
         $gunkills = $gunkills-1;
         _dbupdate("INSERT INTO `".$db_database."`.`stats` (`playername`, `stat`, `figure`) VALUES ( '".mysql_escape_string($player['who'])."','total ".$gun." kills','".$gunkills."');");    
        }
    }


// Go through stats and apply ranks and bonus points   
$alltypesofstat = _dbquery("SELECT DISTINCT stat from stats",MYSQL_ASSOC);
foreach ($alltypesofstat as $thing)
    {
        //echo $thing['stat'].'<br>';
        $ranks = _dbquery("SELECT * from stats WHERE stat = '".$thing['stat']."' ORDER by figure DESC",MYSQL_ASSOC);
        $i=1;
        foreach ($ranks as $rank)
            {
               if (isset($scores[$thing['stat']][$i]) && $rank['figure'] > 5 ) { $points = $scores[$thing['stat']][$i]; } else { $points = 0; }
               _dbupdate("UPDATE `q2stats`.`stats` SET `rank` = '".$i."', `points` = '".$points."' WHERE CONVERT( `stats`.`playername` USING utf8 ) = '".$rank['playername']."' AND CONVERT( `stats`.`stat` USING utf8 ) = '".$thing['stat']."' AND `stats`.`figure` =".$rank['figure']." AND `stats`.`rank` =".$rank['rank']." LIMIT 1 ;");
               $i++;
            }                
    }

// Lets total the scores up, oh yes lets!
foreach ($statsallplayers as $player)
    {
     $totalawardscores = _dbquery("SELECT sum(points) FROM stats WHERE playername = '".$player['who']."' AND points != 0",MYSQL_ASSOC);   
     $totalscore = $totalawardscores[0]['sum(points)'];
     $totalscore = $totalscore + ($suicidesforscore[$player['who']] - ($suicidesforscore[$player['who']]*2)) + $killsforscore[$player['who']];
     _dbupdate ("INSERT INTO `q2stats`.`stats` (`playername` ,`stat` ,`figure` ,`rank` ,`points`) VALUES ('".$player['who']."', 'total score', '".$totalscore."', 0, 0);");
    }

?>Stats updated