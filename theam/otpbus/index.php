<?php
$page_name = "Login";
include 'include/header-main-auth.php';
?>
    <wc-toast id="tt" position="top-right"> </wc-toast>

<div class="flex justify-center items-center min-h-screen bg-[url('/assets/images/map.svg')] dark:bg-[url('/assets/images/map-dark.svg')] bg-cover bg-center">
    <div class="panel sm:w-[480px] m-6 max-w-lg w-full">
<?php
if(isset($msg1)){
?>    
    <div class="flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light">
    <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Danger!</strong><?php echo $msg1;?></span>
</div>
<?php
}
?>
        <h2 class="font-bold text-2xl mb-3">Sign In</h2>
        <p class="mb-7">Enter your email and password to login</p>
        <div class="space-y-5">
            <div>
                <label for="email">Email</label>
                <input id="email" type="email" class="form-input" placeholder="Enter Email" />
            </div>
            <div>
                <label for="password">Password</label>
                <input id="password" type="password" class="form-input" placeholder="Enter Password" />
            </div>
             <center><button type="submit" class="btn btn-primary w-full" id="login">SIGN IN</button></center>
        </div>
        <div class="relative my-7 h-5 text-center before:w-full before:h-[1px] before:absolute before:inset-0 before:m-auto before:bg-[#ebedf2] dark:before:bg-[#253b5c] mb-3">
            <div class="font-bold text-white-dark bg-white dark:bg-[#0e1726] px-2 relative z-[1] inline-block"><span>OR</span></div>
        </div>
        <ul class="flex justify-center gap-2 sm:gap-3 mb-7">
            <li>
 <path fill="#4285F4" d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"></path>
  <path fill="#34A853" d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"></path>
  <path fill="#FBBC05" d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"></path>
  <path fill="#EB4335" d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"></path>
</svg>
  
</button></a>
            </li>
          
        </ul>
        <p class="text-center">Dont't have an account ? <a href="register" class="text-primary font-bold hover:underline">Sign Up</a></p>
    </div>
</div>
<?php 
include("include/custom_js.php");
?>   
<?php
include 'include/footer-main-auth.php';
?>
 