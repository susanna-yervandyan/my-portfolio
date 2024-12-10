<?php

class Model{
    public $conn;
    public function __construct(){
        $this->conn=mysqli_connect('localhost','root','','shop_for_close');
        if(!$this->conn){
            die(mysqli_connect_error());
        }else{
            //echo "ok";
        }

    }
        public function __destruct(){
            mysqli_close($this->conn);
        }
        public function admin($login,$pass){
            $query = "SELECT * FROM  admin WHERE login ='$login' AND password = '$pass'";
            $res = mysqli_query($this->conn,$query);
            return mysqli_num_rows($res);
        }
        // public function add_category($name){
        //     $query = "INSERT INTO  categories(name) VALUES ('$name')";
        //     $res = mysqli_query($this->conn, $query);
        // }

        public function add_category($name, $image) {
            // Prepare SQL query to insert both name and image
            $query = "INSERT INTO categories (name, image) VALUES ('$name', '$image')";
            $res = mysqli_query($this->conn, $query); 
            return $res;
        }
        
        
        public function get_categories(){
            $query = "SELECT * FROM categories";
            $res = mysqli_query($this->conn,$query);
            $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
            return $result;
        }
        public function update($name, $id) {
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
            
            // Bind parameters to the statement
            $stmt->bind_param("si", $name, $id);
        
            // Execute the statement
            $success = $stmt->execute();
            
            if ($success && $stmt->affected_rows > 0) {
                // Close the statement and return true if a row was affected
                $stmt->close();
                return true;
            } else {
                // Log the error if execute fails and close the statement
                error_log("Update Error: " . $stmt->error);
                $stmt->close();
                return false;
            }
        }
        
        public function delete($id){
            $query = "DELETE FROM categories WHERE id = '$id'";
            $res = mysqli_query($this->conn, $query);
        }
        public function add_products($cat_id,$name,$price,$desc,$img, $currency){
            $query = "INSERT INTO products VALUES(NULL,'$name','$desc','$cat_id','$img','$price','$currency')";
			$res = mysqli_query($this->conn, $query);
        }
        
        public function get_products($cat_id){
            $query = "SELECT * FROM products WHERE cat_id = '$cat_id'";
            $res = mysqli_query($this->conn, $query);
            $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
            return $result;
        }
       public function update_product($name, $desc, $price, $currency, $id) {
    $query = "UPDATE products SET name ='$name', description ='$desc', price = '$price', currency = '$currency' WHERE id = '$id'";
    $res = mysqli_query($this->conn, $query);

    if (!$res) {
        // Log the error message
        error_log("MySQL Error: " . mysqli_error($this->conn));
    }

    if ($res) {
        if (mysqli_affected_rows($this->conn) > 0) {
            return true; 
        } else {
            return false; 
        }
    } else {
        return false; 
    }
}


        public function delete_product($id){
            $query = "DELETE FROM products WHERE id = '$id'";
            $res = mysqli_query($this->conn, $query);
            return $res;
        }

        public function getAllOrders() {
            $query = "SELECT id, user_id, prod_id, quantity, created_date FROM orders"; // Removed total_price
            $result = $this->conn->query($query);
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        
        

    }

    $model = new Model();




