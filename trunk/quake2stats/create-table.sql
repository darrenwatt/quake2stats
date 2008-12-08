CREATE TABLE `log` (
  `id` int(200) NOT NULL auto_increment,
  `gamedate` varchar(99) NOT NULL,
  `gametime` varchar(99) NOT NULL,
  `map` varchar(99) NOT NULL,
  `timeindex` varchar(99) NOT NULL,
  `action` varchar(99) NOT NULL,
  `who` varchar(99) NOT NULL,
  `target` varchar(99) NOT NULL,
  `weapon` varchar(99) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=371 ;
CREATE TABLE `stats` (
  `playername` varchar(250) NOT NULL,
  `stat` varchar(250) NOT NULL,
  `figure` varchar(250) NOT NULL,
  `rank` varchar(250) NOT NULL,
  `points` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;