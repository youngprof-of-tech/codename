<?php 
$page_name = "Buy Numbers";
include 'include/header-main.php'; 
?>
<script>
    $(document).ready(function() {
        // Remove "active" class from all <a> elements
        $('#slide-dashboard').removeClass("active");
        
        // Add "active" class to the specific element with ID "faq"
        $("#slide-buy-number").addClass("active");

        // Function to calculate the total amount
        function calculateTotalAmount() {
            var quantity = parseInt($("#quantity").val());
            var minimumAmount = 1;
            var totalAmount = quantity * minimumAmount;

            $("#total-amount").text("N" + totalAmount);
            $("#amount").val(totalAmount);

            // Update the redirect_url with the new amount and quantity
            var userId = "<?php echo base64_encode($_SESSION['user_id']); ?>";
            var token = "<?php echo base64_encode($_SESSION['token']); ?>";
            var encodedAmount = btoa(totalAmount);
            var encodedQuantity = btoa(quantity);
            
            var redirectUrl = "https://test.onemediahost.com/updatebalance?u=" + userId + "&t=" + token + "&a=" + encodedAmount + "&q=" + encodedQuantity;
           
            $("#redirect_url").val(redirectUrl);

            // Store quantity and amount in sessionStorage
            sessionStorage.setItem('quantity', quantity);
            sessionStorage.setItem('amount', totalAmount);
        }

        // Retrieve quantity and amount from sessionStorage
        var storedQuantity = sessionStorage.getItem('quantity');
        var storedAmount = sessionStorage.getItem('amount');
        if (storedQuantity && storedAmount) {
            $("#quantity").val(storedQuantity);
            $("#total-amount").text("N" + storedAmount);
            $("#amount").val(storedAmount);
        }

        // Calculate total amount when the page loads and when the quantity changes
        calculateTotalAmount();
        $("#quantity").on("input", calculateTotalAmount);
    });
</script>

<link rel='stylesheet' type='text/css' href='theam/otpbus/assets/css/nice-select2.css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/animations.min.css" integrity="sha512-GKHaATMc7acW6/GDGVyBhKV3rST+5rMjokVip0uTikmZHhdqFWC7fGBaq6+lf+DOS5BIO8eK6NcyBYUBCHUBXA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-3.2.6.min.css" rel="stylesheet">
<style>
/* Additional styling */
.order-summary {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    font-size: 1.2rem;
}

#total-amount {
    font-size: 1.5rem;
    font-weight: bold;
    color: #000;
}

.quantity-input {
    width: 100px;
    text-align: center;
}

.form-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #d3d3d3;
    border-radius: 10px;
    background-color: #f9f9f9;
}
</style>
<wc-toast id="tt" position="top-right"></wc-toast>

<script defer src="theam/otpbus/assets/js/apexcharts.js"></script>


<div class="panel mt-2 dark:bg-[#1b2e4b] dark:border-0">
    <div class="flex items-center justify-between mb-5">

        <h5 class="font-semibold text-lg dark:text-white-light">Flutterwave Payment</h5>
    </div>
    <input type="hidden" id="server_no" value="">
    <input type="hidden" id="token" value="<?php echo $_SESSION['token'];?>">
    <div class="mb-5"></div>
    <div class="mt-5">
        <form method="POST" action="https://checkout.flutterwave.com/v3/hosted/pay">
            <div class="order-summary">
                <div>
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" class="quantity-input" min="1" value="1" required>
                </div>
                <div id="total-amount">N1</div>
            </div>
            <input type="hidden" name="public_key" value="FLWPUBK-19a5e8223912a6e957761ac176a4ca54-X" />
            <input type="hidden" name="customer[email]" value="<?php echo $userdata['email'];?>" />
            <input type="hidden" name="customer[name]" value="<?php echo $userdata['name'];?>" />
            <input type="hidden" name="tx_ref" value="txref-81123" />
            <input type="hidden" id="amount" name="amount" value="1" />
            <input type="hidden" name="currency" value="NGN" />
            <input type="hidden" name="meta[source]" value="docs-html-test" />
            <input type="hidden" id="redirect_url" name="redirect_url" value="" />

            <br>
            <button type="submit" id="start-payment-button" class="btn btn-primary w-full">
                <span class='fa fa-cart-plus' style='margin-right: 8px;'></span> Recharge
            </button>
        </form>
    </div>
</div>


<div id="my_model" class=""></div>

<script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
<script src="theam/otpbus/assets/js/nice-select2.js"></script>
<script src="js/main.js?v=55448535"></script>
<script type="module" src="js/sms.js?v=052"></script>
<script src="js/xy.js?v=22929"></script>

<?php include 'include/footer-main.php'; ?>
