<?php include "header.php"; ?>

<?php
 require("../Educature/authanticate.php");
     $fileError="";
    
  if($_SESSION['user_id']){
       $user = $_SESSION['user_id'];
       $sql ="SELECT * FROM `users` WHERE `user_id`='$user'";                                  
       $result = mysqli_query($con,$sql);

       $row = mysqli_fetch_assoc($result);    
   }

   if (isset($_POST['continuepayment'])) { 
                
                $cardNumber = $con->real_escape_string($_POST['cardNumber']);
              
                $cardname = $con->real_escape_string($_POST['cardname']);
              
                $expirydate = $con->real_escape_string($_POST['expirydate']); 
              
                $paydate =  $today = date("Y-m-d");  
         
                $country = $con->real_escape_string($_POST['country']);
           
                $paymentamount = $con->real_escape_string($_POST['paymentamount']);
             
                $paymentmethod = $con->real_escape_string($_POST['paymentmethod']);
                $totalqty = $con->real_escape_string($_POST['totalqty']); 
                // $billing_postcode = $con->real_escape_string($_POST['billing_postcode']);
               $verificationcode = $con->real_escape_string($_POST['cvv']); 
       
               
               var_dump($totalqty);
              
               

                $pay_key = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789';
                $pay_key = str_shuffle($pay_key);
                $pay_key = substr($pay_key, 0, 6);


                $con->query(" INSERT INTO `payment`(`pay-code`, `payment_amount`, `payment_status`, `payment_dated`, `paymentmethod_paymenttype_id`) 
                VALUES ('$pay_key','$paymentamount','Paid','$today','$paymentmethod')"); 
               
                
            // $pid = "SELECT payment_id FROM payment WHERE pay_code ='$pay_key'";
            // $result = mysqli_query($con,$pid);
            // $row = mysqli_fetch_assoc($result);
            // $paymentid= $row['payment_id'];  

            // $lookupID = "SELECT `payment_id`  FROM `payment` WHERE `pay-code` ='$pay_key'";
            // var_dump($lookupID);
            // $result = mysqli_query($con, $lookupID);
            // $row = mysqli_fetch_row($result);
            // $paymentid = $row[0];
            $con = mysqli_connect("localhost","root","","my_educature");
            if (mysqli_connect_errno()){
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                die();
                }
            $sql = "SELECT `payment_id`  FROM `payment` WHERE `pay-code` ='$pay_key'";
            
          
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_assoc($result);
            $paymentid= $row['payment_id'];
            

            $con->query(" INSERT INTO `payment_details`( `card_number`, `card_name`, `expiry_date`, `country`, `verification_code`, `payment_payment_id`, `user_user_id`)
            VALUES ('$cardNumber','$cardname','$expirydate','$country','$verificationcode','$paymentid','$user')");
            

            $con->query(" INSERT INTO `order`( `total_qty`, `user_user_id`, `payment_payment_id`)
            VALUES ('$totalqty','$user','$paymentid')");
            
            echo" <script type='text/javascript'>
            window.location.href = 'http://localhost:8080/educature/thanks.php';
            </script>"; 


   }

       ?>


         <section class="page-name background-bg" data-image-src="images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container">
                    <h2 class="section-title">About</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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

<script>

function CardValidation(){

var cardNum = document.getElementById("cNum").value;

    var visaRegEx = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
    var mastercardRegEx = /^(?:5[1-5][0-9]{14})$/;
    var amexpRegEx = /^(?:3[47][0-9]{13})$/;
    var isValid = false;


    if (visaRegEx.test(cardNum)){ // Visa validation
        isValid = true;
        }  
      else if (mastercardRegEx.test(cardNum)){ // MasterCard validation
        isValid = true; 
        }  
      else if(amexpRegEx.test(cardNum)){ // Amex  validation
            isValid = true;
        } 

      if (isValid) {
        alert("Thank you!"); 
      }
      else
        {   
            alert("Not a valid card number!");   
        }
}


  If ($paymentmethod == "AMEX") 
	{
	If (!ereg('([0-9]{4})', $cvv)) 
		{
		$errortext = "Please enter a valid CVV code";
		exit;
		}
	}
	// else mastercard or visa
	elseif (!ereg('([0-9]{3})', $cvv)) 
		{
		$errortext = "Please enter a valid CVV code";
		exit;
		}
</script>


    <section class="shop">
        <div class="section-padding">
            <div class="container">
                <div>

                    <div class="woocommerce">

                        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="#" enctype="multipart/form-data" novalidate="novalidate">

                            <div class="col2-set" id="customer_details">
                                <div class="">
                                    <div class="woocommerce-billing-fields">

                                        <h3>Payment detail</h3>

                                        <div class="woocommerce-billing-fields__field-wrapper">
                                            
                                        <p class="form-row form-row-wide validate-required" id="billing_first_name_field" data-priority="10">
                                                <label for="billing_first_name" class="">Card Type&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                <span class="woocommerce-input-wrapper">

                                                <p class="radiogroup">
                                                    <?php 
                                                $con = mysqli_connect("localhost","root","","my_educature");
                                                if (mysqli_connect_errno()){
                                                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                                    die();
                                                    }
                                                    $sql = $con->query("SELECT * FROM paymentmethod ");
                                            
                                                  
                                                    foreach ($sql as $value) {
                                                        echo '<input type="radio" name="paymentmethod" value="'.$value['payment_id'].'" id="visa" />'.$value['payment_method'].' &nbsp;';
                                                    }
                                                  

                                                    ?>

                                            </p> 


                                              
                                                <input type="text" require="required" name="cardNumber" id="cNum" size="30" value="" onblur="CardValidation()" />

                                                    </span></p>
                                            

                                             <p class="form-row form-row-wide validate-required" id="billing_first_name_field" data-priority="10">
                                                <label for="billing_first_name" class="">Name On Card&nbsp;<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper">
                                                <input class="input-text " name="cardname" id="billing_first_name" placeholder="Enter Your Name" value="" autocomplete="given-name" type="text"></span></p>
                                            
                                            <p class="form-row form-row-wide validate-required" id="billing_first_name_field" data-priority="10">
                                                <label for="billing_first_name" class="">Expiry Date&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                <span class="woocommerce-input-wrapper">
                                                <input class="input-text " name="expirydate" id="billing_first_name" placeholder="Enter Your Name" value="" autocomplete="given-name" type="date">
                                                </span></p>


                                            <!-- <p class="form-row form-row-wide validate-required" id="billing_first_name_field" data-priority="10">
                                                <label for="billing_first_name" class="">Payment Date&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                <span class="woocommerce-input-wrapper">
                                                <input class="input-text " name="paydate" id="billing_first_name" placeholder="Enter Your Name" value="" autocomplete="given-name" type="date">
                                                </span></p> -->
                                            
                                            <p class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated" id="billing_country_field" data-priority="40">
                                                <label for="billing_country" class="">Country&nbsp;<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper">
                                                <select name="country" id="billing_country" class="country_to_state country_select select2-hidden-accessible" autocomplete="country" tabindex="-1" aria-hidden="true">
                                                <option value="">Select a country…</option><option value="AX">Åland Islands</option><option value="AF">Afghanistan</option><option value="AL">Albania</option><option value="DZ">Algeria</option><option value="AS">American Samoa</option><option value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antarctica</option><option value="AG">Antigua and Barbuda</option><option value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria</option><option value="AZ">Azerbaijan</option><option value="BS">Bahamas</option><option value="BH">Bahrain</option><option value="BD" >Bangladesh</option><option value="BB">Barbados</option><option value="BY">Belarus</option><option value="PW">Belau</option><option value="BE">Belgium</option><option value="BZ">Belize</option><option value="BJ">Benin</option><option value="BM">Bermuda</option><option value="BT">Bhutan</option><option value="BO">Bolivia</option><option value="BQ">Bonaire, Saint Eustatius and Saba</option><option value="BA">Bosnia and Herzegovina</option><option value="BW">Botswana</option><option value="BV">Bouvet Island</option><option value="BR">Brazil</option><option value="IO">British Indian Ocean Territory</option><option value="VG">British Virgin Islands</option><option value="BN">Brunei</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="KH">Cambodia</option><option value="CM">Cameroon</option><option value="CA">Canada</option><option value="CV">Cape Verde</option><option value="KY">Cayman Islands</option><option value="CF">Central African Republic</option><option value="TD">Chad</option><option value="CL">Chile</option><option value="CN">China</option><option value="CX">Christmas Island</option><option value="CC">Cocos (Keeling) Islands</option><option value="CO">Colombia</option><option value="KM">Comoros</option><option value="CG">Congo (Brazzaville)</option><option value="CD">Congo (Kinshasa)</option><option value="CK">Cook Islands</option><option value="CR">Costa Rica</option><option value="HR">Croatia</option><option value="CU">Cuba</option><option value="CW">Curaçao</option><option value="CY">Cyprus</option><option value="CZ">Czech Republic</option><option value="DK">Denmark</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="DO">Dominican Republic</option><option value="EC">Ecuador</option><option value="EG">Egypt</option><option value="SV">El Salvador</option><option value="GQ">Equatorial Guinea</option><option value="ER">Eritrea</option><option value="EE">Estonia</option><option value="ET">Ethiopia</option><option value="FK">Falkland Islands</option><option value="FO">Faroe Islands</option><option value="FJ">Fiji</option><option value="FI">Finland</option><option value="FR">France</option><option value="GF">French Guiana</option><option value="PF">French Polynesia</option><option value="TF">French Southern Territories</option><option value="GA">Gabon</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="DE">Germany</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GR">Greece</option><option value="GL">Greenland</option><option value="GD">Grenada</option><option value="GP">Guadeloupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GG">Guernsey</option><option value="GN">Guinea</option><option value="GW">Guinea-Bissau</option><option value="GY">Guyana</option><option value="HT">Haiti</option><option value="HM">Heard Island and McDonald Islands</option><option value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hungary</option><option value="IS">Iceland</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IR">Iran</option><option value="IQ">Iraq</option><option value="IE">Ireland</option><option value="IM">Isle of Man</option><option value="IL">Israel</option><option value="IT">Italy</option><option value="CI">Ivory Coast</option><option value="JM">Jamaica</option><option value="JP">Japan</option><option value="JE">Jersey</option><option value="JO">Jordan</option><option value="KZ">Kazakhstan</option><option value="KE">Kenya</option><option value="KI">Kiribati</option><option value="KW">Kuwait</option><option value="KG">Kyrgyzstan</option><option value="LA">Laos</option><option value="LV">Latvia</option><option value="LB">Lebanon</option><option value="LS">Lesotho</option><option value="LR">Liberia</option><option value="LY">Libya</option><option value="LI">Liechtenstein</option><option value="LT">Lithuania</option><option value="LU">Luxembourg</option><option value="MO">Macao S.A.R., China</option><option value="MK">Macedonia</option><option value="MG">Madagascar</option><option value="MW">Malawi</option><option value="MY">Malaysia</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MQ">Martinique</option><option value="MR">Mauritania</option><option value="MU">Mauritius</option><option value="YT">Mayotte</option><option value="MX">Mexico</option><option value="FM">Micronesia</option><option value="MD">Moldova</option><option value="MC">Monaco</option><option value="MN">Mongolia</option><option value="ME">Montenegro</option><option value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option value="MM">Myanmar</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="NL">Netherlands</option><option value="NC">New Caledonia</option><option value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk Island</option><option value="KP">North Korea</option><option value="MP">Northern Mariana Islands</option><option value="NO">Norway</option><option value="OM">Oman</option><option value="PK">Pakistan</option><option value="PS">Palestinian Territory</option><option value="PA">Panama</option><option value="PG">Papua New Guinea</option><option value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option value="PN">Pitcairn</option><option value="PL">Poland</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="RE">Reunion</option><option value="RO">Romania</option><option value="RU">Russia</option><option value="RW">Rwanda</option><option value="ST">São Tomé and Príncipe</option><option value="BL">Saint Barthélemy</option><option value="SH">Saint Helena</option><option value="KN">Saint Kitts and Nevis</option><option value="LC">Saint Lucia</option><option value="SX">Saint Martin (Dutch part)</option><option value="MF">Saint Martin (French part)</option><option value="PM">Saint Pierre and Miquelon</option><option value="VC">Saint Vincent and the Grenadines</option><option value="WS">Samoa</option><option value="SM">San Marino</option><option value="SA">Saudi Arabia</option><option value="SN">Senegal</option><option value="RS">Serbia</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SK">Slovakia</option><option value="SI">Slovenia</option><option value="SB">Solomon Islands</option><option value="SO">Somalia</option><option value="ZA">South Africa</option><option value="GS">South Georgia/Sandwich Islands</option><option value="KR">South Korea</option><option value="SS">South Sudan</option><option value="ES">Spain</option><option value="LK">Sri Lanka</option><option value="SD">Sudan</option><option value="SR">Suriname</option><option value="SJ">Svalbard and Jan Mayen</option><option value="SZ">Swaziland</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option value="SY">Syria</option><option value="TW">Taiwan</option><option value="TJ">Tajikistan</option><option value="TZ">Tanzania</option><option value="TH">Thailand</option><option value="TL">Timor-Leste</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option value="TO">Tonga</option><option value="TT">Trinidad and Tobago</option><option value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TM">Turkmenistan</option><option value="TC">Turks and Caicos Islands</option><option value="TV">Tuvalu</option><option value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United Arab Emirates</option><option value="GB">United Kingdom (UK)</option><option value="US">United States (US)</option><option value="UM">United States (US) Minor Outlying Islands</option><option value="VI">United States (US) Virgin Islands</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistan</option><option value="VU">Vanuatu</option><option value="VA">Vatican</option><option value="VE">Venezuela</option><option value="VN">Vietnam</option><option value="WF">Wallis and Futuna</option><option value="EH">Western Sahara</option><option value="YE">Yemen</option><option value="ZM">Zambia</option><option value="ZW">Zimbabwe</option></select>
                                                <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;">
                                                    <span class="selection">
                                                <span class="select2-selection select2-selection--single" aria-haspopup="true" aria-expanded="false" tabindex="0" role="combobox">
                                                    <span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span>
                                                </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                <noscript>
                                                    <button type="submit" name=" country woocommerce_checkout_update_totals" value="Update country">Update country</button>
                                                </noscript>
                                                </span>
                                            </p>

                                            <p class="form-row form-row-wide validate-required" id="billing_first_name_field" data-priority="10">
                                                <label for="billing_first_name" class="">Security Code&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                <span class="woocommerce-input-wrapper">
                                                <input class="input-text " name="cvv" id="billing_first_name" placeholder="Enter Your CVV" value="" autocomplete="given-name" type="text">
                                                </span></p>

                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="woocommerce-shipping-fields">

                                        <div class="shipping_address" style="display: none;">

                                            <div class="woocommerce-shipping-fields__field-wrapper">
                                            
                                                
                                            </div>

                                        </div>

                                    </div>
                                    <div class="woocommerce-additional-fields">

                                        <div class="woocommerce-additional-fields__field-wrapper">
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <h3 id="order_review_heading">Your order</h3>

                            <div id="order_review" class="woocommerce-checkout-review-order">
                                <table class="shop_table woocommerce-checkout-review-order-table" style="position: relative;">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Courses</th>
                                            <th class="product-total">Price</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $qty=0;;
                                        $price=0;
                                        if($_SESSION["user_id"]){
                                        
                                            $id = $_SESSION['user_id'];
                                            $lookupID = "SELECT `cart_id` FROM `cart` WHERE `user_user_id`='$id'";
                                            $result = mysqli_query($con, $lookupID);
                                            $row = mysqli_fetch_row($result);
                                            $cart_cart_id = $row[0];
                                        
                                        
                                            $sql = $con->query("SELECT * FROM `cartitem` WHERE `cart_cart_id`='$cart_cart_id'");
                                        }
                                    ?>
                                    <?php
                                     foreach ($sql as $value){
                                         echo'
                                        <tbody>
                                        <tr class="cart_item">
                                            <td class="product-name">'.$value['course_name'].'</td>
                                            <td class="product-total">
                                                <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$&nbsp;</span>'.$value['course_price'].'</span>
                                            </td>
                                        </tr>
                                        <input type="hidden" name="course_name" value="'.$value['course_name'].'">  
                                        <input type="hidden" name="course_price" value="'.$value['course_price'].'">
                                               
                                    </tbody>
                                    
                                    ';
                                    $qty += ($sql);
                                    $price += ($value["course_price"]);
                                     }
                                    ?>
                                    <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Quantity</th>
                                        <td><span  name="totalqty"  class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&nbsp;</span><?php echo $qty;?></span> 
                                        <input type="hidden" name="totalqty" value="<?php echo $qty;?>">
                                        </td>
                                    </tr>
                                    
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td>
                                        <strong>
                                            <span name="paymentamount" class="woocommerce-Price-amount amount">
                                            <span class="woocommerce-Price-currencySymbol">$&nbsp;</span>
                                            <?php echo $price;?></span></strong>  
                                            <input type="hidden" name="paymentamount" value="<?php echo $price;?>">   
                                            </td>
                                    </tr>

                                    </tfoot>
                                </table>
                                <div id="payment" class="woocommerce-checkout-payment">

                                    <div class="form-row place-order">
                                        <noscript>
                                            Since your browser does not support JavaScript, or it is disabled, please ensure you click the &lt;em&gt;Update Totals&lt;/em&gt; button before placing your order. You may be charged more than the amount stated above if you fail to do so.
                                            <br/>
                                            <button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals">Update totals</button>
                                        </noscript>

                                        <div class="woocommerce-terms-and-conditions-wrapper">
                                            <div class="woocommerce-privacy-policy-text"></div>
                                        </div>

                                        <button type="submit" class="button alt" name="continuepayment" id="place_order" value="Place order" data-value="Place order">Continue to payment</button>

                                        <input id="woocommerce-process-checkout-nonce" name="woocommerce-process-checkout-nonce" value="698c117a02" type="hidden">
                                        <input name="_wp_http_referer" value="#checkout" type="hidden"> </div>


                                </div>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.section-padding -->
    </section>
    <!-- /.shop -->

   <?php   include "footer.php"; ?>