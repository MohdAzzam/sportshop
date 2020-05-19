<?php

class DBHelper
{
    /*
     * create conn
     *  create single object
     *
     * */

    private $con;
    private static $instance = null;

    private function __construct()
    {
        $this->con = mysqli_connect("localhost", "root", "", "sportshop");
        if (!$this->con) {
            die("Can't Connect To Server");
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DBHelper();
        }
        return self::$instance;
    }

    /*
     *
     * Start Admin
     *
     * */
    public function addAdmin($name, $email, $password)
    {
        $query = "insert into `admin`(`name`, `email`,`password`)values('$name','$email','$password')";
        return mysqli_query($this->con, $query);

    }

    public function updateAdmin($id, $name, $email, $password)
    {
        if (isset($password) && !empty($password)) {
            $query = "update admin set email   ='$email',
                              password    ='$password',
                              name='$name'
                              where id=$id";
        } else {
            $query = "update admin set email   ='$email',
                              name='$name'
                              where id=$id";
        }

        return mysqli_query($this->con, $query);
    }

    public function getAdminById($id)
    {
        $query = "select * from admin where id=$id";
        $result = mysqli_query($this->con, $query);
        return mysqli_fetch_assoc($result);
    }

    public function getAdminByEmail($email)
    {
        $query = "SELECT email FROM admin where email='$email'";
        $result = mysqli_query($this->con, $query);
        return mysqli_fetch_assoc($result);
    }


    public function getAdmins()
    {
        $query = "select * from admin";
        return mysqli_query($this->con, $query);
    }

    public function deleteAdmin($admin_id)
    {
        $query = "delete from admin where id=$admin_id";
        return mysqli_query($this->con, $query);
    }

    public function getAdmin($email, $password)
    {
        $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
        $result = mysqli_query($this->con, $query);
        return mysqli_fetch_assoc($result);
    }


    /*
     *
     * End Admin
     *
     * */
    /*
     *
     * Start Prouduct
     *
    */
    public function addProduct($name, $price, $img, $desc, $quantity, $category_id)
    {
        $query = "insert into `product`(`name_pro`, `price`, `image_pro`, `description`,`quantity`, `cat_id`)
                                 values('$name',$price,'$img','$desc',$quantity,'$category_id')";
        return mysqli_query($this->con, $query);
    }

    public function updateProduct($name, $price, $img, $desc, $quantity, $category_id, $id)
    {
        $query = "UPDATE product SET cat_id=$category_id, name_pro='$name',
                                    image_pro='$img',price=$price,description='$desc',quantity=$quantity
                          WHERE id_pro=$id";


        return mysqli_query($this->con, $query);
    }

    public function updateProduct1($name, $price, $desc, $quantity, $category_id, $id)
    {
        $query = "UPDATE product SET    cat_id=$category_id, name_pro='$name',
                                        price=$price,description='$desc',quantity=$quantity WHERE id_pro=$id";

        return mysqli_query($this->con, $query);
    }

    public function getAllProduct()
    {
        $query = "select * from `product`"; //edit in inner join
        return mysqli_query($this->con, $query);
    }

    public function getProudctbyID($id)
    {
        $query = "select * from product where id_pro=$id";
        $result = mysqli_query($this->con, $query);
        return mysqli_fetch_assoc($result);
    }

    public function getProudctbyID1($id)
    {
        $query = "SELECT `id_pro`,`name_pro`,`image_pro`,`price`,`cat_id`,`name`,`description`,`quantity` FROM product INNER JOIN category on product.cat_id =category.id WHERE product.id_pro=$id";

        $result = mysqli_query($this->con, $query);
//        print_r($result);die;
        return mysqli_fetch_assoc($result);
    }

    public function getProudctbyID2($id)
    {
        $query = "SELECT `id_pro`,`name_pro`,`image_pro`,`price`,`cat_id`,`name`,`description`,`quantity` FROM product INNER JOIN category on product.cat_id =category.id WHERE product.id_pro=$id";

        return mysqli_query($this->con, $query);

    }

    public function deleteProduct($product_id)
    {
        $query = "delete from product where id_pro=$product_id";
        return mysqli_query($this->con, $query);
    }

    public function likefun($name)
    {
        $query = "SELECT * FROM `product` WHERE name_pro LIKE '%$name%'";
        return mysqli_query($this->con, $query);
    }

    public function lastProAdd()
    {
        $query = "SELECT `id_pro`,`name_pro`,`image_pro`,`price`,`cat_id`,`name` FROM product INNER JOIN category on product.cat_id =category.id order by id_pro desc limit 4";

        return mysqli_query($this->con, $query);
    }
    public function topSell(){
        $query="SELECT SUM(order_item.quantity) as asum ,order_item.product_id,product.image_pro,product.name_pro,category.name,product.description,price from product INNER JOIN order_item on product.id_pro=order_item.product_id inner join category on product.cat_id=category.id GROUP by product.name_pro ORDER by asum DESC limit 3";
        return mysqli_query($this->con,$query);

    }

    /*
      *
      * End Prouduct
      *
     */

    public function innerjoinprocat()
    {
        $query = "select * from product inner join category on category.id=product.cat_id";

        return mysqli_query($this->con, $query);

    }

    public function innerJoinCatPro($id)
    {
        $query = "SELECT `id_pro`,`name_pro`,`image_pro`,`price`,`cat_id`,`name` FROM product INNER JOIN category on product.cat_id =category.id WHERE product.cat_id=$id";

        return mysqli_query($this->con, $query);

    }

    public function inner($id, $name)
    {
        $query = "SELECT `name_pro`,`image_pro`,`price`,`cat_id`,`name` FROM product INNER JOIN category on product.cat_id =category.id WHERE product.cat_id=$id AND name_pro LIKE '%$name%'";

        return mysqli_query($this->con, $query);

    }

