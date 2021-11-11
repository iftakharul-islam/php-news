<?php
include "header.php";
include "config.php";
if (!$_SESSION['user_role'] == 1) {
    header("Location:{$host}admin/post.php");
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        $limit = 3;
                        $page = $_GET['page'] ?? 1;
                        $offset = ($page - 1) * $limit;

                        $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset},{$limit}";
                        $result = mysqli_query($conn, $sql) or die("Query Failed");
                        if (mysqli_num_rows($result) > 0) :
                            foreach ($result as $user) :
                        ?>
                                <tr>
                                    <td class='id'><?php echo $user['user_id'] ?></td>
                                    <td><?php echo $user['first_name'] . " " . $user['last_name'] ?></td>
                                    <td><?php echo $user['username'] ?></td>
                                    <td><?php echo $user['role'] == 1 ? "Admin" : "Normal"; ?></td>
                                    <td class='edit'><a href='update-user.php?id=<?php echo $user['user_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href="delete-user.php?id=<?php echo $user['user_id'] ?>"><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>

                <?php
                $sql1 = "SELECT * FROM user ";
                $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
                if (mysqli_num_rows($result1) > 0) {
                    $total_records = mysqli_num_rows($result1);

                    $total_page = ceil($total_records / $limit);
                    echo "<ul class='pagination admin-pagination'>";
                    if ($page > 1) {
                        echo "<li class=''><a style='cursor:pointer;' href='?page=" . ($page - 1) . "'>Prev</a></li>";
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($page == $i) {
                            echo "<li class='active'><a style='cursor:pointer;' href='?page={$i}'>{$i}</a></li>";
                        } else {
                            echo "<li class=''><a style='cursor:pointer;' href='?page={$i}'>{$i}</a></li>";
                        }
                    }
                    if ($total_page > $page) {
                        echo "<li class=''><a style='cursor:pointer;' href='?page=" . ($page + 1) . "'>Next</a></li>";
                    }
                    echo " </ul>";
                }
                ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "header.php"; ?>