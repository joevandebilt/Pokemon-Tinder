CREATE TABLE `PokeSwipes` (
  `ID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Swipes` bigint(20) GENERATED ALWAYS AS ((`LeftSwipes` + `RightSwipes`)) VIRTUAL NOT NULL,
  `LeftSwipes` bigint(20) NOT NULL DEFAULT '0',
  `RightSwipes` bigint(20) NOT NULL DEFAULT '0',
  `Desirability` decimal(4,2) GENERATED ALWAYS AS (if((`RightSwipes` > 0),((`RightSwipes` / `Swipes`) * 100),0.00)) VIRTUAL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;