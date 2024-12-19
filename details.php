<?php
include 'db.php';

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
   
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./src/output.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap"
      rel="stylesheet">
  <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
  <title>Details</title>
</head>
<body>
<header class="bg-white">
        <nav class="flex justify-between items-center w-[92%]  mx-auto">
            <div class="mt-1">
                <img class="w-16 cursor-pointer rounded-xl" src="./img/logo.png" alt="...">
                <p class="text-purple-600">Nothing True Here</p>
            </div>
            <div
                class="nav-links duration-500 md:static absolute bg-white md:min-h-fit min-h-[60vh] left-0 top-[-100%] md:w-auto  w-full flex items-center px-5">
                <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8">
                    <?php
                     $sql = "SELECT * FROM categories";
                        $result = $conn->query($sql);
                     if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){?>
                    <li>
                        <a class="hover:text-gray-500" href="list.php?id=<?php echo $row['category_id']?>"><?php echo $row['cate_name']?></a>
                    </li>
                    <?php
                        } }
                    ?>
                  
                </ul>
            </div>
            <div class="flex items-center gap-6">
                <button class="bg-[#a6c1ee] text-white px-5 py-2 rounded-full hover:bg-[#87acec]">Sign in</button>
                <ion-icon onclick="onToggleMenu(this)" name="menu" class="text-3xl cursor-pointer md:hidden"></ion-icon>
            </div>
</header>
<div class="m-2 p-4 flex flex-row gap-6">
    <!-- Main Content -->
    <div class="w-3/5">
        <h1 class="text-3xl font-bold"><?php echo $post['headlines']; ?></h1>
        <h3 class="text-gray-600 text-sm font-semibold mt-1">Category: <i><?php echo $category['cate_name']; ?></i></h3>
        <img class="mt-4 rounded-lg shadow-md w-96 h-80" src="./uploads/<?php echo $post['image']; ?>" alt="Post Image">
        <p class="mt-4 text-gray-700"><?php echo $post['description']; ?></p>
    </div>

    <!-- Sidebar -->
    <div class="">
        <h3 class="text-2xl font-bold mb-2">More About <?php echo $category['cate_name']; ?></h3>
        <ul class="list-disc ml-4 text-gray-600">
            <?php foreach($more_result as $key=>$val){
                $more_headlines = $val['headlines'];
                $id = $val['post_id'];
                if($id == $post['post_id']){ 
                    echo "";
                }else{?>
                    <li><a href="details.php?id=<?php echo $id?>" class="text-blue-600 hover:underline"><?php  echo $more_headlines; ?></a></li>

               <? ?>
            
            <?php }}?>
        </ul>
    </div>
</div>
<script>
        const navLinks = document.querySelector('.nav-links')
        function onToggleMenu(e){
            e.name = e.name === 'menu' ? 'close' : 'menu'
            navLinks.classList.toggle('top-[9%]')
        }
    </script>
</body>
</html>