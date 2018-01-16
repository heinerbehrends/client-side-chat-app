$(function() {
  console.log("hello");
  var form = $("form");
  form.submit(function(event) {
    event.preventDefault();
    var form_data = form.serializeArray();
    $.ajax({
      method: "POST",
      url: form.attr('action'),
      data: form.serialize(),
      success: function(data) {
        console.log(form_data);
      },
      error: function(data) {
        console.log("An error occured");
      }
    })
  })
})
