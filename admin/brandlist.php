<?php include "../Classes/Brand.php";?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 
    
    $brand = new Brand();
    if (isset($_GET['branddelid'])) {
         $branddelid  = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['branddelid']);
         $deleteBrand = $brand->deleteBrand($branddelid);
        }

 ?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                <?php 

                    if (isset($deleteBrand)) {
                        echo $deleteBrand;
                    }

                 ?> 
                <div class="block">      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 	

							$getBrand = $brand->getALLBrand();
							 if ($getBrand) {
							 	$i=0;
							 	while ($result = $getBrand->fetch_assoc()) { 
							 		$i++;
							 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['brandName']; ?></td>
							<td><a class="btn btn-blue" href="editbrand.php?brandeditid=<?php echo $result['brandId']; ?>">Edit</a> <a class="btn btn-red" onclick="return confirm('Are you sure to Delete ?');" href="?branddelid=<?php echo $result['brandId']; ?>">Delete</a></td>
						</tr>
					<?php 	}}else {
						echo "<span class='error'>Something went wrong !! Brand not found.</span>";
					} ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

