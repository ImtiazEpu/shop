<?php include "../Classes/Category.php";?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 

    $filepath = realpath(dirname(__FILE__));

    include_once ($filepath."/../classes/Customer.php"); 
    include_once ($filepath."/../helpers/Formate.php");
    $fm =  new Formate();
    $cus = new Customer();
?>

<?php 
        if (!isset($_GET['custid']) || $_GET['custid'] == NULL ) {
           echo "<script type='text/javascript'>window.top.location='order.php';</script>"; 
        }else {
           $id  = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['custid']) ;
        }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script type='text/javascript'>window.top.location='order.php';</script>"; 
    }

 ?>




        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Details</h2>
               <div class="block copyblock" style="text-align: center;"> 
                 <?php 

                    $getCustomer = $cus->getCustomerDataByID($id);
                    if ($getCustomer) {
                        while ($result = $getCustomer->fetch_assoc()) {
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td >Name</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $result['name']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="email"readonly="readonly" value="<?php echo $result['email']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $result['phone']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $result['address']; ?>"></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $result['city']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Zipcode</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $result['zipcode']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $result['country']; ?>"></td>
                        </tr>
						<tr> 
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
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