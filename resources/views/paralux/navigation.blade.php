 <!-- Navigation -->
<header>
    {{-- <div class="hwrap">
        <div class="hmove">
            <div class="hitem"><i class="fas fa-truck-moving"></i>  Livraison 2-5 jours.</div>
            <div class="hitem"><i class="far fa-credit-card"></i>  Paiment à la Livraison.</div>
            <div class="hitem"><i class="fas fa-gift"></i>  Livraison offerte à partir de 200 DT.</div>
            <div class="hitem"><i class="fas fa-trophy"></i>  +10.000 Clients satisfait.</div>
        </div>
    </div> --}}
    
    <div class="navigation">
        <ul>
            <li>
                <a href="{{ route('home') }}">
                    <span class="title1">ParaLux</span>
                </a>
            </li>

            <li style="margin-left: 8%">
                <a href="{{ route('home') }}" class="{{ Request::is('admin/showhome') ? 'active' : '' }} dropdown-toggle">
                    <span class="title">Accueil</span>
                </a>
            </li>

            <li class="dropmenu">
                <a href="{{ route('boutique') }}" class="{{ Request::is('admin/showboutique') ? 'active' : '' }} dropdown-toggle" >
                    <span class="title">Boutique</span>
                </a>
            </li>

            <li class="parent">
                <a href="{{ route('showventeflash') }}">
                    <span class="title">Ventes Flash</span> 
                </a>
            </li>

            <li class="parent">
                <a href="{{ route('marque') }}" class="{{ Request::is('admin/showmarque') ? 'active' : '' }}">
                    <span class="title">Marques</span> 
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="title">Blog</span>
                </a>
            </li>

            <li class="sgin">
                <a href="#">
                    <span class="title">Contact US</span>
                </a>
            </li>

            <ul class="icones-part">
                <li>
                    <a href="#">
                        <span class="icon">
                        </span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="search-outline" ></ion-icon>
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('showpanier') }}">
                        <span class="icon">
                            <ion-icon name="cart-outline" ></ion-icon>
                            <span class="cart-counter">{{ $cartCount ?? 0 }}</span>
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('showwishlist') }}">
                        <span class="icon">
                            <ion-icon name="heart-outline" ></ion-icon>
                            <span class="wishlist-counter">{{ $wishlistCount ?? 0 }}</span>
                        </span>
                    </a>
                </li>

                @auth
                    <li>
                        <a href="{{ route('logout') }}">
                            <span class="icon">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </span>
                        </a>
                    </li>
                @endauth

                @guest
                    <li>
                        <a href="{{ route('login_form') }}">
                            <span class="icon">
                                <ion-icon name="person-outline"></ion-icon>
                            </span>
                        </a>
                    </li>
                @endguest

                {{-- <li>
                    <a href="{{ route('login_form') }}">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                    </a>
                </li> --}}
            </ul>
        </ul>
    </div>
</header>