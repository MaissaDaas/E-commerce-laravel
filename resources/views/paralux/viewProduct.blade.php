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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <style>
       .message {
            position: fixed;
            top: 10px;
            right: 10px;
            border-radius: .7vw;
            font-size: 1.5vw;
            font-family: 'Lato', sans-serif;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            width: 28vw;
            height: auto;
            text-align: center;
            z-index: 1000;
            display: none; 
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 1vw; 
            border-radius: .3vw;
            padding-bottom: .8vw
        }

        .icon-box {
            width: 100%;
            height: 4vw;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--icon-background-color);
            color: white;
            font-size: 3vw;
            border-top-left-radius: .3vw;
            border-top-right-radius: .3vw;
        }

        .message.success {
            background-color: white;
            border-color: #388E3C; 
            color: #388E3C;
        }

        .message.error {
            background-color: white;
            border-color: #d32f2f; 
            color: #d32f2f;
        }

        .message.warning {
            background-color: white;
            border-color: #f57c00; 
            color: #f57c00;
        }

        .message .material-symbols-sharp {
            font-size: 4vw;
        }

        .status-label {
            font-size: 1.2vw;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: .5vw;
            margin-top: .9vw;
            text-align: center;
            width: 100%;
            color: var(--icon-background-color);
        }

        .text-box {
            width: 100%;
            background-color: white;
            height: 3.6vw;
            color: var(--clr-dark);
            text-align: center;
            justify-content: center;
            align-items: center;
            padding: 1vw;
            font-size: .8vw;
            font-family: 'Lato', sans-serif;
        }

        .text-box-label{
            background-color: white;
            width: 100%;
        }
    </style>
</head>

