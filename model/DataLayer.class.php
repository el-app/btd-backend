<?php
/**
 * DataLayer.class.php
 * @author elapp
 */
class DataLayer{

    private $connection;


    function __construct()
    {
        $stmt = "mysql:host=".HOST.";db_name=".DB_NAME;
        
        try {
            $this->connection = new PDO($stmt, DB_USER,DB_PASSWORD);
            //echo "Successful authentication";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Function used to authenticate an user
     * @param UserEntity $user Business object describing an user
     * @return UserEntity $user Business object describing the authenticated user
     * @return FALSE In case of failed authentication
     * @return NULL Exception thrown
    */
    function authenticate(UserEntity $user){
        $sql = "SELECT * FROM ".DB_NAME.".`customers` WHERE email = :email";

        try {
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->execute(array(':email' => $user->getEmail()));
            $data = $stmt->fetch(PDO::FETCH_OBJ);

            if ($data && ($data->password == sha1($user->getPassword()))) {
                // Authentication successful
                $user->setIdUser($data->id);
                $user->setGender($data->gender);
                $user->setPseudo($data->pseudo);
                $user->setLastname($data->lastname);
                $user->setFirstname($data->firstname);
                $user->setDescription($data->description);
                $user->setBirthDate($data->birthDate);
                $user->setDeliveryAddress($data->delivery_address);
                $user->setBillingAddress($data->billing_address);
                $user->setTel($data->tel);
                $user->setMobile($data->mobile);
                $user->setPassword(NULL);

                return $user;

            } else {
                // Failed authentication
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

    
    /**
     * Function used to create an user in the database
     * @param UserEntity $ user Business object describing an user
     * @return TRUE If successful persistence
     * @return FALSE If failed persistence
     * @return NULL Exception thrown
     */

    function createUser(UserEntity $user){
        $sql = "INSERT INTO ".DB_NAME.".`customers`(`gender`, `pseudo`, `lastname`, `firstname`, `birthDate`, `email`, `password`)
         VALUES (:gender,:pseudo,:lastname,:firstname,:birthDate,:email,:password)";
         
        try {
            $stmt = $this->connection->prepare($sql);
            $data = $stmt->execute(array(
                ':gender' => $user->getGender(),
                ':pseudo' => $user->getPseudo(),
                ':lastname' => $user->getLastname(),
                ':firstname' => $user->getFirstname(),
                ':birthDate' => $user->getBirthDate(),
                ':email' => $user->getEmail(),
                ':password' => sha1($user->getPassword())
            ));

            return $data ? $this->connection->lastInsertId() : FALSE;

        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Function used to create a category in the database
     * @param CategoryEntity $category Business object describing a category
     * @return TRUE If successful persistence
     * @return FALSE If failed persistence
     * @return NULL Exception thrown
     */
    function createCategory(CategoryEntity $category){
        $sql = "INSERT INTO ".DB_NAME.".`category`(`category`) VALUES (:name)";

        try {
            $stmt = $this->connection->prepare($sql);
            $data = $stmt->execute(array(':name' => $category->getName()));

            return $data ? $this->connection->lastInsertId() : FALSE;

        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Function used to create a product in the database
     * @param ProductEntity $product Business object describing a product
     * @return TRUE If successful persistence
     * @return FALSE If failed persistence
     * @return NULL Exception thrown
     */
    function createProduct(ProductEntity $product){
        $sql ="INSERT INTO ".DB_NAME.".`product`(`brand`, `name`, `description`, `color`, `price`, `stock`, `category`, `image`) 
        VALUES (:brand,:name,:description,:color,:price,:stock,:category,:image)";
        
        try {
            $stmt = $this->connection->prepare($sql);
            $data = $stmt->execute(array(
                ':brand' => $product->getBrand(),
                ':name' => $product->getName(),
                ':description' => $product->getDescription(),
                ':color' => $product->getColor(),
                ':price' => $product->getPrice(),
                ':stock' => $product->getStock(),
                ':category' => $product->getCategory(),
                ':image' => $product->getImage()
            ));

            return $data ? $this->connection->lastInsertId() : FALSE;

        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Function used to create an order in the database
     * @param OrderEntity $order Business object describing an order
     * @return TRUE If successful persistence
     * @return FALSE If failed persistence
     * @return NULL Exception thrown
     */
    function createOrder(OrderEntity $orders){
        $sql = "INSERT INTO ".DB_NAME.".`orders`(`id_customers`, `id_product`, `quantity`, `price`)
         VALUES (:idCustomer,:idProduct,:quantity,:price)";

        try {
            $stmt = $this->connection->prepare($sql);
            $data = $stmt->execute(array(
                'idCustomer' => $orders->getIdUser(),
                ':idProduct' => $orders->getIdProduct(),
                ':quantity' => $orders->getQuantity(),
                ':price' => $orders->getPrice()
            ));
            
            return $data ? $this->connection->lastInsertId() : FALSE;

        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Function used to get users in database
     * @param VOID No parameters
     * @return ARRAY Array containing user data
     * @return FALSE If failed persistence
     * @return NULL Exception thrown
     */
    function getUsers() {
        $sql = "SELECT * FROM ".DB_NAME.".`customers`";

        try {
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->execute();
            $users = [];

            while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
                $user = new UserEntity();
                $user->setIdUser($data->id);
                $user->setGender($data->gender);
                $user->setPseudo($data->pseudo);
                $user->setLastname($data->lastname);
                $user->setFirstname($data->firstname);
                $user->setEmail($data->email);
                $users[] = $user;
            }

            return $users ? $users : FALSE;

        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Function used to get categories in database
     * @param VOID No parameters
     * @return ARRAY Array containing category data
     * @return FALSE If failed persistence
     * @return NULL Exception thrown
     */
    function getCategories() {
        $sql = "SELECT * FROM ".DB_NAME.".`categories`";

        try {
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->execute();
            $categories = [];

            while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
                $category = new CategoryEntity();
                $category->setIdCategory($data->id);
                $category->setName($data->category);

                $categories[] = $category;
            }

            return $categories ? $categories : FALSE;

        } catch (PDOException $th) {
            return NULL;
        }
    }

     /**
      * Function used to get products in database
      * @param VOID No parameters
      * @return ARRAY Array containing product data
      * @return FALSE If failed persistence
      * @return NULL Exception thrown
     */
    function getProducts() {
        $sql = "SELECT * FROM ".DB_NAME.".`products`";

        try {
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->execute();
            $products = [];

            while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
               $product = new ProductEntity();
               $product->setIdProduct($data->id);
               $product->setBrand($data->brand);
               $product->setName($data->name);
               $product->setDescription($data->description);
               $product->setColor($data->color);
               $product->setPrice($data->price);
               $product->setStock($data->stock);
               $product->setImage($data->image);
               $product->setCategory($data->category);
               $product->setCreatedAt($data->createdat);

               $products[] = $product;
            }

            return $products ? $products : FALSE;

        } catch (PDOException $th) {
            return NULL;
        }
    }

    function getProductById($id) {
        $sql = "SELECT * FROM ".DB_NAME.".`product` WHERE id=:id";

        try {
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->execute(array(":id", $id));
    
            if($stmt) {
                $data = $stmt->fetch(PDO::FETCH_OBJ);
                $product = new ProductEntity();
                $product->setIdProduct($data->id);
                $product->setBrand($data->brand);
                $product->setName($data->name);
                $product->setDescription($data->description);
                $product->setColor($data->color);
                $product->setPrice($data->price);
                $product->setStock($data->stock);
                $product->setImage($data->image);
                $product->setCategory($data->category);
                $product->setCreatedAt($data->createdat);
            }

            return $product ? $product : FALSE;

        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Function used to get orders in database
     * @param VOID No parameters
     * @return ARRAY Array containing order data
     * @return FALSE If failed persistence
     * @return NULL Exception thrown
     */
    function getOrders() {
        $sql = "SELECT * FROM ".DB_NAME.".`orders`";

        try {
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->execute();
            $orders = [];

            while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
                $order = new OrdersEntity();
                $order->setIdOrder($data->id);
                $order->setIdUser($data->id_customers);
                $order->setIdProduct($data->id_product);
                $order->setPrice($data->price);
                $order->setQuantity($data->quantity);
                $order->setCreatedAd($data->createdat);

                $orders[] = $order;
            }

            return $orders ? $orders : FALSE;

        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Function used to update user data in database
     * @param UserEntity $user Business object describing a user
     * @return TRUE Update successful
     * @return FALSE Update failed
     * @return NULL Exception thrown
     */
    function updateUser(UserEntity $user) {
        $sql ="UPDATE ".DB_NAME.".`customers` SET ";
        
        try {
            $sql .= " gender = '".$user->getGender()."',";
            $sql .= " pseudo = '".$user->getPseudo()."',";
            $sql .= " lastname = '".$user->getLastname()."',";
            $sql .= " firstname = '".$user->getFirstname()."',";
            $sql .= " birthDate = '".$user->getBirthDate()."',";
            $sql .= " delivery_address = '".$user->getDeliveryAddress()."',";
            $sql .= " billing_address = '".$user->getBillingAddress()."',";
            $sql .= " tel = '".$user->getTel()."',";
            $sql .= " mobile = '".$user->getMobile()."',";
            $sql .= " email = '".$user->getEmail()."',";
            $sql .= " password = '".sha1($user->getPassword())."'";

            $sql .= " WHERE id=".$user->getIdUser(); 

            $stmt = $this->connection->prepare($sql);
            $result = $stmt->execute();

            return $result ? TRUE : FALSE;

        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Function used to update product data in database
     * @param ProductEntity $product Business object describing a product
     * @return TRUE Update successful
     * @return FALSE Update failed
     * @return NULL Exception thrown
     */
    function updateProduct(ProductEntity $product) {
        $sql = "UPDATE ".DB_NAME.".`product` SET `brand`=:brand,`name`=:name,`description`=:description,`color`=:color,`price`=:price,
        `stock`=:stock,`category`=:category,`image`=:image WHERE id=:id";

        try {
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->execute(array(
                ':id' => $product->getIdproduct(),
                ':brand' => $product->getBrand(),
                ':name' => $product->getName(),
                ':description' => $product->getDescription(),
                ':color' => $product->getColor(),
                ':price' => $product->getPrice(),
                ':stock' => $product->getStock(),
                ':category' => $product->getCategory(),
                ':image' => $product->getImage()
            ));

            return $result ? TRUE : FALSE;

        } catch (PDOException $th) {
            return NULL;
        } 
    }

    /**
     * Function used to update category data in database
     * @param CategoryEntity $category Business object describing a category
     * @return TRUE Update successful
     * @return FALSE Update failed
     * @return NULL Exception throw
     */
    function updateCategory(CategoryEntity $category) {
        $sql = "UPDATE ".DB_NAME.".`category` SET `category`=:name WHERE id=:id";
        
        try {
            $stmt = $this->connection->prepare($sql);

            $result = $stmt->execute(array(
                ':name' => $category->getName(),
                ':id' => $category->getIdcategory()
            ));

            return $result ? TRUE : FALSE;

        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Function used to update order data in database
     * @param OrdersEntity $order Business object describing an order
     * @return TRUE Update successful
     * @return FALSE Update failed
     * @return NULL Exception thrown
     */
    function updateOrder(OrdersEntity $order) {
        $sql = "UPDATE ".DB_NAME.".`orders` SET `id_customers`=:id_customers, `id_product`=:id_product, `quantity`=:quantity, `price`=:price
         WHERE id=:id";

        try {
            $stmt = $this->connection->prepare($sql);

            $result = $stmt->execute(array(
                ':id_customers' => $order->getIduser(),
                ':id_product' => $order->getIdproduct(),
                ':quantity' => $order->getQuantity(),
                ':price' => $order->getPrice(),
                ':id' => $order->getIdOrder()
            ));
            
            return $result ? TRUE : FALSE;

        } catch (PDOException $th) {
            return NULL;
        }
    }  

    /**
     * Function used to delete an user in database
     * @param UserEntity $user Business object describing an user
     * @return TRUE Delete successful
     * @return FALSE Delete failed
     * @return NULL Exception thrown
     */
    function deleteUsers(UserEntity $user) {
        $sql = "DELETE FROM ".DB_NAME.".`customers` WHERE id=".$user->getIdUser();

        try {
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->execute();
            
            return $result ? TRUE : FALSE;

        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Function used to delete a product in database
     * @param ProductEntity $product Business object descibing a product
     * @return TRUE Delete successful
     * @return FALSE Delete failed
     * @return NULL Exception thrown
     */
    function deleteProduct(ProductEntity $product) {
        $sql = "DELETE FROM ".DB_NAME.".`product` WHERE id=".$product->getIdProduct();

        try {
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->execute();
            
            return $result ? TRUE : FALSE;

        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Function used to delete a category in database
     * @param CategoryEntity $user Business object describing a category
     * @return TRUE Delete successful
     * @return FALSE Delete failed
     * @return NULL Exception thrown
     */
    function deleteCategory(CategoryEntity $category) {
        $sql = "DELETE FROM ".DB_NAME.".`category` WHERE id=".$category->getIdCategory();

        try {
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->execute();
            
            return $result ? TRUE : FALSE;

        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Function used to delete an order in database
     * @param OrdersEntity $order Business object describing an order
     * @return TRUE Delete successful
     * @return FALSE Delete failed
     * @return NULL Exception thrown
     */
    function deleteOrders(OrdersEntity $order) {
        $sql = "DELETE FROM ".DB_NAME.".`orders` WHERE id=".$order->getIdOrder();

        try {
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->execute();
            
            return $result ? TRUE : FALSE;

        } catch (PDOException $th) {
            return NULL;
        }
    }

}

?>