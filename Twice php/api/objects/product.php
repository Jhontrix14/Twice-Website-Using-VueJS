<?php
class Product{
    // database connection and table name
    private $conn;
    private $table_name = 'product';
  
    // object properties
    public $product_id ;
    public $product_name;
    public $product_img_1;
    public $product_img_2;
    public $product_img_3;
    public $prize;
    public $rating;
    public $is_latest;
    public $is_feature;
    public $created;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        date_default_timezone_set('Asia/Manila');
    }

    public function create() {
        // query to insert record
        $query = 'INSERT INTO ' . 
        $this->table_name . 
        ' SET product_name=:product_name, product_img_1=:product_img_1, product_img_2=:product_img_2, product_img_3=:product_img_3, '.
        'prize=:prize, rating=:rating, is_latest=:is_latest, is_feature=:is_feature, created=:created';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->product_name=htmlspecialchars(strip_tags($this->product_name));
        $this->product_img_1=htmlspecialchars(strip_tags($this->product_img_1));
        $this->product_img_2=htmlspecialchars(strip_tags($this->product_img_2));
        $this->product_img_3=htmlspecialchars(strip_tags($this->product_img_3));
        $this->prize=htmlspecialchars(strip_tags($this->prize));
        $this->rating=htmlspecialchars(strip_tags($this->rating));
        $this->is_latest=htmlspecialchars(strip_tags($this->is_latest));
        $this->is_feature=htmlspecialchars(strip_tags($this->is_feature));
        $this->created=htmlspecialchars(strip_tags($this->created));
        
        // bind values
        $stmt->bindParam(':product_name', $this->product_name);
        $stmt->bindParam(':product_img_1', $this->product_img_1);
        $stmt->bindParam(':product_img_2', $this->product_img_2);
        $stmt->bindParam(':product_img_3', $this->product_img_3);
        $stmt->bindParam(':prize', $this->prize);
        $stmt->bindParam(':rating', $this->rating);
        $stmt->bindParam(':is_latest', $this->is_latest);
        $stmt->bindParam(':is_feature', $this->is_feature);
        $stmt->bindParam(':created', $this->created);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function getAll(){
        // query to get all product
        $query = 'SELECT * FROM '. $this->table_name;
      
        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // execute query
        $stmt->execute();

        $rowCount = $stmt->rowCount();
        if($rowCount > 0) {
            // products array
            $products_arr = [];
            //loop to all query result
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $product_item = [
                    "product_id" => $row['product_id'],
                    "product_name" => $row['product_name'],
                    "product_img_1" => $row['product_img_1'],
                    "product_img_2" => $row['product_img_2'],
                    "product_img_3" => $row['product_img_3'],
                    "prize" => $row['prize'],
                    "rating" => $row['rating'],
                    "is_latest" =>$row['is_latest'],
                    "is_feature" => $row['is_feature'],
                    "created" => $row['created']
                ];
                array_push($products_arr, $product_item);
            }

            return $products_arr;

        } else {
            return [];
        }
    }

    public function getOne(){
        // query to read single record
        $query = 'SELECT * FROM '. $this->table_name . ' WHERE product_id  = :product_id';
      
        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // sanitize
        $this->product_id=htmlspecialchars(strip_tags($this->product_id));
      
        // bind id of product to be updated
        $stmt->bindParam(':product_id', $this->product_id);
      
        // execute query
        $stmt->execute();
      
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row !== false) {
            // set values to object properties
            $this->product_id = $row['product_id'];
            $this->product_name = $row['product_name'];
            $this->product_img_1 = $row['product_img_1'];
            $this->product_img_2 = $row['product_img_2'];
            $this->product_img_3 = $row['product_img_3'];
            $this->prize = $row['prize'];
            $this->rating = $row['rating'];
            $this->is_latest = $row['is_latest'];
            $this->is_feature = $row['is_feature'];
            $this->created = $row['created'];
        }
    }

}
?>