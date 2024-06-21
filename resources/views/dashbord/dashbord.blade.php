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
                        <a href="{{ route('dashbord') }}" class="active">
                            <span class="material-symbols-sharp">grid_view </span>
                            <h3>Dashbord</h3>
                        </a>

                        <!-- <div class="dropdown">
                            <a href="#" class="main-link">
                                <span class="material-symbols-sharp">category</span>
                                <h3>Categories</h3>
                                <span class="material-symbols-sharp dropdown-icon">expand_more</span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="#">
                                        <span class="material-symbols-sharp">add</span>
                                        <h3>Add Category</h3>
                                    </a>
                                </li>
                            </ul>
                        </div> -->

                        <a href="{{ route('categoryAdmin') }}">
                            <span class="material-symbols-sharp">category</span>
                            <h3>Categories</h3>
                        </a>

                        <a href="#">
                            <span class="material-symbols-sharp">add </span>
                            <h3>Add category</h3>
                        </a>

                        <!-- <a href="#">
                            <span class="material-symbols-sharp">mail_outline </span>
                            <h3>Messages</h3>
                            <span class="msg_count">14</span>
                        </a> -->

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

                        <!-- <a href="#" class="active"> -->

                        <a href="#">
                            <span class="material-symbols-sharp">person_outline </span>
                            <h3>Users</h3>
                        </a>

                        <!-- <a href="#">
                            <span class="material-symbols-sharp">report_gmailerrorred </span>
                            <h3>Reports</h3>
                        </a>

                        <a href="#">
                            <span class="material-symbols-sharp">settings </span>
                            <h3>settings</h3>
                        </a> -->

                        <a href="{{ route('login_form') }}">
                            <span class="material-symbols-sharp">logout </span>
                            <h3>logout</h3>
                        </a>
                    </div>
                    
                </div>

            </aside>

            <main style="margin-left:3rem;">
                <h1>Dashbord</h1>

                <div class="date">
                    <input type="date" id="currentDate">
                </div>

                <div class="insights">
                    <div class="sales" style="border-radius: 2rem; margin:2rem;">
                        <span class="material-symbols-sharp">category</span>
                        <div class="middle">

                            <div class="left">
                                <h3>Total Categories</h3>
                                <h1>{{ $totalCategories }}</h1>
                            </div>

                            <div class="progress">
                                <svg>
                                    <circle  r="30" cy="40" cx="40"></circle>
                                </svg>
                                <div class="number"><p>{{ round($categoryPercentage) }}%</p></div>
                            </div>

                        </div>
                    </div>

                    <div class="expenses" style="border-radius: 2rem; margin:2rem;">
                        <span class="material-symbols-sharp">receipt_long </span>
                        <div class="middle">
                            <div class="left">
                                <h3>Total Products</h3>
                                <h1>..</h1>
                            </div>

                            <div class="progress">
                                <svg>
                                    <circle  r="30" cy="40" cx="40"></circle>
                                </svg>
                                <div class="number"><p>%</p></div>
                            </div>
        
                        </div>
                    </div>

                    <div class="income" style="border-radius: 2rem; margin:2rem;">
                        <span class="material-symbols-sharp">shopping_bag</span>
                        <div class="middle">
        
                            <div class="left">
                                <h3>Total Orders</h3>
                                <h1>{{ $totalOrders }}</h1>
                            </div>
                            <div class="progress">
                                <svg>
                                    <circle  r="30" cy="40" cx="40"></circle>
                                </svg>
                                <div class="number"><p>{{ round($orderPercentage) }}%</p></div>
                            </div>
        
                        </div>
                    </div>
                </div>

                <div class="recent_order">
                    <h2>Recent Orders</h2>
                    <table> 
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Number</th>
                                <th>Payments</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Mini USB</td>
                                <td>4563</td>
                                <td>Due</td>
                                <td class="warning">Pending</td>
                                <td class="primary"><span class="material-symbols-sharp">open_in_new</span></td>
                            </tr>
                            <tr>
                                <td>Mini USB</td>
                                <td>4563</td>
                                <td>Due</td>
                                <td class="warning">Pending</td>
                                <td class="primary"><span class="material-symbols-sharp">open_in_new</span></td>
                            </tr>
                            <tr>
                                <td>Mini USB</td>
                                <td>4563</td>
                                <td>Due</td>
                                <td class="warning">Pending</td>
                                <td class="primary"><span class="material-symbols-sharp">open_in_new</span></td>
                            </tr>
                        
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
                    <!-- <div class="profile">
                        <div class="info">
                            <p><b>Babar</b></p>
                            <p>Admin</p>
                            <small class="text-muted"></small>
                        </div>
                        <div class="profile-photo">
                            <img src="./images/profile-1.jpg" alt=""/>
                        </div>
                    </div> -->
                </div>

                <!-- <div class="recent_updates">
                    <h2>Recent Update</h2>
                    <div class="updates">
                        <div class="update">
                            <div class="profile-photo">
                                <img src="./images/profile-4.jpg" alt=""/>
                            </div>

                            <div class="message">
                                <p><b>Babar</b> Recived his order of USB</p>
                            </div>
                        </div>
                        <div class="update">
                            <div class="profile-photo">
                                <img src="./images/profile-3.jpg" alt=""/>
                            </div>
                            <div class="message">
                                <p><b>Ali</b> Recived his order of USB</p>
                            </div>
                        </div>
                        <div class="update">
                            <div class="profile-photo">
                                <img src="./images/profile-2.jpg" alt=""/>
                            </div>
                            <div class="message">
                                <p><b>Ramzan</b> Recived his order of USB</p>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="sales-analytics">
                    <h2>Sales Analytics</h2>

                    <div class="item onlion">
                        <div class="icon">
                            <span class="material-symbols-sharp">shopping_cart</span>
                            </div>
                            <div class="right_text">
                            <div class="info">
                                <h3>Onlion Orders</h3>
                                <small class="text-muted">Last seen 2 Hours</small>
                            </div>
                            <h5 class="danger">-17%</h5>
                            <h3>3849</h3>
                        </div>
                    </div>
                    <div class="item onlion">
                        <div class="icon">
                            <span class="material-symbols-sharp">shopping_cart</span>
                            </div>
                            <div class="right_text">
                            <div class="info">
                                <h3>Onlion Orders</h3>
                                <small class="text-muted">Last seen 2 Hours</small>
                            </div>
                            <h5 class="success">-17%</h5>
                            <h3>3849</h3>
                        </div>
                    </div>
                    <div class="item onlion">
                        <div class="icon">
                        <span class="material-symbols-sharp">shopping_cart</span>
                        </div>
                        <div class="right_text">
                        <div class="info">
                            <h3>Onlion Orders</h3>
                            <small class="text-muted">Last seen 2 Hours</small>
                        </div>
                        <h5 class="danger">-17%</h5>
                        <h3>3849</h3>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="item add_product">
                    <div>
                        <span class="material-symbols-sharp">add</span>
                    </div>
                </div> -->
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