--
-- Database: `q2stats`
--

-- --------------------------------------------------------

--
-- Table structure for table `knownusers`
--

CREATE TABLE `knownusers` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `playername` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `gamedate` varchar(99) NOT NULL,
  `gametime` varchar(99) NOT NULL,
  `map` varchar(99) NOT NULL,
  `timeindex` varchar(99) NOT NULL,
  `action` varchar(99) NOT NULL,
  `who` varchar(99) NOT NULL,
  `target` varchar(99) NOT NULL,
  `weapon` varchar(99) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=249 ;

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `award` varchar(250) NOT NULL,
  `place` int(99) NOT NULL,
  `points` varchar(99) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE `stats` (
  `playername` varchar(250) NOT NULL,
  `stat` varchar(250) NOT NULL,
  `figure` int(250) NOT NULL,
  `rank` int(250) NOT NULL,
  `points` int(250) NOT NULL,
  `good` binary(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------