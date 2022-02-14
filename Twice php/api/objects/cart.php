<?php
class Cart{
    // database connection and table name
    private $conn;
    private $table_name = 'cart';
  
    // object properties
    public $cart_id;
    public $account_id;
    public $product_id;
    public $quantity;
    public $created;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        date_default_timezone_set('Asia/Manila');
    }

    public function getOne(){
        // query to get one cart
        $query = 'SELECT * FROM '. $this->table_name . 
        ' INNER JOIN product ON cart.product_id = product.product_id'.
        ' WHERE account_id  = :account_id AND cart.product_id  = :product_id';
      
        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // sanitize
        $this->account_id=htmlspecialchars(strip_tags($this->account_id));
        $this->product_id=htmlspecialchars(strip_tags($this->product_id));
      
        // bind id of account to be searched
        $stmt->bindParam(':account_id', $this->account_id);
        $stmt->bindParam(':product_id', $this->product_id);
      
        // execute query
        $stmt->execute();
      
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            return null;
        }

        return [
            "cart_id" => $row['cart_id'],
            "account_id" => $row['account_id'],
            "product_id" => $row['product_id'],
            "product_name" => $row['product_name'],
            "product_img_1" => $row['product_img_1'],
            "prize" => $row['prize'],
            "quantity" => $row['quantity'],
            "prize" => $row['prize'],
            "rating" => $row['rating'],
            "total_prize" => $row['prize'] * $row['quantity'],
            "created" => $row['created']
        ];
    }

    public function getAllCart(){
        // query to get all cart
        $query = 'SELECT * FROM '. $this->table_name . 
        ' INNER JOIN product ON cart.product_id = product.product_id'.
        ' WHERE account_id  = :account_id';
      
        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // sanitize
        $this->account_id=htmlspecialchars(strip_tags($this->account_id));

        // bind id of account to be searched
        $stmt->bindParam(':account_id', $this->account_id);

        // execute query
        $stmt->execute();

        $rowCount = $stmt->rowCount();
        if($rowCount > 0) {
            // products array
            $carts_arr = [];
            //loop to all query result
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $cart_item = [
                    "cart_id" => $row['cart_id'],
                    "account_id" => $row['account_id'],
                    "product_id" => $row['product_id'],
                    "product_name" => $row['product_name'],
                    "product_img_1" => $row['product_img_1'],
                    "prize" => $row['prize'],
                    "quantity" => $row['quantity'],
                    "prize" => $row['prize'],
                    "rating" => $row['rating'],
                    "total_prize" => $row['prize'] * $row['quantity'],
                    "created" => $row['created']
                ];
                array_push($carts_arr, $cart_item);
            }

            return $carts_arr;

        } else {
            return [];
        }
    }

    public function create() {
        // query to insert record
        $query = 'INSERT INTO ' . $this->table_name . ' SET account_id=:account_id, product_id=:product_id, quantity=:quantity, created=:created';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->account_id=htmlspecialchars(strip_tags($this->account_id));
        $this->product_id=htmlspecialchars(strip_tags($this->product_id));
        $this->quantity=htmlspecialchars(strip_tags($this->quantity));
        $this->created=htmlspecialchars(strip_tags($this->created));
        
        // bind values
        $stmt->bindParam(':account_id', $this->account_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':created', $this->created);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function update() {
        // query to update record
        $query = 'UPDATE ' . $this->table_name . ' SET quantity=:quantity WHERE account_id  = :account_id AND cart.product_id  = :product_id';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->account_id=htmlspecialchars(strip_tags($this->account_id));
        $this->product_id=htmlspecialchars(strip_tags($this->product_id));
        $this->quantity=htmlspecialchars(strip_tags($this->quantity));
        
        // bind values
        $stmt->bindParam(':account_id', $this->account_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':quantity', $this->quantity);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function delete() {
        // query to delete record
        $query = 'DELETE FROM ' . $this->table_name . ' WHERE account_id  = :account_id AND cart.product_id  = :product_id';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->account_id=htmlspecialchars(strip_tags($this->account_id));
        $this->product_id=htmlspecialchars(strip_tags($this->product_id));
        
        // bind values
        $stmt->bindParam(':account_id', $this->account_id);
        $stmt->bindParam(':product_id', $this->product_id);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>