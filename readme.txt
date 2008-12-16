QUAKE2 STATS
============

Quake2 Stats is a great new system, just like the old system, but new. It takes log files from the game Quake2, and produces a bunch of tables and graphs which are automatically updated and can be added to your website if you like. Not a lot of development has been done on Quake2 since about 2000, which is a shame as it's still quite a lot of fun to play, with the advantage you don't need a beefy new PC to run it on.

Here's how to get it going.

INSTALLATION
============

This takes just a few steps.

1. On your Web-hosting:

- Create a mysql database for the statistics with a user setup for full access.
- Run the "create-table.sql" script to structure the database.
- Edit config.php with the details of the database location and credentials.
- Upload entire "q2stats" folder to your hosting, eg. /public_html/q2stats/

2. On the Quake 2 server:

This assumes you've got PHP installed on your server. If not, install it with mysql extension.

- Edit file "update.php" with details of the database location and credentials.
- upload update.php to the server.
- either run the update.php manually...
$ php -f update.php

-or add as a cron job to automate...
0-59/10 * * * * /usr/bin/php /home/quake2/update.php

That should do it.

=====================================================================================

Problems? Talk to him.
http://www.james-lloyd.com

Working Great! Talk to me.
http://www.darrenwatt.com

Confused where you got this? Probably from http://code.google.com/p/quake2stats/
=====================================================================================