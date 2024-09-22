<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashbord Admin</title>
        <link rel="icon" href="../images/logopara.png" type="image/x-icon">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="../../css/dashbord.css">
    </head>
    <body>
        <div class="container">
            @include('dashbord.sidebar')

            <main style="margin-left:3rem;">
                <a href="{{ route('brandAdmin') }}" class="link">Brands</a>
                <span class="arrow">&rarr;</span>
                <a href="{{ route('addBrandAdmin') }}" class="link">Add Brand</a>
                <h1>Add Brands</h1>

                <div class="recent_order">
                    <div class="date">
                        <input type="date" id="currentDate">
                    </div>

                    <form id="addBrandForm" action="{{ route('createBrandAdmin') }}" method="POST" class="add_form" enctype="multipart/form-data">
                        @csrf
                        <div class="add__inputs">
                            <div class="add__box @error('name') input-error @enderror">
                                <h3 class="add_h">Name</h3>
                                <input type="text"  required class="add__input" id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="add__box @error('slug') input-error @enderror">
                                <h3 class="add_h">Slug</h3>
                                <input type="text"  required class="add__input" id="slug" name="slug" value="{{ old('slug') }}">
                                @error('slug')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="add__box @error('image') input-error @enderror">
                            <h3 class="add_h">Image</h3>
                            <input type="file" class="" id="image" name="image" style="margin-top:5x">
                            @error('image')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="button-group">
                            <button type="submit" class="add__button">Create</button>
                            <button type="button" class="cancel__button" onclick="document.getElementById('addBrandForm').reset();">Cancel</button>
                            <a href="{{ route('brandAdmin') }}" class="bacK__button">Back</a>
                        </div>
                    </form>
                </div>
            </main>
            @include('dashbord.right')
        </div>
</body>
</html>