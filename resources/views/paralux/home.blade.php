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
     <!-- Include Slick CSS -->
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <style>
        .image-and-products-visage {
            display: flex;
            gap: 2rem;
            align-items: flex-start;
            position: relative;
            margin-top: 3vw;
            margin-bottom: 4vw;
        }

        .image-and-products-cheveux {
            display: flex;
            gap: 2rem;
            align-items: flex-start;
            position: relative;
            margin-top: 3vw;
            margin-bottom: 4vw;
        }

        .product-section-cheveux {
            width: 75%;
            margin-left: 2vw
        }

        .side-image {
            width: 22%;
            height: 35vw;
            position: absolute; 
            align-items: center;
            justify-content: center;
            text-align: center;
            padding-bottom: 1vw;
            top: -0vw;
            left: 0vw;
            z-index: 10;
        }

        .side-image-cheveux {
            width: 22%;
            height: 35vw;
            position: absolute; 
            align-items: center;
            justify-content: center;
            text-align: center;
            padding-bottom: 1vw;
            top: -0vw;
            left: 80vw;
            z-index: 10;
        }

        .product-section {
            width: 80%;
            margin-left: 25%;
            position: relative;
            z-index: 1;
        } 

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

        <!-- Image Container -->
        <div class="image-container">
            <img src="../images/banner-nuxe.png" alt="Grande Image">
            <button class="image-button">Découvre produit</button>
        </div>

        <div class="min-category">
            @foreach($categories as $category)                       
                <div class="category-item">
                    <a href="{{ route('boutique', ['category' => $category->slug]) }}" class="a-button-home">
                        <img src="{{ asset($category->images) }}" alt="category" class="category-min-image">
                        <span>{{ $category->name}}</span>
                    </a>
                </div>
            @endforeach
        </div>
        
        <!-- Category visage -->
        <div class="image-and-products-visage" style="padding-bottom: 0; margin-bottom: 3vw">
            <img src="../images/visage-image1.png" alt="" class="side-image" style="padding-bottom: 0;">
            <div class="product-section">
                <form method="GET" action="" class="form">
                    <div class="titlecateg-div">
                        <span class="titlecateg" style="margin-left: 2vw">Soin du Visage</span>
                        <button class="button-home-category" style="margin-right: 2.3vw;">
                            <a href="{{ route('boutique', ['category' => 'visage']) }}" class="a-button-home">Tous les produits</a>
                        </button>
                    </div>                    

                    <div class="products-container items" style="padding-left: 2vw; padding-top: 4vw; padding-right: 2vw">
                        @foreach($visageProducts as $product)
                            @include('paralux.productBox')
                        @endforeach
                    </div>
                </form>
            </div>
        </div>

          <!-- Category Section -->
        {{-- <div class="category">
            <span class="title1seller">Achetez par catégories</span>
            <div class="images_categories">
                <a href="{{ route('boutique', ['category' => 'visage']) }}" class="image-wrapper-visage">
                    <div class="best" style=" width:11vw ; height: 10vw;">
                        <h3 style="padding-top: 2vw">&nbsp; Visage &nbsp;&nbsp;</h3>
                    </div>
                    <img src="../images/visage1.jpg" alt="category visage" class="category-image visage">
                </a>
             
                <div class="grid-container" >
                    <a href="{{ route('boutique', ['category' => 'corps']) }}" class="image-wrapper">
                        <div class="best">
                            <h3 style="">&nbsp;&nbsp;  Corps &nbsp;&nbsp;&nbsp;</h3>
                        </div>
                        <img src="../images/visage2.jpg" alt="category corps" class="category-image" style=" height: 16vw;">
                    </a>

                    <a href="{{ route('boutique', ['category' => 'cheveux']) }}" class="image-wrapper">
                        <div class="best">
                            <h3>&nbsp; Cheveux &nbsp;&nbsp;</h3>
                        </div>
                        <img src="../images/visage3.jpg" alt="category cheveux" class="category-image"  style=" height: 16vw;">
                    </a>

                    <a href="{{ route('boutique', ['category' => 'mamanbebe']) }}}" class="image-wrapper mamanbebe-wrapper">
                        <div class="best">
                            <h3>&nbsp; Maman & Bébé &nbsp;&nbsp;</h3>
                        </div>
                        <img src="../images/visage4.jpg" alt="category mamanbebe" class="category-image mamanbebe">
                    </a>
                </div>
            </div>
        </div> --}}

        <!-- Category cheveux -->
        <div class="image-and-products-cheveux">
            <div class="product-section-cheveux">
                <form method="GET" action="" class="form">
                    <div class="titlecateg-div">
                        <span class="titlecateg" style="margin-left: 1vw">Soin du Cheveux</span>
                        <button class="button-home-category">
                            <a href="{{ route('boutique', ['category' => 'cheveux']) }}" class="a-button-home">Tous les produits</a>
                        </button>
                    </div>                    

                    <div class="products-container items" style="padding-left: 0vw; padding-top: 0vw; padding-right: 0vw">
                        @foreach($cheveuxProducts as $product)
                            @include('paralux.productBox')
                        @endforeach
                    </div>
                </form>
            </div>
            <img src="../images/cheveux-image.png" alt="" class="side-image-cheveux" style="width: 20vw; padding-bottom: 0;">
        </div>

        <!-- Category coprs -->
        <div class="image-and-products-visage" style="margin-bottom: 0">
            <img src="../images/image2.png" alt="" class="side-image" style="width: 22vw; padding-bottom: 0;">
            <div class="product-section">
                <form method="GET" action="" class="form">
                    <div class="titlecateg-div">
                        <span class="titlecateg" style="margin-left: 2vw">Soin du Corps</span>
                        <button class="button-home-category" style="margin-right: 2.3vw;">
                            <a href="{{ route('boutique', ['category' => 'corps']) }}" class="a-button-home">Tous les produits</a>
                        </button>
                    </div>                    

                    <div class="products-container items" style="padding-left: 2vw; padding-top: 0vw; padding-right: 2vw">
                        @foreach($corpsProducts as $product)
                            @include('paralux.productBox')
                        @endforeach
                    </div>
                </form>
            </div>
        </div>

        <!-- carosal brand -->
        {{-- <div class="brand-home" style="margin-top: 0vw; height: 30%;">
            <section class="customer-logos slider"  style="margin-top: 8vw;">
                @foreach($brands as $brand)
                    <div class="slide"><img src="{{ asset($brand->images) }}" alt="logo" style="width: 8.33vw; height:6.25vw;"></div>
                @endforeach
            </section>
        </div> --}}
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
    </script>
</body>

</html>
