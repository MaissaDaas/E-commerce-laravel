<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--=============== REMIXICONS ===============-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">

      <link rel="stylesheet" href="../css/login.css">

      <title>Login form - Admin</title>
   </head>
   <body>
      <div class="login">
         <!-- <img src="assets/img/login-bg.png" alt="image" class="login__bg"> -->

         <form action="{{ route('admin_login') }}" method="POST" class="login__form" encrypt="multipart/form-data">
            @csrf   
            <h1 class="login__title">Login</h1>

            <div class="login__inputs">
               <div class="login__box">
                  <input type="email" placeholder="Email" required class="login__input" id="email" name="email" value="">
                  <i class="ri-mail-fill"></i>
               </div>

               <div class="login__box">
                  <input type="password" placeholder="Password" required class="login__input" id="password" name="password" value="">
                  <i class="ri-lock-2-fill"></i>
               </div>
            </div>

            <div class="login__check">
               <div class="login__check-box">
                  <input type="checkbox" class="login__check-input" id="user-check">
                  <label for="user-check" class="login__check-label">Remember me</label>
               </div>

               <a href="#" class="login__forgot">Forgot Password?</a>
            </div>

            <button type="submit" class="login__button">Login</button>

            <div class="login__register">
               Don't have an account? <a href="#">Register</a>
            </div>
         </form>
      </div>
   </body>
</html>