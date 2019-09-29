$(document).ready(function() {

  //todo - get reactions for a specific collection
  var reactionData = [];

  $.get("php/retrievereactions.php", function(data, status){
      alert("Data: " + data + "\nStatus: " + status);
      reactionData = JSON.parse( data );
  });

  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  // Only draw the chart after the data is collected
  google.charts.setOnLoadCallback( drawChart );


  function drawChart() {
    var reactionDataTable = new google.visualization.DataTable();
    reactionDataTable.addColumn('number', 'Time');
    reactionDataTable.addColumn('number', 'Reaction');

    // here is where you need to get all the data out of the arg in a loop.
    // should be an array of strings.
    reactionDataTable.addRows(reactionData);

    var options = {
      title: 'Reactions over Time',
      curveType: 'function',
      //width: 900,
      //height: 500,
      legend: 'none',
      hAxis: {title: 'Time'},
      vAxis: {title: 'Reaction'}
    };
    // set the chart handle
    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

    //var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
    chart.draw(reactionDataTable, options);
  }

});
