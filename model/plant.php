<?php
class Plant{
    private $conn;
    
    public $product_id;
    public $name;
    public $price;
    public $image_url;
    public $quantity;
    public $category_id;

    //connect db
    public function __construct($db){
        $this->conn = $db;
    }

    //read data
    public function read(){
        $query = "SELECT * FROM products  ORDER BY product_id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;   
    }
    //show data
    public function show(){
        $query = "SELECT * FROM products WHERE product_id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->product_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->name= $row['name'];
        $this->price= $row['price'];
        $this->image_url= $row['image_url'];
        $this->quantity= $row['quantity'];
        $this->category_id= $row['category_id'];
        return $stmt;   
    }
    //create data
    public function create(){
        $query="INSERT INTO products (name, price, image_url, quantity, category_id) VALUES (:name, :price, :image_url, :quantity, :category_id)";
        $stmt = $this->conn->prepare($query);
        //clear data;
        $this->name= htmlspecialchars(strip_tags($this->name));
        $this->price= htmlspecialchars(strip_tags($this->price));
        $this->image_url= htmlspecialchars(strip_tags($this->image_url));
        $this->quantity= htmlspecialchars(strip_tags($this->quantity));
        $this->category_id= htmlspecialchars(strip_tags($this->category_id));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':image_url', $this->image_url);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':category_id', $this->category_id);
        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    //update data
    public function update(){
        $query = "UPDATE products SET name = :name, price = :price, image_url = :image_url, quantity = :quantity, category_id = :category_id WHERE product_id = :product_id";
    
        $stmt = $this->conn->prepare($query);

        // Liên kết các tham số
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':image_url', $this->image_url);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':product_id', $this->product_id);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':image_url', $this->image_url);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':product_id', $this->product_id);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    //delete data
    public function delete(){
        $query = "DELETE FROM products WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        $this->product_id= htmlspecialchars(strip_tags($this->product_id));
        $stmt->bindParam(1, $this->product_id);
        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    
}

?>
