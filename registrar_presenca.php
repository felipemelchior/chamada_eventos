<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "Nome => " . $_POST['nome'] . PHP_EOL;
        echo "Email => " . $_POST['email'] . PHP_EOL;
        echo "Matricula => " . $_POST['matricula'] . PHP_EOL;

        if(isset($_GET['e'])) {
            $conn = new mysqli('127.0.0.1', 'eventos_unipampa', 'Super_segura', 'eventos');

            if($conn->connect_error){
                echo "Erro ao conectar ao banco de dados" . $conn->connect_error . PHP_EOL;
	    }

	    $sql = "INSERT INTO presenca_evento (code, nome, matricula, email) VALUES('" . $_GET['e'] . "','" . $_POST['nome'] . "','" . $_POST['matricula'] . "','" . $_POST['email'] . "');"; 
	    if($conn->query($sql)) {
	  	echo "Presença registrada com sucesso!" . PHP_EOL;
            } else {
	    	echo "Erro ao registrar a presença! => " . $conn->error . PHP_EOL;
	    }
        } else {
            echo "Falta o código do evento!";
        }
    }
?>


<form method="POST" action=''>
    Nome Completo:<br>
    <input type='text' name='nome'><br>
    E-mail:<br>
    <input type='email' name='email'><br>
    Matrícula:<br>
    <input type='text' name='matricula'><br><br>
    <input type='submit' value='Submit'>
</form>
