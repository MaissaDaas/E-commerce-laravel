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
                    {{-- <span class="cart-icon"><ion-icon name="cart-outline"></ion-icon></span> --}}
                    {{-- <span class="wishlist-icon"><ion-icon name="heart-outline"></ion-icon></span> --}}
                    
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

                        <div id="success-message" style="display: none; color: green;"></div>
                        <div id="error-message" style="display: none; color: red;"></div>
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
