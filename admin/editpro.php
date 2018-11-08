<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../Classes/Brand.php";?>
<?php include "../Classes/Category.php";?>
<?php include "../Classes/Product.php";?>

<?php 
     $brand = new Brand();
     $cat   = new Category();
     $prod  = new Product();

     if (!isset($_GET['proeditid']) || $_GET['proeditid'] == NULL ) {
           echo "<script type='text/javascript'>window.top.location='productlist.php';</script>"; 
        }else {
           $proeditid  = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proeditid']) ;
        }
  
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

        $updateProduct = $prod->updateProduct($_POST,$_FILES,$proeditid);
    }
  ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <div class="block">
        <?php if (isset($updateProduct)) { echo $updateProduct;} ?> 
<?php 
    $getproduct = $prod->getProductById($proeditid);
        if ($getproduct) {
            while ($value = $getproduct->fetch_assoc()){ ?>

         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $value['productName'];  ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option value="">Select Category</option>
                            <?php 
                                $getcat = $cat->getALLCategory();
                                if ($getcat) {
                                    while ($result = $getcat->fetch_assoc()) {?>
                            <option 
                                <?php 
                                    if ($value['catId'] == $result['catId']) {?>
                                        selected = "selected"
                                <?php }?>value="<?php echo $result['catId']; ?>"><?php echo $result['catName'];  ?>
                            </option>
                            <?php }} ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option value="">Select Brand</option>
                            <?php 
                                $getBrand = $brand->getALLBrand();
                                if ($getBrand) {
                                    while ($result = $getBrand->fetch_assoc()) {?>
                            <option 
                                <?php 
                                    if ($value['brandId'] == $result['brandId']) {?>
                                        selected = "selected"
                                <?php }?>value="<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?>
                            </option>
                            <?php }} ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="productBody"><?php echo $value['productBody']; ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="productPrice" value="<?php echo $value['productPrice']; ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $value['productImage']; ?>" height="150px" width="150px" style="margin-left: 11px;" alt=""><br/>
                        <input type="file" name="productImage" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="productType">
                            <option value="">Select Type</option>
                            <?php 
                                if ($value['productType'] == 0) {?>
                            <option  selected = "selected" value="0">Featured</option>
                            <option value="1">General</option>
                        <?php }else {?>
                            <option selected = "selected" value="1">General</option>
                            <option value="0">Featured</option>
                        <?php } ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
<?php }} ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


