<?php 
$mapname = str_replace('%7B','{',str_replace('%7D','}',str_replace('-',' ',str_replace('.html','',$pathparams[1]))));  
?>
<h3><?php echo $mapname; ?></h3>
