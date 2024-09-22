<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ParaLux</title>
    <link rel="icon" href="../images/logopara.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="../../css/user.css">
    
    <!-- Include Slick CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <div class="container">
         <!-- Navigation -->
         @include('paralux.navigation')

        <div class="categorie-title">
            <span class="span-category">Panier</span>
        </div>

        @if(count($paniers) > 0)

            @if($orderCount > 1)
                <div class="btnpannier-historique">
                    <button type="submit" class="btnpan-historique">
                        <a href="{{ route('showAllOrders') }}">Historique des commandes
                            <i class="fas fa-chevron-right" style="margin-left: .4vw; margin-right: .4vw"></i>
                        </a>
                    </button>
                </div>
            @endif

            <div class="details">
                <div class="recentOrders">
                    <table> 
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Product Name</th>
                                <th style="justify-content: center; align-items: center; text-align: center;">Price</th>
                                <th style="justify-content: center; align-items: center; text-align: center;">Quantité</th>
                                <th style="justify-content: center; align-items: center; text-align: center;">Sous-total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($paniers as $panier)
                                <tr class="table-tr">
                                    <td class="table-td"> 
                                        <form action="{{ route('destroy.product.panier', $panier->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <span class='delete-panier'>&times;</span>
                                            </button>
                                        </form>
                                    </td>

                                    <td class="table-td" style="justify-content: center; align-items: center; text-align: center; padding-top: .2; padding-bottom: .2;">
                                        <img  src="{{ asset($panier->product->images) }}" alt="simple image" style="justify-content: center; align-items: center; text-align: center; height:7vw; width:auto; padding-top: 0; padding-bottom: 0;">
                                    </td>

                                    <td class="table-td" style="justify-content: flex-start; align-items: flex-start; text-align: start; width: 23vw; color: #363949">{{ $panier->product->name }}</td>
                                    <td class="table-price1 table-td">{{ $panier->product->price}} TND</td>
                                    
                                    <td class="table-td" >
                                        <form method='post' action="{{ route('panier.update', $panier->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-outline" >
                                                <div class="quantity-box" style="width: 6vw;">
                                                    <button type="button" class="min" data-id="{{ $panier->id }}">-</button>
                                                    <input type="hidden" name="quantity" value="{{ $panier->quantity }}" class="qte-input">
                                                    <span id="quantity" class="qte" name="quantity">{{ $panier->quantity }}</span>
                                                    <button type="button" class="plus" data-id="{{ $panier->id }}">+</button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>

                                    <td class="table-price2 table-td">{{ $panier->total_amount}} TND</td>
                                </tr>
                            @endforeach       
                        </tbody>
                    </table>
                </div>
        
                <div class="total">
                    <div class='header-case'>
                        <table class='tabbtol'>
                            <tr class='tot'>
                                <td class='ttol'>Total Panier</td>        
                            </tr>

                            <tr>
                                <td class='sous-ttol' style="border-bottom: 1px solid #dce1eb;">
                                    <span class='sous-total-start'>Sous-total</span>
                                    <span class='sous-total-end'>{{ $subtotal }} TND</span>
                                </td> 
                            </tr>

                            <tr>
                                <td class='sous-ttol'>
                                    <span class='sous-total-end-delivery'>FIRST DELIVERY:</span>
                                </td> 
                            </tr>

                            <tr>
                                <td class='sous-ttol' style="border-bottom: 1px solid #dce1eb;">
                                    <span class='sous-total-end'>7.000 TND</span>
                                </td> 
                            </tr>

                            <tr>
                                <td class='sous-ttol' style="margin-top: .7vw">
                                    <span class='sous-total-start' style=" font-size: 1.2vw; font-weight: 600;">Total</span>
                                    <span class='sous-total-end' style=" font-size: 1.3vw; color: #4b9a94; font-weight: 600;">{{ $total }} TND</span>
                                </td> 
                            </tr>
                        </table>

                        <div class="">
                            <div class="btnpannier">
                                <button type="submit" class="btnpan"><a href="{{ route('showorderuser') }}">Valider ma Commande</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        @else
            <div class="empty-cart" >
                <ion-icon name="cart-outline" style="font-size: 18vw; color: #f7f7f7;"></ion-icon>
                <p  >Votre panier est vide</p>
            </div>
        @endif  
    </div>

    <!-- footer -->
    @include('paralux.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const plusButtons = document.querySelectorAll(".plus");
            const minusButtons = document.querySelectorAll(".min");

            plusButtons.forEach(button => {
                button.addEventListener("click", function() {
                    updateQuantity(this, 1);
                });
            });

            minusButtons.forEach(button => {
                button.addEventListener("click", function() {
                    updateQuantity(this, -1);
                });
            });

            function updateQuantity(button, change) {
                const quantityBox = button.closest(".quantity-box");
                const quantityElement = quantityBox.querySelector(".qte");
                const quantityInput = quantityBox.querySelector(".qte-input");
                const panierId = button.getAttribute("data-id");

                let currentQuantity = parseInt(quantityElement.innerText);
                let newQuantity = currentQuantity + change;
                if (newQuantity < 1) return;

                quantityElement.innerText = newQuantity;
                quantityInput.value = newQuantity;

                // AJAX request to update quantity in the database
                fetch(`/panier/${panierId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        quantity: newQuantity
                    })
                })
                .then(response => {
                    if (response.ok) {
                        location.reload(); 
                    } else {
                        throw new Error('Failed to update quantity');
                    }
                })
                .catch(error => {
                    console.error('Error updating quantity:', error);
                });
            }
        });
    </script>   
</body>

</html>
