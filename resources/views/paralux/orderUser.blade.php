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
        .required::after {
            content: "*";
            color: red;
            margin-left: 0.25em;
        }

        .hidden {
            display: none;
        }
    </style>

</head>

<body>
    <div class="container">
         <!-- Navigation -->
         @include('paralux.navigation')

        <div class="details" style="padding-left: 8vw; padding-right: 9vw">
            <form id="addAddressForm" action="{{ route('saveAddress') }}" method="POST" class="add_form_adress" style="margin-top:1.5vw">
                @csrf
                <div class="add__inputs_order">

                    <div class="add__box_order @error('first_name') input-error @enderror">
                        <h3 class="add_h_order required">Prénom</h3>
                        <input type="text"  required class="add__input_order" id="first_name" name="first_name" value="{{ old('first_name', $address->first_name ?? '') }}">
                        @error('first_name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="add__box_order @error('last_name') input-error @enderror">
                        <h3 class="add_h_order required">Nom</h3>
                        <input type="text"  required class="add__input_order" id="last_name" name="last_name" value="{{ old('last_name', $address->last_name ?? '') }}">
                        @error('last_name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="add__inputs_order">
                    <div class="add__box_order @error('phone') input-error @enderror">
                        <h3 class="add_h_order required">Numéro de télephne </h3>
                        <input  required class="add__input_order" id="phone" name="phone" value="{{ old('phone', $address->phone ?? '') }}">
                        @error('phone')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="add__inputs_order">
                    <div class="add__box_order @error('street_address	') input-error @enderror">
                        <h3 class="add_h_order required">Numéro et nom de rue </h3>
                        <input  required class="add__input_order" id="street_address" name="street_address" value="{{ old('street_address', $address->street_address ?? '') }}">
                        @error('street_address	')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="add__inputs_order">
                    <div class="add__box_order @error('state') input-error @enderror">
                        <h3 class="add_h_order required">Région</h3>
                        <input type="text"  required class="add__input_order" id="state" name="state" value="{{ old('state', $address->state ?? '') }}">
                        @error('state')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
               
                <div class="add__inputs_order">
                    <div class="add__box_order @error('city') input-error @enderror">
                        <h3 class="add_h_order required">Ville</h3>
                        <input type="text"  required class="add__input_order" id="city" name="city" value="{{ old('city', $address->city ?? '') }}">
                        @error('city')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="add__inputs_order">
                    <div class="add__box_order @error('zip_code') input-error @enderror">
                        <h3 class="add_h_order required">Code postal</h3>
                        <input type="text"  required class="add__input_order" id="zip_code" name="zip_code" value="{{ old('zip_code', $address->zip_code ?? '') }}">
                        @error('zip_code')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>   
                </div>
  
                <div class="button-group_order" style="margin-top:  1.3vw;">
                    <button type="submit" id="nextButton" class="add__button_order">Next</button>
                    @if ($address)
                        <button type="submit" formaction="{{ route('saveAddress') }}" class="add__button_order" style="width: 15rem; background-color: #7380ec">Modifier les données</button>
                    @endif
                </div>
            </form>

            <form id="paymentForm"id="addOrderForm" style="padding-top: 0" action="{{ route('createorderuser') }}" method="POST" class="hidden" enctype="multipart/form-data">
                @csrf

                @if(auth()->check())
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                @endif
                <input type="hidden" name="grand_total" value="{{ $total }}">

                <div class="add__inputs_order" style="margin-top: 1.2vw">
                    <div class="add__box_order @error('payment_method') input-error @enderror">
                        <h3 class="add_h_order required">Méthodes de paiement</h3>
                        <select required class="add__input" id="payment_method" name="payment_method" style="height: 2.2vw">
                            <option value="">Select méthodes de paiement</option>
                            <option value="Paiement à la livraison" >Paiement à la livraison</option>
                            <option value="Paiement en ligne">Paiement en ligne</option>
                        </select>
                        @error('payment_method')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>  
                </div>

                <div class="button-group_order" style="margin-top:  1.3vw;">
                    <button type="submit" class="add__button_order">Valider</button>
                </div>
            </form>   

            <div class="total_order">
                <div class='header-case_order'>
                    <table class='tabbtol_order'>
                        <tr class='tot_order'>
                            <td class='ttol_order'>Votre Commande</td>        
                        </tr>

                        <tr style="border-bottom: 1px solid #dce1eb;">
                            <td class='sous-ttol_order' >
                                <td class='sous-ttol' style="border-bottom: 1px solid #dce1eb;">
                                    <span class='sous-total-start_order_titre'>Produits</span>
                                    <span class='sous-total-end_order_titre'>Sous-total</span>
                                </td> 
                            </td>
                        </tr>

                        <tr style="border-bottom: 1px solid #dce1eb;">
                            @foreach($paniers as $panier)
                                <td class='sous-ttol_order'>
                                    <span class='sous-total-start_order'>{{ $panier->product->name}} x{{ $panier->quantity}}</span>
                                    <span class='sous-total-end_order'>{{ $panier->product->price}} TND</span>
                                </td> 
                            @endforeach    
                        </tr>

                        {{-- <tr style="border-bottom: 1px solid #dce1eb;">
                            @foreach($orderItems as $orderItem)
                                <td class='sous-ttol_order'>
                                    <span class='sous-total-start_order'>{{ $orderItem->product->name}}</span>
                                    <span class='sous-total-end_order'>{{ $orderItem->product->price}} TND</span>
                                </td> 
                            @endforeach    
                        </tr> --}}

                        <tr  style="border-bottom: 1px solid #dce1eb;">
                            <td class='sous-ttol_order' style="margin-top: .7vw">
                                <span class='sous-total-start_order' style=" font-size: 1.2vw; font-weight: 700;">Sous-total</span>
                                <span class='sous-total-end_order' style=" font-size: 1.2vw; color: #4b9a94; font-weight: 700;">{{ $subtotal }} TND</span>
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
                            <td class='sous-ttol' style="margin-top: .7vw; padding-bottom: 2vw">
                                <span class='sous-total-start' style=" font-size: 1.5vw; font-weight: 700;">Total</span>
                                <span class='sous-total-end' style=" font-size: 1.5vw; color: #4b9a94; font-weight: 700;">{{ $total }} TND</span>
                            </td> 
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    @include('paralux.footer') 
    <script src="https://js.stripe.com/v3/"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        document.getElementById('nextButton').addEventListener('click', function(event) {
            // Prevent form submission
            event.preventDefault();
            
            // Hide the address form
            document.getElementById('addAddressForm').classList.add('hidden');
            // Show the payment form
            document.getElementById('paymentForm').classList.remove('hidden');
        });
    </script>

</body>
</html>
