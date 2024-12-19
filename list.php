<?php 
include 'db.php';?>


<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./src/output.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap"
      rel="stylesheet">
  <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</head>
<body class="font-[Poppins] bg-gradient-to-t from-[#fbc2eb] to-[#a6c1ee] h-screen">
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

<div class="rounded-lg p-4 m-1 sm:flex flex-wrap">
<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM posts WHERE category_id = $id";
    $result = $conn->query($sql);
   
    if($result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){?>
         

         <div class="bg-white shadow-lg rounded-sm sm:flex justify-between items-center m-1 w-full sm:w-[48%] lg:w-[32%]">
        <div class="flex flex-col justify-center">
            <div class="m-1 flex flex-row-reverse">
                <img class="max-h-32 max-w-36 " src="./uploads/<?php echo $row['image']; ?>" alt="profile">
                <h5 class="text-gray-900 px-1"><a href="details.php?id=<?php echo htmlspecialchars($row['post_id']); ?>"><?php echo substr($row['headlines'], 0, 70); ?>
                </a></h5>
            </div>
            <div class="px-1">
                <h5 class="text-gray-600 text-sm font-semibold mt-1">Editor: <i><?php
                   echo $row['published_by'] ?></i></h5>
                </i></h5>
                <p class="text-xs text-gray-500 mt-2"><?php echo substr($row['description'], 0, 230); ?>
                <a href="details.php?id=<?php echo htmlspecialchars($row['post_id']); ?>" class="hover:bg-[#87acec] underline text-xs text-red-500 mx-2 px-1">Read more >></a></p>
                
            </div>
        </div>
    </div>

       <?php }
    }
   
  
}
?>
    
       


   
   
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