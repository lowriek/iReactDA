use ireact;
DROP TABLE IF EXISTS composition;
CREATE TABLE composition (
  compositionID int(11) NOT NULL auto_increment,
  composername varchar(100) NOT NULL,
  compositionname varchar(100) NOT NULL,
  PRIMARY KEY  (compositionID)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS collection;
CREATE TABLE collection (
  collectionID int(11) NOT NULL auto_increment,
  compositionID int(11) NOT NULL,
  description varchar(1024) NOT NULL,
  url varchar(1024),
  type ENUM('live', 'video'),
  collectionenabled boolean,
  FOREIGN KEY (compositionID) references composition(compositionID),
  PRIMARY KEY  (collectionID)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS reactiondata;
CREATE TABLE reactiondata (
  reactionID int(11) NOT NULL auto_increment,
  collectionID int not null,
  reactionName varchar(128),
  reaction mediumblob,
  FOREIGN KEY (collectionID) references collection(collectionID),
  PRIMARY KEY  (reactionID)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO composition VALUES
(NULL, "Yu-Hui Chang", "Ode to Kate" );

INSERT INTO composition VALUES
(NULL, "Kate", "Hi Cousin James" );

INSERT INTO collection VALUES
(NULL, 2, "Example collection", "media/TEST.webm", "video", false)
