<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head><script src="<?php echo PATH ?>thirdparty/sorttable.js"></script>  
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="content-language" content="en">
<meta name="generator" content="Q2Stats by James Lloyd & Darren Watt">
<title>Q2Stats <?php if (!empty($pathparams[0])) { echo $pathparams[0]; } ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>style.css">
<link rel="shortcut icon" href="<?php echo PATH; ?>favicon.ico">
<link rel="icon" type="image/ico" href="<?php echo PATH; ?>favicon.ico">
</head>
<body>
<div id="wrapper">
    <div id="header">
          <h1>Q2Stats</h1>
          <h4>The latest in Quake 2 statistics, since 2008</h4>
          <img class=logo src="<?php echo PATH ?>images/name.PNG">
          <img class=badge1 src="<?php echo PATH.'images/badges/badge'. mt_rand(1,4) . '.png' ?>">

    </div>
    <div id=toolbar>
        <ul>
            <li><a href="<?php echo PATH; ?>">Home</a></li>
            <li><?php _html_link('Awards')?></li>
            <li><?php _html_link('Weapons')?></li> 
        </ul>
    </div>