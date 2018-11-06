<?php include "../Classes/Brand.php";?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 
        if (!isset($_GET['brandeditid']) || $_GET['brandeditid'] == NULL ) {
           echo "<script type='text/javascript'>window.top.location='brandlist.php';</script>"; 
        }else {
           $brandeditid  = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['brandeditid']) ;
        }
    
    $brand = new Brand();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brandName'];

        $updateBrand = $brand->updateBrand($brandName, $brandeditid);
    }

 ?>




        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
               <div class="block copyblock" style="text-align: center;"> 
                <?php 

                    if (isset($updateBrand)) {
                        echo $updateBrand;
                    }

                 ?>
                 <?php 

                    $getBrand = $brand->getBrandById($brandeditid);
                    if ($getBrand) {
                        while ($result = $getBrand->fetch_assoc()) {
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" value="<?php echo $result['brandName']; ?>" class="medium" />
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
                    echo "<span class='error'>Something went wrong !! Brand not found.</span>";
                } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>