<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--=============== REMIXICONS ===============-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">

      <link rel="stylesheet" href="../css/login.css">

      <title>Login</title>

      <style>
        .error-message {
            color: red;
            font-size: 0.675em;
            margin-left: 25px;
            margin-top: -20px;
        }
     </style>
   </head>
   <body>
      <div class="login">
         <!-- <img src="assets/img/login-bg.png" alt="image" class="login__bg"> -->

         <!-- @if ($errors->any())
            <div class="alert alert-danger">
               <ul>
                     @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                     @endforeach
               </ul>
            </div>
         @endif -->

         <form action="{{ route('admin_login') }}" method="POST" class="login__form" encrypt="multipart/form-data">
            @csrf   
            <h1 class="login__title">Login</h1>

            <div class="login__inputs">
               <div class="login__box @error('email') input-error @enderror">
                  <input type="email" placeholder="Email" required class="login__input" id="email" name="email" value="{{ old('email') }}">
                  <i class="ri-mail-fill"></i>
               </div>
               @error('email')
                  <div class="error-message">{{ $message }}</div>
               @enderror

               <div class="login__box @error('password') input-error @enderror">
                  <input type="password" placeholder="Password" required class="login__input" id="password" name="password" value="{{ old('password') }}">
                  <i class="ri-lock-2-fill"></i>
               </div>

               @error('password')
                  <div class="error-message">{{ $message }}</div>
               @enderror
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
               Don't have an account? <a href="{{ route('signin_form') }}">Register</a>
            </div>
         </form>
      </div>
   </body>
</html>