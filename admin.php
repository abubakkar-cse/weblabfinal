<?php
// Include database connection
include 'db.php';

// Fetch posts with category name and publisher name
$sql = "
    SELECT posts.headlines,posts.post_id, categories.cate_name AS category, users.name AS publisher_name
    FROM posts
    LEFT JOIN categories ON posts.category_id = categories.category_id
    LEFT JOIN users ON posts.published_by = users.id
";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Control Panel</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo_details">
            <i class='bx bxs-cube-alt'></i>
            <span class="logo_name">Inventory App</span>
        </div>
        <ul class="main-links">
            <li>
                <a href="">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link-name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <div class="icon-link">
                    <a href="">
                        <i class='bx bx-user-plus'></i>
                        <span class="link-name">Posts</span>
                    </a>
                    <i class='bx bx-chevron-right' id="arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link-name" href="">Posts</a></li>
                    <li><a href="addpost.php">Add New</a></li>
                    <li><a href="#">Delete </a></li>
                    <li><a href="#">Edit</a></li>
                </ul>
            </li>
            <li>
                <a href="">
                    <i class='bx bx-door-open'></i>
                    <span class="link-name">Roles & Permissions</span>
                </a>
                <span class="tooltip">permissions</span>
            </li>
            
        </ul>
        <hr>
        <ul class="nav-links">
            <li>
                <a href="addpost.php">
                    <i class='bx bx-credit-card-front'></i>
                    <span class="link-name">Post</span>
                </a>
                 <span class="tooltip">Post</span>
            </li>
            <li>
                <a href="">
                    <i class='bx bxs-report' ></i>
                    <span class="link-name">Invoice</span>
                </a>
                 <span class="tooltip">Invoice</span>
            </li>
            <li>
                <a href="">
                    <i class='bx bx-cart-alt'></i>
                    <span class="link-name">Cart</span>
                </a>
                 <span class="tooltip">Cart</span>
            </li>
            <li>
                <a href="">
                    <i class='bx bx-cabinet'></i>
                    <span class="link-name">Stocks</span>
                </a>
                 <span class="tooltip">Stocks</span>
            </li>
            <li>
                <a href="">
                    <i class='bx bx-user'></i>
                    <span class="link-name">Users</span>
                </a>
                 <span class="tooltip">Users</span>
            </li>
        </ul>
    </div>

    <div class="main-content">
    <h2 class="mb-4">Posts Table</h2>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Headlines</th>
                    <th>Category</th>
                    <th>Published By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars(substr($row['headlines'], 0, 30)); ?></td>
                            <td><?php echo htmlspecialchars($row['category']); ?></td>
                            <td><?php echo htmlspecialchars($row['publisher_name']); ?></td>
                            <td><a href="editpost.php?id=<?php echo $row['post_id']?>" class="btn btn-primary">Edit</a></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="3" class="text-center">No posts found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>