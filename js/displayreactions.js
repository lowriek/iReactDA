$(document).ready(function() {

  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  // Only draw the chart after the data is collected
  //google.charts.setOnLoadCallback( drawChart );

  $.get("php/retrievereactions.php", function(data, status){
      alert("Data: " + data + "\nStatus: " + status);
    });

  var foo = getallreactions();
  drawChart( foo );

    //alert ("test" + JSON.stringify(reactionData));

  function getallreactions() {
    var request = $.ajax({
      url: "php/retrievereactions.php",
		  type: "post_max_size",
		  dataType: "text",
      //contentType: 'application/json',
      data: "getalldata"
		});

    request.success ( function (data) {
      alert("Request success:" + data);
      return data;
    });

    request.done ( function( data ) {
      alert("Request done:" + data);
    });

    request.fail (function(jqXHR, textStatus) {
      alert( "Request failed: " + textStatus );
    });

    //return data;

  }


  function drawChart( data ) {
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
    //var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

    var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
    chart.draw(reactionDataTable, options);
  }

});
