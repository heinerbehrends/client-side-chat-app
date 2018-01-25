$(function() {
  window.number_of_messages = 0;
  function checkNewMessages() {
    $.ajax({
      method: "GET",
      url: "api.php?minumid=0",
    }).done(function(data) {
      var updated_number_of_messages = data.length;
      if (updated_number_of_messages != number_of_messages) {
        for (var i = number_of_messages; i<updated_number_of_messages; i++) {
          var message = data[i].value;
          var user = data[i].mykey;
          var post = makePost(user, message);
          $("#chatbox").append(post);
        }
        // Scroll to the bottom of the page after adding new stuff
        $('#chatbox').animate({
          scrollTop: $('#chatbox').get(0).scrollHeight
        }, 10);
        // Update the number_of_messages variable to represent the current state
        number_of_messages = updated_number_of_messages;
      }
    });
  }
  // Call checkNewMessages once and then every 3 seconds
  checkNewMessages();
  window.setInterval(function() {checkNewMessages()}, 3000);

  // function to merge markup and variables
  function makePost(userName, message) {
    return '<p class="ml-3">' + userName + ' wrote: <strong>' + message + '</strong></p>'
  }
  // save the form data of the login screen in global variable and hide the modal
  var loginForm = $("#login-form");
  loginForm.submit(function(event) {
    event.preventDefault();
    window.user_name = loginForm.serializeArray();
    $("#overlay").addClass("hidden");
  })
  // save the message and merge it with the username
  var messageForm = $("#message-form");
  messageForm.submit(function(event) {
    event.preventDefault();
    var form_data = $(this).serializeArray();
    form_data = user_name.concat(form_data);
    console.log(form_data);
    //
    $.ajax({
      method: "PUT",
      url: "api.php",
      data: form_data,
      success: function(data) {
        console.log(data);
        // update the state of number_of_messages
        number_of_messages++;
        // parse the JSON data
        // var data = data;
        $('#chatbox').append(makePost(data.user, data.message));
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

  function makeUploadPost(userName, link, fileName) {
    return '<p class="ml-3">' + userName + ' uploaded <a href =' + link + '>' + fileName + '</a></p>'
  }

  var fileForm = $("#file-form");
  fileForm.submit(function(event) {
    event.preventDefault();
    var fileInput = $("#file-input");
    var fileFormData = new FormData;
    fileFormData.append("fileToUpload", fileInput[0].files[0]);
    fileFormData.append("userName", user_name[0].value);
    console.log(fileFormData.getAll("userName")[0]);
    $.ajax({
      method: "POST",
      url: "upload.php",
      processData: false,
      contentType: false,
      data: fileFormData,
      success: function(data) {
        console.log(data);
      },
      error: function(data) {
        console.log("An error occured");
        console.log(data);
      }
    })
  })

  // get messages from DB
  function getMessages() {
    $.ajax({
      method: "GET",
      url: "api.php?minimumid=0",
    }).done(function(data) {
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
});
