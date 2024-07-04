<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashbord Admin</title>
        <link rel="icon" href="images/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="../../css/dashbord.css">
    </head>
    <body>
        <div class="container">
            @include('dashbord.sidebar')

            <main style="margin-left:3rem;">
                <a href="{{ route('orderAdmin') }}" class="link">Orders</a>
                <span class="arrow">&rarr;</span>
                <a href="{{ route('orderAdmin') }}" class="link">List</a>
                <h1>Orders</h1>

                <div class="recent_order">
                    <div class="date">
                        <input type="date" id="currentDate">
                    </div>

                    <table> 
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Grand total</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->grand_total }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>
                                        <label for="payment_status" class="button-checkbox">
                                            <input type="checkbox" id="payment_status" name="payment_status" style="display: none;" {{ $order->payment_status ? 'checked' : '' }}>
                                            <span class="payment_status-{{ strtolower($order->payment_status) }}">{{ $order->payment_status }}</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label for="status" class="button-checkbox">
                                            <input type="checkbox" id="status" name="status" style="display: none;" {{ $order->status ? 'checked' : '' }}>
                                            <span class="status-{{ strtolower($order->status) }}">{{ $order->status }}</span>
                                        </label>
                                    </td>
                                    <td class="primary" >
                                        <span class="material-symbols-sharp more-icon" style="font-size: 2rem; padding-top: .2rem; padding-right: 1rem; font-variation-settings: 'wght' 900;">more_vert</span>
                                        <div class="popup">

                                            <div class="action-icons ic1" style="">
                                                <button id='openModal_all'  class="view-button" data-order-id="{{ $order->id }}">
                                                    <span class="material-symbols-sharp" style="font-size: 1.7rem; padding-top:.2rem">visibility</span>
                                                    <h3>View</h3>
                                                </button>
                                            </div>

                                            <div class="action-icons ic2" style=" ">
                                                <button id='openModal'  class="edit-button" data-order-id="{{ $order->id }}">
                                                    <span class="material-symbols-sharp" style="font-size: 1.7rem; padding-top:.2rem">create</span>
                                                    <h3>Edit</h3>
                                                </button>
                                            </div>
                                        </div>   

                                        <!-- ************ view modal **************************** -->
                                        <div id='modal_view{{ $order->id }}' class='modal' >
                                            <div class='modal-content-order'>
                                                <span class='close'>&times;</span>

                                                <h1 class="edit-h1">View all</h1>

                                                <div class="add__inputs">
                                                    <div class="add__box ">
                                                        <h3 class="add_h" style="text-align: left;">UserName</h3>
                                                        <input type="text" required class="add__input"
                                                            id="name" name="name"
                                                            value="{{ $order->user->name }}">
                                                    </div>

                                                    <div class="add__box ">
                                                        <h3 class="add_h" style="text-align: left;">Status</h3>
                                                        <input type="text" required class="add__input "
                                                            id="name" name="name"
                                                            value="{{ $order->status }}">
                                                    </div>
                                                </div>

                                                <div class="add__inputs">
                                                    <div class="add__box ">
                                                        <h3 class="add_h" style="text-align: left;">Grand total</h3>
                                                        <input type="text" required class="add__input"
                                                            id="name" name="name"
                                                            value="{{ $order->grand_total }}">
                                                    </div>

                                                    <div class="add__box ">
                                                        <h3 class="add_h" style="text-align: left;">Note</h3>
                                                        <input type="text" required class="add__input"
                                                            id="name" name="name"
                                                            value="{{ $order->notes }} ">
                                                    </div>
                                                </div>

                                                <div class="add__inputs">
                                                    <div class="add__box ">
                                                        <h3 class="add_h" style="text-align: left;">Payment Method</h3>
                                                        <input type="text" required class="add__input"
                                                            id="name" name="name"
                                                            value="{{ $order->payment_method }}">
                                                    </div>

                                                    <div class="add__box ">
                                                        <h3 class="add_h" style="text-align: left;">Payment Status</h3>
                                                        <input type="text" required class="add__input"
                                                            id="name" name="name"
                                                            value="{{ $order->payment_status }}">
                                                    </div>
                                                </div>

                                                <div class="add__inputs">
                                                    <div class="add__box ">
                                                        <h3 class="add_h" style="text-align: left;">Shipping Amount</h3>
                                                        <input type="text" required class="add__input"
                                                            id="name" name="name"
                                                            value="{{ $order->shipping_amount }}">
                                                    </div>

                                                    <div class="add__box ">
                                                        <h3 class="add_h" style="text-align: left;">Shipping Method</h3>
                                                        <input type="text" required class="add__input"
                                                            id="name" name="name"
                                                            value="{{ $order->shipping_method }}">
                                                    </div>
                                                </div>

                                                <div class="add__inputs">
                                                    <div class="add__box ">
                                                        <h3 class="add_h" style="text-align: left;">Created at</h3>
                                                        <input type="text" required class="add__input"
                                                            id="name" name="name"
                                                            value="{{ $order->created_at }}">
                                                    </div>

                                                    <div class="add__box ">
                                                        <h3 class="add_h" style="text-align: left;">Updated at</h3>
                                                        <input type="text" required class="add__input"
                                                            id="name" name="name"
                                                            value="{{ $order->updated_at }}">
                                                    </div>
                                                </div>

                                                <div class="view view__box" style="">
                                                    <h3 class="add_h" style="text-align: left;">Order Item</h3>
                                                    <table style='margin-top: 0; width:80%'>
                                                        <thead>
                                                            <tr>
                                                                <th>Product Name</th>
                                                                <th>Images</th>
                                                                <th>Unit Amount</th>
                                                                <th>Quantity</th>
                                                                <th>Total Amount</th>
                                                            </tr>
                                                        </thead>
    
                                                        <tbody>
                                                            @foreach($orders as $order)
                                                            @foreach($order->orderItems as $orderItem)
                                                            <tr>
                                                                <td>{{ $orderItem->product->name }}</td>
                                                                <td>
                                                                    @if($orderItem->product->images)
                                                                    <img src="{{ asset($orderItem->product->images) }}" alt="{{ $orderItem->product->name }}" style="width: 60px; height: 60px;">
                                                                    @else
                                                                    No Image
                                                                    @endif
                                                                </td>
                                                                <td>{{ $orderItem->unit_amount }} Dt</td>
                                                                <td>{{ $orderItem->quantity }}</td>
                                                                <td>{{ $orderItem->total_amount }} Dt</td>
                                                            </tr>
                                                            @endforeach
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    {{-- <button id='openModal_all'  class="view-button" data-orderitem-id="{{ $order->id }}">
                                                        <span class="material-symbols-sharp" style=" font-size: 1.7rem; ">open_in_new</span>
                                                    </button> --}}
                                                </div>
                                               
                                            </div>
                                        </div> 

                                        <!-- ******************************edit modal******************* -->
                                        <div id='modal_{{ $order->id }}' class='modal'>
                                            <div class='modal-content-order-edit' style=" margin-top: 270px; height:400px;">
                                                <span class='close'>&times;</span>

                                                <h1 class="edit-h1" style="padding-bottom: 20px">Edit Order</h1>

                                                <form action="{{ route('order.update', $order->id) }}"
                                                    method="POST" class="add_form" enctype="multipart/form-data"
                                                    style="padding:0px;">
                                                    @csrf
                                                    <div class="add__inputs">
                                                        <div class="add__box @error('name') input-error @enderror">
                                                            <h3 class="add_h" style="text-align: left;">Status</h3>
                                                            <select required class="add__input" id="status" name="status">
                                                                <option value="">Select a Status</option>
                                                                <option value="new" {{ $order->status == 'new' ? 'selected' : '' }}>New</option>
                                                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                                            </select>
                                                            @error('status')
                                                                <div class="error-message">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="add__inputs">
                                                        <div class="add__box @error('name') input-error @enderror">
                                                            <h3 class="add_h" style="text-align: left;">Payment Status</h3>
                                                            <select required class="add__input" id="payment_status" name="payment_status">
                                                                <option value="">Select a Payment Status</option>
                                                                <option value="Paid" {{ $order->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                                                                <option value="Pending" {{ $order->payment_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                                <option value="Failed" {{ $order->payment_status == 'Failed' ? 'selected' : '' }}>Failed</option>
                                                                <option value="Refunded" {{ $order->payment_status == 'Refunded' ? 'selected' : '' }}>Refunded</option>
                                                                <option value="Canceled" {{ $order->payment_status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                                                                <option value="Authorized" {{ $order->payment_status == 'Authorized' ? 'selected' : '' }}>Authorized</option>
                                                                <option value="Partially Paid" {{ $order->payment_status == 'Partially Paid' ? 'selected' : '' }}>Partially Paid</option>
                                                            </select>
                                                            @error('payment_status')
                                                                <div class="error-message">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="button-group" style="padding-bottom:10px;">
                                                        <button type="submit" class="add__button">Update</button>
                                                        <button type="button" class="cancel__button">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div> 
                                    </td>
                                </tr>
                            @endforeach       
                        </tbody>
                    </table>
                </div>
            </main>
            @include('dashbord.right')
        </div>
    </body>
</html>
