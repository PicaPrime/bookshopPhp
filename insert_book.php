<!DOCTYPE html>
<html>
<head>
	<title>Insert Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body class="bg-dark text-white m-auto container">
	<h1 class="text-primary mt-5">Insert New Book</h1>
	<form class="text-primary " style="font-size: large;" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label class="mt-3" for="title">Title:</label>
		<input class="" type="text" name="title" required>
		<br>
		<label for="author" class="mt-3">Author:</label>
		<input type="text" name="author" required>
		<br>
		<label for="publisher" class="mt-3">Publisher:</label>
		<input type="text" name="publisher" required>
		<br>
		<label for="price" class="mt-3">Price:</label>
		<input type="number" name="price" step="0.01" min="0" required>
		<br>
		<label for="category" class="mt-3">Category:</label>
		<select name="category" id="category" required>
			<option value="">Select a category</option>
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
		<br>
		<label for="genres" class="mt-3">Genres:</label>
		<input type="text" name="genres">
		<br>
		<input class="mt-3 btn btn-primary" type="submit" name="submit" value="Submit">
	</form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<?php
	include 'db_connection.php';

	if (isset($_POST['submit'])) {
		$title = $_POST['title'];
		$author = $_POST['author'];
		$publisher = $_POST['publisher'];
		$price = $_POST['price'];
		$category_id = $_POST['category'];
		$genres = $_POST['genres'];

		$sql = "INSERT INTO books (title, author, publisher, price, category_id, genres) VALUES ('$title', '$author', '$publisher', $price, $category_id, '$genres')";

		if (mysqli_query($conn, $sql)) {
			echo "Book inserted successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}

	mysqli_close($conn);
?>
