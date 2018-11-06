<?php include "../Classes/Category.php";?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 
        if (!isset($_GET['cateditid']) || $_GET['cateditid'] == NULL ) {
           echo "<script type='text/javascript'>window.top.location='catlist.php';</script>"; 
        }else {
           $cateditid  = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['cateditid']) ;
        }
    
    $cat = new Category();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName'];

        $updateCategory = $cat->updateCategory($catName, $cateditid);
    }

 ?>




        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock" style="text-align: center;"> 
                <?php 

                    if (isset($updateCategory)) {
                        echo $updateCategory;
                    }

                 ?>
                 <?php 

                    $getCategory = $cat->getCategoryById($cateditid);
                    if ($getCategory) {
                        while ($result = $getCategory->fetch_assoc()) {
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" value="<?php echo $result['catName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php   }}else {
                    echo "<span class='error'>Something went wrong !! Category not found.</span>";
                } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>