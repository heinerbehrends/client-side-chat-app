$(function() {
  var number_of_messages = false;
  function checkNewMessages() {
    $.ajax({
      method: "GET",
      url: "get.php",
    }).done(function(data) {
      console.log("done");
      var updated_number_of_messages = data.length;
      if (updated_number_of_messages != number_of_messages) {
        console.log("new");
        $.each(data, function(key, value) {
          // create variables for makePost()
          var message = value['value'];
          var user = value['mykey'];
          var post = makePost(user, message);
          // insert  table into #records
          $("#chatbox").append(post);
        });
        $('#chatbox').animate({
          scrollTop: $('#chatbox').get(0).scrollHeight
        }, 10);
      }
      number_of_messages = updated_number_of_messages;
    });
  }
  window.setInterval(function() {checkNewMessages()}, 3000);


  function makePost(mykey, value) {
    return '<p class="ml-3">' + mykey + ' wrote: <strong>' + value + '</strong></p>'
  }

  var form2 = $("#form2");
  form2.submit(function(event) {
    event.preventDefault();
    window.form_data2 = form2.serializeArray();
    console.log(form_data2);
    $("#overlay").addClass("hidden");
  })

  console.log("hello");
  var form = $("#form");
  form.submit(function(event) {
    event.preventDefault();
    var form_data = $(this).serializeArray();
    console.log(form_data);
    form_data = form_data2.concat(form_data);
    // console.log(form_data);
    $.ajax({
      method: "POST",
      url: form.attr('action'),
      data: form_data,
      success: function(data) {
        var parsed = JSON.parse(data);
        $('#chatbox').append(makePost(parsed.user, parsed.message));
        $('#chatbox').animate({
          scrollTop: $('#chatbox').get(0).scrollHeight
        }, 10);
        $("#message").val("");
      },
      error: function(data) {
        console.log("An error occured");
      }
    })
  })
  //test
  // console.log(JSON.parse('[1, 5, "false"]'));
  // get messages from DB
  function getMessages() {
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
        $('#chatbox').animate({
          scrollTop: $('#chatbox').get(0).scrollHeight
        }, 10);

      });
    });
  }
  getMessages();
});
