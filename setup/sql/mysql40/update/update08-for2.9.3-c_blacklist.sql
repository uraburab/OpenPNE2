CREATE TABLE `c_blacklist` (
  `c_blacklist_id` int(11) NOT NULL auto_increment,
  `c_member_id` int(11) NOT NULL,
  PRIMARY KEY  (`c_blacklist_id`)
) TYPE=MyISAM;