<?php
$page_name = "Register";
include 'include/header-main-auth.php';
?>
    <wc-toast id="tt" position="top-right"> </wc-toast>
    
<div class="flex justify-center items-center min-h-screen bg-[url('/assets/images/map.svg')] dark:bg-[url('/assets/images/map-dark.svg')] bg-cover bg-center">
    <div class="panel sm:w-[480px] m-6 max-w-lg w-full">
        <h2 class="font-bold text-2xl mb-3">Sign Up</h2>
        <p class="mb-7">Enter your email and password to register</p>
        <div class="space-y-5">
            <div>
                <label for="name">Name</label>
                <input id="name" type="text" class="form-input" placeholder="Enter Name" />
            </div>
            <div>
                <label for="email">Email</label>
                <input id="email" type="email" class="form-input" placeholder="Enter Email" />
            </div>
            
            <div>
                <label for="password">Password</label>
                <input id="password" type="password" class="form-input" placeholder="Enter Password" />
            </div>
              <div>
               <input type="hidden" id="refer_id" value="<?php echo $_GET['ref_id'];?>">               
                <label for="confirm_password">Confirm Password</label>
                <input id="confirm_password" type="password" class="form-input" placeholder="Enter Confirm Password" />
            </div>
            <!--  <div>-->
            <!--    <label for="token">Token</label>-->
            <!--    <input id="token" type="text" class="form-input" placeholder="Enter Token" />-->
            <!--             <p class="mt-2">Don't Have Token  ? <a href="https://telegram.me/KGet_token_bot" target="_blank" class="text-primary font-bold hover:underline">Get Token</a></p>                         -->
            <!--</div>-->
            <div>
            <center><div class="g-recaptcha" data-sitekey="<?php echo $site_data['captcha_public_key'];?>"></div></center>
            </div>
             <center><button type="submit" id="register" class="btn btn-primary w-full">Sign Up</button></center>
        </div><br>
         <p class="text-center">Already have an account ? <a href="index" class="text-primary font-bold hover:underline">Sign In</a></p>
    </div>
</div>
<?php 
include("include/custom_js.php");
?>   
<?php include 'include/footer-main-auth.php'; ?>
 