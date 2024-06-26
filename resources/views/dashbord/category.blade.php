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
                <a href="{{ route('categoryAdmin') }}" class="link">List</a>
                <h1>Categories</h1>

                <div class="recent_order">
                    <div class="date">
                        <input type="date" id="currentDate">
                    </div>

                    <div class="addbutton">
                        <a href="{{ route('addCategoryAdmin') }}" class="add-category-link" style="margin:0px;">
                            <span class="material-symbols-sharp" style="bottom:20px;">add </span>
                            <h3>Add category</h3>
                        </a>
                    </div>
                    <!-- <h2>Recent Orders</h2> -->
                    <table> 
                        <thead>
                            <tr>
                                <!-- <th>Category ID</th> -->
                                <th >Category Name</th>
                                <th>Images</th>
                                <th>Slug</th>
                                <th>Is Active</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <!-- <td>{{ $category->id }}</td> -->
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if($category->images)
                                            <img src="{{ asset( $category->images) }}" alt="{{ $category->name }}" style="width: 60px; height: 60px;">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="material-symbols-sharp icon-active">check_circle</span>
                                        @else
                                            <span class="material-symbols-sharp icon-inactive">cancel</span>
                                        @endif
                                    </td>
                                    <td class="primary" >
                                        <span class="material-symbols-sharp more-icon" style="font-size: 2rem; padding-top: .2rem; padding-right: 1rem; font-variation-settings: 'wght' 900;">more_vert</span>
                                        <div class="popup">

                                            <div class="action-icons ic1" style="">
                                                <button id='openModal_all'  class="view-button" data-category-id="{{ $category->id }}">
                                                    <span class="material-symbols-sharp" style="font-size: 1.7rem; padding-top:.2rem">visibility</span>
                                                    <h3>View</h3>
                                                </button>
                                            </div>

                                            <div class="action-icons ic2" style=" ">
                                                <button id='openModal'  class="edit-button" data-category-id="{{ $category->id }}">
                                                    <span class="material-symbols-sharp" style="font-size: 1.7rem; padding-top:.2rem">create</span>
                                                    <h3>Edit</h3>
                                                </button>

                                            </div>

                                            <div class="action-icons ic3" style="">
                                                <form action="{{ route('category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete-button">
                                                        <span class="material-symbols-sharp" style="font-size: 1.7rem; padding-top:.2rem">delete</span>
                                                        <h3>Delete</h3>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>   

                                        <div id='modal_{{ $category->id }}' class='modal'>
                                            <div class='modal-content' >
                                                <span class='close'>&times;</span>

                                                @foreach($categories as $category)
                                                <!-- ******************************form edit******************* -->
                                                <h1 class="edit-h1">Edit Category</h1>
                                                <!-- <form action="{{ route('updateCategoryAdmin', ['id' => $category->id]) }}" method="POST" class="add_form" enctype="multipart/form-data" style="padding:0px;"> -->

                                                <form action="{{ route('createCategoryAdmin') }}" method="POST" class="add_form" enctype="multipart/form-data" style="padding:0px;">
                                                    @csrf
                                                    @method('PUT') 
                                                    <div class="add__inputs">
                                                        <div class="add__box @error('name') input-error @enderror">
                                                            <h3 class="add_h" style="text-align: left;">Name</h3>
                                                            <input type="text"  required class="add__input" id="name" name="name" value="{{ $category->name }}">
                                                            @error('name')
                                                                <div class="error-message">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        
                                                        <div class="add__box @error('slug') input-error @enderror">
                                                            <h3 class="add_h" style="text-align: left;">Slug</h3>
                                                            <input type="text"  required class="add__input" id="slug" name="slug" value="{{ old('slug') }}">
                                                            @error('slug')
                                                                <div class="error-message">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="add__box @error('description') input-error @enderror">
                                                        <h3 class="add_h" style="text-align: left;">Description</h3>
                                                        <textarea  required class="add__input" id="description" name="description">{{ old('description') }}</textarea>
                                                        @error('description')
                                                            <div class="error-message">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="add__box @error('image') input-error @enderror">
                                                        <h3 class="add_h" style="text-align: left;">Image</h3>
                                                        <input type="file" class="" id="image" name="image" style="margin-top:5x ; display: block;">
                                                        @error('image')
                                                            <div class="error-message">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    

                                                    <div class="button-group">
                                                        <button type="submit" class="add__button">Create</button>
                                                        <button type="button" class="cancel__button">Cancel</button>
                                                    </div>
                                                </form>
                                                @endforeach

                                            </div>
                                        </div>   
                                        
                                        <!-- ************ view modal **************************** -->
                                            <div id='modal_view{{ $category->id }}' class='modal'>
                                                <div class='modal-content'>
                                                    <span class='close'>&times;</span>
                                                </div>
                                            </div>
                                    </td>
                                    <!-- <td class="warning">Pending</td> -->

                                </tr>
                            @endforeach        
                        
                        </tbody>
                    </table>
                    <!-- <a href="#">Show All</a> -->
                </div>

            </main>

            @include('dashbord.right')

        </div>

        <script>
            // document.addEventListener('DOMContentLoaded', function() {
            //     const dateInput = document.getElementById('currentDate');
            //     const today = new Date();
            //     const yyyy = today.getFullYear();
            //     const mm = String(today.getMonth() + 1).padStart(2, '0'); 
            //     const dd = String(today.getDate()).padStart(2, '0');
            //     const formattedDate = `${yyyy}-${mm}-${dd}`;
            //     dateInput.value = formattedDate;
            // });

            // document.addEventListener('DOMContentLoaded', function() {
            //     const categoriesLink = document.getElementById('categories-link');
            //     const categoriesSubmenu = document.getElementById('categories-submenu');
            //     const dropdown = categoriesLink.closest('.dropdown');

            //     categoriesLink.addEventListener('click', function(e) {
            //         e.preventDefault();
            //         dropdown.classList.toggle('active');
            //     });
            // });

            // const moreIcons = document.querySelectorAll('.more-icon');
    
            // moreIcons.forEach(icon => {
            //     icon.addEventListener('click', function(e) {
            //         e.stopPropagation(); 
            //         const popup = this.nextElementSibling;
                    
            //         if (popup.style.display === "block") {
            //             closeAllPopups(); 
            //         } else {
            //             closeAllPopups(); 
            //             popup.style.display = "block";
            //             popup.style.opacity = "1";
            //             popup.style.visibility = "visible";
            //             popup.style.pointerEvents = "all";
            //         }
            //     });
            // });

            // /*  ***** popup ******/
            // function closeAllPopups() {
            //     const popups = document.querySelectorAll('.popup');
            //     popups.forEach(popup => {
            //         popup.style.display = "none";
            //         popup.style.opacity = "0";
            //         popup.style.visibility = "hidden";
            //         popup.style.pointerEvents = "none";
            //     });
            // }

            // document.addEventListener('click', function() {
            //     closeAllPopups();
            // });

            // document.querySelectorAll('.popup').forEach(popup => {
            //     popup.addEventListener('click', function(e) {
            //         e.stopPropagation();
            //     });
            // });

            // const editButtons = document.querySelectorAll('.edit-button');
            // editButtons.forEach(button => {
            //     button.addEventListener('click', function() {
            //         const categoryId = this.getAttribute('data-category-id');
            //         const modal = document.getElementById('modal_' + categoryId);
            //         modal.style.display = "block";
            //         closeAllPopups();
            //     });
            // });

            // const viewButtons = document.querySelectorAll('.view-button');
            // viewButtons.forEach(button => {
            //     button.addEventListener('click', function() {
            //         const categoryId = this.getAttribute('data-category-id');
            //         const modal_view = document.getElementById('modal_view' + categoryId);
            //         modal_view.style.display = "block";
            //         closeAllPopups();
            //     });
            // });


            // closeButtons = document.querySelectorAll('.close');
            // closeButtons.forEach(button => {
            //     button.addEventListener('click', function() {
            //         const modal = this.closest('.modal');
            //         modal.style.display = "none";
            //     });
            // });

            // window.onclick = function(event) {
            //     const modals = document.querySelectorAll('.modal');
            //     modals.forEach(modal => {
            //         if (event.target == modal) {
            //             modal.style.display = "none";
            //         }
            //     });
            // }

            // // Get the modal
            // const modal = document.getElementById('modal');
            // const modal_all = document.getElementById('modal_all');

            // // Get the button that opens the modal
            // const btnOpenModal = document.getElementById('openModal');
            // const btnOpenModal_all = document.getElementById('openModal_all');

            // // Get the <span> element that closes the modal
            // var spanCloseModal = document.getElementsByClassName("close")[0];
            // var spanCloseModal_all = document.getElementsByClassName("close")[1];

            // // const spanCloseModal = document.querySelector('close');
            // // const spanCloseModal1 = document.querySelector('close');

            // // When the user clicks the button, open the modal 
            // btnOpenModal.onclick = function() {
            //     modal.style.display = "block";
            //     closeAllPopups(); 
            // }

            // btnOpenModal_all.onclick = function() {
            //     modal_all.style.display = "block";
            //     closeAllPopups(); 
            // }

            // // When the user clicks on <span> (x), close the modal
            // spanCloseModal.onclick = function() {
            //     modal.style.display = "none";
            // }

            // spanCloseModal_all.onclick = function() {
            //     modal_all.style.display = "none";
            // }

            // // When the user clicks anywhere outside of the modal, close it
            // window.onclick = function(event) {
            //     if (event.target == modal) {
            //         modal.style.display = "none";
            //     }
            // }

            // window.onclick = function(event) {
            //     if (event.target == modal_all) {
            //         modal_all.style.display = "none";
            //     }
            // }
        </script>

</body>
</html>