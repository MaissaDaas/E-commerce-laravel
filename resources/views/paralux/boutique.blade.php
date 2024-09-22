<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ParaLux</title>
    <link rel="icon" href="../images/logopara.png" type="image/x-icon">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="../../css/user.css">
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

<body >
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
            <span class="span-category">Découvrez nos articles</span>
        </div>
       
        <!-- filter Section -->
        <div class="filter-section-boutique ">
            <div class = "filter-btns">
                <button type = "button" class = "filter-btn active-btn " data-category="all" data-description=" " id = "all">All</button>
                @foreach($categories as $category)
                    <button type = "button" class = "filter-btn active-btn" data-category="{{ $category->slug }}" data-description="{{ $category->description }}" id = "{{ $category->slug }}">{{ $category->name }}</button>
                @endforeach
            </div>

            <div class="description-category" id="description-category">
                <span> </span>
            </div>

            <div class="filter-condition">
                <div class="products-count">
                    <span id="total-products">Total des produits: {{ count($products) }}</span>
                </div>

                <div class="selector-product">
                    <span id="total-products" class="products-prix-brand">Filtrer par:</span>
                    <form method="GET" action="{{ route('boutique') }}" id="filter-form">
                        <select name="brand_id" id="select-brand" class="brand-selector">
                            <option value="">Choisir une marque</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>

                        <select name="sort_by" id="sort-select">
                            <option value="">Trier par prix</option>
                            <option value="Default" {{ request('sort_by') == 'Default' ? 'selected' : '' }}>Prix par default</option>
                            <option value="LowToHigh" {{ request('sort_by') == 'LowToHigh' ? 'selected' : '' }}>Prix croissant</option>
                            <option value="HighToLow" {{ request('sort_by') == 'HighToLow' ? 'selected' : '' }}>Prix décroissant</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="product-section">
                <form method="GET" action="" class="form">
                    <div class="products-container items">
                        @foreach($products as $product)
                            <div class="products ic filter-item all {{ $product->category->slug }}" data-price="{{ $product->price }}">
                                <div class="box-container-p">
                                    <div class="box-p">
                                        <div class="image-p">
                                            @if($product->images)
                                                <img src="{{ asset($product->images) }}" alt="{{ $product->name }}" class="image-pr">
                                            @else
                                                No Image
                                            @endif
                            
                                            <div class="brand-container">
                                                <img src="{{ asset( $product->brand->images) }}" class="marque-image" alt="Logo de la marque">

                                                @if($product->on_sale)
                                                    @php
                                                        $discountAmount = (float)$product->discount_amount;
                                                        $discountedPrice = $product->price * (1 - $discountAmount / 100);
                                                        $formattedDiscount = (floor($discountAmount) == $discountAmount) ? intval($discountAmount) : number_format($discountAmount, 2, '.', '');
                                                    @endphp
                                                    <span class="discount">{{ $formattedDiscount }}%</span>
                                                @endif
                                            </div>

                                            @if($product->in_stock == 0)
                                                <span class="out-of-stock">Epuisé</span>
                                            @endif

                                            <div class="hover-box">
                                                <form id="addProductForm{{ $product->id }}" method="POST" action="{{ route('addpanier') }}" class="add_form" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" id="quantity" name="quantity" value=1>
                                                    @if(auth()->check())
                                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                    @endif

                                                    <button type="submit" class="cart-icon" style="padding-left: 0; padding-right: 0">
                                                        <ion-icon name="cart-outline"></ion-icon>
                                                    </button>
                                                </form>

                                                <form id="addProductFormWishlist{{ $product->id }}" method="POST" action="{{ route('addwishlist') }}" class="add_form_wishlist" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    @if(auth()->check())
                                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                    @endif
                                                    <button type="submit" class="wishlist-icon" style="padding-left: 0; padding-right: 0">
                                                        <ion-icon name="heart-outline"></ion-icon>
                                                    </button>
                                                </form>

                                                <a href="{{ route('viewProduct', ['id' => $product->id]) }}" class="view-button" style="width: 5vw;">
                                                    <span class="preview-icon" style="margin-bottom: 0; background-color: white;"><ion-icon name="eye-outline"></ion-icon></span>
                                                </a>
                                            </div>                             
                                        </div>
                            
                                        <div class="content-p">
                                            <h3>{{ $product->name }}</h3>
                                            <input type="hidden" name="nom" value="{{ $product->name }}">
                                            <h3 class="marque-pr">{{ $product->brand->name }}</h3>
                                            
                                            <div class="price">
                                                @if($product->on_sale)
                                                    <span class="original-price">{{ $product->price }} TND</span>
                                                    <span class="new-price">{{ number_format($discountedPrice, 2) }} TND</span>
                                                @else
                                                    {{ $product->price }} TND
                                                @endif
                                            </div>
                                            
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </form>
            </div> 
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
                event.preventDefault(); 

                var form = $(this);
                var formData = form.serialize();

                $.ajax({
                    url: '{{ route('addpanier') }}',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.status === 200) {
                            showMessage('error','Erreur lors de l\'ajout du produit au panier');
                        } else {
                            showMessage('success','Produit ajouté au panier avec succès !');
                        }
                    },
                    error: function(xhr) {
                        showMessage('warning','Please login');
                    }
                });
            });
        });

        $(document).ready(function() {
            $('.add_form_wishlist').on('submit', function(event) {
                event.preventDefault(); 

                var form = $(this);
                var formData = form.serialize();

                $.ajax({
                    url: '{{ route('addwishlist') }}',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            showMessage('success', 'Produit ajouté à la liste de souhaits avec succès !');
                        } else {
                            showMessage('error', 'Erreur lors de l\'ajout du produit à la liste de souhaits.');
                        }
                    },
                    error: function(xhr) {
                        showMessage('warning','Veuillez vous connecter pour continuer.');
                    }
                });
            });
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

        document.getElementById('select-brand').addEventListener('change', function() {
            document.getElementById('filter-form').submit();
        });

        document.getElementById('sort-select').addEventListener('change', function() {
            document.getElementById('filter-form').submit();
        });

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
                const quantityInput = document.getElementById(`quantity_input${button.closest('.modal-content-product').id.replace('modal_view', '')}`);
                let currentQuantity = parseInt(quantityElement.innerText);
                let newQuantity = currentQuantity + change;
                if (newQuantity < 1) return;

                quantityElement.innerText = newQuantity;
                quantityInput.value = newQuantity;
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const descriptionContainer = document.getElementById('description-category');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const categorySlug = this.getAttribute('data-category');
                    const description = this.getAttribute('data-description');
                    
                    // Remove 'active-btn' class from previously active button
                    const activeButton = document.querySelector('.filter-btn.active-btn');
                    if (activeButton) {
                        activeButton.classList.remove('active-btn');
                    }
                    
                    // Add 'active-btn' class to the currently clicked button
                    this.classList.add('active-btn');
                    
                    // Update the description
                    descriptionContainer.querySelector('span').innerText = description || 'Veuillez sélectionner une catégorie pour voir la description.';

                    // Update the URL without reloading the page
                    if (categorySlug) {
                        window.history.pushState({}, '', `/boutique/${categorySlug}`);
                    } else {
                        window.history.pushState({}, '', '/boutique');
                    }

                    window.location.reload();
                });
            });
        });

        $(document).ready(function() {
            $('.filter-btn').on('click', function() {
                $('.filter-btn').removeClass('active-btn');

                $(this).addClass('active-btn');

                var description = $(this).data('description');
                $('#description-category span').text(description);
            });
        });
    </script>

    <script src="../../js/user.js"></script>
</body>

</html>
