<?php
$page_name = "Otp Verification";
include 'include/header-main-auth.php';
?>
    <wc-toast id="tt" position="top-center"> </wc-toast>    
    
<div class="flex justify-center items-center min-h-screen bg-[url('/assets/images/map.svg')] dark:bg-[url('/assets/images/map-dark.svg')] bg-cover bg-center">
    <div class="panel sm:w-[480px] m-6 max-w-lg w-full">
        <div class="flex items-center mb-10">
            <div class="ltr:mr-4 rtl:ml-4">
                <img src="https://cdn-icons-png.flaticon.com/512/2919/2919906.png" class="w-16 h-16 object-cover rounded-full" alt="images" />
            </div>
            <div class="flex-1">
                <h4 class="text-2xl">Otp Verification</h4>
                <p>Otp Send Your Telegram Account</p>
            </div>
        </div>
        <div class="space-y-5">
            <div>
                 <input type="hidden" id="token" value="<?php echo $_SESSION['token'];?>">                                                                                                                   
                <label for="otp">Otp</label>
                <input id="otp" type="number" class="form-input" placeholder="Enter 6 Digit Otp" />
            </div>
            <button type="submit" id="otp_login" class="btn btn-primary w-full">UNLOCK</button>
        </div>
    </div>
</div>
    <?php 
include("include/custom_js.php");
?>   
<?php
include 'include/footer-main-auth.php';
?>
