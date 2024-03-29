<?php

define("PATH", "/q2stats/");    // www path where its installed
$db_user = "root"; // Username
$db_pass = ""; // Password
$db_database = "q2stats"; // Database Name
$db_host = "localhost"; // Server Hostname
require_once 'd:/wamp/www/q2stats/thirdparty/gameq.1.03/GameQ.php';  
include('functions.php');
$guns = array('Blaster','Shotgun','Super Shotgun','Machinegun','Chaingun','Grenade Launcher','Rocket Launcher','Hyperblaster','Railgun','BFG10K','Hand Grenade','Telefrag','Grappling Hook');

$levelname= array(
'q2dm1' => 'The Edge',
'q2dm2' => 'Tokay\'s Towers',
'q2dm3' => 'The Frag Pipe',
'q2dm4' => 'Lost Hallways',
'q2dm5' => 'The Pits',
'q2dm6' => 'Lava Tomb',
'q2dm7' => 'The Slimy Place',
'q2dm8' => 'WareHouse',
'base1' => 'Outer Base',
'base2' => 'Installation',
'base3' => 'Comm Center',
'train' => 'Lost Station',
'bunk1' => 'Ammo Depot',
'ware1' => 'Supply Station',
'ware2' => 'Warehouse',
'jail1' => 'Main Gate',
'jail2' => 'Detention Center',
'jail3' => 'Security Complex',
'jail4' => 'Torture Chambers',
'jail5' => 'Guard House',
'security' => 'Grid Control',
'mintro' => 'Mine Entrance',
'mine1' => 'Upper Mines',
'mine2' => 'Bore Hole',
'mine3' => 'Drilling Area',
'mine4' => 'Lower Mines',
'fact1' => 'Receiving Center',
'fact2' => 'Processing Plant',
'fact3' => 'Sudden Death',
'power1' => 'Power Plant',
'power2' => 'The Reactor',
'cool1' => 'Cooling Facility',
'waste1' => 'Toxic Waste Dump',
'waste2' => 'Pumping Station 1',
'waste3' => 'Pumping Station 2',
'biggun' => 'Big Gun',
'hangar1' => 'Outer Hangar',
'hangar2' => 'Inner Hangar',
'lab' => 'Research Lab',
'command' => 'Launch Command',
'strike' => 'Outlands',
'space' => 'Comm Satellite',
'city1' => 'Outer Courts',
'city2' => 'Lower Palace',
'city3' => 'Upper Palace',
'boss1' => 'Inner Chamber',
'boss2' => 'Final Showdown');

    

   
?>
