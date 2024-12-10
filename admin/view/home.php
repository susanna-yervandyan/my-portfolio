<?php


session_start();
include_once( "../model/model.php" );
include_once( 'header.php' );
if ( ! isset( $_SESSION['admin'] ) ) {
	header( "location:login.php" );
	die();
}

echo "Welcome home " . $_SESSION['admin'] . "<br>";

$all = $model->get_categories();
//print_r($all);
?>





<a href="../view/orders.php">Orders</a>
<a href="../controller/logout.php">Log Out</a>


<form id="cat_form">
	<input type="text" id="inp" placeholder="Category Name" />
	<input type="file" id="cat_img" />
	<button type="button" id="btn_add">Add Category</button>
</form>

<p id="p_mess"></p>


<table>
	<caption>Categories</caption>
	<tr>
		<th>Name</th>
		<th>Image</th>
		<th>Update</th>
		<th>Delete</th>
	</tr>


	<?php
	foreach ( $all as $key => $category ) { ?>
		<tr id="<?= $category['id'] ?>">
			<td contenteditable class="name_category"><?= $category['name'] ?></td>

			<td>
				<img src="../Assets/Image/<?= $category['image'] ?>" width="100" height="100">
			</td>
			<td><button class="btn_upd">Update</button></td>
			<td><button class="btn_del">Delete</button></td>
			<td><a href="products.php?cat_id=<?= $category['id'] ?>">
					Show</a></td>
		</tr>

	<?php
	}
	?>

</table>

<?php
include_once( 'footer.php' );
?>