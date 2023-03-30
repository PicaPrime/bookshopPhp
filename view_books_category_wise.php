<!DOCTYPE html>
<html>
<head>
	<title>View Books Category Wise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="bg-dark text-white container">

	<h1 class="mt-4">List of Books Category Wise</h1>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label for="category" class="">Select Category:</label>
		<select name="category" id="category" class="bg-dark text-white m-3 rounded border border-primary">
			<option value="0">All Categories</option>
			<?php include 'db_connection.php';
				$sql = "SELECT * FROM categories";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
					}
				}
			?>
		</select>
		<input type="submit" name="submit" value="Submit" class="bg-primary rounded-pill text-white border border-dark">
	</form>
	<table class='table table-dark table-hover table-bordered border-primary mt-4 '>
		<tr>
			<th>Title</th>
			<th>Author</th>
			<th>Publisher</th>
			<th>Price</th>
			<th>Category</th>
			<th>Genres</th>
		</tr>
		<?php 
			if (isset($_POST['submit'])) {
				$category_id = $_POST['category'];
				if ($category_id == 0) {
					$sql = "SELECT * FROM books b JOIN categories c ON b.category_id = c.category_id";
				} else {
					$sql = "SELECT * FROM books b JOIN categories c ON b.category_id = c.category_id WHERE b.category_id = $category_id";
				}
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>" . $row['title'] . "</td>";
						echo "<td>" . $row['author'] . "</td>";
						echo "<td>" . $row['publisher'] . "</td>";
						echo "<td>" . $row['price'] . "</td>";
						echo "<td>" . $row['category_name'] . "</td>";
						echo "<td>" . $row['genres'] . "</td>";
						echo "</tr>";
					}
				} else {
					echo "<tr><td colspan='6'>No books found</td></tr>";
				}
			}
		?>
	</table>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