    public function innerJoinCatPro1($id)
    {
        $query = "select * from product inner join category on product.cat_id=category.id WHERE id=$id";

        return mysqli_query($this->con, $query);

    }

    public function filterItemsByCategoryIdAndPrice($categoryId, $min, $max)
    {
        $query = "SELECT `name_pro`,`image_pro`,`price`,`cat_id`,`name` FROM
        product INNER JOIN category on product.cat_id =category.id 
        WHERE product.cat_id=$categoryId AND `price` BETWEEN $min AND $max";

        return mysqli_query($this->con, $query);
    }

    public function getItemsByCategoryId($id)
    {
        $query = "SELECT `name_pro`,`image_pro`,`price`,`cat_id`,`name` FROM product INNER JOIN category on product.cat_id =category.id WHERE product.cat_id=$id AND name_pro";

        return mysqli_query($this->con, $query);

    }

    //public function filter

    /*
     *
     * Start Category
     *
     * */

    public function deleteCategory($category_id)
    {
        $query = "delete from category where id=$category_id";
        return mysqli_query($this->con, $query);
    }

    public function editCategory($id, $name, $img)
    {
        $query = "update `category` set `name` ='$name' ,image='$img'
   		where `id`='$id'";

        return mysqli_query($this->con, $query);
    }

    public function editCategory1($id, $name)
    {
        $query = "update `category` set `name` ='$name'
   		where `id`='$id'";

        return mysqli_query($this->con, $query);
    }

    public function addCategory($name, $image)
    {
        $query = "insert into `category` (name,image)values('$name','$image')";
        return mysqli_query($this->con, $query);
    }

    public function getAllCategories()
    {
        $query = "select * from `category`";
        return mysqli_query($this->con, $query);
    }

    public function getCategoryById($id)
    {
        $query = "SELECT * from `category` WHERE `id`=$id";
        $result = mysqli_query($this->con, $query);
        return mysqli_fetch_assoc($result);
    }

    public function getCategoryByName($name)
    {
        $query = "SELECT * from `category` WHERE `name`='$name'";
        $result = mysqli_query($this->con, $query);
        return mysqli_fetch_assoc($result);
    }

    /*
     * This function to remove File
     *
     * */
    /*
     *
     * Start Customer
     */
    public function addCustomer($name, $email, $password, $address)
    {
        $query = "insert into `customer`(`name`, `email`, `password`, `address`)values('$name','$email','$password','$address')";
        return mysqli_query($this->con, $query);

    }

    public function getCustomerByNameEmailPasswordAddres($name, $email, $password, $address)
    {
        $query = "SELECT  `id` FROM `customer` WHERE name='$name'AND email='$email' AND
                                password='$password' AND address='$address'";

        return mysqli_query($this->con, $query);

    }

    public function getCustomerByEmailAndPassword($email, $password)
    {
        $query = "SELECT * FROM customer where email='$email' AND password='$password'";
        $result = mysqli_query($this->con, $query);
        return mysqli_fetch_assoc($result);
    }

    public function getAllCustomer()
    {
        $query = "SELECT * FROM customer";

        return mysqli_query($this->con, $query);
    }
    public function getCustomerById($id)
    {
        $query = "SELECT * FROM customer where id=$id";

        $result= mysqli_query($this->con, $query);
        return mysqli_fetch_assoc($result);
    }
    public function  updateCustomer($name,$email,$address,$password,$id){
       $query=" UPDATE `customer` SET `name`='$name',`email`='$email',`password`='$password',`address`='$address' WHERE id=$id";
       return mysqli_query($this->con,$query);
    }

    public function deleteCustomer($id)
    {
        $query = "delete from customer where id=$id";
        return mysqli_query($this->con, $query);
    }

    /*
     * order
     * */
    public function orderInsert($user_id, $total, $created_date,$delivery)
    {
        $query = "INSERT INTO `user_order`(`customer_id`, `total`, `date`,deliver_date) VALUES ($user_id,$total,'$created_date','$delivery')";
        return mysqli_query($this->con, $query);
    }

    public function orderInsertDetails($pro_id, $total, $quantity, $user_id, $date,$subtotal)
    {
        $query = "INSERT INTO `order_item`( `product_id`, `order_id`,  `quantity`,`sub_total`) 
          VALUES ($pro_id,
          (SELECT `id` FROM `user_order`WHERE `customer_id` =$user_id and `total`=$total and date='$date'),$quantity,$subtotal)";
        return mysqli_query($this->con, $query);

    }
    public  function updateQty($quantity,$id){
        $query="Update product set quantity=$quantity where id_pro=$id";
        return mysqli_query($this->con,$query);

    }

    public function getOrder($id){
        $query="SELECT * FROM user_order where customer_id=$id";
        $result= mysqli_query($this->con,$query);

        return mysqli_fetch_assoc($result);
    }
    public function  innerJoinOrderCustomer(){
        $query="SELECT name,user_order.id,date,deliver_date,total FROM `user_order` INNER join customer on customer.id=user_order.customer_id";
        return mysqli_query($this->con,$query);
    }
    public function  innerJoinOrderProduct($id){
        $query="SELECT name_pro ,order_item.quantity,sub_total FROM `order_item` INNER join  product ON order_item.product_id=product.id_pro where order_id=$id";
        return mysqli_query($this->con,$query);
    }
    public function  innerJoinOrderCustomerPublic($id){
        $query="SELECT name,user_order.id,date,deliver_date,total FROM `user_order` INNER join customer on customer.id= user_order.customer_id where user_order.customer_id=$id";
        return mysqli_query($this->con,$query);
    }


}// end class


?>