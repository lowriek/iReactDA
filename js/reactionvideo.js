$(document).ready(function() {

  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart']});

  var emojiNum = [];
  emojiNum["🙁"] = -1;
  emojiNum["😐"] = 0;
  emojiNum["🙂"] = 1;

  var reactionData = [];
  var reactionNow;    // current reaction for sampling
  var collecting;
  var timeCount;

  // Setup for collecting reactions
  collectionInit();

  // Record Reaction Interface Handlers
  var $listItems = $('li');
  $listItems.on('mouseover', function(event) {
    reactionNow = emojiNum[$(this).text()];
    $(this).addClass('active');
  });

  $listItems.on('mouseout', function(event) {
    $(this).removeClass('active');
  });

  // Video Handlers
  var v = document.getElementsByTagName('video')[0];

  v.addEventListener('timeupdate',function(e){
    if ( collecting ) {
        reactionData.push([timeCount++, reactionNow]);
    }
  },false);

  // when the video ends, show the collected reactions.
  v.addEventListener('ended',function(e){
    collectionEnd();
    drawChart(reactionData);
  },false);

  // Button handlers for display interface
  $("#morereacting").on('click', function (){
    collectionInit();
  });

  $("#savereactions").on('click', function (){
    var reactionId = $("#reactionId").val();
    savereactions(reactionId);
  });

  // Helpers
  function savereactions(idstr) {
    //alert ("test" + JSON.stringify(reactionData));
    var myurl = "php/savereactions.php?idstr=" + idstr;
    console.debug("ajax url:  " + myurl );

    var request = $.ajax({
      url: myurl,
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

  // Google chart jazz... just shows the current set of reactions
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

  function collectionInit(){
    reactionNow = 0;
    collecting = true;
    reactionData.length = 0;
    timeCount = 0;

    recordInterface();
  }

  function collectionEnd(){
    collecting = false;

    displayInterface();
  }

  function recordInterface(){
    $("#recordreactioninterface").show();
    $("#displayreactioninterface").hide();
  }

  function displayInterface(){
    $("#recordreactioninterface").hide();
    $("#displayreactioninterface").show();
  }

});
