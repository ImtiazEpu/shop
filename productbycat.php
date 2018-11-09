<?php include "inc/header.php"; ?>
<?php 

if (!isset($_GET['catid']) || $_GET['catid'] == NULL ) {
	echo "<script type='text/javascript'>window.top.location='404.php';</script>"; 
}else {
	$catid  = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catid']) ;
}

?>
<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Latest from Category</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php 

			$productByCategory = $prod->productByCategory($catid);
			if ($productByCategory) {
				while ($result = $productByCategory->fetch_assoc()) {?>

					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result["productImage"]; ?>" alt="" /></a>
						<h2><?php echo $result["productName"]; ?></h2>
						<p><?php echo $fm->textShorten($result["productBody"], 60); ?></p>
						<p><span class="price">$<?php echo $result["productPrice"]; ?></span></p>
						<div class="button"><span><a href="preview.php?proid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
					</div>
				<?php }}else {
					echo "<div class='content_top'><div class='heading'><h3 style='color:#FF0303;'>Sorry !! No Product available in this category... </h3></div><div class='clear'></div></div>";
				} ?>
			</div>
		</div>
	</div>
	<?php include "inc/footer.php" ?>