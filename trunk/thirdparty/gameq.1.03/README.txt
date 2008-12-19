Readme
======
example.php contains a basic example.
list.php shows a list of supported games.

For further information, visit http://gameq.sourceforge.net/.

Feedback is very much appreciated.


Changelog

=========
Gameq 1.03 - November 1, 2008
----------
- Added [hlold] protocol, points to the old halflife protocol
- [source] now returns players data for halflife 1 servers


Gameq 1.02 - October 25, 2008
----------
- Added compatibility for changed halflife 1, you can use [source] to
  query them

Gameq 1.01 - Semptember 15, 2008
----------
- Games added:
  + [assaultcube] Assault Cube
  + [ffow] Frontline: Fuel of War
  + [savage2] Savage 2: A Tortured Soul
  + [ns] Natural Selection
  + [teeworlds] Teeworlds, suggested by Dirk (http://cstat.y7.ath.cx).
- Games updated:
  + [crysis] Uses the gamespy3 protocol since last update
  + [sauerbraten] Thanks to patch by Dirk (http://cstat.y7.ath.cx).
- Protocols updated:
  + [farcry] Added player listing
  + [source] Updated for new packet headers
- Options:
  + Renamed: "sockets" has been renamed to "sock_count"
  + Added: "sock_start", the first port to be opened locally
    If you want the script to use ports 10000 - 10020, you'll have to use
    $gq->setOption('sock_start', 100000);
    $gq->setOption('sock_count', 20);

- Simplified error handling, now uses trigger_error()
- Filters can now have default arguments
- Fixed normalise filter for players
- Added sortplayers filter
- Added list.php
- Updated example.php, should be much clearer now
- Added a todo section to this document


GameQ 1.0 - April 01, 2008
---------
- Games added:
  + [baldur] Baldur's Gate 1
- Protocols updated:
  + [doom3] Split off quakewars protocol
  + [quakewars] Updated protocol for splatterladder / 1.4
- Games updated:
  + [bf2] Updated query string
  + [cs] Changed to source protocol. Use [halflife] for old
    games
  + [source] Updated query string
  + [ut3] Added default port


Alpha 2.2 - November 19, 2007
---------
- Games added:
  + [cod3] Call of Duty 3, thanks to Allstats
  + [cod4] Call of Duty 4, thanks to Allstats
  + [coduo] Call of Duty: United offensive
  + [crysis] Crysis
  + [mohbreak] Medal of Honor: Breakthrough
  + [mohspear] Medal of Honor: Spearhead
  + [rfactor] rFactor
  + [tf2] Team Fortress 2
  + [ut3] Unreal Tournament 3, unknown default port
- Games updated:
  + [aa] America's army now uses gamespy2 protocol
  + [quakewars] Updated for version 1.2
- Protocols updated:
  + [source] Better handling for erroneous responses
  + [gamespy] Improved
  + [gamespy2] Fixed bug for empty player list

- Added GameQ_Buffer::goto
- Modified GameQ_Config::getGame to return game type
- Added some default return values (gq_<name>)
- Partially rewrote the normalise filter
- Added some script examples


Alpha 2.1 - August 18, 2007
-------
- Added a normalising filter
- Added ghost recon: advanced warfighter 2 to list [graw2]
- Added ghost recon: advanced warfighter to list [graw]
- Added vietcong 2 to list [vietcong2]
- Added mta: san andreas to list [mtasa]
- Added hexenworld to list [hexenworld]
- Added generic entry for source [source]
- Added halo 2 entry, untested [halo2]
- Changed fear to use gamespy2 protocol [fear]
- Added a limit on sockets to be used by the script, preventing errors when
  querying large amounts of servers.
  The limit can be set using $gameq->setOption('sockets', <number>);
- Added a GameQ::clearServers() method
- Fixed doom3/quakewars players


Alpha 2 - July 29, 2007
-------
- Added battlefield 2142 support [bf2142]
- Added stalker support [stalker]
- Added alien arena to list [alienarena]
- Added armed assault to list [armedassault]
- Added red orchestra to list [redorchestra]
- Added cross racing championship to list [crossracing]
- Added kiss psycho circus to list [kiss]
- Updated kingpin data [kingpin]
- Fixed player bug for doom3 protocol
- Fixed player bug for gamespy protocol
- Added a filter to strip color tags
- Modified main GameQ and Communicate objects to send challenge-
  response packets over same socket. This caused problems with the new 
  gamespy protocol
- Added some sanity checks to main class


Alpha 1.2 - July 17, 2007
-------
- Added hexen 2 support [hexen2]
- Added silverback engine support [silverback]
- Added partial tribes support [tribes]
- Added partial tribes 2 support [tribes2]
- Added dark messiah to list [messiah]
- Added tremulous to list [tremulous]
- Added savage to list [savage]
- Added ragdoll kung fu to list [ragdoll]
- Added neverwinter nights 2 to list [neverwinter2]
- Added Red Orchestra to list [redorchestra]
- Added this file


Alpha 1.1 - July 05, 2007
-------
- Added Cube engine support [cube]
- Added Sauerbraten / Cube2 engine support [sauerbraten]
- Added limited Ghost Recon support [ghostrecon]
- Added Warsow support [warsow]
- Added Counter-Strike list [cs]
- Added Dod: Source to list [dodsource]
- Modified quake3 protocol, now manually counts players
- Changed filters to accept arguments


Alpha 1 - June 29, 2007
-------
- Initial commit


TODO
====
- [source] Add support for compressed responses
- Create more extensive documentation
- Add more games :)
