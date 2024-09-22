<!-- View modal -->
<div id='modal_view{{ $product->id }}' class='modal' >
    <div class='modal-content-product'>
        <span class='close'>&times;</span>

        <form id="addProductForm{{ $product->id }}" action="{{ route('addpanier') }}" method="POST" class="add_form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="unit_amount" value="{{ $product->price }}">
            <input type="hidden" name="quantity" id="quantity{{ $product->id }}" value="1">

            <div class="add__inputs" style="padding-bottom: 0px;">
                <div class="view" >
                    <img src="{{ asset($product->images) }}" alt="{{ $product->name }}" class="image-view">
                </div>

                <div class="details-view" style="flex: 2; height: auto;">
                    <div class="add__inputs">
                        <div class="add__box ">
                            <h3 class="view-name">{{ $product->name }}</h3>
                        </div>
                    </div>

                    <div class="add__inputs">
                        <div class="add__box">
                            <h3 class="price-view">{{ $product->price }} Dt</h3>
                        </div>   
                    </div>

                    <div class="add__inputs">
                        <div class="add__box " style="width: 390px;">
                            <h3 class="desc-view">{{ $product->description }}</h3>
                        </div>
                    </div>

                    <hr>

                    <div class="add__inputs" style="padding-bottom: 0;">
                        <div class="add__box add__inputs" style="padding-bottom: .2vw;">
                            <h3 class="marque-view-titre" style="text-align: left;">Catégorie:</h3>
                            <h3 class="marque-view">{{ $product->category->name }}</h3>
                        </div>  
                    </div>

                    <div class="add__inputs">
                        <div class="add__box add__inputs">
                            <h3 class="marque-view-titre" style="text-align: left;">Marque:</h3>
                            <h3 class="marque-view">{{ $product->brand->name }}</h3>
                        </div> 
                    </div>

                    <div class="add__inputs">
                        <div class="add__box quantity-box" style="width: 6vw;">
                            <input type="button" value="-" class="min" onclick="updateQuantity('{{ $product->id }}', -1)">
                            <span id="quantity{{ $product->id }}" class="qte">1</span>
                            <input type="button" value="+" class="plus" onclick="updateQuantity('{{ $product->id }}', 1)">
                        </div>
                    </div>

                    <div class="add__inputs" style="padding-bottom: 0;">
                        <div class="btn-panier">
                            <a href="#" class="btn-panier-link" style="margin:0px;">
                                <h3>Ajouter au Panier</h3>
                            </a>
                        </div>

                        {{-- <div class="">
                            <span class="wishlist-icon-view"><ion-icon name="heart-outline"></ion-icon></span>
                        </div> --}}
                    </div>
                </div>
            </div>   
        </form> 
    </div>                                           
</div>

<script>
    function updateQuantity(productId, change) {
        const quantityField = document.getElementById('quantity' + productId);
        let quantity = parseInt(quantityField.innerText);
        quantity = Math.max(1, quantity + change); // Ensure quantity is at least 1
        quantityField.innerText = quantity;
        document.querySelector('input[name="quantity"]').value = quantity;
    }
</script>