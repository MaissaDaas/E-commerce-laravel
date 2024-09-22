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
            <span class="span-category">Historique des commandes</span>
        </div>

        <div class="btnpannier-historique">
            <button type="submit" class="btnpan-historique">
                <a href="{{ route('showpanier') }}">
                    Panier
                    <i class="fas fa-chevron-right" style="margin-left: .4vw; margin-right: .4vw"></i>
                </a>
            </button>
        </div>

        <div class="details" >
            <div class="recentOrders">
                <table> 
                    <thead>
                        <tr>
                            <th class="th-recent">ID de la commande</th>
                            <th class="th-recent">Montant total</th>
                            <th class="th-recent">Méthode de paiement</th>
                            <th class="th-recent">Statut du paiement</th>
                            <th class="th-recent">État de la commande</th>                            
                            <th class="th-recent">Produits</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $order)
                            <tr class="table-tr">
                                <td class="table-td-recent">{{ $loop->index + 1 }}</td>
                                <td class="table-td-recent">{{ $order->grand_total }}</td>
                                <td class="table-td-recent">{{ $order->payment_method }}</td>
                                <td class="table-td-recent">
                                    <label for="payment_status" class="button-checkbox-recent-order">
                                        <input type="checkbox" id="payment_status" name="payment_status" style="display: none;" {{ $order->payment_status ? 'checked' : '' }}>
                                        <span class="payment_status-{{ strtolower($order->payment_status) }}">{{ $order->payment_status }}</span>
                                    </label>
                                </td>

                                <td class="table-td-recent">
                                    <label for="status" class="button-checkbox-recent-order">
                                        <input type="checkbox" id="status" name="status" style="display: none;" {{ $order->status ? 'checked' : '' }}>
                                        <span class="status-{{ strtolower($order->status) }}">{{ $order->status }}</span>
                                    </label>
                                </td>     
                                
                                <td class="table-td-recent">
                                    <div class="action-icons ic1" style="">
                                        <button id='openModal_all'  class="view-button" data-order-id="{{ $order->id }}">
                                            <span class="material-symbols-sharp" style="font-size: 1.7rem; padding-top:.2rem; background-color: white; display: block;">visibility</span>
                                        </button>
                                    </div>

                                    <!-- ************ view modal **************************** -->
                                     <div id='modal_view{{ $order->id }}' class='modal' >
                                        <div class='modal-content-order'>
                                            <span class='close'>&times;</span>

                                            <h1 class="edit-h1" style="padding-bottom: 2vw; padding-top: 1vw; font-size: 2vw">Order Item</h1>
                                            <div class="view view__box" style="padding-left: 0">
                                                <table style='margin-top: 0; width:90%'>
                                                    <thead>
                                                        <tr>
                                                            <th class="col-order">Nom du Produit</th>
                                                            <th class="col-order">Images</th>
                                                            <th class="col-order">Quantité</th>
                                                            <th class="col-order">Prix</th>
                                                            <th class="col-order">Montant Unitaire</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach($order->orderItems as $orderItem)
                                                        <tr>
                                                            <td>{{ $orderItem->product ? $orderItem->product->name : 'No Product' }}</td>
                                                            <td style="padding-left: 1vw; padding-right: 1vw">
                                                                @if($orderItem->product->images)
                                                                <img src="{{ asset($orderItem->product->images) }}" alt="{{ $orderItem->product->name }}" style="width: 60px; height: auto;">
                                                                @else
                                                                No Image
                                                                @endif
                                                            </td>
                                                            <td>{{ $orderItem->quantity }}</td>
                                                            <td>{{ $orderItem->product->price }}</td>
                                                            <td>{{ $orderItem->unit_amount }} Dt</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div> 
                                </td>
                            </tr>
                        @endforeach       
                    </tbody>
                </table>
            </div>
        </div>  
    </div>

    <!-- footer -->
    @include('paralux.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
  
        //************** order view modal
        const viewButtonsOrder = document.querySelectorAll('.view-button');
        viewButtonsOrder.forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-order-id');
                const modal_view = document.getElementById('modal_view' + orderId);
                modal_view.style.display = "block";
                closeAllPopups();
            });
        });
        });

        // Close modals
        closeButtons = document.querySelectorAll('.close');
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modal = this.closest('.modal');
                modal.style.display = "none";
            });
        });

        closeButtons = document.querySelectorAll('.cancel__button');
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modal = this.closest('.modal');
                modal.style.display = "none";
            });
        });

        // Click outside modal to close
        window.onclick = function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
        }

        // Get the modal
        const modal = document.getElementById('modal');
        const modal_all = document.getElementById('modal_all');

        // Get the button that opens the modal
        const btnOpenModal = document.getElementById('openModal');
        const btnOpenModal_all = document.getElementById('openModal_all');

        // Get the <span> element that closes the modal
        var spanCloseModal = document.getElementsByClassName("close")[0];
        var spanCloseModal_all = document.getElementsByClassName("close")[1];

        // const spanCloseModal = document.querySelector('close');
        // const spanCloseModal1 = document.querySelector('close');

        // When the user clicks the button, open the modal 
        btnOpenModal.onclick = function() {
            modal.style.display = "block";
            closeAllPopups(); 
        }

        btnOpenModal_all.onclick = function() {
            modal_all.style.display = "block";
            closeAllPopups(); 
        }

        // When the user clicks on <span> (x), close the modal
        spanCloseModal.onclick = function() {
            modal.style.display = "none";
        }

        spanCloseModal_all.onclick = function() {
            modal_all.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        window.onclick = function(event) {
            if (event.target == modal_all) {
                modal_all.style.display = "none";
            }
        }
    </script>   
</body>

</html>
