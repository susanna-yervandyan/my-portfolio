<?php

class Model {
	public $conn;

	public function __construct() {
		$this->conn = mysqli_connect( 'localhost', 'root', '', 'shop_for_close' );
		if ( ! $this->conn ) {
			die( mysqli_connect_error() );
		}
	}

	public function __destruct() {
		mysqli_close( $this->conn );
	}

	public function get_categories() {
		$query  = "SELECT * FROM categories";
		$res    = mysqli_query( $this->conn, $query );
		$result = mysqli_fetch_all( $res, MYSQLI_ASSOC );
		return $result;
	}

	public function add_user( $name, $login, $pass, $email ) {
		$query = "INSERT INTO users VALUES(null,'$name','$login','$pass','$email')";
		$res   = mysqli_query( $this->conn, $query );
		return $res;
	}

	public function check_user( $email ) {
		$query = "SELECT * FROM users WHERE email =  '$email'";
		$res   = mysqli_query( $this->conn, $query );
		return mysqli_num_rows( $res );
	}

	public function check_login( $email, $pass ) {
		$query = "SELECT * FROM users WHERE email =  '$email' AND password = '$pass'";
		$res   = mysqli_query( $this->conn, $query );
		return mysqli_fetch_assoc( $res );
	}



	public function get_products( $cat_id ) {
		$query  = "SELECT * FROM products WHERE cat_id = '$cat_id'";
		$res    = mysqli_query( $this->conn, $query );
		$result = mysqli_fetch_all( $res, MYSQLI_ASSOC );
		return $result;
	}

	public function get_category_by_id( $cat_id ) {
		$query  = "SELECT * FROM categories WHERE id = '$cat_id'";
		$res    = mysqli_query( $this->conn, $query );
		$result = mysqli_fetch_assoc( $res );
		return $result;
	}

	public function add_to_cart( $user_id, $prod_id, $quantity ) {
		$query = "INSERT INTO cart VALUES(null,'$user_id','$prod_id','$quantity')";
		$res   = mysqli_query( $this->conn, $query );
	}


	public function check_cart( $user_id, $prod_id ) {
		$query  = "SELECT * FROM cart WHERE user_id = '$user_id' AND 
    product_id = '$prod_id'";
		$res    = mysqli_query( $this->conn, $query );
		$result = mysqli_fetch_all( $res, MYSQLI_ASSOC );
		return ! empty( $result );
	}

	public function check_cart_quantity( $user_id, $prod_id ) {
		$query  = "SELECT quantity FROM cart WHERE user_id = '$user_id' AND 
    product_id = '$prod_id'";
		$res    = mysqli_query( $this->conn, $query );
		$result = mysqli_fetch_all( $res, MYSQLI_ASSOC );
		return $result;
	}


	public function update_cart_quantity( $user_id, $prod_id, $quantity ) {
		$query = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
		$stmt  = $this->conn->prepare( $query );
		$stmt->bind_param( "iii", $quantity, $user_id, $prod_id );
		$stmt->execute();
		$stmt->close();
	}


	public function get_cart_items( $user_id ) {
		$query  = "SELECT name, price, image, quantity, description, 
    cart.id,product_id, user_id FROM cart JOIN products ON 
    product_id = products.id WHERE user_id = '$user_id'";
		$res    = mysqli_query( $this->conn, $query );
		$result = mysqli_fetch_all( $res, MYSQLI_ASSOC );
		return $result;
	}


	public function getOrder( $user_id ) {
		$query  = "SELECT ord.*, pr.* from orders as ord LEFT JOIN products  as pr ON ord.prod_id = pr.id where ord.user_id = '$user_id'";
		$res    = mysqli_query( $this->conn, $query );
		$result = mysqli_fetch_all( $res, MYSQLI_ASSOC );
		return $result;
	}



	public function update_cart( $user_id, $cart_id, $quantity ) {
		// Prepare the SQL statement to prevent SQL injection
		$query = "UPDATE cart SET quantity = ? WHERE user_id = ? AND id = ?";
		$stmt  = $this->conn->prepare( $query );

		// Bind parameters
		$stmt->bind_param( "iii", $quantity, $user_id, $cart_id );

		// Execute the query
		$res = $stmt->execute();

		// Optionally, check for errors
		if ( $res ) {
			return true; // Update was successful
		} else {
			return false; // Update failed
		}
	}


	public function remove_item( $user_id, $product_id ) {
		$query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
		$stmt  = $this->conn->prepare( $query );
		$stmt->bind_param( "ii", $user_id, $product_id );
		return $stmt->execute(); // Return true if successful
	}




	public function add_order_item( $order_id, $prod_id, $quantity ) {
		$query = "INSERT INTO order_items (order_id, prod_id, quantity) VALUES (?, ?, ?)";
		$stmt  = $this->conn->prepare( $query );
		$stmt->bind_param( "iii", $order_id, $prod_id, $quantity );
		return $stmt->execute(); // Return true if successful
	}

	public function clear_cart( $user_id ) {
		$query = "DELETE FROM cart WHERE user_id = ?";
		$stmt  = $this->conn->prepare( $query );
		$stmt->bind_param( "i", $user_id );
		return $stmt->execute(); // Return true if successful
	}




	public function add_to_order( $user_id ) {
		$query = "INSERT INTO orders (user_id, created_date) VALUES (?, NOW())";
		$stmt  = $this->conn->prepare( $query );

		// Bind parameters
		$stmt->bind_param( "i", $user_id ); // Ensure this matches the number of placeholders in the query

		return $stmt->execute(); // Return true if successful
	}

	public function get_orders_by_user( $user_id ) {
		$query = "SELECT id, prod_id, quantity, created_date FROM orders WHERE user_id = ?";
		$stmt  = $this->conn->prepare( $query );
		$stmt->bind_param( "i", $user_id ); // Bind the user_id as an integer

		$stmt->execute();
		$result = $stmt->get_result(); // Get the result set from the prepared statement

		$orders = [];
		while ( $row = $result->fetch_assoc() ) {
			$orders[] = $row; // Add each row to the orders array
		}

		return $orders; // Return the array of orders
	}


}
$user_model = new Model();
