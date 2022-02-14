<?php
class Account{
    // database connection and table name
    private $conn;
    private $table_name = 'account';
  
    // object properties
    public $account_id;
    public $username;
    public $email;
    public $password;
    public $created;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        date_default_timezone_set('Asia/Manila');
    }

    public function create() {
        // query to insert record
        $query = 'INSERT INTO ' . $this->table_name . ' SET username=:username, email=:email, password=:password, created=:created';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->created=htmlspecialchars(strip_tags($this->created));
        
        // bind values
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':created', $this->created);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function readOne(){
        // query to read single record
        $query = 'SELECT * FROM '. $this->table_name . ' WHERE username  = :username  AND password = :password';
      
        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // sanitize
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->password=htmlspecialchars(strip_tags($this->password));
      
        // bind id of product to be updated
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
      
        // execute query
        $stmt->execute();
      
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row !== false) {
            // set values to object properties
            $this->account_id = $row['account_id'];
            $this->username = $row['username'];
            $this->email = $row['email'];
            $this->created = $row['created'];
        }
    }

    //Check if Username exist since username is unique
    public function checkUsernameExist(){
        // query to read single record
        $query = 'SELECT * FROM '. $this->table_name . ' WHERE username  = :username';
          
        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // sanitize
        $this->username=htmlspecialchars(strip_tags($this->username));
      
        // bind id of product to be updated
        $stmt->bindParam(':username', $this->username);
      
        // execute query
        $stmt->execute();
      
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row !== false;
    }

    //Check if Email exist since email is unique
    public function checkEmailExist(){
        // query to read single record
        $query = 'SELECT * FROM '. $this->table_name . ' WHERE email  = :email';
          
        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
      
        // bind id of product to be updated
        $stmt->bindParam(':email', $this->email);
      
        // execute query
        $stmt->execute();
      
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row !== false;
    }
}
?>