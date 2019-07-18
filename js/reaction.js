$(document).ready(function() {

    var $listItems = $('li');
    var reactionData = [];

    $("#displayreaction").hide();
    $("#currentreaction").hide();

    $listItems.on('mouseover', function(event) {
      $(this).addClass('active');
      var r = { "reactiontext":$(this).text(), "happenedat":event.timeStamp};
      reactionData.push(r);
      //$("#myreaction").append("<li>" + r.reactiontext + " " + r.happenedat + "</li>");
      //recordReaction($(this).text(), event.timeStamp);
    });

    $listItems.on('mouseout', function(event) {
      $(this).removeClass('active');
    });

    $("#donereacting").on('click', function (){
        reactionData.forEach ( function(r){
        $("#myreaction").append("<li class=\"list-group-item\"> { x:" + r.happenedat + ", y: " + r.reactiontext + "}</li>");
        $("#displayreaction").show();
        $("#currentreaction").show();
      });
    });

    function recordReaction(reactiontext, timeduration){
      var r = { "reactiontext":reactiontext, "happenedat":timeduration};
      reactionData.push(r);
      //$("#myreaction").append("<li>" + r.reactiontext + " " + r.happenedat + "</li>");
    }


});
