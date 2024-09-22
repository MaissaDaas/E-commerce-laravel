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

    <div class="container">
         <!-- Navigation -->
         @include('paralux.navigation')

        <div class="categorie-title">
            <span class="span-category">liste de souhaits</span>
        </div>

        @if(count($wishlists) > 0)
            <div class="product-section" style="margin-top: 4.5vw">
                <form method="GET" action="" class="form">                   
                    <div class="products-container items" style="padding-left: 2vw; padding-top: 0vw; padding-right: 2vw">
                        @foreach($wishlists as $wishlist)
                        <div class="products ic" data-price="{{ $wishlist->product->price }}">
                            <div class="box-container-p">
                                <div class="box-p">
                                    <div class="image-p">
                        
                                        @if($wishlist->product->images)
                                            <img src="{{ asset($wishlist->product->images) }}" alt="{{ $wishlist->product->name }}" class="image-pr">
                                        @else
                                            No Image
                                        @endif
                        
                                        <div class="brand-container">
                                            <img src="{{ asset($wishlist->product->brand->images) }}" class="marque-image" alt="Logo de la marque">

                                            <td class="table-td"> 
                                                <form action="{{ route('destroy.product.wishlist', $wishlist->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">
                                                        <span class='delete-panier'>&times;</span>
                                                    </button>
                                                </form>
                                            </td>
                        
                                            @if($wishlist->product->on_sale)
                                                @php
                                                    $discountAmount = (float)$wishlist->product->discount_amount;
                                                    $discountedPrice = $wishlist->product->price * (1 - $discountAmount / 100);
                                                    $formattedDiscount = (floor($discountAmount) == $discountAmount) ? intval($discountAmount) : number_format($discountAmount, 2, '.', '');
                                                @endphp
                                                <span class="discount">{{ $formattedDiscount }}%</span>
                                            @endif
                                        </div>
                        
                                        @if($wishlist->product->in_stock == 0)
                                            <span class="out-of-stock">Epuisé</span>
                                        @endif

                                        <div class="hover-box">
                                            <form id="addProductForm{{ $wishlist->product->id }}" method="POST" action="{{ route('addpanier') }}" class="add_form" enctype="multipart/form-data" style="width: auto;">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $wishlist->product->id }}">
                                                <input type="hidden" id="quantity" name="quantity" value=1>
                                                @if(auth()->check())
                                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                @endif
                                                <button type="submit" class="cart-icon" style="padding-left: 0; padding-right: 0">
                                                    <ion-icon name="cart-outline"></ion-icon>
                                                </button>
                        
                                                <div id="success-message" style="display: none; color: green;"></div>
                                                <div id="error-message" style="display: none; color: red;"></div>
                                            </form>

                                            <a href="{{ route('viewProduct', ['id' => $wishlist->product->id]) }}" class="view-button" style="width: 5vw;">
                                                <span class="preview-icon" style="margin-bottom: 0; background-color: white;"><ion-icon name="eye-outline"></ion-icon></span>
                                            </a>

                                            {{-- <a href="{{ route('viewProduct', ['id' =>  $wishlist->product->id ]) }}" class="view-button" style="width: 5vw;">
                                                <span class="preview-icon" style="margin-bottom: 0; background-color: white;"><ion-icon name="eye-outline"></ion-icon></span>
                                            </a> --}}
                                        </div>
                                    </div>
                        
                                    <div class="content-p">
                                        <h3>{{ $wishlist->product->name }}</h3>
                                        <input type="hidden" name="nom" value="{{ $wishlist->product->name }}">
                                        <h3 class="marque-pr">{{ $wishlist->product->brand->name }}</h3>
                                        
                                        <div class="price">
                                            @if($wishlist->product->on_sale)
                                                <span class="original-price">{{ $wishlist->product->price }} DT</span>
                                                <span class="new-price">{{ number_format($discountedPrice, 2) }} DT</span>
                                            @else
                                                {{ $wishlist->product->price }} DT
                                            @endif
                                        </div>
                                        
                                        <input type="hidden" name="price" value="{{ $wishlist->product->price }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </form>
            </div>
        @else
            <div class="empty-cart" >
                <ion-icon name="heart-outline" style="font-size: 18vw; color: #f7f7f7;"></ion-icon>
                <p  >Votre wishlist est vide</p>
            </div>
        @endif 
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
        
        $(document).ready(function() {
            $('.add_form').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                var form = $(this);
                var formData = form.serialize();

                $.ajax({
                    url: '{{ route('addpanier') }}',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            showMessage('error','Erreur lors de l\'ajout du produit au panier');
                        } else {
                            showMessage('success',' Produit ajouté au panier avec succès !');
                        }
                    },
                    error: function(xhr) {
                        showMessage('warning','Veuillez vous connecter pour continuer.');
                    }
                });
            });
        });

        document.body.addEventListener('submit', function(event) {
            if (event.target.classList.contains('add_form')) {
                event.preventDefault(); // Prevent default form submission

                const form = event.target;
                const formData = new FormData(form);

                fetch('{{ route('addpanier') }}', { // Use Blade route helper to get the URL
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
                        showMessage('success',' Produit ajouté au panier avec succès !');
                        // Optionally, update the UI to reflect the addition to the cart
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
    </script>

    <script>
         document.addEventListener('DOMContentLoaded', function() {
            const viewButtonsProduct = document.querySelectorAll('.view-button');
            viewButtonsProduct.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); 
                    const productId = this.getAttribute('data-product-id');
                    const modal_view = document.getElementById('modal_view' + productId);
                    if (modal_view) {
                        modal_view.style.display = "block";
                        closeAllPopups();
                    }
                });
            });

            const closeButtons = document.querySelectorAll('.close');
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const modal = this.closest('.modal');
                    if (modal) {
                        modal.style.display = "none";
                    }
                });
            });

            window.onclick = function(event) {
                const modals = document.querySelectorAll('.modal');
                modals.forEach(modal => {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                });
            };
        });

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.modal').forEach(modal => {
                const plusButton = modal.querySelector(".plus");
                const minusButton = modal.querySelector(".min");
                const quantityElement = modal.querySelector("#quantity");

                plusButton.addEventListener("click", function() {
                    let currentQuantity = parseInt(quantityElement.innerText);
                    quantityElement.innerText = currentQuantity + 1;
                });

                minusButton.addEventListener("click", function() {
                    let currentQuantity = parseInt(quantityElement.innerText);
                    if (currentQuantity > 1) {
                        quantityElement.innerText = currentQuantity - 1;
                    }
                });
            });
        });
    </script>
 
</body>

</html>
