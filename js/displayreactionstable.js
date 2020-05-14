$(document).ready(function() {

  //todo - get reactions for a specific collection
  var reactionData = [];

  $.get("php/retrievereactions.php", function(data, status){
      alert("TABLE *** Data: " + data.length + "\nStatus: " + status);
      reactionData = JSON.parse( data );
      //alert("TABLE *** Data: " + reactionData + "\nStatus: " + status);
  });

  alert("displayreactionstable: amount of data is: " + reactionData.length);
  // chuck a bunch of reactions here to see if we can get the table to work correctly
  var reactionDataReduced = [];
  for (var i = 0; i < 3; i++) {
    reactionDataReduced[i] = reactionData[i];
    alert("testing: " + reactionData[i] + "</br>");
  }
  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['table']});

  // Set a callback to run when the Google Visualization API is loaded.
  // Only draw the chart after the data is collected
  google.charts.setOnLoadCallback(drawTablefoo);

  function drawTablefoo() {
    var reactionDataTable = new google.visualization.DataTable();
    reactionDataTable.addColumn('number', 'Time');
    reactionDataTable.addColumn('number', 'Reaction');

    // here is where you need to get all the data out of the arg in a loop.
    // should be an array of strings.
    //reactionDataTable.addRows(reactionData);
    reactionDataTable.addRows( reactionDataReduced );

    // set the chart handle
    var table = new google.visualization.Table(document.getElementById('table_div'));

    //var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
    table.draw(reactionDataTable, {showRowNumber: true, width: '100%', height: '100%', paging: true});

  }

  function drawTable() {
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Name');
          data.addColumn('number', 'Salary');
          data.addColumn('boolean', 'Full Time Employee');
          data.addRows([
            ['Mike',  {v: 10000, f: '$10,000'}, true],
            ['Jim',   {v:8000,   f: '$8,000'},  false],
            ['Alice', {v: 12500, f: '$12,500'}, true],
            ['Bob',   {v: 7000,  f: '$7,000'},  true]
          ]);

          var table = new google.visualization.Table(document.getElementById('table_div'));

          table.draw(data, {showRowNumber: true, width: '100%', height: '100%', paging: true});
        }

});
