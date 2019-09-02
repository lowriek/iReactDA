use ireact;
DROP TABLE IF EXISTS composition;
CREATE TABLE composition (
  compositionID int(11) NOT NULL auto_increment,
  composertname varchar(100) NOT NULL,
  compositionname varchar(100) NOT NULL,
  collectioneabled boolean,
  PRIMARY KEY  (`compositionID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS reactiondata;
CREATE TABLE reactiondata (
  reactionID int(11) NOT NULL auto_increment,
  compositionID int not null,
  reaction json,
  FOREIGN KEY (reactionID) references compostion(compositionID)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO composition VALUES
(1, "Yu-Hui Chang", "Ode to Kate", FALSE
);

INSERT INTO reactiondata VALUES
(1, 1,
  '{ "1": "-1", "13": "0", "49": "1" }'
);