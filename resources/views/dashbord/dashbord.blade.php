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

            </main>

            @include('dashbord.right')


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