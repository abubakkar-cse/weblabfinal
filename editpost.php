
<?php include 'db.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM posts WHERE post_id = $id";
    $result = $conn->query($sql);
    $post = $result->fetch_assoc();
    $cat_que = "SELECT * FROM categories WHERE category_id = ".$post['category_id'];
    $cat = $conn->query($cat_que);
    $category = $cat->fetch_assoc();
    $more = "SELECT * FROM posts WHERE category_id = ".$post['category_id'];
    $more_result = $conn->query($more);
    var_dump($category);
   
}
if(isset($_POST['update'])){
    $headline = $_POST['headline'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $file = $_FILES['file'];
    $filename = $file['name'];
    $filetmp = $file['tmp_name'];
    $fileerror = $file['error'];
    $fileext = explode('.',$filename);
    $filecheck = strtolower(end($fileext));
    $fileextstored = array('png','jpg','jpeg','pdf');
    if(in_array($filecheck,$fileextstored)){
        $destinationfile = 'uploads/'.$filename;
        move_uploaded_file($filetmp,$destinationfile);
        $update = "UPDATE posts SET headlines = '$headline', description = '$description', category_id = $category, image = '$filename' WHERE post_id = $id";
        if($conn->query($update) === TRUE){
            header('Location: admin.php');
        }else{
            echo "Error: ".$conn->error;
        }
    }else{
        echo "Invalid file format";
    }
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Post</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
  <div class="container mt-5">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8"><h2 class="mb-4">Update Post</h2>
    <form action="" method="POST" enctype="multipart/form-data">
      <!-- Post Headline -->
      <div class="mb-3">

      <?php
        //fetching the post id
      ?>
        <label for="postHeadline" class="form-label">Post Headline</label>
        <input type="text" class="form-control" id="postHeadline" name="headline" value="<?php echo $post['headlines']?>" required>
      </div>

      <!-- Description -->
      <div class="mb-3">
        <label for="postDescription" class="form-label">Description</label>
        <textarea class="form-control" id="postDescription" name="description" rows="4" required><?php echo $post['description']?></textarea>
      </div>

      <!-- Category -->
      <div class="mb-3">
        <label for="postCategory" class="form-label">Category</label>
        <select class="form-select" id="postCategory" name="category" required>
          <option value="<?php echo $category['category_id']?>" selected><?php echo $category['cate_name']?></option>
         



            <?php   //fetching the categories
            $cat = "SELECT * FROM categories";
            $categories = $conn->query($cat);
            while ($categorie = $categories->fetch_assoc()) {
                if($categorie['category_id'] != $category['category_id']) {
                echo "<option value='{$categorie['category_id']}'>{$categorie['cate_name']}</option>";
                }
            }?>
  
          
        </select>
      </div>

      <!-- File Upload -->
      <div class="mb-3">
        <label for="postFile" class="form-label">Upload File</label>
        <input type="file" class="form-control" id="postFile" name="file" accept="image/*,application/pdf" required>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary" name="update">update Post</button>
    </form></div>
    <div class="col-md-2"></div>
  </div>
    
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
