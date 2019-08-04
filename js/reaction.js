$(document).ready(function() {

  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  //google.charts.setOnLoadCallback( drawChart );

  var reactionData = [];
  var $listItems = $('li');

  $("#currentreaction").hide();
  $("#chartreaction").hide();
  $("#morereacting").hide();

  $listItems.on('mouseover', function(event) {
    //alert ("val is  " + $(this).text());

    reactionData.push([event.timeStamp, emojitonum($(this).text())]);
    $(this).addClass('active');
  });

  function emojitonum(val){
    switch(val){
      case "🙂":
        return 1;
      case "😐" :
        return 0;
      case "🙁" :
        return -1;
      default:
            alert ("bad val " + val);
    }
  }

  $listItems.on('mouseout', function(event) {
    $(this).removeClass('active');
  });

  $("#donereacting").on('click', function (){
      reactionData.forEach ( function(r){
        $("#myreaction").append("<li class=\"list-group-item\"> [" + r[0] + ", " + r[1] + "]</li>");
    });
    // for ( var i=0; i<10; i++){
    //   reactionData.push([i, 0]);
    // }
    drawChart(reactionData);

    $("#currentreaction").hide();
    $("#chartreaction").show();
    $("#morereacting").show();
    $("#recordreaction").hide();

  });

  $("#morereacting").on('click', function (){

    $("#currentreaction").hide();
    $("#chartreaction").hide();
    $("#morereacting").hide();
    $("#recordreaction").show();

  });

  function drawChart() {
    var reactionDataTable = new google.visualization.DataTable();
    reactionDataTable.addColumn('number', 'Time');
    reactionDataTable.addColumn('number', 'Reaction');
    reactionDataTable.addRows(reactionData);

    var options = {
      title: 'Reactions over Time',
      hAxis: {title: 'Time', minValue: 50, maxValue: 250},
      vAxis: {title: 'Reaction', minValue: -1, maxValue: 1},
      legend: 'none'
    };
    // set the chart handle
    var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
    chart.draw(reactionDataTable, options);
  }

});
