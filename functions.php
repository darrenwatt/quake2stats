<?php
require ('thirdparty/gchart2/gChart2.php');
function _page_name($pathparams,$output=true)
    {
     if ($pathparams[1] && $pathparams[1] != 'index.html') 
        { 
            $pagename =  $pathparams[0]." for ".str_replace('.html','',str_replace('-',' ',$pathparams[1])); 
        } else { 
            $pagename = "All ".$pathparams[0]; 
        }    
     echo  $pagename;
    }
    
function _calc_score($kills,$suicides,$deaths,$bonus)
    {
     $score = ($kills - $suicides) + $bonus;
     return($score);   
    }


  function _ordinalize($number,$type="medal") {
      if ($type == "rank") { $icon = 'award_star'; }   else {  $icon = 'medal'; } 
        if (in_array(($number % 100),range(11,13))){
            
            
            return $number.'th';
            }else{
            switch (($number % 10)) {
            case 1:
            return $number.'<sup>st</sup><img src="'.PATH.'images/icons/'.$icon.'_gold_2.png">';
            break;
            case 2:
            return $number.'<sup>nd</sup><img src="'.PATH.'images/icons/'.$icon.'_silver_2.png">';
            break;
            case 3:
            return $number.'<sup>rd</sup><img src="'.PATH.'images/icons/'.$icon.'_bronze_2.png">';
            default:
            return $number.'<sup>th</sup>';
            break;
            }
        }
    }
  function _ordinalizebad($number,$type="medal") {
      if ($type == "rank") { $icon = 'award_star'; }   else {  $icon = 'medal'; } 
        if (in_array(($number % 100),range(11,13))){
            
            
            return $number.'th';
            }else{
            switch (($number % 10)) {
            case 1:
            return $number.'<sup>st</sup><img src="'.PATH.'images/icons/'.$icon.'_gold_1.png">';
            break;
            case 2:
            return $number.'<sup>nd</sup><img src="'.PATH.'images/icons/'.$icon.'_silver_1.png">';
            break;
            case 3:
            return $number.'<sup>rd</sup><img src="'.PATH.'images/icons/'.$icon.'_bronze_1.png">';
            default:
            return $number.'<sup>th</sup>';
            break;
            }
        }
    }
function _medal_img_link($stat,$rank,$type="good")
    {
    switch ($type)
        {
         case "good":
         $type = '2';
         break;
         case "bad";
         $type = '1';
         break;   
        }
    switch ($rank) {
        case 1:
        $image = '<img src="'.PATH.'images/icons/medal_gold_'.$type.'.png">'; 
        break;
        case 2:
        $image = '<img src="'.PATH.'images/icons/medal_silver_'.$type.'.png">'; 
        break;
        case 3:
        $image = '<img src="'.PATH.'images/icons/medal_bronze_'.$type.'.png">';
        break;
        default:
        echo 'error rank '.$rank.' should not be passed';
        break; 
    }       
     echo "<a title='No. ".$rank." ".$stat."' href='".PATH."Awards/".str_replace(' ','-',$stat).".html'>".$image."</a>";   
    }

function _html_link ($type,$pagename="index")
    {
    
    $pagefilename = str_replace(' ','-',$pagename).'.html';
    if ($pagename  == "index") { $pagename = $type; }
    if ($type == 'Player' && $pagename != 'index')
        {
         echo "<a href='".PATH."$type/$pagefilename'>";
         _gravatar($pagename,20);  
        echo " $pagename</a>";
        } else {
        echo "<a href='".PATH."$type/$pagefilename'>$pagename</a>";        
        }
    }
 function _outputstat($item)
    {
      if(!isset($item))
        { $item = '0'; }
      echo $item;  
    }
function _gravatar($playername,$size=40)
    {
     $getemail = _dbquery ("SELECT email from knownusers WHERE playername = '".$playername."';",MYSQL_ASSOC);
     if ($getemail)
        { 
         $email = $getemail['0']['email'];
         $default = "http://tbn0.google.com/images?q=tbn:BlF8Wi0FqGr-ZM:http://media.giantbomb.com/uploads/0/36/253803-070907quake_ii_logo_tiny.jpg";
         $grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5( strtolower($email) )."&default=".urlencode($default)."&size=".$size;
         echo '<img src="'.$grav_url.'">';
        }  else {
        echo '<img src="'.PATH.'images/icons/q2logo.jpg">';
        }  
    }

function array_search_recursive($needle, $haystack, $a=0, $nodes_temp=array()){
global $nodes_found;
  $a++;
  foreach ($haystack as $key1=>$value1) {
    $nodes_temp[$a] = $key1;
    if (is_array($value1)){   
      array_search_recursive($needle, $value1, $a, $nodes_temp);
    }
    else if ($value1 === $needle){
      $nodes_found[] = $nodes_temp[$a];
    }
  }
  return $nodes_found;
}

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
        if (isset($output)) { return $output; } else { return false; }
        if ($_GET['debug'] =='true') { echo '<span class="debug">Debug! '.$sql.'</span>'; };
        mysql_close();
        }
/*############ End of MYSQL Functions  ###############*/

?>
