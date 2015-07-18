  <?php

  class ConnectionFactory {

    private $username = "root";
    private $password = "123";
    private $hostname = "localhost";
    private $dbhandle;

    function __construct() {





    }

    function experiment() {

      $this->dbhandle = mysql_connect($this->hostname, $this->username, $this->password);

      $selected = mysql_select_db("oxigen",$this->dbhandle); 
      //or die("Unable to connect to MySQL");
      echo "Connected to MySQL<br>";
      
    //or die("Could not select examples");

      $file = "QuestionsTestData.txt";
      $contents = file_get_contents($file);
      $lines = explode("\n", $contents); 

      foreach($lines as $word)
      {
        $word = mysql_real_escape_string($word);
        $q = "INSERT INTO `QuestionInfo` (`QuestionID`, `Question`) VALUES 
        ('', '$word')";
        $result = mysql_query($q);
        if ($result == true) {
          echo("Fateh<br>");
        } else {
          echo('failure'.$q."<br>");

        }
        


      }
    }

    function getScore($question, $ques)
    {
      $score = 0;
      //echo $question."=====".$ques."<br>";
      $question = strtolower($question);
      $ques = strtolower($ques);

      $question = str_replace("?"," " ,$question);
      $ques = str_replace("?"," " ,$ques);

      $question = str_replace("."," " ,$question);
      $ques = str_replace("."," " ,$ques);

      $token = strtok($question, " ");

      

      $token2 = strtok($ques, " ");
      while ($token2 !== false)
      {
        $factory[$token2] = true;
        $token2 = strtok(" ");
      } 
      $token = strtok($question," ");
      while ($token !== false)
      {
        if(array_key_exists($token,$factory)) {
          $score+=strlen($token);
          //echo "Kya baat hai<br>";
        }
        $token = strtok(" ");
      }
      //echo $score.$question."=====".$ques."<br>";

      return $score;
      
    } 


    function getCloseQuestions($question) {

      $this->dbhandle = mysql_connect($this->hostname, $this->username, $this->password);

      $selected = mysql_select_db("oxigen",$this->dbhandle); 


      $result = mysql_query("SELECT * FROM QuestionInfo");


      while ($row = mysql_fetch_array($result)) {

        $qID = $row{'QuestionID'};
        $ques = $row{'Question'};
        //echo "ID:".$row{'QuestionID'}." Question:".$row{'Question'}."<br>";
        $score = $this->getScore($question,$ques);
        if($score>1)
        $scores[$qID] = $score;
      }
      if(isset($scores)) {
      arsort($scores);
      echo "<h1> Similar Questions are </h1>";
      foreach ($scores as $key => $value) {

        $result = mysql_query("SELECT * FROM QuestionInfo WHERE QuestionID='$key'");
        $row = mysql_fetch_array($result); 
        $qID = $row{'QuestionID'};
        $ques = $row{'Question'};
        echo "Question:".$row{'Question'}."<br>";

      }
    }


       


      mysql_close($this->dbhandle);
    }


  }




  ?>