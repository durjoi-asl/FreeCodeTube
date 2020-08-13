"use strict"

$(document).ready(function(){
  $('#videoLike').click(function(e) {
    let video_id = $(this).attr('data');

    console.log(video_id);

    $.ajax({
        type: 'POST',
        url: "/video/like?id="+video_id,
        data: {
          "type": '1',
        },
        success: function(response){
          console.log(response);
        }
    });
  });
});
