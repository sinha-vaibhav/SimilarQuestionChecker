<html>
<head>
  <title>Oxigen Question Finder</title>
</head>
<body>
  <p>
    <h1>Oxigen Question Finder Client</h1>

    <?php

    $check = "Yes PHP is working";
    echo $check."<br>";


    ?>


    <form action="question.php" method="post">
      Question: <input type="text" name="question"><br>
      <input type="submit">
    </form>
  </p>
</body>
</html>