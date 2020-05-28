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
(NULL, "test composer", "Big Buck Bunny Trailer" ),
(NULL, "test composer", "Small" ),
(NULL, "test composer", "Volcano Lava Sample" );

INSERT INTO collection VALUES
(NULL, 1, "Big Bunny Trailer", "https://dl5.webmfiles.org/big-buck-bunny_trailer.webm", "video", false),
(NULL, 2, "Small", "http://techslides.com/demos/sample-videos/small.webm", "video", false),
(NULL, 3, "Example collection", "https://commons.wikimedia.org/wiki/File:Volcano_Lava_Sample.webm", "video", false);
