<?php
	$conn = new mysqli('127.0.0.1', 'eventos_unipampa', 'Super_segura', 'eventos');
	if($conn->connect_error){
		echo "Erro ao conectar ao banco de dados" . $conn->connect_error . PHP_EOL;
	}

	$sql = "SELECT code FROM eventos";
	$query = $conn->query($sql);

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$sql2 = "SELECT * FROM presenca_evento WHERE code='" . $_POST['codigo'] . "'";
		$query2 = $conn->query($sql2);
	}
?>

<form method="POST" action=''>
	Visualizar evento:<br>
	<select name='codigo'>
	<option value='Selecione'>Selecione...<option>
	<?php while($row = $query->fetch_assoc()) {?>
		<option value='<?php echo $row['code']; ?>'><?php echo $row['code'];?></option>
    	<?php }?>

    	<input type='submit' value='Submit'>
</form>

<hr>

<?php if(isset($query2) && $query2->num_rows > 0) {?>
	<h1>Lista de Presença</h1>
	<table border='1'>
		<tr>
			<th>ID</th>
			<th>Código</th>
			<th>Nome</th>
			<th>E-mail</th>
			<th>Matrícula</th>
		</tr>
		<?php while($row = $query2->fetch_assoc()) {?>
		<tr>
			<td><?php echo $row['id'];?></td>
			<td><?php echo $row['code'];?></td>
			<td><?php echo $row['nome'];?></td>
			<td><?php echo $row['email'];?></td>
			<td><?php echo $row['matricula'];?></td>
		<?php }?>
	</table>
<?php }?>
