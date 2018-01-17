<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
</head>
<body>
  <div class="container">
    <div id="chatbox">
      <p>Hallo wereld</p>
    </div>
    <form id="form" method="post" enctype="multipart/form-data" class="fixed-bottom" action="post.php">
      <div class="form-inline">
        <input type="text" name="mykey" placeholder="Enter Name" class="form-control col m-3">
        <input type="text" name="message" placeholder="Enter Message" class="form-control col m-3">
        <input type="submit" class="btn btn-primary ml-auto col-auto mr-3"></input>
      </div>
    </form>
  </div>
  <script src="node_modules/jquery/dist/jquery.js"></script>
  <script src="jqueryAJAX.js"></script>
</body>
</html>
