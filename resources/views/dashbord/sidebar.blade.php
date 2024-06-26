<aside>
    <!-- <iframe src="sidebar.balade.php" frameborder="0" style="width: 100%; height: 100%;"></iframe> -->

    <div class="sidebar">
        <div class="top">
            <div class="logo">
                <h2 style="margin-left:20px;" classe="logo-color">Dashbord <span class="danger">Admin</span> </h2>
            </div>

            <div class="close" id="close_btn">
                <span class="material-symbols-sharp">
                close
                </span>
            </div>
        </div>

        <div class="sous_sidebar">
            <a href="{{ route('dashbord') }}" class="{{ Request::is('showdashbord') ? 'active' : '' }}">
                <span class="material-symbols-sharp">grid_view </span>
                <h3>Dashbord</h3>
            </a>

            <a href="{{ route('categoryAdmin') }}" class="{{ Request::is('showcategory') ? 'active' : '' }}">
                <span class="material-symbols-sharp">category</span>
                <h3>Categories</h3>
            </a>

            <a href="{{ route('addCategoryAdmin') }}" class="{{ Request::is('addcategory') ? 'active' : '' }}">
                <span class="material-symbols-sharp">add </span>
                <h3>Add category</h3>
            </a>

            <a href="#">
                <span class="material-symbols-sharp">receipt_long </span>
                <h3>Products</h3>
            </a>

            <a href="#">
                <span class="material-symbols-sharp">add </span>
                <h3>Add Product</h3>
            </a>

            <a href="#">
                <span class="material-symbols-sharp">shopping_bag</span>
                <h3>Orders</h3>
            </a>

            <a href="#">
                <span class="material-symbols-sharp">person_outline </span>
                <h3>Users</h3>
            </a>

            <a href="{{ route('login_form') }}">
                <span class="material-symbols-sharp">logout </span>
                <h3>logout</h3>
            </a>
        </div>
        
    </div>

</aside>





