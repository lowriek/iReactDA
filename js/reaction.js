$(document).ready(function() {

  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  // Only draw the chart after the data is collected
  //google.charts.setOnLoadCallback( drawChart );

  var reactionData = [];
  var $listItems = $('li');
  var reactionNow = 0;

  $("#currentreaction").hide();
  $("#chartreaction").hide();
  $("#morereacting").hide();

  //kbl todo get from db
  var collecting = true;

  setInterval(function(){
    if (collecting == true)
      reactionData.push([Date.now(), reactionNow]);
  }, 100);

  $listItems.on('mouseover', function(event) {
    reactionNow = emojitonum($(this).text());
    $(this).addClass('active');
  });

  $listItems.on('mouseout', function(event) {
    $(this).removeClass('active');
  });

  // Should be an associative array but I like the alert, kbl todo add configurable
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

  $("#donereacting").on('click', function (event){
      event.preventDefault();
      reactionData.forEach ( function(r){
          $("#myreaction").append("<li class=\"list-group-item\"> [" + r[0] + ", " + r[1] + "]</li>");
      });

      drawChart(reactionData);

      $("#currentreaction").hide();
      $("#chartreaction").show();
      $("#morereacting").show();
      $("#recordreaction").hide();

  });

  $("#morereacting").on('click', function (){

    savereactions();

    reactionData.length = 0;

    $("#currentreaction").hide();
    $("#chartreaction").hide();
    $("#morereacting").hide();
    $("#recordreaction").show();

  });

  function savereactions() {
    //alert ("test" + JSON.stringify(reactionData));

    var request = $.ajax({
      url: "php/savereactions.php",
      type: "post_max_size",
      dataType: "text",
      //contentType: 'application/json',
      data: JSON.stringify(reactionData)
    });

    request.done ( function( data ) {
      alert("Request complete:" + data);
    });

    request.fail (function(jqXHR, textStatus) {
      alert( "Request failed: " + textStatus );
    });
  }


  function drawChart(reactionData) {
    var reactionDataTable = new google.visualization.DataTable();
    reactionDataTable.addColumn('number', 'Time');
    reactionDataTable.addColumn('number', 'Reaction');
    reactionDataTable.addRows(reactionData);

    var options = {
      title: 'Reactions over Time',
      curveType: 'function',
      width: 900,
      height: 500,
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
