
<?php include 'db.php';
if(isset($_POST['submit'])){
    $headline = $_POST['headline'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');
    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 1000000){
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $sql = "INSERT INTO posts (headlines, description, category_id, published_by,image) VALUES ('$headline', '$description', $category, 1,'$fileNameNew')";
                if($conn->query($sql) === TRUE){
                    echo "Post added successfully";
                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }else{
                echo "Your file is too big!";
            }
        }else{
            echo "There was an error uploading your file!";
        }
    }else{
        echo "You cannot upload files of this type!";
    }
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Post</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
  <div class="container mt-5">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8"><h2 class="mb-4">Create New Post</h2>
    <form action="" method="POST" enctype="multipart/form-data">
      <!-- Post Headline -->
      <div class="mb-3">
        <label for="postHeadline" class="form-label">Post Headline</label>
        <input type="text" class="form-control" id="postHeadline" name="headline" placeholder="Enter post headline" required>
      </div>

      <!-- Description -->
      <div class="mb-3">
        <label for="postDescription" class="form-label">Description</label>
        <textarea class="form-control" id="postDescription" name="description" rows="4" placeholder="Enter post description" required></textarea>
      </div>

      <!-- Category -->
      <div class="mb-3">
        <label for="postCategory" class="form-label">Category</label>
        <select class="form-select" id="postCategory" name="category" required>
          <option value="" selected disabled>Select a category</option>
          <?php

$cat = "SELECT * FROM categories";
$categories = $conn->query($cat);

// Check if the query was successful
if ($categories && $categories->num_rows > 0) {
    // Loop through each post
    while ($categorie = $categories->fetch_assoc()) {

        // Output the post data
        echo "<option value='{$categorie['category_id']}'>{$categorie['cate_name']}</option>";
    }}
        ?>
          
        </select>
      </div>

      <!-- File Upload -->
      <div class="mb-3">
        <label for="postFile" class="form-label">Upload File</label>
        <input type="file" class="form-control" id="postFile" name="file" accept="image/*,application/pdf" required>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary" name="submit">Submit Post</button>
    </form></div>
    <div class="col-md-2"></div>
  </div>
    
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
