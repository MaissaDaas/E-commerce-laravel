<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--=============== REMIXICONS ===============-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">

      <link rel="stylesheet" href="../css/login.css">

      <title>Sign Up</title>

      <style>
        .error-message {
            color: red;
            font-size: 0.675em;
            margin-left: 25px;
            margin-top: -20px;
         }

         .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: none;
         }
     </style>
   </head>
   <body>
      <div class="login">
         <!-- <img src="assets/img/login-bg.png" alt="image" class="login__bg"> -->

         <form action="{{ route('admin_register') }}" method="POST" class="register__form" enctype="multipart/form-data">
            @csrf   
            <h1 class="login__title">Sign Up</h1>

            <div class="login__inputs">

                <div class="login__box @error('name') input-error @enderror">
                  <input type="text" placeholder="Name" required class="login__input" id="name" name="name" value="{{ old('name') }}">
                  <i class="ri-user-fill"></i>
               </div>
               @error('name')
                  <div class="error-message">{{ $message }}</div>
               @enderror

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

            <button type="submit" class="login__button">Register</button>

            <div class="login__register">
            Already have an account? <a href="{{ route('login_form') }}">Login</a>
            </div>
         </form>
      </div>

      <!-- ***************success message**************** -->
      @if (session('success'))
      <div class="popup">
         <p>{{ session('success') }}</p>
      </div>
      @endif

      <script>
         document.addEventListener('DOMContentLoaded', function() {
            const successMessage = '{{ session('success') }}';
            if (successMessage) {
               const popup = document.querySelector('.popup');
               popup.style.display = 'block';

               // ferme popup apres 3 seconds 
               setTimeout(function() {
                  popup.style.display = 'none';
               }, 3000); 
            }
         });
      </script>

   </body>
</html>