<html>
<head>
	<title>Oxigen Question Finder Client</title>
</head>
<body>
	<p>
		<h1>Oxigen Question Finder Client</h1>

		<?php

		
		//phpinfo();

		require 'ConnectionFactory.php';

		$question = $_POST["question"];
		echo $question."<br>";
		$client = new ConnectionFactory();
		//$client->experiment();
		$client->getCloseQuestions($question);



		?>


	</p>
</body>
</html>