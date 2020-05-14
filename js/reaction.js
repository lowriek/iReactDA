$(document).ready(function() {

  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  // Only draw the chart after the data is collected
  //google.charts.setOnLoadCallback( drawChart );

  var reactionData = [];
  var $listItems = $('li');
  var reactionNow = 0;    // current reaction for sampling
  var collecting = true;

  // hide everything until collection is enabled.
  //$("#recordreactioninterface").hide();
  $("#displayreactioninterface").hide();

  //updateCollection();
  //  every 10 seconds, check to see if collection has been enabled or disabled.
  // setInterval( updateCollection(), 10000 );
  //
  // function updateCollection (){
  //   $.ajax({url: "php/iscollectionenabled.php", success: function( data ){
  //       $("#currentcollection").text(data);
  //       collecting = !(data.startsWith("Error:"));
  //       if (collecting)
  //         $("#recordreactioninterface").show();
  //       else
  //         $("#recordreactioninterface").hide();
  //
  //       alert(data + " collecting is " + collecting);
  //
  //     }
  //   });
  // }

  // collect reactions by sampling every tenth of a second
  // setInterval(function(){
  //   if ( collecting ) {
  //     reactionData.push([Date.now(), reactionNow]);
  //   }
  // }, 100);

  // Setup for reactions collection from a video (not live)
  var count = 0;
  $("#vidstat")= "haven't started yet ";

  $('video').on('timeupdate',function(e){
    // t.innerHTML = parseInt(v.currentTime) + ' - ' + v.currentTime;
    $(#vidtime) = count++ + " " + v.duration + " " + reactionNow;

    if ( collecting ) {
        reactionData.push([count, reactionNow]);
        console.debug("rd: " + count + ","+ reactionNow );
    }
  },false);

  $('video').on('ended',function(e){
    console.debug("video ended");


    $("#vidstat")= "all done! ";
    $("#recordreactioninterface").hide();
    $("#displayreactioninterface").show();

    drawChart(reactionData);
    savereactions();
    reactionData.length = 0;
  },false);


  // Set up to get the current reaction
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
      alert("bar");

      $("#recordreactioninterface").hide();
      $("#displayreactioninterface").show();
      // reactionData.forEach ( function(r){
      //     $("#myreaction").append("<li class=\"list-group-item\"> [" + r[0] + ", " + r[1] + "]</li>");
      // });

      drawChart(reactionData);
      //savereactions();
      reactionData.length = 0;
  });

  $("#morereacting").on('click', function (){
    $("#recordreactioninterface").show();
    $("#displayreactioninterface").hide();
  });

  function savereactions() {
    //alert ("test" + JSON.stringify(reactionData));

    var request = $.ajax({
      //url: "php/savereactions.php",
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
