<?php
// get all reaction data from the db

include 'dbconn.php';

$dbc = connectToDB();

// add check for collectionenabled?
$query = "SELECT reactionName, reaction FROM reactiondata where collectionID=1";
$result = performQuery($dbc, $query);
$reactions = array();
$colnum = 0;
while ($row = mysqli_fetch_assoc($result)) {

   $current_reaction = json_decode( $row['reaction'] );
   $current_name = $row['reactionName'];

    if ($colnum == 0){
      $row=0;
      $col=0;

      $reactions[$row][$col] = "Time";
      $reactions[$row][$col+1] = $current_name;
      foreach ($current_reaction as $k => $v){
        $row++;
        $reactions[$row][$col]=$k;      // store the time in col 0
        $reactions[$row][$col+1]=$v[1];    // store the reaction in col 1
      }
      $colnum +=2;
    } else {

      // add the column header
      $reactions[0][$colnum] = $current_name;

      // loop through and add each reaction value to the appropriate time
      foreach ($current_reaction as $k =>$v)
        $reactions[$k+1][$colnum] = $v[1];

      $colnum ++;
  }
}

// returns all data as one array
echo json_encode( $reactions );
exit;

// CREATE TABLE reactiondata (
//   reactionID int(11) NOT NULL auto_increment,
//   collectionID int not null,
//   reactionName varchar(128),
//   reaction mediumblob,
//   FOREIGN KEY (collectionID) references collection(collectionID),
//   PRIMARY KEY  (reactionID)
// ) ENGINE=MyISAM DEFAULT CHARSET=latin1;


?>
