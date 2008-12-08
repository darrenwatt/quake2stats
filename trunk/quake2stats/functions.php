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


function _ordinalize($number) {
    if (in_array(($number % 100),range(11,13))){
        return $number.'th';
        }elseif ($number == 1) {
         return $number.'<sup>st</sup><img src="'.PATH.'images/icons/award_star_gold_1.png">'; 
        } elseif ($number == 2) {
        return $number.'<sup>nd</sup><img src="'.PATH.'images/icons/award_star_silver_1.png">'; 
        } elseif ($number == 3) {
        return $number.'<sup>rd</sup><img src="'.PATH.'images/icons/award_star_bronze_1.png">';
        } else {   
        switch (($number % 10)) {
        case 1:
        return $number.'<sup>st</sup>';
        break;
        case 2:
        return $number.'<sup>nd</sup>';
        break;
        case 3:
        return $number.'<sup>rd</sup>';
        default:
        return $number.'<sup>th</sup>';
        break;
        }
    }
}

function _html_link ($type,$pagename="index")
    {
    
    $pagefilename = str_replace(' ','-',$pagename).'.html';
    if ($pagename  == "index") { $pagename = $type; }
    echo "<a href='".PATH."$type/$pagefilename'>$pagename</a>";        
    }
 function _outputstat($item)
    {
      if(!isset($item))
        { $item = '0'; }
      echo $item;  
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
        return $output;
        if ($_GET['debug'] =='true') { echo '<span class="debug">Debug! '.$sql.'</span>'; };
        mysql_close();
        }
/*############ End of MYSQL Functions  ###############*/

?>
