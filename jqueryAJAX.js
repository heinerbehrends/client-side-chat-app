$(function() {

  function makePost(mykey, value) {
    return "<p>" + mykey + " wrote: <strong>" + value + "</strong></p>"
  }

  console.log("hello");
  var form = $("#form");
  form.submit(function(event) {
    event.preventDefault();
    var form_data = form.serializeArray();
    console.log(form_data);
    $.ajax({
      method: "POST",
      url: form.attr('action'),
      data: form_data,
      success: function(data) {
        var parsed = JSON.parse(data);
        $('#chatbox').append(makePost(parsed.user, parsed.message));
      },
      error: function(data) {
        console.log("An error occured");
      }
    })
  })
  //test
  // console.log(JSON.parse('[1, 5, "false"]'));
  // get messages from DB
  $.ajax({
    method: "GET",
    url: "get.php",
  }).done(function(data) {
    // console.log(data);
    // save result in global variable
    // window.result = JSON.parse(data);
    // create the cards in a loop
    $.each(data, function(key, value) {
      // create variables for makePost()
      var message = value['value'];
      var user = value['mykey'];
      var post = makePost(user, message);
      // insert  table into #records
      $("#chatbox").append(post);
    });
  });
})
