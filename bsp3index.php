<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>index</title>
		<style></style>
	</head>
	<body>
		<div class="container">
			<?php 
					$host = 'localhost';
					$dbname = 'classicmodels';
					$user = 'root';
					$pwd = '';
					try {
						$db = new PDO ( "mysql:host=$host;dbname=$dbname", $user, $pwd);
					}
					catch (PDOException $e) {
						echo "<strong>PDO Exception aufgetreten.</strong><br>";
						echo $e->getMessage();
						echo "<br><br><strong>Datenbankzugriff nicht erfolgreich.</strong>";
						$db = false;
						exit();
					}
					if (isset($_GET['page']) && $_GET['page'] > 0)
						$page = $_GET['page'];
					else
						$page = 1;
					
					if (isset($_GET['count']) && $_GET['count'] > 0)
						$count = $_GET['count'];
					else
						$count = 20;
					
					$lowlimit = $count * ($page - 1);
					$query = $db->query("SELECT count(customerNumber)/$count FROM customers");
					$maxval = ceil($query->fetch()[0]);
					$query = $db->query("SELECT customerNumber,customerName,city FROM customers LIMIT $lowlimit,$count");
				?>
			<table class="table table-hover">
				<th>Customer Nummer</th>
				<th>Customer Name</th>
				<th>Stadt</th>
				<?php
					foreach ($query->fetchAll(PDO::FETCH_OBJ) as $item) {
				?>
					<tr>
						<td><?php echo $item->customerNumber; ?></td>
						<td><?php echo $item->customerName; ?></td>
						<td><?php echo $item->city; ?></td>
					</tr>
				<?php
					}
				?>
			</table>
			<p style="text-align:center;font-size:150%"><a href="index.php?page=1&count=<?php echo $count; ?>"><<</a>
			<a href="index.php?page=<?php echo $page-1; ?>"><</a><?php echo " ".$page;?>
			<a href="index.php?page=<?php echo $page+1; ?>">></a>
			<a href="index.php?page=<?php echo $maxval; ?>">>></a></p>
		</div>
	</body>
</html>
