<?php include "../Classes/Category.php";?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 
    
    $cat = new Category();
    if (isset($_GET['catdelid'])) {
         $catdelid  = $_GET['catdelid'];
         $deleteCategory = $cat->deleteCategory($catdelid);
        }else{
           
        }

 ?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <?php 

                    if (isset($deleteCategory)) {
                        echo $deleteCategory;
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

							$getCategory = $cat->getALLCategory();
							 if ($getCategory) {
							 	$i=0;
							 	while ($result = $getCategory->fetch_assoc()) { 
							 		$i++;
							 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catName']; ?></td>
							<td><a href="editcat.php?cateditid=<?php echo $result['catId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to Delete ?');" href="?catdelid=<?php echo $result['catId']; ?>">Delete</a></td>
						</tr>
					<?php 	}}else {
						echo "<span class='error'>Something went wrong !! Category not found.</span>";
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

