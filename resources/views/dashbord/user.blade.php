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
                <a href="{{ route('userAdmin') }}" class="link">Users</a>
                <span class="arrow">&rarr;</span>
                <a href="{{ route('userAdmin') }}" class="link">List</a>
                <h1>User</h1>

                <div class="recent_order">
                    <div class="date">
                        <input type="date" id="currentDate">
                    </div>

                    <table> 
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    
                                    <td class="primary" >
                                        <span class="material-symbols-sharp more-icon" style="font-size: 2rem; padding-top: .2rem; padding-right: 1rem; font-variation-settings: 'wght' 900;">more_vert</span>
                                        <div class="popup">

                                            <div class="action-icons ic1" style="">
                                                <button id='openModal_all'  class="view-button" data-user-id="{{ $user->id }}">
                                                    <span class="material-symbols-sharp" style="font-size: 1.7rem; padding-top:.2rem">visibility</span>
                                                    <h3>View</h3>
                                                </button>
                                            </div>

                                            <div class="action-icons ic3" style="">
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
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
                                        <div id='modal_view{{ $user->id }}' class='modal'>
                                            <div class='modal-content-user'>
                                                <span class='close'>&times;</span>

                                                <h1 class="edit-h1">View all</h1>

                                                <div class="add__inputs">
                                                    <div class="add__box">
                                                        <h3 class="add_h" style="text-align: left;">Name</h3>
                                                        <input type="text" required class="add__input"
                                                            id="name" name="name"
                                                            value="{{ $user->name }}">
                                                    </div>

                                                    <div class="add__box">
                                                        <h3 class="add_h" style="text-align: left;">Role</h3>
                                                        <input type="text" required class="add__input"
                                                            id="slug" name="slug"
                                                            value="{{ $user->role }}">
                                                    </div>
                                                </div>

                                                <div class="add__box" style="width: 390px;">
                                                    <h3 class="add_h" style="text-align: left;">Email</h3>
                                                    <input type="text" required class="add__input"
                                                        id="name" name="name"
                                                        value="{{ $user->email }}">
                                                </div>

                                                <div class="add__inputs">
                                                    <div class="add__box">
                                                        <h3 class="add_h" style="text-align: left;">Created at</h3>
                                                        <input type="text" required class="add__input"
                                                            id="name" name="name"
                                                            value="{{ $user->created_at }}">
                                                    </div>

                                                    <div class="add__box">
                                                        <h3 class="add_h" style="text-align: left;">Updated at</h3>
                                                        <input type="text" required class="add__input"
                                                            id="slug" name="slug"
                                                            value="{{ $user->updated_at }}">
                                                    </div>
                                                </div>
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
