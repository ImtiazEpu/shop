<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../Classes/Brand.php";?>
<?php 
    
    $brand = new Brand();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brandName'];

        $addBrand = $brand->addBrand($brandName);
    }

 ?>




        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brand</h2>
               <div class="block copyblock" style="text-align: center;"> 
                <?php 

                    if (isset($addBrand)) {
                        echo $addBrand;
                    }

                 ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" placeholder="Enter Brand Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Add" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>