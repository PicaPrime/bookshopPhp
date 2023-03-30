<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Search Book</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">






</head>

<body class="container mt-5">
	<!-- <h1 class="text-primary">Search Books</h1> -->
	<form class="text-primary h6 mb-3 form-control" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label class="h3" for="search">Search Book by Title:</label>
		<input class="mt-3 form-control" type="text" name="search" required>
		<br>
		<input class="btn btn-outline-primary"type="submit" name="submit" value="Search">
	</form>
	<?php
	include 'db_connection.php';

	if (isset($_GET['submit'])) {
		$search = $_GET['search'];

		$sql = "SELECT * FROM books WHERE title LIKE '%$search%'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			echo "<h2 class='container'>Search results:</h2>";

			echo "<table class='table table-dark table-hover table-bordered border-primary mt-4 container'  border='1'>
					<tr>
						<th>Title</th>
						<th>Author</th>
						<th>Publisher</th>
						<th>Price</th>
						<th>Category</th>
						<th>Genres</th>
					</tr>";
			while ($row = mysqli_fetch_assoc($result)) {
				$category_id = $row['category_id'];
				$sql_cat = "SELECT category_name FROM categories WHERE category_id=$category_id";
				$result_cat = mysqli_query($conn, $sql_cat);
				$row_cat = mysqli_fetch_assoc($result_cat);

				echo "<tr>
						<td>" . $row['title'] . "</td>
						<td>" . $row['author'] . "</td>
						<td>" . $row['publisher'] . "</td>
						<td>" . $row['price'] . "</td>
						<td>" . $row_cat['category_name'] . "</td>
						<td>" . $row['genres'] . "</td>
					</tr>";
			}
			echo "</table>";
		} else {
			echo "<p>No results found</p>";
		}
	}

	mysqli_close($conn);
	?>



	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>