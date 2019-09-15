use ireact;
DROP TABLE IF EXISTS composition;
CREATE TABLE composition (
  compositionID int(11) NOT NULL auto_increment,
  composername varchar(100) NOT NULL,
  compositionname varchar(100) NOT NULL,
  collectionenabled boolean,
  PRIMARY KEY  (`compositionID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS reactiondata;
CREATE TABLE reactiondata (
  reactionID int(11) NOT NULL auto_increment,
  compositionID int not null,
  reaction mediumblob,
  FOREIGN KEY (reactionID) references compostion(compositionID)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO composition VALUES
(1, "Yu-Hui Chang", "Ode to Kate", FALSE
);

INSERT INTO reactiondata VALUES
(1, 1,
  '[[1747.3200000822544,1],[1907.304999884218,0],[2107.2900001890957,-1]]'
);
