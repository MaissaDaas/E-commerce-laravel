<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashbord Admin</title>
        <link rel="icon" href="images/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="../../css/dashbord.css">
    </head>
    <body>
        <div class="container">
            @include('dashbord.sidebar')

            <main style="margin-left:3rem;">
                <a href="{{ route('categoryAdmin') }}" class="link">Categories</a>
                <span class="arrow">&rarr;</span>
                <a href="{{ route('addCategoryAdmin') }}" class="link">Add Categories</a>
                <h1>Add Categories</h1>

                <div class="recent_order">
                    <div class="date">
                        <input type="date" id="currentDate">
                    </div>

                    <form id="addCategoryForm" action="{{ route('createCategoryAdmin') }}" method="POST" class="add_form" enctype="multipart/form-data">
                        @csrf
                        <div class="add__inputs">
                            <div class="add__box @error('name') input-error @enderror">
                                <h3 class="add_h">Name</h3>
                                <input type="text"  required class="add__input" id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="add__box @error('slug') input-error @enderror">
                                <h3 class="add_h">Slug</h3>
                                <input type="text"  required class="add__input" id="slug" name="slug" value="{{ old('slug') }}">
                                @error('slug')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="add__box @error('description') input-error @enderror">
                            <h3 class="add_h">Description</h3>
                            <textarea  required class="add__input" id="description" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                       
                        <div class="add__box @error('image') input-error @enderror">
                            <h3 class="add_h">Image</h3>
                            <input type="file" class="" id="image" name="image" style="margin-top:5x">
                            @error('image')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="button-group">
                            <button type="submit" class="add__button">Create</button>
                            <button type="button" class="cancel__button" onclick="document.getElementById('addCategoryForm').reset();">Cancel</button>
                            <a href="{{ route('categoryAdmin') }}" class="bacK__button">Back</a>
                        </div>
                    </form>
                </div>

            </main>

            @include('dashbord.right')
        </div>

        <!-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dateInput = document.getElementById('currentDate');
                const today = new Date();
                const yyyy = today.getFullYear();
                const mm = String(today.getMonth() + 1).padStart(2, '0'); 
                const dd = String(today.getDate()).padStart(2, '0');
                const formattedDate = `${yyyy}-${mm}-${dd}`;
                dateInput.value = formattedDate;
            });

            document.addEventListener('DOMContentLoaded', function() {
                const categoriesLink = document.getElementById('categories-link');
                const categoriesSubmenu = document.getElementById('categories-submenu');
                const dropdown = categoriesLink.closest('.dropdown');

                categoriesLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    dropdown.classList.toggle('active');
                });
            });




            document.addEventListener('DOMContentLoaded', function() {
                const moreIcons = document.querySelectorAll('.more-icon');
        
                moreIcons.forEach(icon => {
                    icon.addEventListener('click', function(e) {
                        e.stopPropagation(); // Prevent click event from bubbling up
                        const popup = this.nextElementSibling;
                        
                        if (popup.style.display === "block") {
                            popup.style.display = "none";
                            popup.style.opacity = "0";
                            popup.style.visibility = "hidden";
                            popup.style.pointerEvents = "none";
                        } else {
                            popup.style.display = "block";
                            popup.style.opacity = "1";
                            popup.style.visibility = "visible";
                            popup.style.pointerEvents = "all";
                        }
                    });
                });

                // Hide popup when clicking outside
                document.addEventListener('click', function() {
                    const popups = document.querySelectorAll('.popup');
                    popups.forEach(popup => {
                        popup.style.display = "none";
                        popup.style.opacity = "0";
                        popup.style.visibility = "hidden";
                        popup.style.pointerEvents = "none";
                    });
                });

                // Prevent popup from closing when clicking inside
                document.querySelectorAll('.popup').forEach(popup => {
                    popup.addEventListener('click', function(e) {
                        e.stopPropagation();
                    });
                });
            });

            /******** theme color ******** */
            const  sideMenu = document.querySelector('aside');
            const menuBtn = document.querySelector('#menu_bar');
            const closeBtn = document.querySelector('#close_btn');

            const themeToggler = document.querySelector('.theme-toggler');

            menuBtn.addEventListener('click',()=>{
                sideMenu.style.display = "block"
            })
            closeBtn.addEventListener('click',()=>{
                sideMenu.style.display = "none"
            })

            themeToggler.addEventListener('click',()=>{
                document.body.classList.toggle('dark-theme-variables')
                themeToggler.querySelector('span:nth-child(1').classList.toggle('active')
                themeToggler.querySelector('span:nth-child(2').classList.toggle('active')
            })
        </script> -->

</body>
</html>