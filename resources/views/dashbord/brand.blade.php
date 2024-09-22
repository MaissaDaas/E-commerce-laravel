<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashbord Admin</title>
    <link rel="icon" href="../images/logopara.png" type="image/x-icon">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="../../css/dashbord.css">
</head>

<body>
    <div class="container">
        @include('dashbord.sidebar')

        <main style="margin-left:3rem;">
            <a href="{{ route('brandAdmin') }}" class="link">Brands</a>
            <span class="arrow">&rarr;</span>
            <a href="{{ route('brandAdmin') }}" class="link">List</a>
            <h1>Brand</h1>

            <div class="recent_order">
                <div class="date">
                    <input type="date" id="currentDate">
                </div>

                <div class="addbutton">
                    <a href="{{ route('addBrandAdmin') }}" class="add-category-link" style="margin:0px;">
                        <span class="material-symbols-sharp" style="bottom:20px;">add </span>
                        <h3>Add brand</h3>
                    </a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Brand Name</th>
                            <th>Images</th>
                            <th>Slug</th>
                            <th>Is Active</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->name }}</td>
                                <td>
                                    @if ($brand->images)
                                        <img src="{{ asset($brand->images) }}" alt="{{ $brand->name }}"
                                            style="width: 90px; height: 70px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $brand->slug }}</td>
                                <td>
                                    @if ($brand->is_active)
                                        <span class="material-symbols-sharp icon-active">check_circle</span>
                                    @else
                                        <span class="material-symbols-sharp icon-inactive">cancel</span>
                                    @endif
                                </td>
                                <td class="primary">
                                    <span class="material-symbols-sharp more-icon"
                                        style="font-size: 2rem; padding-top: .2rem; padding-right: 1rem; font-variation-settings: 'wght' 900;">more_vert</span>
                                    <div class="popup">

                                        <div class="action-icons ic1" style="">
                                            <button id='openModal_all' class="view-button"
                                                data-brand-id="{{ $brand->id }}">
                                                <span class="material-symbols-sharp"
                                                    style="font-size: 1.7rem; padding-top:.2rem">visibility</span>
                                                <h3>View</h3>
                                            </button>
                                        </div>

                                        <div class="action-icons ic2" style=" ">
                                            <button id='openModal' class="edit-button"
                                                data-brand-id="{{ $brand->id }}">
                                                <span class="material-symbols-sharp"
                                                    style="font-size: 1.7rem; padding-top:.2rem">create</span>
                                                <h3>Edit</h3>
                                            </button>

                                        </div>

                                        <div class="action-icons ic3" style="">
                                            <form action="{{ route('brand.destroy', $brand->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this brand?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-button">
                                                    <span class="material-symbols-sharp"
                                                        style="font-size: 1.7rem; padding-top:.2rem">delete</span>
                                                    <h3>Delete</h3>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- ************ view modal **************************** -->
                                    <div id='modal_view{{ $brand->id }}' class='modal'>
                                        <div class='modal-content-brand '>
                                            <span class='close'>&times;</span>

                                            <h1 class="edit-h1">View all</h1>

                                            <div class="add__inputs" style="padding-bottom: 0px;">
                                                <div class="view" style="padding-right: 2.9vw">
                                                    @if ($brand->images)
                                                        <img src="{{ asset($brand->images) }}" alt="{{ $brand->name }}" style="width: 140px; height: 100px; margin-bottom: 5px;">
                                                        <input type="hidden" name="current_image" value="{{ $brand->images }}">
                                                    @else
                                                        No Image
                                                    @endif
                                                </div>

                                                <div style="flex: 2;">
                                                    <div class="add__inputs" style="width: 350px">
                                                        <div class="add__box">
                                                            <h3 class="add_h" style="text-align: left;">Name</h3>
                                                            <h3 class="view-h3">{{ $brand->name }}</h3>
                                                        </div>

                                                        <div class="add__box">
                                                            <h3 class="add_h" style="text-align: left;">Slug</h3>
                                                            <h3 class="view-h3">{{ $brand->slug }}</h3>
                                                        </div>
                                                    </div>

                                                    <div class="add__inputs" style="width: 350px">
                                                        <div class="add__box">
                                                            <h3 class="add_h" style="text-align: left;">Created at</h3>
                                                            <h3 class="view-h3">{{ $brand->created_at }}</h3>
                                                        </div>

                                                        <div class="add__box">
                                                            <h3 class="add_h" style="text-align: left;">Updated at</h3>
                                                            <h3 class="view-h3">{{ $brand->updated_at }}</h3>
                                                        </div>
                                                    </div>  
                                                </div>         
                                            </div>

                                            <div class="float-left" >
                                                <h3 class="add_h" style="text-align: center;">Is active</h3>
                                                @if ($brand->is_active)
                                                <span
                                                    class="material-symbols-sharp icon-active">check_circle</span>
                                                @else
                                                    <span
                                                        class="material-symbols-sharp icon-inactive">cancel</span>
                                                @endif                                                
                                            </div> 
                                        </div>
                                    </div>

                                    <!-- ******************************edit modal******************* -->
                                    <div id='modal_{{ $brand->id }}' class='modal'>
                                        <div class='modal-content-brand' style=" padding-top: 20px; height:500px;">
                                            <span class='close'>&times;</span>

                                            <h1 class="edit-h1" style="padding-bottom: 20px">Edit Brand</h1>

                                            <form action="{{ route('brand.update', $brand->id) }}"
                                                method="POST" class="add_form" enctype="multipart/form-data"
                                                style="padding:0px;">
                                                @csrf
                                                <div class="add__box">
                                                    @if ($brand->images)
                                                        <img src="{{ asset($brand->images) }}" alt="{{ $brand->name }}" style="width: 80px; height: 80px; margin-bottom: 5px;">
                                                        <input type="hidden" name="current_image"
                                                            value="{{ $brand->images }}">
                                                    @else
                                                        No Image
                                                    @endif
                                                </div>
                                                <div class="add__inputs">
                                                    <div class="add__box @error('name') input-error @enderror">
                                                        <h3 class="add_h" style="text-align: left;">Name</h3>
                                                        <input type="text" required class="add__input"
                                                            id="name" name="name"
                                                            value="{{ $brand->name }}">
                                                        @error('name')
                                                            <div class="error-message">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="add__box @error('slug') input-error @enderror">
                                                        <h3 class="add_h" style="text-align: left;">Slug</h3>
                                                        <input type="text" required class="add__input"
                                                            id="slug" name="slug"
                                                            value="{{ $brand->slug }}">
                                                        @error('slug')
                                                            <div class="error-message">{{ $message }}</div>
                                                        @enderror
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
    
                                                    <div class="float-left" >
                                                        <h3 class="add_h" style="text-align: center;">Is active</h3>
                                                        <input type="checkbox" name="is_active" id="is_active" {{ $brand->is_active ? 'checked' : '' }}>
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

    <script>
        function toggleIsActive(brandId, isActive) {
            const isActiveSpan = document.getElementById('isActive_' + brandId);
            const newIsActive = isActive ? 0 : 1; // Inverser l'état actuel

            // Envoi d'une requête AJAX pour mettre à jour l'état dans la base de données
            fetch('/admin/brand/updateIsActive/' + brandId + '?isActive=' + newIsActive, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    // body: JSON.stringify({ isActive: newIsActive }) // Utilisation de JSON si nécessaire
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        isActiveSpan.classList.toggle('icon-active', newIsActive === 1);
                        isActiveSpan.classList.toggle('icon-inactive', newIsActive === 0);
                        isActiveSpan.textContent = newIsActive === 1 ? 'check_circle' : 'cancel';
                    } else {
                        console.error('Erreur lors de la mise à jour de l\'état.');
                    }
                })
                .catch(error => console.error('Erreur:', error));
        }
    </script>
</body>
</html>