<body>
    <div id="message" class=" message-box">
        <div class="icon-box">
            <span class="material-symbols-sharp">check_circle</span>
        </div>

        <div class="text-box-label">
            <div class="status-label"></div>
            <div class="text-box">Message content here</div>
        </div>
    </div>

    <div class="container" style=" height: 120vw">
         <!-- Navigation -->
        @include('paralux.navigation')

        <div class="" style="margin: 2vw 13vw 7vw 9vw;">
            <div class="add__inputs" style="padding-bottom: 0px;">
                <div class="image-p-view">
                    @if($product->images)
                        <img src="{{ asset($product->images) }}" alt="{{ $product->name }}" class="image-view-product">
                    @else
                        No Image
                    @endif
    
                    <div class="brand-container">
                        <img src="{{ asset( $product->brand->images) }}" class="marque-image-view" alt="Logo de la marque">

                        @if($product->on_sale)
                            @php
                                $discountAmount = (float)$product->discount_amount;
                                $discountedPrice = $product->price * (1 - $discountAmount / 100);
                                $formattedDiscount = (floor($discountAmount) == $discountAmount) ? intval($discountAmount) : number_format($discountAmount, 2, '.', '');
                            @endphp
                            <span class="discount-view">{{ $formattedDiscount }}%</span>
                        @endif
                    </div>
                </div>

                <div class="details-view" style="flex: 2; height: auto;">
                    <div class="add__inputs">
                        <div class="add__box">
                            <span class="lien-view"><a href="{{ route('boutique') }}">Boutique</a> <i class="fas fa-chevron-right" style="margin-left: .4vw; margin-right: .4vw"></i> <a href="{{ route('viewProduct', ['id' => $product->id]) }}">{{ $product->name }}</a></span>
                        </div>  
                    </div>

                    <div class="add__inputs">
                        <div class="add__box ">
                            <h3 class="view-name">{{ $product->name }}</h3>
                        </div>

                        <div class="view-marque-img" style="width: 2vw">
                            <img src="{{ asset( $product->brand->images) }}" class="" style="width: auto; height: 3vw; max-width: 8vw; padding-right: 3vw" alt="Logo de la marque">
                        </div>
                    </div>

                    <div class="add__inputs">
                        <div class="add__box">
                            @if($product->on_sale)
                                <span class="old-price-view">{{ $product->price }} TND</span>
                                <span class="new-price-view">{{ number_format($discountedPrice, 2) }} TND</span>
                            @else
                                <span class="price-view">{{ $product->price }} TND</span>
                            @endif
                        </div>  
                        
                        <input type="hidden" name="price" value="{{ $product->price }}">
                    </div>

                    <div class="add__inputs">
                        <div class="add__box " style="width: 390px;">
                            <h3 class="desc-view">{!! $product->description !!}</h3>                            
                        </div>
                    </div>

                    <div class="add__inputs" style="width: 7vw; margin-top: 1vw">
                        <div class="add__box quantity-box">
                            <input type="button" value="-" class="min" onclick="updateQuantity('{{ $product->id }}', -1)">
                            <span id="quantity{{ $product->id }}" class="qte" style="color: #777777; padding-left: .8vw; padding-right: .8vw">1</span>
                            <input type="button" value="+" class="plus" onclick="updateQuantity('{{ $product->id }}', 1)">
                        </div>
                        <input type="hidden" name="quantity" id="quantityInput{{ $product->id }}" value=1>
                    </div>

                    <div class="add__inputs" style="padding-bottom: 0;">
                        <form id="addProductForm{{ $product->id }}" method="POST" class="add_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" id="quantity" name="quantity" id="quantityInput{{ $product->id }}" value=1>
                            @if(auth()->check())
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            @endif

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="btn-panier" style="margin-right: .7vw">
                                <button type="submit" class="btn-panier-link">Ajouter au Panier</button>
                            </div>    
                        </form>

                        <form id="addProductFormWishlist{{ $product->id }}" method="POST" class="add_form_wishlist" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            @if(auth()->check())
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            @endif

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="btn-panier">
                                <button type="submit" class="btn-panier-link-wishlist"><ion-icon name="heart-outline"></ion-icon>Ajouter au liste de souhaits</button>
                            </div>
                        </form>

                        @if($product->in_stock == 0)
                            <span class="out-of-stock-view">Epuisé</span>
                        @endif
                    </div>

                    <div class="add__inputs" style="width: 35vw; margin-top: 3vw; border-bottom: 1px solid #ccc;">
                        <img src="../images/o1.png" alt="">
                        
                        <div class="spans-view">
                            <span class="titre-span-view">Produit 100% Authentique</span>
                            <span class="desc-span-view">Ce produit est 100% authentique, en vente sur notre site depuis la marque originale.</span>
                        </div>
                    </div>

                    <div class="add__inputs" style="width: 35vw; margin-top: 2vw; border-bottom: 1px solid #ccc;">
                        <img src="../images/o2.png" alt="">
                        
                        <div class="spans-view" style="margin-top: .5vw">
                            <span class="titre-span-view">Livraison à domicile</span>
                            <span class="desc-span-view">Livraison 7.00 TND</span>
                            <span class="desc-span-view" style="margin-top: .4vw">Livraison gratuite si supérieur à 200.00 TND.</span>
                        </div>
                    </div>

                    <div class="add__inputs" style="width: 35vw; margin-top: 2vw; border-bottom: 1px solid #ccc;">
                        <img src="../images/o3.png" alt="">
                        
                        <div class="spans-view">
                            <span class="titre-span-view">Politique de retour</span>
                            <span class="desc-span-view">Certains de nos articles, en raison de leurs caractéristiques spéciales, doivent respecter nos conditions pour pouvoir être retournés .</span>
                        </div>
                    </div>

                    <div class="add__inputs" style="padding-bottom: 0; margin-top: 1vw">
                        <div class="add__box add__inputs" style="padding-bottom: .2vw;">
                            <h3 class="marque-view-titre" style="text-align: left;">Catégorie:</h3>
                            <h3 class="marque-view">{{ $product->category->name }}</h3>
                        </div>  
                    </div>

                    <div class="add__inputs">
                        <div class="add__box add__inputs">
                            <h3 class="marque-view-titre" style="text-align: left;">Marque:</h3>
                            <h3 class="marque-view" style="text-transform: uppercase;">{{ $product->brand->name }}</h3>
                        </div> 
                    </div>
                </div>
            </div>   
        </div>

        <div class="product-section">
            <form method="GET" action="" class="form" style="margin-left: 2vw; margin-right: 2vw">
                <div class="titlecateg-div">
                    <span class="titlecateg" style="margin-left: 2vw">Produits similaires</span>
                </div>                    

                <div class="products-container items" style="padding-left: 2vw; padding-top: 3vw; padding-right: 2vw">
                    @foreach($similarProducts as $similarProduct)
                        @include('paralux.productBox', ['product' => $similarProduct])
                    @endforeach
                </div>
            </form>
        </div>
    </div>

    <!-- footer -->
    @include('paralux.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.customer-logos').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 1500,
                arrows: false,
                dots: false,
                pauseOnHover: false,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4
                    }
                }, {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 3
                    }
                }]
            });
        });
    </script>

     <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to update quantity
            function updateQuantity(button, change) {
                const quantityBox = button.closest(".quantity-box");
                const quantityElement = quantityBox.querySelector(".qte");
                const quantityInput = document.getElementById("quantity")
                // const hiddenQuantityInput = document.getElementById(`hiddenQuantity${productId}`);

                let currentQuantity = parseInt(quantityElement.innerText);
                let newQuantity = currentQuantity + change;
                if (newQuantity < 1) newQuantity = 1; 

                quantityElement.innerText = newQuantity;
                quantityInput.value = newQuantity;
            }

            // Add event listeners for quantity buttons
            document.querySelectorAll(".plus").forEach(button => {
                button.addEventListener("click", function() {
                    updateQuantity(this, 1);
                });
            });

            document.querySelectorAll(".min").forEach(button => {
                button.addEventListener("click", function() {
                    updateQuantity(this, -1);
                });
            });
        });
    </script> 
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showMessage(type, text) {
            var messageBox = document.getElementById('message');
            var statusLabel = messageBox.querySelector('.status-label');
            var iconBox = messageBox.querySelector('.icon-box');
            var textBox = messageBox.querySelector('.text-box');

            message.className = 'message ' + type;

            if(type === 'success') {
                statusLabel.textContent = 'Success';
                iconBox.innerHTML = '<span class="material-symbols-sharp">check_circle</span>';
            } else if(type === 'error') {
                statusLabel.textContent = 'Error';
                iconBox.innerHTML = '<span class="material-symbols-sharp">error</span>';
            } else if(type === 'warning') {
                statusLabel.textContent = 'Warning';
                iconBox.innerHTML = '<span class="material-symbols-sharp">warning</span>';
            }

            textBox.textContent = text;

            messageBox.style.display = 'flex';

            setTimeout(function() {
                messageBox.style.display = 'none';
            }, 5000);
        }

        document.body.addEventListener('submit', function(event) {
            if (event.target.classList.contains('add_form')) {
                event.preventDefault(); 

                const form = event.target;
                const formData = new FormData(form);

                fetch('{{ route('addpanier') }}', { 
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': formData.get('_token')
                    },
                    body: formData
                })
                .then(response => response)
                .then(data => {
                    if (data.status === 200) {
                        showMessage('success',' Produit ajouté au panier avec succès !');
                    } else {
                        showMessage('error','Erreur lors de l\'ajout du produit au panier');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('warning','Veuillez vous connecter pour continuer.');
                });
            }
        });

        document.body.addEventListener('submit', function(event) {
            if (event.target.classList.contains('add_form_wishlist')) {
                event.preventDefault(); 

                const form = event.target;
                const formData = new FormData(form);

                fetch('{{ route('addwishlist') }}', { 
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': formData.get('_token')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showMessage('success', 'Produit ajouté à la liste de souhaits avec succès !');
                    } else {
                        showMessage('error', 'Erreur lors de l\'ajout du produit à la liste de souhaits.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('warning','Veuillez vous connecter pour continuer.');
                });
            }
        });
    </script>
</body>
</html>
