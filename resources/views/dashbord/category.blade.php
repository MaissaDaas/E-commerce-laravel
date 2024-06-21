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
            <aside>
            <!-- <iframe src="sidebar.balade.php" frameborder="0" style="width: 100%; height: 100%;"></iframe> -->

                <div class="sidebar">
                    <div class="top">
                        <div class="logo">
                            <h2 style="margin-left:20px;">Dashbord <span class="danger">Admin</span> </h2>
                        </div>

                        <div class="close" id="close_btn">
                            <span class="material-symbols-sharp">
                            close
                            </span>
                        </div>
                    </div>

                    <div class="sous_sidebar">
                        <a href="{{ route('dashbord') }}">
                            <span class="material-symbols-sharp">grid_view </span>
                            <h3>Dashbord</h3>
                        </a>

                        <a href="{{ route('categoryAdmin') }}" class="active">
                            <span class="material-symbols-sharp">category</span>
                            <h3>Categories</h3>
                        </a>

                        <a href="#">
                            <span class="material-symbols-sharp">add </span>
                            <h3>Add category</h3>
                        </a>

                        <a href="#">
                            <span class="material-symbols-sharp">receipt_long </span>
                            <h3>Products</h3>
                        </a>

                        <a href="#">
                            <span class="material-symbols-sharp">add </span>
                            <h3>Add Product</h3>
                        </a>

                        <a href="#">
                            <span class="material-symbols-sharp">shopping_bag</span>
                            <h3>Orders</h3>
                        </a>

                        <a href="#">
                            <span class="material-symbols-sharp">person_outline </span>
                            <h3>Users</h3>
                        </a>

                        <a href="{{ route('login_form') }}">
                            <span class="material-symbols-sharp">logout </span>
                            <h3>logout</h3>
                        </a>
                    </div>
                    
                </div>

            </aside>

            <main style="margin-left:3rem;">
                <h1>Categories</h1>

                <div class="date">
                    <input type="date" id="currentDate">
                </div>

                <div class="recent_order">
                    <!-- <h2>Recent Orders</h2> -->
                    <table> 
                        <thead>
                            <tr>
                                <!-- <th>Category ID</th> -->
                                <th>Category Name</th>
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
                                            <img src="images/{{ $category->images }}" alt="{{ $category->name }}" style="width: 50px; height: 50px;">
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
                                        <div class="action-icons ic1" style="">
                                            <span class="material-symbols-sharp" style="font-size: 1.7rem; padding-top:.2rem">visibility</span>
                                        </div>

                                        <div class="action-icons ic2" style="">
                                            <span class="material-symbols-sharp" style="font-size: 1.7rem;  padding-top:.2rem">create</span>
                                        </div>

                                        <div class="action-icons ic3" style="">
                                            <span class="material-symbols-sharp" style="font-size: 1.7rem;  padding-top:.2rem">delete</span>
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

            <div class="right">

                <div class="top">
                    <button id="menu_bar">
                        <span class="material-symbols-sharp">menu</span>
                    </button>

                    <div class="theme-toggler">
                        <span class="material-symbols-sharp active">light_mode</span>
                        <span class="material-symbols-sharp">dark_mode</span>
                    </div>
            </div>
        </div>

        <script>
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
        </script>

        <script src="../../js/script.js"></script>
    </body>
</html>