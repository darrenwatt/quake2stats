<pre>
<?php
require_once 'GameQ.php';
require_once 'function.hexdump.php';
$servers['q2'] = array('quake2', 'kungfudazza.game-server.cc', 27910);   


function addRange($type, $address, $start, $end)
{
    $serv = array();
    for ($i = $start; $i != $end + 1; $i++) {
        $serv[$type . $i] = array($type, $address, $i);
    }

    return $serv;
}

function addPorts($type, $address, $ports) {
    $serv = array();
    foreach ($ports as $key => $port) {
        $serv[$port] = array($type, $address, $port);
    }

    return $serv;

}

/**
 * Tests
 */
$timeout = 2000;
$normal  = true;
$raw     = true;


 
if (!isset($servers)) {
    exit('No servers defined.');
}

 
$gq = new GameQ;
$gq->setOption('timeout', $timeout);
$gq->setOption('debug',   true);
$gq->setOption('sock_count', 4);
$gq->setOption('sock_start', 10000);
$gq->addServers($servers);
//$gq->setFilter('normalise');
//$gq->setFilter('sortplayers');


if ($raw) {



/**
 * Raw mode
 */
$gq->setOption('raw', true);
$result = $gq->requestData();

foreach ($result as $key => $entry)
{
    echo "<h1 style=\"color:red\">$key</h1>\n";
    
    foreach ($entry as $id => $packets) {
        echo "<h2>$id</h2>\n";
        if (!isset($packets)) {
            //echo "<h3 style=\"color:gray\">No response</h3>\n";
            continue;
        }
        foreach ($packets as $p_id => $packet) {
            echo "<h3 style=\"color:gray\">$p_id</h3>\n";
            hexdump($packet);
        }
    }
}
}

if ($normal) {
/**
 * Parsed mode
 */
$gq->setOption('raw', false);
$result = $gq->requestData();
echo "<pre>\n";
print_r($result);
echo "\n</pre>\n";
}
?>
