<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashbord Admin</title>
        <link rel="icon" href="../images/logopara.png" type="image/x-icon">
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
                                <h1>{{ $totalProducts }}</h1>
                            </div>

                            <div class="progress">
                                <svg>
                                    <circle  r="30" cy="40" cx="40"></circle>
                                </svg>
                                <div class="number"><p>{{ round($productPercentage) }}%</p></div>
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

                <div class="insights">
                    <div class="income" style="border-radius: 2rem; margin:2rem;">
                        <span class="material-symbols-sharp">check</span>
                        <div class="middle">

                            <div class="left">
                                <h3>In Stock</h3>
                                <h1>{{ $productsInStock }}</h1>
                            </div>

                            <div class="progress">
                                <svg>
                                    <circle  r="30" cy="40" cx="40"></circle>
                                </svg>
                                <div class="number"><p>{{ round($inStockPercentage) }}%</p></div>
                            </div>

                        </div>
                    </div>

                    <div class="expenses2" style="border-radius: 2rem; margin:2rem;">
                        <span class="material-symbols-sharp">cancel</span>
                        <div class="middle">

                            <div class="left">
                                <h3>Out Of Stock</h3>
                                <h1>{{ $productsOutOfStock }}</h1>
                            </div>

                            <div class="progress">
                                <svg>
                                    <circle  r="30" cy="40" cx="40"></circle>
                                </svg>
                                <div class="number"><p>{{ round($outOfStockPercentage) }}%</p></div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- <!-- dashbord.blade.php -->
                <canvas id="orderStatusChart" width="400" height="200"></canvas>

                <div class="orders-status">
                    <h2>Orders Status</h2>
                    <div class="status-bar">
                        @foreach ($orderCountsByStatus as $status => $count)
                            <div class="status-item">
                                <span>{{ ucfirst($status) }}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: {{ $count / $totalOrders * 100 }}%;"></div>
                                </div>
                                <p>{{ $count }}</p>
                            </div>
                        @endforeach
                    </div>
                </div> --}}
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


            /* ********************************* */
            document.addEventListener('DOMContentLoaded', function() {
                // Récupérer les données depuis PHP
                const orderStatusCounts = @json($orderStatusCounts);

                // Préparer les labels et les données pour Chart.js
                const labels = orderStatusCounts.map(status => status.status);
                const data = orderStatusCounts.map(status => status.total);

                // Créer le graphique avec Chart.js
                const ctx = document.getElementById('orderStatusChart').getContext('2d');
                const chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Order Status',
                            data: data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>

        <script src="../../js/script.js"></script>
    </body>
</html>