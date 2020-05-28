$(document).ready(function() {

  //todo - get reactions for a specific collection
  var reactionData = [];

  var myurl = "php/retrievereactions.php?collectionID=" + $("#currentcollectionID").html();

  $("#currentcollectionID").hide();

  $.get(myurl, function(data, status){
      reactionData = JSON.parse( data );
  });

  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  // Only draw the chart after the data is collected
  google.charts.setOnLoadCallback( drawChart );


  function drawChart() {
    var reactionDataTable = new google.visualization.DataTable();

    // handle the column names from the first row
    for(var i=0;i<reactionData[0].length;i++){
      reactionDataTable.addColumn('number', reactionData[0][i]);
    }

    // get each row of data
    for(var i=1; i < reactionData.length - 1; i++){
          reactionDataTable.addRow(reactionData[i]);
    }

    var options = {
      title: 'Reactions over Time',
      curveType: 'function',
      legend: { position: 'bottom' },
    };
    // set the chart handle
    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

    //var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
    chart.draw(reactionDataTable, options);
  }


});
