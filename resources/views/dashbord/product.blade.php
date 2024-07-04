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
                <a href="{{ route('productAdmin') }}" class="link">Products</a>
                <span class="arrow">&rarr;</span>
                <a href="{{ route('productAdmin') }}" class="link">List</a>
                <h1>Products</h1>

                <div class="recent_order">
                    <div class="date">
                        <input type="date" id="currentDate">
                    </div>

                    <div class="addbutton">
                        <a href="{{ route('addProductAdmin') }}" class="add-category-link" style="margin:0px;">
                            <span class="material-symbols-sharp" style="bottom:20px;">add </span>
                            <h3>Add product</h3>
                        </a>
                    </div>

                    <table> 
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Images</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>In Stock</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        @if($product->images)
                                            <img src="{{ asset( $product->images) }}" alt="{{ $product->name }}" style="width: 60px; height: 60px;">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>{{ $product->price }} Dt</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>
                                        @if($product->in_stock)
                                            <span class="material-symbols-sharp icon-active">check_circle</span>
                                        @else
                                            <span class="material-symbols-sharp icon-inactive">cancel</span>
                                        @endif
                                    </td>
                                    <td class="primary" >
                                        <span class="material-symbols-sharp more-icon" style="font-size: 2rem; padding-top: .2rem; padding-right: 1rem; font-variation-settings: 'wght' 900;">more_vert</span>
                                        <div class="popup">

                                            <div class="action-icons ic1" style="">
                                                <button id='openModal_all'  class="view-button" data-product-id="{{ $product->id }}">
                                                    <span class="material-symbols-sharp" style="font-size: 1.7rem; padding-top:.2rem">visibility</span>
                                                    <h3>View</h3>
                                                </button>
                                            </div>

                                            <div class="action-icons ic2" style=" ">
                                                <button id='openModal'  class="edit-button" data-product-id="{{ $product->id }}">
                                                    <span class="material-symbols-sharp" style="font-size: 1.7rem; padding-top:.2rem">create</span>
                                                    <h3>Edit</h3>
                                                </button>
                                            </div>

                                            <div class="action-icons ic3" style="">
                                                <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete-button">
                                                        <span class="material-symbols-sharp" style="font-size: 1.7rem; padding-top:.2rem">delete</span>
                                                        <h3>Delete</h3>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>   

                                        <!-- ************ view modal **************************** -->
                                        <div id='modal_view{{ $product->id }}' class='modal' >
                                            <div class='modal-content-product'>
                                                <span class='close'>&times;</span>

                                                <h1 class="edit-h1">View all</h1>

                                                <div class="view">
                                                    <img src="{{ asset($product->images) }}" alt="{{ $product->name }}"
                                                        style="width: 90px; height: 90px; border-radius: 10px; margin-bottom: 15px">
                                                </div>

                                                <div class="add__inputs">
                                                    <div class="add__box">
                                                        <h3 class="add_h" style="text-align: left;">Name</h3>
                                                        <input type="text" required class="add__input"
                                                            id="name" name="name"
                                                            value="{{ $product->name }}">
                                                    </div>

                                                    <div class="add__box">
                                                        <h3 class="add_h" style="text-align: left;">Slug</h3>
                                                        <input type="text" required class="add__input"
                                                            id="slug" name="slug"
                                                            value="{{ $product->slug }}">
                                                    </div>
                                                </div>

                                                <div class="add__box" style="width: 390px;">
                                                    <h3 class="add_h" style="text-align: left;">Description</h3>
                                                    <textarea required class="add__input add__input__description" id="description" name="description">{{ $product->description }}</textarea>
                                                </div>

                                                <div class="add__inputs">
                                                    <div class="add__box">
                                                        <h3 class="add_h" style="text-align: left;">Price</h3>
                                                        <input type="text" required class="add__input"
                                                            id="price" name="price"
                                                            value="{{ $product->price }}">
                                                    </div>

                                                    <div class="add__box">
                                                        <h3 class="add_h" style="text-align: left;">Category</h3>
                                                        <input type="text" required class="add__input"
                                                            id="price" name="price"
                                                            value="{{ $product->category->name }}">
                                                    </div>                                                        
                                                </div>

                                                <div class="add__inputs">
                                                    <div class="add__box">
                                                        <h3 class="add_h" style="text-align: left;">Created at</h3>
                                                        <input type="text" required class="add__input"
                                                            id="price" name="price"
                                                            value="{{ $product->created_at }}">
                                                    </div>

                                                    <div class="add__box">
                                                        <h3 class="add_h" style="text-align: left;">Updated at</h3>
                                                        <input type="text" required class="add__input"
                                                            id="price" name="price"
                                                            value="{{ $product->updated_at }}">
                                                    </div>                                                        
                                                </div>
                                                
                                                <div class="inline" style="width: 400px;">
                                                    <div class="float-left" style="width: 30%;">
                                                        <h3 class="add_h" style="text-align: center;">Is active</h3>
                                                        @if ($product->is_active)
                                                        <span class="material-symbols-sharp icon-active" style="align-items:center; margin-right:25px;">check_circle</span>
                                                        @else
                                                            <span class="material-symbols-sharp icon-inactive" style=" align-items: center; margin-right:25px;">cancel</span>
                                                        @endif                                                    
                                                    </div>
                                            
                                                    <div class="float-left" style="width: 35%;">
                                                        <h3 class="add_h" style="text-align: left;">Is featured</h3>
                                                        @if ($product->is_featured)
                                                        <span class="material-symbols-sharp icon-active" style="align-items:center; margin-right:25px;">check_circle</span>
                                                        @else
                                                            <span class="material-symbols-sharp icon-inactive" style="align-items:center; margin-right:25px;">cancel</span>
                                                        @endif                                                    
                                                    </div>
                                            
                                                    <div class="float-left" style="width: 30%;">
                                                        <h3 class="add_h" style="text-align: left;">In stock</h3>
                                                        @if ($product->in_stock)
                                                            <span class="material-symbols-sharp icon-active" style="align-items:center; margin-right:20px;">check_circle</span>
                                                        @else
                                                            <span class="material-symbols-sharp icon-inactive" style="align-items:center; margin-right:20px;">cancel</span>
                                                        @endif
                                                    </div>
                                            
                                                    <div class="float-left" style="width: 30%;">
                                                        <h3 class="add_h" style="text-align: left;">On sale</h3>
                                                        @if ($product->on_sale)
                                                        <span class="material-symbols-sharp icon-active" style="align-items:center; margin-right:25px;">check_circle</span>
                                                        @else
                                                            <span class="material-symbols-sharp icon-inactive" style="align-items:center; margin-right:25px;">cancel</span>
                                                        @endif                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                        <!-- ******************************edit modal******************* -->
                                        <div id='modal_{{ $product->id }}' class='modal'>
                                            <div class='modal-content-product-view' style=" margin-top: 70px; height:800px;">
                                                <span class='close'>&times;</span>

                                                <h1 class="edit-h1" style="padding-bottom: 20px">Edit Product</h1>

                                                <form action="{{ route('product.update', $product->id) }}"
                                                    method="POST" class="add_form" enctype="multipart/form-data"
                                                    style="padding:0px;">
                                                    @csrf
                                                    <div class="add__box">
                                                        @if ($product->images)
                                                            <img src="{{ asset($product->images) }}" alt="{{ $product->name }}" style="width: 80px; height: 80px; margin-bottom: 5px;">
                                                            <input type="hidden" name="current_image"
                                                                value="{{ $product->images }}">
                                                        @else
                                                            No Image
                                                        @endif
                                                    </div>

                                                    <div class="add__inputs">
                                                        <div class="add__box @error('name') input-error @enderror">
                                                            <h3 class="add_h" style="text-align: left;">Name</h3>
                                                            <input type="text" required class="add__input"
                                                                id="name" name="name"
                                                                value="{{ $product->name }}">
                                                            @error('name')
                                                                <div class="error-message">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="add__box @error('slug') input-error @enderror">
                                                            <h3 class="add_h" style="text-align: left;">Slug</h3>
                                                            <input type="text" required class="add__input"
                                                                id="slug" name="slug"
                                                                value="{{ $product->slug }}">
                                                            @error('slug')
                                                                <div class="error-message">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="add__box @error('description') input-error @enderror">
                                                        <h3 class="add_h" style="text-align: left;">Description</h3>
                                                        <textarea required class="add__input add__input__description" id="description" name="description">{{ $product->description }}</textarea>
                                                        @error('description')
                                                            <div class="error-message">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="add__inputs">
                                                        <div class="add__box @error('price') input-error @enderror">
                                                            <h3 class="add_h" style="text-align: left;">Price</h3>
                                                            <input type="text" required class="add__input"
                                                                id="price" name="price"
                                                                value="{{ $product->price }}">
                                                            @error('price')
                                                                <div class="error-message">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="add__box @error('category_id') input-error @enderror">
                                                            <h3 class="add_h" style="text-align: left;">Category</h3>
                                                            <select required class="add__input" id="category_id" name="category_id">
                                                                <option value="">Select a category</option>
                                                                @foreach($categories as $cat)
                                                                    <option value="{{ $cat->id }}" {{ $product->category->id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('category_id')
                                                                <div class="error-message">{{ $message }}</div>
                                                            @enderror
                                                        </div>                                                        
                                                    </div>
                                                    
                                                    <div class="inline" style="width: 400px;">
                                                        <div class="float-left" style="width: 30%;">
                                                            <h3 class="add_h" style="text-align: center;">Is active</h3>
                                                            <input type="checkbox" id="is_active" name="is_active" {{ $product->is_active ? 'checked' : '' }}>
                                                        </div>
                                                
                                                        <div class="float-left" style="width: 35%;">
                                                            <h3 class="add_h" style="text-align: left;">Is featured</h3>
                                                            <input type="checkbox" id="is_featured" name="is_featured" {{ $product->is_featured ? 'checked' : '' }}>
                                                        </div>
                                                
                                                        <div class="float-left" style="width: 30%;">
                                                            <h3 class="add_h" style="text-align: left;">In stock</h3>
                                                            <input type="checkbox" id="in_stock" name="in_stock" {{ $product->in_stock ? 'checked' : '' }}>
                                                        </div>
                                                
                                                        <div class="float-left" style="width: 30%;">
                                                            <h3 class="add_h" style="text-align: left;">On sale</h3>
                                                            <input type="checkbox" id="on_sale" name="on_sale" {{ $product->on_sale ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="add__inputs">
                                                        <div class="add__box @error('image') input-error @enderror">
                                                            <h3 class="add_h" style="text-align: left;">Image</h3>
                                                            <input type="file" class="" id="image" name="image" style="margin-top: 5px; display: block;">
                                                            @error('image')
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
