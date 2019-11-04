<?php include "header.php"; ?>



    <section class="page-name background-bg" data-image-src="images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container">
                    <h2 class="section-title">About</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
                <!-- /.container -->
            </div>
            <!-- /.section-padding -->
        </div>
        <!-- /.overlay -->
    </section>
    <!-- /.page-name -->





    <section class="shop">
        <div class="section-padding">
            <div class="container">
                <div>
                    <div class="woocommerce">
                    <?php
                       $total_price = 0;
                    ?>
                    <?php
                      
                      if($_SESSION["user_id"]){
                     
                        $id = $_SESSION['user_id'];
                        $lookupID = "SELECT `cart_id` FROM `cart` WHERE `user_user_id`='$id'";
                          $result = mysqli_query($con, $lookupID);
                          $row = mysqli_fetch_row($result);
                          $cart_cart_id = $row[0];
                     
                       
                        $sql = $con->query("SELECT * FROM `cartitem` WHERE `cart_cart_id`='$cart_cart_id'");
                    
                          ?>
                          <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                                <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">Courses</th>
                                        <th class="product-price">Price</th>

                                    </tr>
                                </thead>
                        <?php
                         foreach ($sql as $value){
                            echo'
                            <tbody>

                                <tr class="woocommerce-cart-form__cart-item cart_item">

                                    <td class="product-remove">
                                        <form method="post" action="">
                                        <input type="hidden" name="course_code" value="'.$value['course_code'].'" />
                                        <input type="hidden" name="action" value="remove" />
                                        <button type="submit" class="remove">×</button>
                                        </form>
                                        
                                    </td>

                                    <td class="product-thumbnail">
                                        <a href="#"><img src="images/'.$value['course_image'].'" alt="Placeholder" class="woocommerce-placeholder wp-post-image" width="324" height="324"></a>
                                    </td>

                                    <td class="product-name" data-title="Product">
                                        <a href="#">'.$value['course_name'].'</a> </td>

                                    <td class="product-price" data-title="Price">
                                        <a href="#">'.$value['course_price'].'</a></span>
                                    </td>
                                    
                                </tr>
                               

                            </tbody>';
                                $total_price += ($value["course_price"]);
                            }
                    
                        ?>
                       </table>
                        <?php
  //if cart is empty
}
?>

                        <?php
                      
                      if(isset($_SESSION["shopping_cart"])){
                         
                          ?>
                           <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                                
                                <?php
                                
                            $con = mysqli_connect("localhost","root","","my_educature");
                            if (mysqli_connect_errno()){
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                die();
                            }  

                           
                           

                            if(isset($_SESSION['user_id']) && empty($_SESSION["shopping_cart"])){
                               
                                foreach ($_SESSION["shopping_cart"] as $value){
                                echo'
                                <tbody>

                                    <tr class="woocommerce-cart-form__cart-item cart_item">

                                        <td class="product-remove">
                                            <form method="post" action="">
                                            <input type="hidden" name="course_code" value="'.$value['course_code'].'" />
                                            <input type="hidden" name="action" value="remove" />
                                            <button type="submit" class="remove">×</button>
                                            </form>
                                            
                                        </td>

                                        <td class="product-thumbnail">
                                            <a href="#"><img src="images/'.$value['course_image'].'" alt="Placeholder" class="woocommerce-placeholder wp-post-image" width="324" height="324"></a>
                                        </td>

                                        <td class="product-name" data-title="Product">
                                            <a href="#">'.$value['course_name'].'</a> </td>

                                        <td class="product-price" data-title="Price">
                                            <a href="#">'.$value['course_price'].'</a></span>
                                        </td>
                                        
                                    </tr>
                                   

                                </tbody>';
                                    $total_price += ($value["course_price"]);
                                }
                            }
                                                ?>
                            </table>
                        <?php
  //if cart is empty
}
?>
                         
                     

                        <div class="cart-collaterals">
                            <div class="cart_totals ">

                                <h2>Cart totals</h2>

                                <table class="shop_table shop_table_responsive">

                                    <tbody>                                      
                                     
                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td data-title="Total"><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$&nbsp;</span>
                                                <?php 
                                                
                                                echo $total_price;
                                                
                                                ?>
                                                </span></strong> </td>
                                        </tr>

                                    </tbody>
                                </table>

                                <div class="wc-proceed-to-checkout">

                                    <a href="checkout.php"  class="checkout-button button alt wc-forward">
                                        Proceed to checkout</a>
                                    <div class="wcppec-checkout-buttons woo_pp_cart_buttons_div">

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.section-padding -->
    </section>
    <!-- /.shop -->





     <?php   include "footer.php"; ?>