<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title', 'Synergy 4.0')</title>
    <link rel="icon" type="image/png" href="{{ asset('client/images/favicon/favicon-16x16.png') }}" />
    <link rel="stylesheet" href="{{ asset('client/lib/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/lib/css/bvselect.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/lib/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/css/style.css') }}" />
    @yield('css')

</head>

<body>
    <div class="loader">
        <div class="loader-icon">
            <img src="{{ asset('client/images/loader.gif') }}" alt="loader" />
        </div>
    </div>
    <!-- Header Section start -->
    <header class="header header--two header--four">
        <div class="header__top">
            <div class="container">
                <div class="header__top-content">
                    <div class="header__top-left">
                        <p class="font-body--sm">
                            <span>
                                <svg width="17" height="20" viewBox="0 0 17 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16 8.36364C16 14.0909 8.5 19 8.5 19C8.5 19 1 14.0909 1 8.36364C1 6.41068 1.79018 4.53771 3.1967 3.15676C4.60322 1.77581 6.51088 1 8.5 1C10.4891 1 12.3968 1.77581 13.8033 3.15676C15.2098 4.53771 16 6.41068 16 8.36364Z"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M8.5 10.8182C9.88071 10.8182 11 9.71925 11 8.36364C11 7.00803 9.88071 5.90909 8.5 5.90909C7.11929 5.90909 6 7.00803 6 8.36364C6 9.71925 7.11929 10.8182 8.5 10.8182Z"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            Vị Trí Cửa Hàng: {{ $websiteInfo->address }}
                        </p>
                    </div>
                    <div class="header__top-right">
                        <div class="header__dropdown">
                            <select id="selectbox2" class="header__dropdown-menu">
                                <option value="pt_1">USD</option>
                                <option value="en_2">Tk</option>

                                <option value="ch_4">yan</option>
                                <option value="5">rup</option>
                            </select>
                        </div>
                        <div class="header__in">

                            @if (Auth::check())
                                @if (Auth::user()->role === 'admin')
                                    <div class="dropdown">
                                        <button class="btn btn-Body text-white dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Xin chào, {{ Auth::user()->firstname }}
                                        </button>
                                        <ul class="dropdown-menu text-uppercase" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <form id="" action="/admin">
                                                    <button type="submit" class="dropdown-item">Trang Quản Trị
                                                        Website</button>
                                                </form>
                                            </li> <!-- fs-4 to make it larger -->
                                            <li>
                                                <form id="logout" action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Logout</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @elseif (Auth::user()->role === 'staff')
                                    <div class="dropdown">
                                        <button class="btn btn-Body text-white dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Xin chào, {{ Auth::user()->firstname }}
                                        </button>
                                        <ul class="dropdown-menu text-uppercase" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <form id="" action="/staff">
                                                    <button type="submit" class="dropdown-item">Trang Quản Trị Nhân
                                                        Viên</button>
                                                </form>
                                            </li> <!-- fs-4 to make it larger -->
                                            <li>
                                                <form id="logout" action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Logout</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @elseif (Auth::user()->role === 'customer')
                                    <div class="dropdown">
                                        <button class="btn btn-Body text-white dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Xin chào, {{ Auth::user()->firstname }}
                                        </button>
                                        <ul class="dropdown-menu text-uppercase" aria-labelledby="dropdownMenuButton">

                                            <li>
                                                <form id="logout" action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Logout</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            @else
                                <a href="#" onclick="openLoginPopup(event)">Đăng Nhập</a>
                                <span>/</span>
                                <a href="{{ route('register') }}">Đăng Ký</a>
                            @endif



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__center">
            <div class="container">
                <div class="header__center-content">
                    <div class="header__brand">
                        <button class="header__sidebar-btn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 12H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M3 6H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M3 18H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                        <a href="{{ route('client.pages.homepage') }}">
                            <img src="{{ asset('storage/logos/' . $websiteInfo->logo) }}" alt="brand-logo" />
                        </a>
                    </div>
                    <form action="{{ route('search') }}" method="GET">
                        <div class="header__input-form">
                            <input type="text" name="query" placeholder="Tìm Kiếm" />
                            <span class="search-icon">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.16667 16.3333C12.8486 16.3333 15.8333 13.3486 15.8333 9.66667C15.8333 5.98477 12.8486 3 9.16667 3C5.48477 3 2.5 5.98477 2.5 9.66667C2.5 13.3486 5.48477 16.3333 9.16667 16.3333Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M17.4999 18L13.8749 14.375" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <button type="submit" class="search-btn button button--md">
                                Tìm Kiếm
                            </button>
                        </div>
                    </form>


                    <div class="header__cart">
                        <div class="header__cart-item">
                            <a class="fav" href="{{ route('wishlist.index') }}">
                                <svg width="25" height="23" viewBox="0 0 20 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z"
                                        stroke="#1A1A1A" stroke-width="1.5" />
                                </svg>
                            </a>
                        </div>
                        <div class="header__cart-item">
                            <div class="header__cart-item-content" id="cart-bag">
                                <button class="cart-bag">
                                    <svg width="34" height="35" viewBox="0 0 34 35" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.3333 14.6667H7.08333L4.25 30.25H29.75L26.9167 14.6667H22.6667M11.3333 14.6667V10.4167C11.3333 7.28705 13.8704 4.75 17 4.75V4.75C20.1296 4.75 22.6667 7.28705 22.6667 10.4167V14.6667M11.3333 14.6667H22.6667M11.3333 14.6667V18.9167M22.6667 14.6667V18.9167"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    <span class="item-number">0</span>
                                    <!-- Số lượng sản phẩm sẽ được cập nhật từ API -->
                                </button>
                                <div class="header__cart-item-content-info">
                                    <h5>Giỏ Hàng:</h5>
                                    <span class="price">₫0.00</span> <!-- Tổng tiền sẽ được cập nhật từ API -->
                                </div>
                            </div>
                        </div>
                        <div class="header__cart-item">
                            <a href="{{ route('client.user.user-dashboard') }}" class="icon user-icon">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.0003 14.6667C18.9458 14.6667 21.3337 12.2789 21.3337 9.33333C21.3337 6.38781 18.9458 4 16.0003 4C13.0548 4 10.667 6.38781 10.667 9.33333C10.667 12.2789 13.0548 14.6667 16.0003 14.6667Z"
                                        stroke="black" stroke-width="1.5" />
                                    <path
                                        d="M20.0003 18.6666H12.0003C8.31764 18.6666 5.02031 22.0666 7.44297 24.8386C9.09097 26.724 11.8163 28 16.0003 28C20.1843 28 22.9083 26.724 24.5563 24.8386C26.9803 22.0653 23.6816 18.6666 20.0003 18.6666Z"
                                        stroke="black" stroke-width="1.5" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__bottom">
            <div class="container">
                <div class="header__bottom-content">
                    <div class="header__bottom-left">

                        @if (in_array(Route::currentRouteName(), ['client.pages.homepage', 'register']))
                            <ul class="header__category-content">
                                <li class="header__category-content-item">
                                    <a>
                                        <span class="bar"></span>
                                        Danh Mục
                                        <span class="toggle-icon">
                                            <svg width="12" height="8" viewBox="0 0 12 8" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0.75 1.375L6 6.625L11.25 1.375" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </a>
                                    <ul class="header__category-content-dropdown">
                                        <!-- Áo Quần -->
                                        <li>
                                            <a href="#">
                                                <span class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M12 2L9 5H6L2 9V20H10V15H14V20H22V9L18 5H15L12 2Z"
                                                            fill="#FF6F61" />
                                                        <circle cx="12" cy="7" r="2" fill="#FFF" />
                                                    </svg>
                                                </span>
                                                Áo Quần
                                            </a>
                                        </li>

                                        <!-- Giày Dép -->
                                        <li>
                                            <a href="#">
                                                <span class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M2 18H22L18 9H6L2 18Z" fill="#FFB84D" />
                                                        <path d="M16 9L14 4H10L8 9H16Z" fill="#FFF" />
                                                    </svg>
                                                </span>
                                                Giày Dép
                                            </a>
                                        </li>

                                        <!-- Phụ Kiện -->
                                        <li>
                                            <a href="#">
                                                <span class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M12 2C10 2 8 4 8 4L4 8V20H20V8L16 4C16 4 14 2 12 2Z"
                                                            fill="#6ECFF6" />
                                                        <circle cx="12" cy="8" r="2" fill="#FFF" />
                                                    </svg>
                                                </span>
                                                Phụ Kiện
                                            </a>
                                        </li>

                                        <!-- Đồng Hồ -->
                                        <li>
                                            <a href="#">
                                                <span class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none">
                                                        <circle cx="12" cy="12" r="10" stroke="#FF6F61"
                                                            stroke-width="2" />
                                                        <path d="M12 6V12L16 14" stroke="#FF6F61" stroke-width="2"
                                                            stroke-linecap="round" />
                                                    </svg>
                                                </span>
                                                Đồng Hồ
                                            </a>
                                        </li>

                                        <!-- Túi Xách -->
                                        <li>
                                            <a href="#">
                                                <span class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M4 8L6 20H18L20 8H4Z" fill="#FFB84D" />
                                                        <path d="M8 8V6C8 4.9 8.9 4 10 4H14C15.1 4 16 4.9 16 6V8"
                                                            stroke="#FFF" stroke-width="2" />
                                                    </svg>
                                                </span>
                                                Túi Xách
                                            </a>
                                        </li>

                                        <!-- Kính Mắt -->
                                        <li>
                                            <a href="#">
                                                <span class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M6 12C7.1 12 8 12.9 8 14C8 15.1 7.1 16 6 16C4.9 16 4 15.1 4 14C4 12.9 4.9 12 6 12Z"
                                                            fill="#6ECFF6" />
                                                        <path
                                                            d="M18 12C19.1 12 20 12.9 20 14C20 15.1 19.1 16 18 16C16.9 16 16 15.1 16 14C16 12.9 16.9 12 18 12Z"
                                                            fill="#6ECFF6" />
                                                        <path d="M8 14H16" stroke="#6ECFF6" stroke-width="2"
                                                            stroke-linecap="round" />
                                                    </svg>
                                                </span>
                                                Kính Mắt
                                            </a>
                                        </li>

                                        <!-- Mũ Nón -->
                                        <li>
                                            <a href="#">
                                                <span class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M4 10L12 4L20 10H4Z" fill="#FF6F61" />
                                                        <path d="M4 10H20V14C20 16 18 18 12 18C6 18 4 16 4 14V10Z"
                                                            fill="#FFB84D" />
                                                    </svg>
                                                </span>
                                                Mũ Nón
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        @endif

                        <ul class="header__navigation-menu">
                            <li
                                class="header__navigation-menu-link {{ Route::currentRouteName() == 'client.pages.homepage' ? 'active' : '' }}">
                                <a href="{{ route('client.pages.homepage') }}">Trang Chủ</a>
                            </li>
                            <li
                                class="header__navigation-menu-link {{ Route::currentRouteName() == 'client.shop.shop' ? 'active' : '' }}">
                                <a href="{{ route('client.shop.shop') }}">Cửa Hàng</a>
                            </li>
                            <li
                                class="header__navigation-menu-link {{ Route::currentRouteName() == 'client.blog.blog-list' ? 'active' : '' }}">
                                <a href="{{ route('client.blog.blog-list') }}">Bài Viết</a>
                            </li>
                            <li
                                class="header__navigation-menu-link {{ Route::currentRouteName() == 'client.pages.about' ? 'active' : '' }}">
                                <a href="{{ route('client.pages.about') }}">Giới Thiệu</a>
                            </li>
                            <li
                                class="header__navigation-menu-link {{ Route::currentRouteName() == 'client.pages.contact' ? 'active' : '' }}">
                                <a href="{{ route('client.pages.contact') }}">Liên Hệ</a>
                            </li>
                        </ul>

                    </div>
                    <a href="#" class="header__telephone-number">
                        <span>
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.436 2.375C15.9194 2.77396 17.2719 3.55567 18.3581 4.64184C19.4442 5.72801 20.226 7.08051 20.6249 8.56388"
                                    stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M13.5308 5.75687C14.4206 5.99625 15.2319 6.46521 15.8835 7.11678C16.535 7.76835 17.004 8.57967 17.2434 9.46949"
                                    stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M7.115 11.6517C8.02238 13.5074 9.5263 15.0049 11.3859 15.9042C11.522 15.9688 11.6727 15.9966 11.8229 15.9851C11.9731 15.9736 12.1178 15.9231 12.2425 15.8386L14.9812 14.0134C15.1022 13.9326 15.2414 13.8833 15.3862 13.8698C15.5311 13.8564 15.677 13.8793 15.8107 13.9364L20.9339 16.1326C21.1079 16.2065 21.2532 16.335 21.3479 16.4987C21.4426 16.6623 21.4815 16.8523 21.4589 17.04C21.2967 18.307 20.6784 19.4714 19.7196 20.3154C18.7608 21.1593 17.5273 21.6249 16.25 21.625C12.3049 21.625 8.52139 20.0578 5.73179 17.2682C2.94218 14.4786 1.375 10.6951 1.375 6.75C1.37512 5.47279 1.84074 4.23941 2.68471 3.28077C3.52867 2.32213 4.6931 1.70396 5.96 1.542C6.14771 1.51936 6.33769 1.55832 6.50134 1.653C6.66499 1.74769 6.79345 1.89298 6.86738 2.067L9.06537 7.1945C9.1219 7.32698 9.14485 7.47137 9.13218 7.61485C9.11951 7.75833 9.07162 7.89647 8.99275 8.017L7.17275 10.7977C7.09015 10.923 7.04141 11.0675 7.03129 11.2171C7.02117 11.3668 7.05001 11.5165 7.115 11.6517V11.6517Z"
                                    stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>

                            {{ $websiteInfo->phone }}
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="header__sidebar">
            <button class="header__cross">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
            <div class="header__mobile-sidebar">
                <div class="header__mobile-top">
                    <form action="#">
                        <div class="header__mobile-input">
                            <input type="text" placeholder="Tìm Kiếm" />
                            <button class="search-btn">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.16667 16.3333C12.8486 16.3333 15.8333 13.3486 15.8333 9.66667C15.8333 5.98477 12.8486 3 9.16667 3C5.48477 3 2.5 5.98477 2.5 9.66667C2.5 13.3486 5.48477 16.3333 9.16667 16.3333Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M17.4999 18L13.8749 14.375" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </form>
                    <ul class="header__mobile-menu">
                        <li class="header__mobile-menu-item active">
                            <a href="{{ route('client.pages.homepage') }}" class="header__mobile-menu-item-link">
                                Trang Chủ
                            </a>
                        </li>
                        <li class="header__mobile-menu-item">
                            <a href="{{ route('client.shop.shop') }}" class="header__mobile-menu-item-link">
                                Cửa Hàng
                            </a>

                        </li>

                        <li class="header__mobile-menu-item">
                            <a href="{{ route('client.blog.blog-list') }}" class="header__mobile-menu-item-link">
                                Bài Viết
                            </a>
                        </li>
                        <li class="header__mobile-menu-item">
                            <a href="{{ route('client.pages.about') }}" class="header__mobile-menu-item-link">Giới
                                Thiệu</a>
                        </li>
                        <li class="header__mobile-menu-item">
                            <a href="{{ route('client.pages.contact') }}" class="header__mobile-menu-item-link">Liên
                                Hệ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- Header  Section start -->
    <!-- Thanh chỉ hướngt -->
    @if (in_array(Route::currentRouteName(), [
            'client.shop.shop',
            'client.shop.product-details',
            'client.blog.blog-list',
            'client.blog.single-blog',
            'client.pages.about',
            'client.pages.contact',
            'register',
            'client.user.user-dashboard',
            'client.user.order-history',
            'client.user.account-setting',
            'client.user.order-details',
            'wishlist.index',
            'client.cart.checkout',
            'client.cart.shopping-cart',
            'client.user.bought',
        ]))
        <!-- breedcrumb section start -->
        <div class="section breedcrumb">
            <div class="breedcrumb__img-wrapper">
                <img src="{{ asset('client/images/banner/breedcrumb.jpg') }}" alt="breedcrumb" />
                <div class="container">
                    <ul class="breedcrumb__content">
                        <li>
                            <a href="{{ route('client.pages.homepage') }}">
                                <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"
                                        stroke="#808080" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <span> > </span>
                            </a>
                        </li>

                        @if (Route::currentRouteName() == 'client.blog.single-blog')
                            <!-- Breadcrumb for single blog post -->
                            <li>
                                <a href="{{ route('client.blog.blog-list') }}">Bài Viết
                                    <span> > </span>
                                </a>

                            </li>

                            <li class="active">
                                <a href="#">Chi Tiết Bài Viết</a>
                            </li>
                        @elseif (Route::currentRouteName() == 'client.user.user-dashboard')
                            <!-- Breadcrumb for dashboard -->
                            <li>
                                <a href="{{ route('client.user.user-dashboard') }}">Tài Khoản
                                    <span> > </span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="#">Dashboard</a>
                            </li>
                        @elseif (Route::currentRouteName() == 'client.user.order-history')
                            <!-- Breadcrumb for dashboard -->
                            <li>
                                <a href="{{ route('client.user.user-dashboard') }}">Tài Khoản
                                    <span> > </span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="#">Lịch Sử Đơn Hàng</a>
                            </li>
                        @elseif (Route::currentRouteName() == 'client.user.order-details')
                            <!-- Breadcrumb for dashboard -->
                            <li>
                                <a href="{{ route('client.user.user-dashboard') }}">Tài Khoản
                                    <span> > </span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="#">Chi Tiết Đơn Hàng</a>
                            </li>
                        @elseif (Route::currentRouteName() == 'client.user.account-setting')
                            <!-- Breadcrumb for dashboard -->
                            <li>
                                <a href="{{ route('client.user.user-dashboard') }}">Tài Khoản

                                    <span> > </span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="#">Cài Đặt</a>
                            </li>
                        @elseif (Route::currentRouteName() == 'client.shop.product-details')
                            <!-- Breadcrumb for dashboard -->
                            <li>
                                <a href="{{ route('client.shop.shop') }}">Cửa Hàng
                                    <span> > </span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="#">Chi Tiết Sản Phẩm</a>
                            </li>
                        @elseif (Route::currentRouteName() == 'client.cart.checkout')
                            <!-- Breadcrumb for dashboard -->
                            <li>
                                <a href="{{ route('client.cart.shopping-cart') }}">Giỏ Hàng
                                    <span> > </span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="#">Thanh Toán</a>
                            </li>
                        @else
                            <!-- Breadcrumb for other pages -->
                            <li class="active">
                                <a href="#">
                                    @php
                                        $breadcrumbTitles = [
                                            'client.shop.shop' => 'Cửa Hàng',
                                            'client.blog.blog-list' => 'Bài Viết',
                                            'client.pages.about' => 'Giới Thiệu',
                                            'client.pages.contact' => 'Liên Hệ',
                                            'register' => 'Đăng Ký',
                                            'wishlist.index' => 'Danh Sách Yêu Thích',
                                            'client.cart.shopping-cart' => 'Giỏ Hàng',
                                        ];

                                        $routeName = Route::currentRouteName();
                                    @endphp

                                    {{ $breadcrumbTitles[$routeName] ?? 'Trang Khác' }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <!-- breedcrumb section end -->
    @endif
    <!-- nav  -->
    @if (in_array(Route::currentRouteName(), [
            'client.user.user-dashboard',
            'client.user.order-history',
            'client.user.account-setting',
            'client.user.order-details',
            'client.user.bought',
        ]))
        <div class="dashboard section">
            <div class="container">
                <div class="row dashboard__content">
                    <!-- Thanh Điều Hướng -->
                    <div class="col-lg-3">
                        <nav class="dashboard__nav">
                            <h5 class="dashboard__nav-title font-body--xxl-500">
                                Thanh Điều Hướng
                            </h5>
                            <ul class="dashboard__nav-item">
                                <li
                                    class="dashboard__nav-item-link {{ Route::currentRouteName() === 'client.user.user-dashboard' ? 'active' : '' }}">
                                    <a href="{{ route('client.user.user-dashboard') }}" class="font-body--lg-400">
                                        <span class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21 21H13V15H21V21ZM11 21H3V11H11V21ZM21 13H13V3H21V13ZM11 9H3V3H11V9Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <span class="name">Dashboard</span>
                                    </a>
                                </li>
                                <!-- Order History -->
                                <li
                                    class="dashboard__nav-item-link {{ Route::currentRouteName() === 'client.user.order-history' ? 'active' : '' }}">
                                    <a href="{{ route('client.user.order-history') }}" class="font-body--lg-400">
                                        <span class="icon">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M0 16V9.00004H7L3.783 12.22C4.33247 12.7819 4.98837 13.2287 5.71241 13.5343C6.43644 13.8399 7.21411 13.9983 8 14C9.23925 13.9982 10.4475 13.6127 11.4589 12.8965C12.4702 12.1802 13.2349 11.1684 13.648 10H13.666C13.78 9.67504 13.867 9.34004 13.925 9.00004H15.937C15.6934 10.9333 14.7527 12.7111 13.2913 14C11.83 15.2888 9.9485 16 8 16H7.99C6.93982 16.0032 5.89944 15.798 4.9291 15.3963C3.95876 14.9946 3.07772 14.4045 2.337 13.66L0 16ZM2.074 7.00004H0.0619998C0.305476 5.06751 1.24564 3.29019 2.70616 2.00145C4.16667 0.712703 6.04719 0.00107558 7.995 3.98088e-05H8C9.05036 -0.00328613 10.0909 0.201826 11.0615 0.603496C12.032 1.00517 12.9132 1.59541 13.654 2.34004L16 3.98088e-05V7.00004H9L12.222 3.78004C11.672 3.21752 11.0153 2.77035 10.2903 2.46471C9.56537 2.15907 8.78674 2.0011 8 2.00004C6.76074 2.00187 5.55246 2.38738 4.54114 3.10361C3.52982 3.81985 2.76508 4.83166 2.352 6.00004H2.334C2.219 6.32504 2.132 6.66004 2.075 7.00004H2.074Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <span class="name"> Lịch Sử Đơn Hàng</span>
                                    </a>
                                </li>
                                <!-- Wishlist -->
                                <li class="dashboard__nav-item-link">
                                    <a href="{{ route('wishlist.index') }}" class="font-body--lg-400">
                                        <span class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11.9997 21.0538C-7.99987 9.99967 6.00011 -2.00033 11.9997 5.58772C18.0001 -2.00034 32.0001 9.99967 11.9997 21.0538Z"
                                                    stroke="currentColor" stroke-width="1.5" />
                                            </svg>
                                        </span>
                                        <span class="name"> Danh Sách Yêu Thích</span>
                                    </a>
                                </li>
                                <!-- Sản Phẩm Đã Mua -->
                                <li class="dashboard__nav-item-link">
                                    <a href="{{ route('client.user.bought') }}" class="font-body--lg-400">
                                        <span class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 11.5L12 14.5L15 10.5" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M4 7L7 14H17L20 7H4Z" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>

                                        <span class="name"> Sản Phẩm Đã Mua </span>
                                    </a>
                                </li>
                                <!-- Shopping Cart  -->
                                <li class="dashboard__nav-item-link">
                                    <a href="{{ route('client.cart.shopping-cart') }}" class="font-body--lg-400">
                                        <span class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8 10H5L3 21H21L19 10H16M8 10V7C8 4.79086 9.79086 3 12 3V3C14.2091 3 16 4.79086 16 7V10M8 10H16M8 10V13M16 10V13"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>

                                        <span class="name"> Giỏ Hàng </span>
                                    </a>
                                </li>
                                <!--  Settings   -->
                                <li
                                    class="dashboard__nav-item-link {{ Route::currentRouteName() === 'client.user.account-setting' ? 'active' : '' }}">
                                    <a href="{{ route('client.user.account-setting') }}" class="font-body--lg-400">

                                        <span class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.8199 22H10.1799C9.95182 22 9.73059 21.9221 9.55289 21.7792C9.37519 21.6362 9.25169 21.4368 9.20288 21.214L8.79588 19.33C8.25294 19.0921 7.73812 18.7946 7.26088 18.443L5.42388 19.028C5.20645 19.0973 4.97183 19.0902 4.759 19.0078C4.54617 18.9254 4.36794 18.7727 4.25388 18.575L2.42988 15.424C2.31703 15.2261 2.27467 14.9958 2.30973 14.7708C2.34479 14.5457 2.45519 14.3392 2.62288 14.185L4.04788 12.885C3.98308 12.2961 3.98308 11.7019 4.04788 11.113L2.62288 9.816C2.45496 9.66177 2.3444 9.45507 2.30933 9.22978C2.27427 9.00449 2.31677 8.77397 2.42988 8.576L4.24988 5.423C4.36394 5.22532 4.54218 5.07259 4.755 4.99019C4.96783 4.90778 5.20245 4.90066 5.41988 4.97L7.25688 5.555C7.50088 5.375 7.75488 5.207 8.01788 5.055C8.26988 4.913 8.52988 4.784 8.79588 4.669L9.20388 2.787C9.25246 2.5642 9.37572 2.36469 9.55323 2.22155C9.73074 2.07841 9.95185 2.00024 10.1799 2H13.8199C14.0479 2.00024 14.269 2.07841 14.4465 2.22155C14.6241 2.36469 14.7473 2.5642 14.7959 2.787L15.2079 4.67C15.7505 4.9079 16.265 5.20539 16.7419 5.557L18.5799 4.972C18.7972 4.90292 19.0316 4.91017 19.2442 4.99256C19.4568 5.07495 19.6349 5.22753 19.7489 5.425L21.5689 8.578C21.8019 8.985 21.7209 9.5 21.3759 9.817L19.9509 11.117C20.0157 11.7059 20.0157 12.3001 19.9509 12.889L21.3759 14.189C21.7209 14.507 21.8009 15.021 21.5689 15.428L19.7489 18.581C19.6349 18.7785 19.4568 18.931 19.2442 19.0134C19.0316 19.0958 18.7972 19.1031 18.5799 19.034L16.7419 18.449C16.2651 18.8004 15.7506 19.0976 15.2079 19.335L14.7959 21.214C14.7471 21.4366 14.6238 21.6359 14.4463 21.7788C14.2688 21.9218 14.0478 21.9998 13.8199 22ZM7.61988 16.229L8.43988 16.829C8.62488 16.965 8.81788 17.09 9.01688 17.204C9.20488 17.313 9.39788 17.411 9.59588 17.5L10.5289 17.909L10.9859 20H13.0159L13.4729 17.908L14.4059 17.499C14.8129 17.319 15.1999 17.096 15.5589 16.833L16.3799 16.233L18.4209 16.883L19.4359 15.125L17.8529 13.682L17.9649 12.67C18.0149 12.227 18.0149 11.78 17.9649 11.338L17.8529 10.326L19.4369 8.88L18.4209 7.121L16.3799 7.771L15.5589 7.171C15.1997 6.90669 14.8131 6.68173 14.4059 6.5L13.4729 6.091L13.0159 4H10.9859L10.5269 6.092L9.59588 6.5C9.18807 6.67861 8.80136 6.90198 8.44288 7.166L7.62188 7.766L5.58188 7.116L4.56488 8.88L6.14788 10.321L6.03588 11.334C5.98588 11.777 5.98588 12.224 6.03588 12.666L6.14788 13.678L4.56488 15.121L5.57988 16.879L7.61988 16.229ZM11.9959 16C10.935 16 9.9176 15.5786 9.16746 14.8284C8.41731 14.0783 7.99588 13.0609 7.99588 12C7.99588 10.9391 8.41731 9.92172 9.16746 9.17157C9.9176 8.42143 10.935 8 11.9959 8C13.0568 8 14.0742 8.42143 14.8243 9.17157C15.5745 9.92172 15.9959 10.9391 15.9959 12C15.9959 13.0609 15.5745 14.0783 14.8243 14.8284C14.0742 15.5786 13.0568 16 11.9959 16ZM11.9959 10C11.6042 10.0004 11.2213 10.1158 10.8947 10.3318C10.568 10.5479 10.3119 10.855 10.1583 11.2153C10.0046 11.5755 9.9601 11.9729 10.0303 12.3583C10.1004 12.7436 10.2822 13.0998 10.5529 13.3828C10.8237 13.6657 11.1716 13.863 11.5534 13.95C11.9353 14.037 12.3343 14.01 12.7009 13.8724C13.0676 13.7347 13.3858 13.4924 13.616 13.1756C13.8462 12.8587 13.9783 12.4812 13.9959 12.09V12.49V12C13.9959 11.4696 13.7852 10.9609 13.4101 10.5858C13.035 10.2107 12.5263 10 11.9959 10Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>

                                        <span class="name"> Cài Đặt </span>
                                    </a>
                                </li>
                                <!--  Log out    -->
                                <li class="dashboard__nav-item-link">
                                    <a href="#" class="font-body--lg-400"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <span class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19 21H10C9.46957 21 8.96086 20.7893 8.58579 20.4142C8.21071 20.0391 8 19.5304 8 19V15H10V19H19V5H10V9H8V5C8 4.46957 8.21071 3.96086 8.58579 3.58579C8.96086 3.21071 9.46957 3 10 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21ZM12 16V13H3V11H12V8L17 12L12 16Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <span class="name">Đăng Xuất</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>

                            </ul>
                            <button class="filter-icon">
                                <svg width="22" height="19" viewBox="0 0 22 19" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18 5.75C18.4142 5.75 18.75 5.41421 18.75 5C18.75 4.58579 18.4142 4.25 18 4.25V5.75ZM9 4.25C8.58579 4.25 8.25 4.58579 8.25 5C8.25 5.41421 8.58579 5.75 9 5.75V4.25ZM18 4.25H9V5.75H18V4.25Z"
                                        fill="white" />
                                    <path
                                        d="M13 14.75C13.4142 14.75 13.75 14.4142 13.75 14C13.75 13.5858 13.4142 13.25 13 13.25V14.75ZM4 13.25C3.58579 13.25 3.25 13.5858 3.25 14C3.25 14.4142 3.58579 14.75 4 14.75V13.25ZM13 13.25H4V14.75H13V13.25Z"
                                        fill="white" />
                                    <circle cx="5" cy="5" r="4" stroke="white" stroke-width="1.5" />
                                    <circle cx="17" cy="14" r="4" stroke="white" stroke-width="1.5" />
                                </svg>
                            </button>
                        </nav>
                    </div>

                    <!-- Nội Dung -->
                    <div class="col-lg-9">
                        @yield('content-nav') <!-- Nội dung thay đổi -->
                    </div>
                </div>
            </div>
        </div>
    @endif


    @yield('content')
    <!-- Đoạn HTML cho popup -->
    @include('auth.login')
    <!-- Popup đăng  nhập end  -->

    <!-- Brand -->
    @if (in_array(Route::currentRouteName(), ['client.pages.homepage', 'client.pages.about']))
        <!-- brand-name Section Start -->
        <div class="brand-name section section--xl">
            <div class="container">
                <div class="brand-name-slide--one swiper-container">
                    <div class="swiper-wrapper">
                        <!-- Louis Vuitton -->
                        <div class="swiper-slide">
                            <span class="brand-name__icon">
                                <svg width="82" height="32" viewBox="0 0 82 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <text x="10" y="22" font-family="Georgia, serif" font-size="18" fill="gold"
                                        font-weight="bold">LV</text>
                                </svg>
                                Louis Vuitton
                            </span>
                        </div>
                        <!-- Gucci -->
                        <div class="swiper-slide">
                            <span class="brand-name__icon">
                                <svg width="82" height="32" viewBox="0 0 82 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="10" y="5" width="60" height="22" rx="5"
                                        fill="green" />
                                    <text x="15" y="22" font-family="Verdana, sans-serif" font-size="14"
                                        fill="white">GUCCI</text>
                                </svg>
                                Gucci
                            </span>
                        </div>
                        <!-- Chanel -->
                        <div class="swiper-slide">
                            <span class="brand-name__icon">
                                <svg width="82" height="32" viewBox="0 0 82 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="16" cy="16" r="10" fill="black" />
                                    <circle cx="16" cy="16" r="8" fill="white" />
                                    <text x="10" y="20" font-family="Georgia, serif" font-size="10" fill="black"
                                        font-weight="bold">CHANEL</text>
                                </svg>
                                Chanel
                            </span>
                        </div>
                        <!-- Dior -->
                        <div class="swiper-slide">
                            <span class="brand-name__icon">
                                <svg width="82" height="32" viewBox="0 0 82 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <text x="10" y="22" font-family="Times New Roman, serif" font-size="16"
                                        fill="darkblue" font-weight="bold">DIOR</text>
                                </svg>
                                Dior
                            </span>
                        </div>
                        <!-- Hermès -->
                        <div class="swiper-slide">
                            <span class="brand-name__icon">
                                <svg width="82" height="32" viewBox="0 0 82 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="5" y="5" width="70" height="22" rx="5" fill="orange" />
                                    <text x="15" y="22" font-family="Georgia, serif" font-size="14"
                                        fill="white">HERMÈS</text>
                                </svg>
                                Hermès
                            </span>
                        </div>
                        <!-- Fendi -->
                        <div class="swiper-slide">
                            <span class="brand-name__icon">
                                <svg width="82" height="32" viewBox="0 0 82 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="5" y="5" width="70" height="22" rx="3" fill="yellow" />
                                    <text x="20" y="22" font-family="Arial, sans-serif" font-size="14"
                                        fill="black">FENDI</text>
                                </svg>
                                Fendi
                            </span>
                        </div>
                        <!-- Prada -->
                        <div class="swiper-slide">
                            <span class="brand-name__icon">
                                <svg width="82" height="32" viewBox="0 0 82 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <text x="10" y="22" font-family="Courier New, monospace" font-size="16"
                                        fill="darkred" font-weight="bold">PRADA</text>
                                </svg>
                                Prada
                            </span>
                        </div>
                        <!-- Synergy -->
                        <div class="swiper-slide">
                            <span class="brand-name__icon">
                                <svg width="82" height="32" viewBox="0 0 82 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="10" y="5" width="60" height="22" rx="5"
                                        fill="purple" />
                                    <text x="15" y="22" font-family="Verdana, sans-serif" font-size="14"
                                        fill="white">SYNERGY</text>
                                </svg>
                                Synergy
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- brand-name Section End -->
    @endif

    <!--Footer Section Start  -->
    <footer class="footer footer--five">
        <div class="container">
            <div class="footer__top">
                <div class="row justify-content-between">
                    <!-- Brand information-->
                    <div class="col-xl-4">
                        <div class="footer__brand-info">
                            <div class="footer__brand-info-logo">
                                <img src="{{ asset('storage/logos/' . $websiteInfo->logo) }}" alt="logo" />
                            </div>
                            <p class="font-body--md-400">
                                Sứ mệnh của chúng tôi là mang đến những sản phẩm thời trang chất lượng và hiện đại
                                cho
                                khách hàng.
                            </p>
                            <p class="font-body--md-400">
                                Địa chỉ: {{ $websiteInfo->address }}
                            </p>

                            <p class="footer__brand-info-contact">
                                <a href="#"><span>{{ $websiteInfo->phone }}</span></a>
                                or
                                <a href="#"><span>{{ $websiteInfo->email }}</span></a>
                            </p>
                            <ul class="social-icon">
                                <li class="social-icon-link">
                                    <a href="#">
                                        <svg width="10" height="18" viewBox="0 0 10 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.99764 2.98875H9.64089V0.12675C9.35739 0.08775 8.38239 0 7.24689 0C4.87764 0 3.25464 1.49025 3.25464 4.22925V6.75H0.640137V9.9495H3.25464V18H6.46014V9.95025H8.96889L9.36714 6.75075H6.45939V4.5465C6.46014 3.62175 6.70914 2.98875 7.99764 2.98875Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social-icon-link">
                                    <a href="#">
                                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18 2.41888C17.3306 2.7125 16.6174 2.90713 15.8737 3.00163C16.6388 2.54488 17.2226 1.82713 17.4971 0.962C16.7839 1.38725 15.9964 1.68763 15.1571 1.85525C14.4799 1.13413 13.5146 0.6875 12.4616 0.6875C10.4186 0.6875 8.77387 2.34575 8.77387 4.37863C8.77387 4.67113 8.79862 4.95238 8.85938 5.22013C5.7915 5.0705 3.07687 3.60013 1.25325 1.36025C0.934875 1.91263 0.748125 2.54488 0.748125 3.2255C0.748125 4.5035 1.40625 5.63638 2.38725 6.29225C1.79437 6.281 1.21275 6.10888 0.72 5.83775C0.72 5.849 0.72 5.86363 0.72 5.87825C0.72 7.6715 1.99912 9.161 3.6765 9.50413C3.37612 9.58625 3.04875 9.62563 2.709 9.62563C2.47275 9.62563 2.23425 9.61213 2.01038 9.56263C2.4885 11.024 3.84525 12.0984 5.4585 12.1333C4.203 13.1154 2.60888 13.7071 0.883125 13.7071C0.5805 13.7071 0.29025 13.6936 0 13.6565C1.63462 14.7106 3.57188 15.3125 5.661 15.3125C12.4515 15.3125 16.164 9.6875 16.164 4.81175C16.164 4.64863 16.1584 4.49113 16.1505 4.33475C16.8829 3.815 17.4982 3.16588 18 2.41888Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social-icon-link">
                                    <a href="#">
                                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.24471 0C3.31136 0 0.687744 3.16139 0.687744 6.60855C0.687744 8.20724 1.58103 10.2008 3.01097 10.8331C3.22811 10.931 3.34624 10.8894 3.39462 10.688C3.43737 10.535 3.62525 9.79807 3.71638 9.45042C3.74451 9.33904 3.72988 9.24229 3.63988 9.13766C3.16511 8.58864 2.78821 7.58847 2.78821 6.65017C2.78821 4.24594 4.69967 1.91146 7.9522 1.91146C10.7648 1.91146 12.7325 3.73854 12.7325 6.35204C12.7325 9.30529 11.1698 11.3484 9.13912 11.3484C8.0152 11.3484 7.17816 10.4663 7.44367 9.37505C7.76431 8.07561 8.39321 6.6783 8.39321 5.74113C8.39321 4.90072 7.91844 4.20544 6.94865 4.20544C5.80447 4.20544 4.87631 5.33837 4.87631 6.85943C4.87631 7.82585 5.21832 8.47838 5.21832 8.47838C5.21832 8.47838 4.08652 13.0506 3.87614 13.9045C3.52062 15.3502 3.92451 17.6914 3.95939 17.8928C3.98077 18.0042 4.10565 18.0391 4.1754 17.9479C4.28678 17.8017 5.65484 15.8497 6.03848 14.4389C6.17799 13.9248 6.75064 11.84 6.75064 11.84C7.12753 12.5207 8.21546 13.0911 9.37426 13.0911C12.8214 13.0911 15.3123 10.0613 15.3123 6.30141C15.2999 2.69675 12.215 0 8.24471 0Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social-icon-link">
                                    <a href="#">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.0027 24.0548C8.72269 24.0548 8.33602 24.0375 7.05602 23.9815C6.05785 23.9487 5.07259 23.7458 4.14269 23.3815C3.34693 23.0718 2.62426 22.6 2.02058 21.9961C1.4169 21.3922 0.945397 20.6694 0.636019 19.8735C0.28576 18.9402 0.0968427 17.9542 0.0773522 16.9575C0.00268554 15.6802 0.00268555 15.2615 0.00268555 12.0068C0.00268555 8.7175 0.0200189 8.3335 0.0773522 7.06017C0.0972691 6.06486 0.28618 5.08018 0.636019 4.14817C0.945042 3.35128 1.41686 2.62761 2.02134 2.02335C2.62583 1.4191 3.34968 0.947556 4.14669 0.638836C5.07821 0.287106 6.06315 0.0976949 7.05869 0.0788358C8.33202 0.0068358 8.75069 0.00683594 12.0027 0.00683594C15.3094 0.00683594 15.6894 0.0241691 16.9494 0.0788358C17.9467 0.0975025 18.936 0.286836 19.8694 0.638836C20.6661 0.947914 21.3898 1.41958 21.9943 2.02379C22.5987 2.628 23.0706 3.35149 23.38 4.14817C23.736 5.09484 23.9267 6.09484 23.9414 7.10417C24.016 8.3815 24.016 8.79883 24.016 12.0522C24.016 15.3055 23.9974 15.7322 23.9414 16.9948C23.9214 17.9924 23.7321 18.9794 23.3814 19.9135C23.0712 20.7099 22.5988 21.4332 21.9942 22.0373C21.3896 22.6414 20.666 23.1133 19.8694 23.4228C18.936 23.7722 17.9507 23.9615 16.9547 23.9815C15.6814 24.0548 15.264 24.0548 12.0027 24.0548ZM11.9574 2.1175C8.69602 2.1175 8.35735 2.1335 7.08402 2.19084C6.32355 2.20078 5.57042 2.34103 4.85735 2.6055C4.33726 2.80486 3.86471 3.11098 3.47017 3.50414C3.07563 3.89731 2.76786 4.36878 2.56669 4.88817C2.30002 5.60817 2.16002 6.3695 2.15202 7.1375C2.08135 8.4295 2.08135 8.76817 2.08135 12.0068C2.08135 15.2068 2.09335 15.5948 2.15202 16.8788C2.16402 17.6388 2.30402 18.3922 2.56669 19.1055C2.97469 20.1548 3.80669 20.9842 4.85869 21.3868C5.57083 21.653 6.32382 21.7933 7.08402 21.8015C8.37469 21.8762 8.71469 21.8762 11.9574 21.8762C15.228 21.8762 15.5667 21.8602 16.8294 21.8015C17.5899 21.7923 18.3432 21.652 19.056 21.3868C19.5733 21.186 20.0432 20.8796 20.4357 20.4873C20.8282 20.095 21.1348 19.6254 21.336 19.1082C21.6027 18.3882 21.7427 17.6255 21.7507 16.8575H21.7654C21.8227 15.5828 21.8227 15.2428 21.8227 11.9855C21.8227 8.72817 21.808 8.3855 21.7507 7.11217C21.7386 6.35278 21.5984 5.60088 21.336 4.88817C21.1353 4.37023 20.8289 3.89977 20.4364 3.50677C20.0438 3.11376 19.5737 2.80682 19.056 2.6055C18.3427 2.33884 17.5894 2.20017 16.8294 2.19084C15.54 2.1175 15.2027 2.1175 11.9574 2.1175ZM12.0027 18.1655C10.7834 18.1663 9.59136 17.8055 8.5772 17.1287C7.56304 16.4519 6.77236 15.4896 6.30517 14.3634C5.83798 13.2373 5.71526 11.9978 5.95254 10.8019C6.18982 9.60598 6.77644 8.50729 7.63819 7.64478C8.49995 6.78228 9.59814 6.19471 10.7939 5.9564C11.9896 5.71808 13.2291 5.83973 14.3557 6.30594C15.4823 6.77216 16.4453 7.56201 17.1229 8.57558C17.8006 9.58916 18.1624 10.7809 18.1627 12.0002C18.1606 13.6337 17.5111 15.1999 16.3565 16.3555C15.2018 17.5111 13.6363 18.162 12.0027 18.1655ZM12.0027 7.9975C11.2116 7.9975 10.4382 8.2321 9.78041 8.67162C9.12261 9.11115 8.60992 9.73586 8.30717 10.4668C8.00442 11.1977 7.9252 12.0019 8.07954 12.7779C8.23388 13.5538 8.61485 14.2665 9.17426 14.8259C9.73367 15.3853 10.4464 15.7663 11.2223 15.9206C11.9982 16.075 12.8025 15.9958 13.5334 15.693C14.2643 15.3903 14.889 14.8776 15.3286 14.2198C15.7681 13.562 16.0027 12.7886 16.0027 11.9975C16.0002 10.9374 15.578 9.92141 14.8284 9.1718C14.0788 8.42219 13.0628 7.99997 12.0027 7.9975ZM18.4027 7.04683C18.2139 7.04613 18.0272 7.00826 17.8531 6.93538C17.6789 6.8625 17.5209 6.75604 17.3879 6.62208C17.1193 6.35153 16.9693 5.98537 16.9707 5.60417C16.9721 5.22296 17.1249 4.85793 17.3954 4.58938C17.666 4.32083 18.0321 4.17075 18.4134 4.17217C18.7946 4.17358 19.1596 4.32637 19.4281 4.59693C19.6967 4.86748 19.8468 5.23363 19.8454 5.61484C19.8439 5.99604 19.6912 6.36107 19.4206 6.62962C19.15 6.89817 18.7839 7.04825 18.4027 7.04683Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- My Account  -->
                    <div class="col-xl-auto col-sm-4 col-6">
                        <ul class="footer__navigation">
                            <li class="footer__navigation-title">
                                <h2 class="font-body--lg-500">Tài Khoản</h2>
                            </li>
                            <li class="footer__navigation-link">
                                <a href="/user/account-setting">Tài Khoản Của Tôi</a>
                            </li>
                            <li class="footer__navigation-link">
                                <a href="/user/order/history"> Lịch Sử Đặt Hàng </a>
                            </li>
                            <li class="footer__navigation-link">
                                <a href="/cart/shopping-cart"> Giỏ Hàng </a>
                            </li>
                            <li class="footer__navigation-link">
                                <a href="/cart/wishlist"> Danh Sách Yêu Thích </a>
                            </li>

                        </ul>
                    </div>
                    <!-- Helps  -->
                    <div class="col-xl-auto col-sm-4 col-6">
                        <ul class="footer__navigation">
                            <li class="footer__navigation-title">
                                <h2 class="font-body--lg-500">Hỗ Trợ</h2>
                            </li>
                            <li class="footer__navigation-link">
                                <a href="contact.html"> Liên Hệ </a>
                            </li>
                            <li class="footer__navigation-link">
                                <a href="#"> faq </a>
                            </li>
                            <li class="footer__navigation-link">
                                <a href="#"> Điều Khoản &amp; Điều Kiện </a>
                            </li>
                            <li class="footer__navigation-link">
                                <a href="#"> Chính Sách Bảo Mật </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Proxy -->
                    <div class="col-xl-auto col-sm-4 col-6">
                        <ul class="footer__navigation">
                            <li class="footer__navigation-title">
                                <h2 class="font-body--lg-500">Proxy</h2>
                            </li>
                            <li class="footer__navigation-link">
                                <a href="about.html"> Về Chúng Tôi </a>
                            </li>
                            <li class="footer__navigation-link">
                                <a href="shop-02.html"> Của Hàng </a>
                            </li>
                            <li class="footer__navigation-link">
                                <a href="#"> Sản Phẩm </a>
                            </li>
                            <li class="footer__navigation-link">
                                <a href="#"> Theo Dỗi Đơn Hàng </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Mobile app -->
                    <div class="col-xl-3">
                        <ul class="footer__navigation mb-0">
                            <li class="footer__navigation-title">
                                <h2 class="font-body--lg-500">Tải Xuống Ứng Dụng Di Động</h2>
                            </li>
                        </ul>
                        <div class="footer__mobile-app">
                            <a href="#" class="footer__mobile-app--item">
                                <span>
                                    <svg width="24" height="29" viewBox="0 0 24 29" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M23.4239 22.0659C23.0156 23.0169 22.5113 23.9238 21.9189 24.7725C21.1268 25.9013 20.4787 26.6824 19.9793 27.1164C19.2053 27.828 18.3752 28.1932 17.4868 28.2136C16.8492 28.2136 16.0803 28.0322 15.1849 27.6641C14.2866 27.2978 13.4612 27.1158 12.7063 27.1158C11.9148 27.1158 11.066 27.2978 10.1578 27.6641C9.24833 28.0322 8.51567 28.2241 7.95567 28.2428C7.104 28.2795 6.25467 27.9044 5.4065 27.1164C4.86575 26.6439 4.18967 25.8354 3.37884 24.6897C2.50909 23.4659 1.79392 22.0472 1.23392 20.429C0.634252 18.682 0.333252 16.9897 0.333252 15.3517C0.333252 13.4751 0.738669 11.8569 1.55067 10.5007C2.18942 9.41103 3.03817 8.55237 4.101 7.9212C5.1437 7.29723 6.33344 6.96145 7.5485 6.9482C8.22517 6.9482 9.11242 7.15762 10.2155 7.56887C11.3151 7.98128 12.0209 8.1907 12.3307 8.1907C12.5617 8.1907 13.3463 7.9457 14.6757 7.45803C15.9333 7.00537 16.9944 6.81812 17.8636 6.8922C20.2197 7.08237 21.9895 8.01103 23.1661 9.68403C21.0597 10.9604 20.0173 12.7483 20.0383 15.0419C20.0569 16.8287 20.705 18.3156 21.979 19.4957C22.5565 20.044 23.2011 20.4675 23.918 20.768C23.7677 21.2059 23.6029 21.6388 23.4239 22.0659ZM18.0211 0.805701C18.0211 2.2057 17.5095 3.51353 16.4898 4.72337C15.259 6.16245 13.7709 6.9937 12.1568 6.86245C12.1351 6.68634 12.1242 6.50906 12.1242 6.33162C12.1242 4.98762 12.7093 3.54912 13.7488 2.37253C14.2679 1.77695 14.9271 1.2817 15.7274 0.886784C16.5266 0.497701 17.2814 0.282451 17.9919 0.245117C18.0123 0.432367 18.0211 0.619617 18.0211 0.805117V0.805701Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <div class="footer__mobile-app--info">
                                    <h5>Download on the</h5>
                                    <h2 class="font-body--xl-500">App Store</h2>
                                </div>
                            </a>
                            <a href="#" class="footer__mobile-app--item">
                                <span>
                                    <svg width="22" height="25" viewBox="0 0 22 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.0652 11.7299L3.7188 1.35472L16.8828 8.91232L14.0652 11.7299ZM1.0176 0.745117C0.408 1.06432 0 1.64512 0 2.40112V23.0891C0 23.8451 0.408 24.4259 1.0176 24.7451L13.05 12.7427L1.0176 0.745117ZM20.9532 11.3219L18.192 9.72352L15.1116 12.7475L18.192 15.7715L21.0096 14.1731C21.8532 13.5023 21.8532 11.9927 20.9532 11.3219ZM3.7188 24.1403L16.8828 16.5827L14.0652 13.7651L3.7188 24.1403Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <div class="footer__mobile-app--info">
                                    <h5>Download on the</h5>
                                    <h2 class="font-body--xl-500">Google Play</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <p class="footer__copyright-text">
                    © 2025 {{ $websiteInfo->site_name }}. All rights reserved.
                </p>
                <div class="footer__partner d-flex">
                    <a href="#" class="footer__partner-item">
                        <img src="{{ asset('client/images/brand-icon/img-01.png') }}" alt="img" />
                    </a>
                    <a href="#" class="footer__partner-item">
                        <img src="{{ asset('client/images/brand-icon/img-02.png') }}" alt="img" />
                    </a>
                    <a href="#" class="footer__partner-item">
                        <img src="{{ asset('client/images/brand-icon/img-03.png') }}" alt="img" />
                    </a>
                    <a href="#" class="footer__partner-item">
                        <img src="{{ asset('client/images/brand-icon/img-04.png') }}" alt="img" />
                    </a>
                    <a href="#" class="footer__partner-item">
                        <img src="{{ asset('client/images/brand-icon/img-05.png') }}" alt="img" />
                    </a>
                </div>
            </div>
        </div>
        <div class="footer__overlay">
            <span class="footer__overlay-img one">
                <svg width="304" height="373" viewBox="0 0 304 373" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.6">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6.88764 238.457C5.98398 239.213 4.36558 240.07 5.29165 241.614C5.98473 242.736 8.13691 244.373 8.34635 244.221C11.548 241.645 14.2044 245.059 17.1354 244.651C17.4943 244.636 17.8326 244.119 18.458 243.59C17.8426 242.609 17.1524 241.559 16.5341 240.506C13.3764 235.387 11.1276 234.904 6.88764 238.457Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M120.092 62.3394C120.089 62.2677 119.306 62.4436 119.028 62.6707C115.132 65.8501 114.605 70.5451 112.686 74.5781C114.013 75.3864 114.692 76.1495 115.487 76.2607C116.279 76.3001 117.697 75.8105 117.748 75.3051C117.988 74.1449 118.3 72.9818 118.543 71.8934C119.168 71.3645 119.719 70.7667 120.255 69.8101C119.81 69.4688 119.385 69.6301 119.035 69.8601C119.539 68.1139 120.117 66.4366 120.985 64.8192C121.32 64.2303 120.484 63.1143 120.092 62.3394Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M0.359528 279.133C-0.0781485 280.732 1.51447 282.752 3.38654 282.819C6.84652 283.037 8.67451 282.027 8.72975 279.868C8.81149 278.355 6.22385 274.866 4.84833 274.635C3.54458 274.401 0.988984 276.95 0.359528 279.133Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M-10.9513 252.273C-11.3043 252.431 -11.499 252.942 -11.7743 253.241C-11.4037 253.514 -11.0213 254.073 -10.6624 254.058C-6.99889 253.98 -3.407 253.905 0.250648 253.683C0.60953 253.668 1.23781 253.211 1.29781 252.921C1.35782 252.631 0.90658 252.146 0.604758 251.799C-2.48819 248.259 -3.21188 248.145 -7.35249 250.615C-8.47736 251.237 -9.75469 251.649 -10.9513 252.273Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.7658 267.356C17.0007 267.665 18.2445 268.189 19.1876 266.64C18.8052 266.081 18.2527 264.881 18.0404 264.962C16.9067 265.368 15.8534 265.986 14.7974 266.533C15.0962 266.808 15.404 267.299 15.7658 267.356Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M185.785 30.2401C185.752 29.4505 185.071 28.6157 184.68 27.8409C184.353 28.6451 183.668 29.4641 183.7 30.2536C183.709 30.469 183.862 30.6784 183.945 30.9626C183.211 32.3587 182.495 34.1855 183.303 34.5838C183.704 33.8483 184.194 33.5407 184.783 33.876C185.173 32.8535 185.422 31.9086 185.464 31.1879C185.599 30.9666 185.728 30.6019 185.785 30.2401Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M103.927 150.285C103.629 150.01 103.393 149.516 103.106 149.528C102.819 149.54 102.549 149.982 102.274 150.281C102.716 150.551 103.159 150.82 103.529 151.093C103.661 150.8 103.796 150.578 103.927 150.285Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M115.576 104.729C116.635 104.254 116.824 103.599 116.085 103.126C115.864 102.991 115.508 103.078 115.149 103.093C115.018 103.386 114.673 103.759 114.751 103.9C114.909 104.253 115.435 104.806 115.576 104.729Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M179.698 50.1196C179.988 50.1796 180.323 49.5907 180.601 49.3636C180.299 49.0165 180.001 48.7412 179.699 48.3941C179.352 48.6959 179.076 48.9948 178.729 49.2966C179.1 49.569 179.336 50.0626 179.698 50.1196Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M185.141 40.8354C185.421 37.1571 187.148 35.4326 186.778 33.4347C186.377 34.1701 185.886 34.4778 185.298 34.1425C184.347 37.273 182.838 40.786 185.141 40.8354Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M196.918 63.2889C197.519 62.1858 198.225 61.8692 198.934 61.6245C199.231 56.5795 199.812 54.974 199.731 51.2387C197.766 55.9207 198.226 56.6208 196.406 59.5713C199.101 58.6699 195.407 63.2789 196.918 63.2889Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M121.078 82.8612C122.39 79.7878 123.832 78.1469 125.263 76.2189C120.515 74.4005 130.145 69.0447 126.427 66.0337C125.944 68.2823 125.002 73.3537 122.637 71.7971C122.197 68.0765 127.963 63.1667 124.761 62.2196C122.849 68.1935 121.497 72.0595 117.846 75.9479C122.343 73.3909 118.849 79.3578 122.714 77.1862C122.148 79.1506 118.628 82.746 121.078 82.8612Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M120.139 187.941C121.83 190.604 124.401 186.688 124.666 184.377C122.843 187.255 121.959 184.991 120.139 187.941Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M105.592 225.925C106.398 222.8 98.1484 230.256 97.4471 232.442C100.106 232.405 102.447 233.387 105.486 232.112C105.134 230.545 103.505 229.39 105.211 227.163C106.635 226.817 114.891 219.504 112.765 218.513C109.83 220.574 108.067 223.163 105.592 225.925Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M144.976 50.249C144.973 50.1773 145.042 50.1027 145.039 50.031C144.97 50.1056 144.973 50.1774 144.901 50.1803L144.976 50.249Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M-253.327 -587.75C-266.358 -586.425 -279.173 -585.108 -291.561 -583.882C-294.639 -583.54 -297.716 -583.198 -300.722 -582.859C-303.719 -582.305 -306.719 -581.822 -309.644 -581.271C-315.494 -580.168 -321.204 -579.143 -326.698 -578.127C-331.028 -575.001 -347.844 -574.815 -351.413 -568.917C-358.076 -568.356 -360.442 -568.187 -366.425 -565.066C-364.864 -569.084 -373.538 -563.193 -373.084 -566.159C-377.928 -563.3 -385.006 -564.088 -386.614 -561.218C-379.349 -562.882 -375.375 -565.921 -372.341 -563.817C-379.259 -562.455 -385.788 -558.592 -391.227 -559.735C-396.309 -557.442 -404.893 -551.122 -409.95 -551.706C-409.405 -548.924 -416.124 -549.727 -418.237 -546.908C-418.262 -545.757 -415.98 -546.21 -417.452 -545.287C-421.213 -542.328 -427.616 -542.425 -430.521 -539.646C-429.175 -540.133 -427.901 -540.616 -427.782 -539.471C-430.941 -537.616 -431.431 -539.034 -434.59 -537.178C-434.077 -535.186 -429.46 -538.323 -427.235 -538.415C-425.837 -541.132 -413.336 -546.606 -411.15 -545.905C-414.498 -543.395 -415.068 -541.502 -419.604 -541.675C-419.671 -539.803 -416.937 -541.497 -416.387 -540.369C-412.783 -541.883 -413.505 -543.723 -409.542 -545.252C-409.612 -543.451 -411.703 -541.856 -412.422 -540.101C-408.455 -541.557 -410.479 -543.56 -406.874 -545.073C-405.412 -544.486 -409.332 -541.881 -405.919 -542.812C-405.58 -543.329 -405.164 -543.706 -404.671 -543.941C-404.584 -543.585 -404.498 -543.23 -404.34 -542.877C-403.951 -542.174 -403.488 -541.402 -403.1 -540.699C-403.608 -540.822 -403.979 -541.094 -404.215 -541.588C-407.153 -539.598 -407.814 -539.93 -410.957 -539.442C-410.327 -538.102 -405.418 -539.381 -402.867 -540.277C-401.941 -538.733 -401.087 -537.186 -400.229 -535.568C-400.152 -535.427 -400.355 -535.131 -400.63 -534.832C-401.695 -534.501 -402.686 -534.101 -403.747 -533.698C-404.965 -533.576 -406.176 -533.311 -407.062 -532.124C-410.236 -530.628 -413.35 -529.422 -415.849 -530.757C-417.559 -526.877 -432.094 -521.895 -436.062 -522.235C-435.716 -520.812 -437.587 -519.081 -439.825 -517.552C-440.686 -517.516 -441.475 -517.484 -442.343 -517.592C-443.497 -517.689 -443.889 -516.738 -443.552 -515.529C-445.598 -514.583 -447.378 -514.15 -447.686 -514.641C-449.263 -512.779 -450.915 -510.986 -452.708 -509.115C-454.12 -508.481 -455.532 -507.848 -456.941 -507.144C-456.946 -507.287 -456.881 -507.434 -456.815 -507.58C-461.533 -505.158 -465.888 -502.678 -470.095 -500.061C-470.164 -499.987 -470.236 -499.984 -470.304 -499.909C-479.92 -494.194 -489.213 -487.63 -497.762 -480.449C-501.684 -477.916 -505.819 -475.302 -510.378 -472.527C-509.7 -471.764 -510.089 -470.741 -511.053 -469.695C-515.626 -469.004 -520.097 -464.076 -524.101 -460.029C-527.221 -458.966 -530.174 -457.335 -533.037 -455.277C-533.259 -455.411 -533.48 -455.546 -533.707 -455.824C-535.445 -454.387 -535.637 -453.804 -535.404 -453.382C-536.17 -452.776 -536.861 -452.1 -537.556 -451.497C-540.608 -448.783 -543.577 -445.785 -546.554 -443.003C-549.454 -440.08 -552.359 -437.301 -555.432 -435.09C-565.288 -428.215 -575.43 -421.328 -585.035 -413.601C-594.27 -405.601 -602.891 -396.692 -608.1 -385.19C-609.803 -382.892 -606.639 -382.878 -607.992 -380.809C-613.894 -373.953 -619.133 -364.966 -624.729 -355.894C-629.735 -346.485 -635.244 -337.057 -639.909 -328.094C-647.017 -315.58 -656.271 -304.56 -660.805 -290.641C-663.203 -282.491 -664.844 -275.162 -665.138 -268.319C-665.361 -261.48 -664.528 -255.187 -662.417 -249.306C-666.953 -237.185 -660.734 -220.545 -668.55 -209.512C-668.082 -206.871 -665.343 -206.695 -666.599 -202.258C-667.115 -199.073 -668.566 -199.373 -669.509 -197.825C-666.178 -197.243 -666.61 -199.022 -664.138 -196.607C-663.729 -205.899 -662.243 -209.986 -663.448 -218.348C-662.601 -220.468 -661.401 -221.021 -660.75 -224.427C-661.228 -243.1 -660.418 -265.421 -653.485 -289.216C-646.514 -312.078 -630.989 -331.479 -627.001 -348.179C-624.684 -351.294 -622.685 -348.141 -620.465 -350.101C-618.395 -359.245 -610.291 -363.244 -605.204 -372.44C-601.366 -378.78 -601.107 -386.484 -596.141 -393.374C-590.885 -400.204 -585.615 -404.95 -580.067 -409.922C-574.367 -414.685 -568.386 -419.604 -561.56 -426.714C-561.132 -426.804 -560.776 -426.89 -560.348 -426.98C-562.94 -423.566 -565.43 -421.163 -569.235 -415.759C-570.556 -416.423 -567.48 -418.563 -568.233 -419.395C-572.025 -415.429 -574.327 -411.955 -576.722 -408.981C-579.116 -406.007 -581.675 -403.529 -585.609 -401.283C-583.103 -399.804 -587.811 -395.369 -586.58 -393.406C-582.528 -398.03 -577.452 -403.99 -572.999 -404.101C-575.188 -399.625 -579.165 -400.181 -579.202 -397.591C-574.146 -400.531 -571.479 -403.876 -568.98 -407.789C-566.48 -411.702 -563.693 -415.627 -558.989 -420.133C-558.319 -419.586 -558.362 -418.865 -558.473 -418.069C-554.617 -420.456 -552.143 -425.015 -549.91 -428.414C-548.791 -429.179 -547.75 -430.085 -546.706 -430.918C-547.041 -430.329 -547.304 -429.743 -547.418 -429.02C-545.941 -429.799 -544.4 -430.797 -542.916 -431.433C-543.248 -430.772 -543.44 -430.19 -543.354 -429.834C-542.597 -430.655 -541.836 -431.406 -541.073 -432.084C-540.29 -432.26 -539.503 -432.364 -538.848 -432.175C-541.771 -426.304 -543.06 -420.93 -544.069 -415.712C-545.185 -414.876 -546.31 -414.254 -547.297 -413.783L-545.952 -412.544C-545.338 -413.36 -544.785 -413.886 -544.3 -414.337C-544.411 -413.541 -544.597 -412.815 -544.708 -412.019C-545.052 -411.646 -545.397 -411.272 -545.815 -410.967C-546.488 -411.587 -549.381 -410.246 -547.333 -409.395C-546.369 -410.441 -545.66 -410.686 -545.071 -410.351C-546.074 -408.512 -546.635 -406.404 -548.011 -404.91C-549.526 -403.266 -552.014 -402.589 -553.756 -401.223C-556.123 -399.329 -555.902 -393.946 -553.053 -392.84C-552.102 -392.448 -551.295 -392.049 -550.413 -391.582C-551.206 -389.896 -552.144 -388.204 -553.152 -386.509C-556.194 -387.032 -559.262 -386.474 -562.293 -384.984C-562.715 -384.751 -562.727 -383.312 -562.692 -382.451C-562.677 -382.092 -562.295 -381.533 -561.93 -381.404C-561.784 -381.338 -561.637 -381.272 -561.419 -381.209C-562.393 -378.653 -563.722 -376.01 -566.71 -375.241C-565.891 -374.555 -565.087 -374.229 -564.094 -374.557C-562.881 -376.548 -561.881 -378.458 -559.747 -380.774C-559.532 -380.783 -559.317 -380.792 -559.248 -380.867C-558.216 -381.988 -557.016 -382.54 -555.813 -383.021C-560.485 -377.725 -564.382 -372.82 -567.274 -367.956C-567.948 -366.85 -568.478 -365.75 -569.083 -364.718C-569.232 -364.856 -569.382 -364.993 -569.531 -365.131C-569.878 -364.829 -570.225 -364.528 -570.572 -364.226C-570.273 -363.95 -570.046 -363.672 -569.75 -363.469C-571.55 -360.016 -572.925 -356.724 -574.087 -353.513C-575.189 -352.317 -576.293 -351.193 -577.262 -350.291C-578.077 -349.107 -578.741 -347.786 -579.478 -346.461C-595.999 -326.803 -611.704 -301.283 -622.863 -273.576C-635.353 -243.299 -642.369 -211.017 -644.145 -184.198C-646.766 -177.979 -648.684 -172.149 -649.717 -165.78C-650.822 -159.407 -651.55 -152.619 -651.22 -144.58C-658.275 -136.023 -658.614 -119.76 -657.177 -104.002C-656.8 -100.063 -656.423 -96.1242 -656.051 -92.3288C-655.608 -88.5365 -655.096 -84.8188 -654.812 -81.3794C-654.311 -74.4259 -654.279 -68.3879 -655.604 -63.876C-645.892 -56.725 -647.147 -31.2221 -649.94 -22.1923C-646.522 -21.254 -644.862 -17.5834 -644.108 -13.2286C-643.282 -8.87679 -643.145 -3.77773 -643.268 0.253494C-644.548 0.593589 -647.6 -5.46434 -645.9 0.936627C-645.414 4.0083 -643.99 3.66229 -642.999 5.05955C-644.305 8.27657 -644.789 12.2508 -647.15 14.2888C-646.122 20.0703 -643.738 20.3321 -642.71 26.1136C-644.908 25.1252 -647.228 24.6452 -648.874 21.3336C-652.433 13.4271 -649.995 11.5296 -650.043 6.85827C-652.241 7.5955 -652.12 10.5383 -653.951 6.22766C-648.915 2.78581 -657.725 -3.39553 -653.693 -8.52176C-652.857 -5.68013 -651.905 -3.4904 -650.437 -2.75974C-652.76 -8.56003 -655.064 -15.6552 -656.999 -20.7525C-656.644 -19.1134 -656.687 -16.6671 -657.574 -19.0034C-657.482 9.53596 -651.222 35.953 -641.438 60.6438C-631.579 85.4034 -618.265 108.512 -602.577 131.666C-602.855 135.416 -600.122 140.696 -597.825 145.851C-586.687 157.976 -579.761 167.326 -569.442 164.746C-581.197 149.842 -591.932 138.779 -606.835 111.997C-607.97 105.357 -607.206 99.4304 -603.184 95.8144C-589.159 115.227 -580.584 140.255 -564.161 156.764C-561.764 159.111 -559.958 159.324 -557.92 161.685C-545.468 176.057 -540.661 184.559 -532.411 194.646C-516.292 214.26 -494.349 230.4 -474.654 246.057C-470.272 249.472 -468.127 256.214 -461.075 256.356C-466.159 251.604 -471.536 246.72 -476.877 242.697C-482.153 238.527 -487.124 234.777 -491.533 232.441C-496.285 227.028 -502.767 219.745 -509.952 212.85C-516.723 205.506 -524.204 198.408 -529.784 192.094C-532.018 188.447 -534.316 185.018 -536.607 181.733C-538.83 178.373 -541.044 175.229 -543.327 172.159C-548.033 166.097 -552.59 160.172 -557.368 154.113C-566.924 141.995 -576.739 128.809 -585.541 110.549C-582.407 106.322 -585.577 102.642 -588.343 96.5718C-583.401 94.356 -583.765 88.9786 -586.557 82.2629C-589.629 79.2254 -588.695 86.2331 -591.27 83.0314C-591.743 78.5213 -591.92 74.2147 -588.634 71.9231C-586.98 75.4501 -584.599 79.163 -584.864 81.4745C-581.614 78.3216 -586.026 70.6658 -581.23 68.3841C-577.601 74.4903 -573.486 80.1452 -569.453 85.5877C-565.138 90.875 -560.9 96.0216 -556.597 101.022C-547.847 111.016 -539.465 120.81 -532.233 132.376C-531.981 136.752 -533.697 140.489 -532.57 145.188C-527.758 145.062 -532.381 135.761 -529.933 132.354C-526.244 134.647 -522.571 138.307 -518.769 141.602C-517.579 142.56 -516.39 143.518 -515.272 144.478C-515.191 144.691 -515.111 144.903 -515.027 145.187C-513.768 149.593 -512.049 154.699 -507.301 156.518C-506.497 156.844 -505.761 157.245 -505.029 157.575C-502.306 160.842 -499.596 163.823 -496.897 166.516C-496.819 166.657 -496.742 166.797 -496.661 167.01C-496.219 167.279 -495.917 167.626 -495.546 167.899C-495.023 168.38 -494.494 169.006 -493.899 169.485C-490.953 172.959 -490.621 177.546 -490.502 182.215C-490.434 183.866 -489.465 184.689 -487.941 185.058C-487.067 185.309 -486.117 185.702 -485.447 186.25C-483.809 187.62 -480.957 188.797 -483.788 191.646C-483.111 194.134 -481.12 195.347 -479.003 196.123C-475.062 197.543 -472.246 199.584 -472.342 204.261C-472.379 205.126 -471.973 206.259 -471.375 206.81C-467.797 209.899 -465.45 214.548 -460.507 215.855C-457.311 216.658 -457.851 219.269 -457.406 221.336C-456.602 221.662 -455.514 221.905 -455.278 222.399C-452.833 229.416 -448.093 234.542 -442.719 239.355C-439.883 241.898 -437.127 244.23 -435.464 247.972C-433.173 252.983 -431.06 258.936 -423.278 257.61C-422.279 257.425 -420.916 259.095 -419.798 260.056C-418.005 261.708 -416.355 263.365 -414.699 265.167C-413.872 266.068 -411.97 266.852 -413.703 268.433C-414.882 269.488 -415.494 272.102 -418.016 270.192C-418.758 269.647 -419.708 269.255 -420.641 269.293C-421.503 269.328 -422.341 269.938 -423.118 270.257C-422.814 270.676 -422.584 271.026 -422.279 271.445C-419.781 274.506 -416.256 276.303 -412.676 275.94C-410.816 275.72 -409.472 275.162 -407.978 276.539C-405.584 278.813 -402.84 280.857 -402.756 284.664C-402.639 289.261 -400.194 285.782 -398.6 286.076C-395.556 286.67 -391.537 288.231 -390.142 290.69C-388.673 293.218 -386.805 294.939 -384.739 296.22C-387.49 295.758 -390.244 295.223 -392.944 294.256C-409.407 289.035 -427.431 275.539 -443.748 270.384C-446.408 263.376 -448.615 269.146 -454.822 261.564C-456.865 262.582 -460.766 263.893 -459.523 266.142C-459.769 267.159 -458.789 268.269 -457.809 269.379C-448.624 272.454 -443.157 277.766 -434.525 279.64C-416.457 295.939 -395.388 304.781 -372.777 310.9C-372.679 311.543 -372.584 312.114 -372.626 312.835C-371.696 312.725 -370.999 312.193 -370.595 311.529C-370.086 311.652 -369.65 311.778 -369.141 311.901C-366.962 312.459 -364.785 312.945 -362.608 313.43C-361.768 314.618 -361.001 315.809 -360.299 317.146C-359.122 319.542 -356.901 321.105 -353.525 321.038C-343.901 320.788 -343.82 321 -338.44 329.479C-337.979 330.179 -337.732 330.96 -337.484 331.74C-335.753 331.885 -334.709 332.777 -334.426 334.419C-332.138 334.109 -330.132 330.432 -327.464 334.133C-326.093 336.018 -324.156 337.665 -322.096 338.802C-321.214 339.269 -320.404 339.739 -319.591 340.281C-319.95 340.296 -320.234 340.38 -320.518 340.463C-319.938 340.583 -319.211 340.769 -318.557 340.958C-317.591 341.709 -316.692 342.607 -315.918 343.941C-314.37 346.61 -311.821 343.917 -309.927 342.761C-304.361 346.99 -296.579 342.142 -291.197 347.169C-287.39 347.085 -283.397 346.274 -279.77 347.06C-275.634 347.969 -271.891 349.829 -267.396 348.997C-264.115 348.359 -262.031 350.071 -260.969 353.191C-260.802 353.76 -258.978 354.404 -258.559 354.099C-255.555 351.963 -252.631 353.137 -249.656 353.806C-245.284 349.96 -239.794 350.597 -234.617 350.601C-229.512 350.607 -224.122 348.804 -219.369 352.492C-218.478 353.174 -216.501 352.302 -215.989 350.771C-215.344 348.948 -214.99 347.064 -212.472 347.104C-210.531 347.097 -208.668 346.948 -206.736 346.725C-198.861 345.899 -190.614 347.143 -183.168 342.883C-182.255 342.342 -180.428 343.058 -179.119 343.436C-177.953 343.819 -177.098 345.366 -175.578 343.866C-173.301 341.544 -170.263 341.994 -167.454 342.095C-161.408 342.278 -158.683 342.094 -156.299 340.631C-152.72 338.471 -148.766 336.727 -146.111 333.095C-145.09 331.687 -143.291 329.96 -141.715 329.823C-137.346 329.428 -133.362 328.402 -129.715 326.168C-122.215 326.723 -116.189 322.881 -110.077 319.395C-109.305 318.932 -107.899 318.155 -107.983 317.871C-109.645 312.403 -103.938 311.306 -102.282 307.859C-100.626 304.412 -99.1192 300.827 -97.6126 297.243C-96.0601 296.532 -94.4355 295.818 -92.8111 295.104C-92.2998 295.299 -91.8752 295.138 -91.6117 294.552C-90.0561 293.913 -88.3571 293.268 -86.7298 292.626C-84.5658 294.551 -82.5719 295.835 -78.9996 293.532C-75.2178 291.076 -70.4413 290.089 -66.0383 288.758C-64.5457 288.337 -63.2713 287.854 -62.8966 286.472C-62.333 284.436 -61.9523 283.198 -59.3125 284.456C-57.2615 285.378 -54.1958 284.749 -52.5608 286.048C-48.6183 289.266 -46.7194 284.73 -43.7913 284.251C-42.2899 284.046 -42.5334 281.611 -43.3642 280.639C-45.5546 278.068 -48.2268 276.021 -50.4143 273.522C-52.5271 271.093 -53.9036 272.587 -56.1681 273.471C-60.6253 275.235 -65.4727 274.499 -70.2364 274.048C-70.5982 273.991 -70.9058 273.5 -71.2765 273.227C-70.9323 272.854 -70.597 272.265 -70.2382 272.25C-66.4429 271.879 -65.1604 268.088 -62.3482 266.534C-61.0138 265.761 -58.6447 269.186 -57.9699 266.355C-56.9263 261.998 -54.0541 260.155 -50.3777 258.638C-46.067 256.808 -41.7535 255.049 -37.5982 252.937C-33.018 250.665 -28.5245 248.036 -24.025 245.551C-22.8284 244.926 -21.437 243.791 -20.2827 243.887C-15.3754 244.333 -11.8806 241.889 -9.36621 238.335C-6.71705 234.56 -3.2001 234.415 0.750571 234.325C3.12213 234.3 5.64896 234.556 7.36093 232.472C10.7161 228.38 15.8282 226.805 19.9482 223.832C21.7643 222.535 19.025 222.36 18.0714 221.896C17.3389 221.566 16.738 220.944 16.0714 220.468C16.4185 220.166 16.8257 219.574 17.1845 219.559C22.789 219.473 28.2511 217.668 33.9014 220.456C37.791 222.381 41.9727 220.915 45.8921 218.31C52.3995 213.945 53.3838 213.402 55.2751 206.925C56.8487 201.468 57.8155 200.494 62.7621 200.147C67.0628 199.827 71.4618 200.15 74.3056 195.863C74.7787 195.125 75.7451 194.151 76.5347 194.118C83.2128 193.916 86.3803 188.754 90.1632 184.572C92.9823 181.437 96.7581 178.838 97.5747 174.203C101.868 171.942 104.729 168.086 108.344 165.062C112.377 161.733 112.402 155.333 118.083 153.59C119.007 153.337 118.673 152.2 117.432 151.748C116.556 151.424 115.554 151.537 114.675 151.142C114.382 151.01 114.086 150.806 113.793 150.675C115.496 148.376 117.188 145.79 118.81 143.279C117.158 145.072 114.154 147.209 111.584 149.399C111.366 149.336 111.216 149.198 111.001 149.207C108.686 148.871 108.039 150.623 107.548 152.656C107.239 153.891 106.155 155.517 105.096 155.992C104.318 156.312 103.69 156.769 102.987 157.157C102.978 156.942 103.038 156.652 103.098 156.362C102.473 156.891 102.203 157.333 101.934 157.775C98.2298 160.372 95.5806 164.147 91.9513 166.812C89.2973 168.719 86.6965 171.917 83.8972 172.032C80.4549 172.245 76.9066 169.874 73.4054 168.651C72.0928 168.202 70.7831 167.824 69.4676 167.303C69.0311 167.177 68.6546 166.761 68.3527 166.414C67.2113 164.879 67.8326 166.004 69.397 165.58C72.9534 164.644 73.7351 162.67 73.5309 159.443C73.3325 156.36 74.8752 157.16 76.9173 157.867C80.1973 158.954 78.474 155.502 79.4347 154.384C80.3236 153.269 81.2479 153.016 81.4474 154.374C81.9228 158.956 84.3104 157.563 86.7784 156.384C89.1006 158.661 91.9028 158.618 94.7444 157.783C95.1722 157.693 95.7317 157.311 95.8605 156.946C95.9923 156.653 95.5379 156.096 95.2391 155.821C94.193 154.857 93.1981 153.388 91.9661 153.151C86.4552 152.011 84.2384 148.795 84.0117 143.268C85.003 141.143 85.4919 139.038 84.9217 137.407C86.2372 137.928 87.469 138.166 88.8152 137.679C88.6145 138.047 88.4798 138.268 88.411 138.343C88.7581 138.041 89.0306 137.67 89.3777 137.368C90.0119 137.055 90.5685 136.601 91.1822 135.784C91.7958 134.968 93.2431 135.197 94.5557 135.646C94.0826 136.385 93.5379 137.126 93.0707 138.008C90.658 137.028 85.8308 142.043 88.7136 142.213C89.0877 137.308 91.3751 142.247 92.3387 141.201C93.1324 139.515 94.871 138.078 96.5318 136.5C99.5305 137.743 102.52 138.771 105.576 139.652C110.45 141.034 115.041 140.773 118.148 135.901C121.052 131.324 125.312 129.999 130.443 130.651C131.816 130.811 133.311 130.462 134.756 130.618C135.404 130.664 135.976 130.568 136.55 130.545C136.436 131.268 136.325 132.064 136.073 132.937C136.899 132.04 137.509 131.153 138.048 130.268C138.476 130.178 138.901 130.017 139.254 129.859C136.687 135.644 132.26 141.649 127.477 147.741C123.646 152.499 119.674 157.335 115.978 161.873C112.132 166.272 108.415 170.307 105.844 174.223C107.077 172.735 104.372 178.669 101.566 180.366C106.519 180.163 115.009 171.547 121.774 169.975C124.791 166.4 127.362 164.21 129.928 163.673C131.014 162.119 131.751 160.795 131.922 159.709C137.017 161.226 150.065 139.265 151.602 143.444C153.025 139.575 153.386 136.109 156.333 130.812C155.281 129.705 154.22 131.905 153.148 130.295C154.762 127.569 155.675 125.303 155.26 123.954C151.758 129.705 154.005 131.914 151.481 136.978C150.112 135.165 147.617 137.424 147.495 139.73C148.391 142.282 149.89 136.756 150.87 137.866C149.924 139.343 151.721 139.341 150.075 141.278C148.489 137.676 145.219 149.098 141.307 150.121C140.413 149.367 140.016 148.449 140.46 146.993C145.599 140.814 141.727 142.843 142.591 139.356C144.193 136.343 145.618 137.794 147.187 135.717C145.02 133.72 147.832 128.644 150.487 125.012C152.006 119.989 152.153 114.807 152.53 109.974C152.734 109.678 152.94 109.454 153.144 109.158C155.472 106.33 157.278 103.021 159.233 99.8492C159.706 99.1109 159.234 98.1237 158.011 98.1019C155.206 98.0732 151.926 96.9855 149.783 99.0864C146.88 101.938 142.731 104.193 143.379 109.487C143.498 110.632 142.707 112.39 141.732 113.149C140.338 114.213 138.869 115.208 137.474 116.271C137.322 116.062 137.164 115.709 137.074 115.281C136.748 116.085 136.412 116.674 136.077 117.263C133.842 118.865 131.532 120.397 129.226 122.002C125.291 120.725 121.29 119.595 117.418 118.1C116.028 117.51 114.793 117.201 113.447 117.688C113.094 117.846 112.546 118.516 112.546 118.516C116.996 123.582 110.93 124.693 109.164 127.21C107.877 129.132 105.583 129.298 103.424 129.243C102.221 126.201 108.128 124.736 106.548 121.278C106.824 120.979 107.168 120.606 107.44 120.235C110.16 118.182 113.467 114.668 115.967 110.755C118.676 106.689 121.035 102.854 122.54 100.994C121.906 101.308 120.959 99.2619 121.217 98.5324C124.152 96.4708 125.095 86.1509 126.01 90.9304C128.037 87.7558 126.973 86.3615 126.612 84.5788C123.982 92.3078 119.273 98.4683 118.854 104.022C115.447 105.096 113.491 109.993 111.341 113.676C110.464 115.078 109.724 116.331 108.901 117.299C108.806 116.728 108.418 116.025 108.179 115.46C108.098 115.247 107.375 115.133 107.165 115.285C106.322 115.751 105.708 116.567 104.858 116.89C103.584 117.374 102.023 117.869 101.097 116.325C100.401 115.131 100.058 113.78 101.007 112.375C101.752 111.266 102.279 110.094 102.878 108.919C104.308 108.716 105.967 108.864 106.943 108.105C107.849 107.421 108.212 105.752 108.375 104.451C108.582 102.502 108.287 100.572 108.785 98.6827C109.182 99.6011 109.08 100.612 110.278 98.262C110.242 97.4007 110.345 96.39 110.591 95.3733C110.791 95.0056 110.848 94.6438 110.905 94.2819C112.551 88.8222 117.098 82.2369 117.648 78.1162C116.1 80.6961 114.693 83.1983 113.211 85.6317C113.224 84.1932 113.165 82.7577 113.031 81.2533C113.016 80.8945 112.496 80.4844 112.132 80.3555C111.985 80.2896 111.423 80.6003 111.288 80.8216C110.007 82.8872 110.164 84.9658 111.538 86.9225C111.691 87.132 111.981 87.1919 112.274 87.3237C111.468 88.7228 110.588 90.0531 109.78 91.3804C108.794 90.1266 107.667 88.9506 107.889 87.3598C108.109 85.6971 107.966 83.9775 107.752 82.2607C109.198 80.6916 110.565 78.9818 111.35 77.0803C109.751 76.6426 112.647 73.648 110.485 73.521C109.974 73.3262 109.478 73.4904 108.987 73.7981C110.376 70.8652 110.046 68.0748 109.854 65.1349C109.656 62.0515 110.078 60.0929 113.692 58.7944C115.534 58.1436 116.914 56.721 117.627 54.8224C118.716 55.0654 119.963 53.9357 121.199 52.519C121.183 55.6113 124.172 56.6391 123.108 60.4932C123.905 58.8788 124.719 57.6951 125.715 57.4385C126.698 58.6204 125.515 61.3292 126.986 62.1316C127.703 58.5793 129.913 54.6062 132.998 50.9567C129.934 49.8601 133.314 44.6169 134.26 43.1401C135.407 44.8186 134.654 47.5097 132.808 49.8142C136.086 49.1046 132.103 53.6537 134.546 53.6253C136.779 50.2265 134.197 38.1099 140.545 35.1175C136.918 43.103 139.034 45.6045 138.316 50.8825C141.08 53.4293 143.198 52.4796 145.048 50.2468L143.442 49.6657C144.006 47.6294 144.858 47.3788 145.529 46.2009C145.777 46.9816 146.093 47.6876 146.695 46.5844C148.019 47.321 145.453 47.8577 145.183 50.0256C147.44 47.201 149.336 42.5937 151.742 39.9067C153.554 31.4924 160.711 20.1987 160.641 13.2275C159.03 16.0257 158.018 22.8974 154.495 22.898C152.221 20.0435 157.66 17.6636 155.358 15.8887C153.292 19.8558 154.101 22.0515 151.262 22.9588C151.643 21.7209 150.495 21.768 150.669 20.7543C152.534 17.1548 155.539 13.2929 157.091 14.3078C155.141 14.1002 159.44 11.9827 157.398 11.2755C156.443 12.5369 155.062 12.1622 153.85 12.4276C152.603 17.0801 150.777 19.8871 148.339 20.0589C147.59 14.0503 150.44 9.90723 150.685 5.36768C152.372 4.43573 153.907 3.29433 155.215 1.87465C156.385 0.604413 156.045 -0.675787 155.486 -2.01893C155.009 -3.14969 153.188 -3.72207 154.194 -5.48887C155.532 -7.91635 156.348 -10.8257 158.134 -12.8402C162.405 -17.401 165.21 -22.6207 167.197 -28.5259C167.194 -28.5976 167.266 -28.6006 167.338 -28.6035C167.559 -28.4688 167.783 -28.2623 168.073 -28.2023C167.435 -22.712 168.958 -18.892 166.311 -13.3193C166.805 -13.5552 167.002 -13.9947 167.346 -14.3683C166.77 -10.8936 166.268 -7.35008 165.769 -3.73478C169.602 -1.44745 165.53 -7.82307 168.628 -7.66255C169.296 -5.38927 167.955 2.21495 165.376 2.46447C166.095 0.709452 166.811 -1.11732 167.246 -2.78879C165.903 -2.23041 165.136 0.10178 164.357 2.14683L164.285 2.14976C164.288 2.22154 164.222 2.36801 164.225 2.43979C163.701 3.68354 163.174 4.8555 162.333 5.39327C162.721 6.0963 162.201 10.9347 163.261 8.73437C163.258 8.66259 163.321 8.44431 163.39 8.36959C162.105 15.612 159.938 22.3872 158.334 28.8519C155.939 37.0744 154.104 44.9146 154.434 52.9535C151.125 54.671 149.962 57.8821 149.811 61.1956C147.649 69.84 142.752 76.6553 138.556 81.285C141.898 83.88 133.378 88.2557 133.399 92.281C132.463 92.2475 131.915 92.9171 131.785 91.4845C131.561 100.049 122.253 101.006 119.606 110.102C122.049 106.551 120.671 115.019 124.196 108.044C123.617 106.199 120.935 109.185 122.061 106.838C125.164 108.867 128.515 101.181 132.778 99.9276C132.438 93.3989 138.117 89.8588 141.853 82.8034C143.211 82.6039 147.374 82.4332 146.674 79.3704C145.325 83.3081 145.027 77.7843 144.283 77.1678C145.852 73.3647 148.241 70.2471 150.339 67.0695C150.858 69.2051 151.578 70.973 152.265 71.9514C152.589 71.0754 152.843 70.274 153.167 69.398C153.816 69.4432 154.169 69.285 155.008 70.4728C157.571 66.3415 155.951 65.4014 156.144 63.0927C159.351 65.909 162.186 52.6356 165.528 49.9822C164.224 49.7481 164.105 48.6026 164.806 46.4169C165.482 47.1082 165.374 47.9754 166.555 46.9923C172.313 27.8473 176.622 10.1996 181.08 -7.31044C180.388 -13.6808 182.044 -31.1478 188.012 -29.3795C193.825 -50.6837 194.265 -73.2773 195.306 -96.9742C192.18 -104.827 193.215 -114.647 193.564 -121.923C193.464 -120.84 191.968 -124.014 192.603 -126.054C194.738 -133.618 197.693 -121.158 197.662 -114.901C197.367 -120.353 201.676 -115.21 203.156 -114.192C204.793 -102.324 204.687 -92.6137 206.194 -82.1785C205.95 -79.3646 204.382 -79.0127 204.299 -75.7739C206.644 -71.1967 202.385 -66.3488 202.465 -60.8879C202.451 -57.7239 204.926 -55.2371 204.622 -52.1331C204.335 -48.5984 201.507 -45.6784 201.197 -42.7179C200.984 -40.9117 201.762 -37.7083 201.681 -36.1951C201.675 -36.3386 200.566 -37.084 200.626 -37.3741C200.253 -34.1953 201.765 -32.388 201.59 -29.6487C201.539 -29.1434 199.672 -29.0668 199.609 -28.8485C197.89 -25.1832 200.115 -20.0259 199.496 -15.8306C197.165 -13.0747 197.462 -19.8453 196.284 -15.2675C198.251 -14.6291 196.995 -10.1919 198.005 -8.36401C194.077 -5.97412 195.835 3.58797 192.807 1.62716C192.526 5.3054 192.376 10.4162 191.428 15.3441C190.477 20.2002 189.379 24.9904 188.289 28.1986C188.744 27.0296 189.548 27.3561 190.349 27.6109C187.937 35.4027 187.179 37.9503 187.005 42.4869C186.422 42.2951 186.602 41.4249 186.157 41.0837C184.385 46.98 183.102 52.4968 181.212 57.2476C179.322 61.9985 177.479 66.1721 175.677 69.5533C176.017 70.8335 176.707 71.8837 176.7 73.4657C174.193 75.4379 174.515 76.2874 175.118 78.7072C173.242 80.294 171.299 78.5043 171.147 81.8178C174.196 79.0325 171.341 86.555 170.787 88.8066C169.69 88.3483 168.874 91.2576 167.667 89.8691C166.288 89.5662 168.327 86.6786 167.298 86.1456C164.621 92.7262 166.304 93.448 168.746 95.1453C170.676 93.1249 172.452 89.0977 174.371 86.7902C172.01 83.5798 178.5 73.5356 180.795 71.6441C180.274 72.9596 181.423 72.9126 181.039 74.0786C180.315 73.9645 179.496 73.2791 178.898 74.4541C179.916 81.7458 175.256 87.3292 171.405 95.1082C174.656 93.7526 172.234 97.8062 174.363 98.8692C177.843 90.8179 181.174 82.6288 184.4 75.3787C181.925 78.1404 183.962 71.7299 183.838 70.4409C185.496 68.7912 189.524 63.5932 189.382 61.8735C188.783 63.0484 188.048 62.6472 187.243 62.3207C191.782 59.043 192.576 52.1083 195.358 46.3143C192.896 52.8861 195.305 50.2709 194.363 55.3423C196.626 50.9356 198.255 48.5681 197.154 44.5151L198.9 45.0187C199.547 39.7438 201.949 33.4621 204.48 26.8156C205.709 23.458 207.081 20.0945 208.091 16.6739C208.954 13.1874 209.531 9.71274 209.751 6.32455C210.469 6.29511 211.426 6.83107 211.806 5.59321C211.967 -6.27635 219.571 -22.4774 217.882 -28.5913C220.319 -28.7632 220.265 -23.0811 218.352 -20.63C222.662 -20.7349 220.725 -27.6295 220.536 -30.4976C220.542 -30.354 221.756 -30.5476 221.765 -30.3323C221.651 -34.8571 219.114 -37.1257 219.35 -41.8806C219.605 -47.9304 222.997 -49.3636 222.742 -57.3338C219.667 -55.1945 223.34 -65.5545 221.993 -68.5908C221.304 -62.5952 220.876 -66.0286 221.181 -70.8582C221.343 -75.682 221.586 -82.0189 223.674 -81.9607C223.465 -78.2854 224.999 -77.7012 225.389 -75.2008C225.208 -81.3765 226.046 -78.4631 228.514 -79.6428C227.877 -84.6495 229.579 -85.2226 229.797 -88.6825C227.877 -88.1724 228.062 -83.6505 226.694 -81.9408C226.704 -83.4511 226.451 -84.3753 226.125 -85.2966C226.881 -87.9159 229.974 -89.6245 227.359 -92.0336C228.441 -91.9342 229.288 -92.3284 229.827 -93.2133C230.488 -84.1095 231.031 -77.8767 231.066 -71.7669C230.667 -65.7112 229.76 -59.7785 227.733 -51.3553C228.16 -46.1962 227.08 -40.9754 226.144 -35.7604C225.21 -30.4736 224.564 -25.1986 225.006 -19.6807C223.854 -19.7053 223.861 -16.0389 222.542 -16.6319C221.399 -2.42131 212.538 11.1711 213.828 23.3407C214.925 20.2761 215.314 15.7306 217.048 15.9471C216.4 19.4247 213.456 35.2909 210.39 30.6714C209.925 33.3507 209.741 35.8746 208.309 39.5282C210.275 41.8921 210.164 33.9161 211.772 34.5691C210.54 39.5805 208.203 50.9642 203.925 53.5841C201.098 63.5499 197.342 71.9002 194.128 79.4374C190.768 86.9087 187.298 93.4498 183.065 98.9438C185.66 100.85 180.899 100.471 180.123 102.587C179.523 105.488 183.299 102.889 182.374 104.868C181.841 105.896 182.214 106.24 181.891 107.116C180.333 111.206 178.632 110.054 177.072 112.347C177.944 114.324 174.828 118.981 172.831 122.874C168.319 121.549 167.012 130.015 164.656 133.922C160.171 142.014 153.251 150.351 147.193 158.651C140.91 166.746 135.417 174.808 130.832 180.46C139.277 172.493 139.818 168.157 147.615 161.941C150.38 155.717 154.801 149.568 159.506 143.336C163.99 136.969 168.316 130.249 171.712 123.639C172.97 124.522 174.2 122.961 175.498 123.052C175.635 124.628 174.305 127.271 174.373 128.922C177.689 125.622 180.056 113.231 186.827 108.28C185.333 106.903 188.02 104.061 189.221 101.783C186.928 96.7004 193.909 81.1 197.125 75.3601C198.087 76.0397 193.204 84.9395 195.604 82.1089C196.913 78.9637 198.216 75.6749 199.971 76.3938C199.548 78.3524 196.692 82.3519 197.867 82.9508C200.115 79.9108 201.971 72.5731 204.834 75.7629C207.101 71.4281 202.055 76.3802 203.877 71.7041C204.448 71.6088 204.927 71.014 205.308 69.7761C208.526 69.3566 207.297 72.7142 208.014 74.4103C211.507 70.1689 209.303 69.037 208.488 68.4234C211.393 65.6441 209.496 71.9769 211.917 69.6489C214.835 65.431 216.496 60.3302 217.257 57.8544C216.733 59.0982 216.027 59.4147 215.393 59.7283C216.396 57.8898 215.181 54.5604 217.179 54.1909C216.873 55.4976 216.085 57.3273 216.677 57.7345C220.251 51.9799 222.047 41.4093 225.951 38.4452C226.046 35.4935 223.57 39.9808 223.937 36.6585C225.03 29.9992 227.747 31.3975 229.371 27.1609C228.69 26.3261 225.943 27.7329 226.779 25.326C228.346 21.4512 228.333 14.1183 231.05 15.5167C231.247 16.8027 229.687 24.344 231.01 21.5576C231.311 14.8589 233.581 10.5958 231.576 7.29886C233.263 2.84396 234.584 8.75722 235.849 4.53535C235.853 2.88154 233.594 3.90882 233.939 1.80965C235.325 0.530587 240.378 -11.252 236.783 -5.99993C238.311 -10.8078 238.416 -11.7468 239.859 -18.6362C238.983 -18.9598 237.562 -18.542 237.641 -20.1269C240.342 -29.6562 240.901 -38.81 241.762 -47.6168C242.408 -56.4147 243.209 -64.9314 244.438 -73.5376C243.412 -73.9988 242.852 -71.8908 242.638 -73.6075C243.665 -80.1204 244.595 -85.4789 242.188 -89.8378C243.049 -89.8731 243.503 -89.3165 244.032 -88.6911C242.973 -93.4648 244.305 -99.5588 245.277 -103.912C247.707 -100.777 245.654 -94.7251 249.589 -93.4486C249.253 -101.631 244.225 -105.02 245.206 -114.407C243.778 -115.93 242.961 -111.295 242.769 -114.235C243.486 -117.787 243.301 -118.786 241.909 -121.173C243.991 -121.259 243.849 -124.704 244.467 -127.174C241.366 -136.178 244.647 -145.587 240.076 -153.596C239.957 -158.264 239.816 -163.435 239.165 -168.801C238.298 -174.157 237.282 -179.652 236.056 -184.994C233.674 -195.752 230.816 -205.845 228.087 -212.779C229.395 -214.198 226.961 -219.203 229.476 -219.234C225.427 -225.036 227.969 -229.669 223.931 -233.458C224.277 -232.034 224.546 -230.751 223.463 -230.851C222.137 -233.385 222.197 -233.675 220.493 -238.422C221.339 -238.816 222.557 -238.938 221.526 -241.268C216.686 -243.586 217.566 -253.688 216.403 -259.248C215.186 -259.126 215.765 -257.281 215.444 -256.333C213.832 -260.581 210 -268.116 212.57 -270.307C214.327 -267.791 211.688 -265.525 214.239 -264.695C213.743 -266.257 214.958 -266.45 215.057 -267.533C207.004 -278.059 201.15 -294.571 198.243 -302.36C197.051 -305.116 194.521 -305.443 193.894 -306.712C192.323 -309.954 193.387 -313.809 189.44 -318.895C190.124 -317.989 188.733 -320.376 187.188 -322.973C186.641 -324.029 179.689 -334.025 180.319 -337.933C181.418 -339.201 185.518 -330.382 184.731 -333.8C182.499 -337.376 181.169 -338.256 180.152 -342.025C179.053 -340.757 177.717 -341.781 176.788 -343.397C175.718 -344.934 174.838 -347.127 174.859 -348.35C177.768 -345.809 180.468 -341.319 182.926 -340.988C178.725 -346.999 168.555 -356.576 173.709 -358.872C173.218 -358.564 171.93 -360.165 172.406 -360.832C176.346 -357.686 176.324 -359.986 179.884 -357.328C173.427 -362.24 170.297 -368.438 166.891 -374.338C163.417 -380.163 160.158 -385.997 152.708 -388.854C153.459 -389.82 154.586 -388.644 155.343 -389.466C153.066 -392.392 151.761 -390.901 149.144 -395.107C150.2 -395.654 149.355 -396.985 150.264 -397.598C148.16 -399.812 145.895 -402.451 144.065 -403.239C147.604 -399.358 148.068 -396.789 146.997 -394.875C142.697 -401.529 138.191 -402.71 135.87 -410.236C138.478 -406.245 139.526 -408.733 142.065 -404.667C142.423 -406.479 144.753 -407.509 141.744 -410.765C140.972 -410.302 140.307 -408.98 139.183 -410.085C141.654 -411.193 132.571 -424.049 127.78 -428.67C125.292 -427.992 128.636 -425.326 126.806 -424.388C126.313 -425.877 124.361 -427.882 122.266 -429.881C125.029 -429.132 124.363 -429.608 125.719 -431.605C123.433 -434.746 123.141 -431.355 121.103 -433.716C122.838 -435.225 117.577 -439.036 118.215 -441.003C113.091 -443.238 113.212 -445.543 114.771 -446.11C110.376 -448.087 109.516 -449.777 105.886 -450.635C105.289 -452.911 106.511 -451.164 107.537 -452.428C103.454 -455.568 104.037 -455.376 101.958 -458.742C100.2 -459.533 98.693 -459.471 96.7974 -460.112C95.9825 -462.451 93.3485 -463.566 97.0679 -462.28C87.7644 -471.749 79.9633 -469.128 76.016 -474.215C72.6915 -471.13 69.5456 -475.962 67.0092 -479.956C64.9277 -479.871 68.0263 -476.188 65.5782 -478.028C63.7978 -481.119 61.7147 -482.831 57.5981 -485.035C57.8686 -487.203 60.239 -485.502 61.2892 -486.193C58.5293 -486.87 56.1029 -489.934 55.104 -489.749C56.3054 -488.505 56.9296 -487.308 56.9737 -486.231C54.678 -487.863 53.5473 -487.385 50.7885 -489.788L51.8063 -491.268C41.694 -494.16 31.7811 -504.467 26.6732 -504.545C23.229 -506.129 25.4127 -507.225 23.6971 -508.736C23.2212 -508.07 23.4689 -507.289 23.7884 -506.511C20.8132 -507.18 10.8195 -517.699 15.6811 -511.355C10.9608 -514.253 10.6248 -517.187 6.94363 -517.54C9.30523 -516.055 8.56571 -514.802 6.07527 -515.922C7.94439 -515.927 7.74791 -517.213 4.88387 -518.678C3.3883 -518.329 1.05038 -519.239 -1.13234 -519.869C2.3935 -519.798 -5.37663 -523.433 -7.11396 -523.722C-6.37269 -523.177 -5.05425 -522.584 -5.32076 -522.07C-7.51525 -522.986 -13.6298 -524.82 -14.657 -527.079C-13.6669 -527.479 -10.6182 -525.016 -9.93866 -525.978C-13.0022 -528.8 -14.9706 -527.713 -18.7736 -529.283C-18.8037 -533.523 -30.5851 -531.53 -29.8433 -536.234C-25.9814 -533.229 -21.8037 -533.041 -18.2572 -532.467C-14.7795 -531.819 -11.8016 -531.079 -10.3654 -527.614C-8.69167 -530.631 -6.09214 -526.855 -0.925436 -525.341C-1.23785 -527.701 1.35656 -525.794 2.26613 -526.407C-2.38823 -529.451 -1.01086 -527.423 -2.45519 -527.579C-3.14829 -528.701 -6.21295 -529.798 -4.82154 -530.933C-3.57488 -530.337 -1.87689 -529.257 -1.39505 -529.78C-6.00237 -531.676 -7.87611 -533.54 -8.02148 -535.332C-11.1461 -536.138 -13.4301 -537.482 -16.5212 -539.225C-19.75 -540.818 -23.7113 -542.741 -29.987 -545C-32.4274 -544.9 -29.1692 -542.589 -33.0981 -543.722C-46.4635 -552.305 -61.3084 -553.134 -72.4244 -557.711C-75.329 -556.657 -71.3981 -553.726 -76.9267 -555.297C-79.4407 -556.992 -78.3307 -557.972 -77.014 -559.176C-88.1264 -560.158 -93.8197 -565.748 -105.365 -568.51C-111.247 -564.674 -126.182 -572.977 -134.127 -570.35C-128.58 -570.075 -121.618 -568.635 -119.353 -565.995C-124.121 -564.793 -137.721 -566.824 -135.359 -570.588C-142.011 -569.74 -146.771 -575.368 -149.441 -572.095C-150.123 -576.453 -163.555 -577.915 -171.37 -577.379C-170.222 -577.426 -173.059 -578.244 -176.017 -578.482C-183.807 -579.098 -192.545 -580.033 -201.125 -580.616C-207.814 -580.701 -214.487 -580.356 -220.564 -579.532C-220.591 -580.178 -220.548 -580.898 -220.297 -581.771C-227.597 -580.969 -234.826 -580.169 -241.983 -579.372C-241.845 -579.522 -241.779 -579.668 -241.938 -580.021C-245.485 -578.869 -246.789 -579.103 -250.142 -578.462C-252.573 -578.147 -254.936 -577.906 -257.368 -577.591C-260.432 -578.687 -265.926 -579.397 -269.024 -579.557C-266.733 -579.795 -267.731 -581.336 -264.489 -581.181C-259.286 -580.532 -252.912 -581.153 -249.274 -583.603C-246.816 -583.272 -246.721 -582.701 -247.978 -581.786C-234.258 -583.859 -223.915 -582.342 -211.388 -585.444C-214.461 -583.233 -199.744 -583.764 -203.068 -585.929C-195.03 -584.533 -184.764 -583.157 -174.606 -582.639C-169.489 -582.345 -164.45 -582.192 -159.71 -582.315C-157.338 -582.34 -155.041 -582.434 -152.891 -582.594C-150.735 -582.611 -148.725 -582.693 -146.79 -582.845C-152.708 -583.393 -163.185 -586.414 -168.357 -584.548C-165.362 -586.9 -173.575 -585.557 -174.398 -584.588L-174.256 -586.392C-199.968 -589.22 -227.117 -588.538 -253.327 -587.75ZM-578.179 -402.451C-579.27 -404.491 -576.164 -405.912 -574.546 -406.769C-573.637 -405.656 -577.402 -402.77 -578.179 -402.451ZM181.331 70.6875C178.164 70.6017 182.552 65.3889 181.745 64.9907C184.008 62.3096 182.876 68.0358 181.331 70.6875ZM200.36 35.0371C197.14 33.6593 201.227 31.6224 202.061 27.4181C203.244 28.2324 200.696 32.7226 200.36 35.0371ZM190.814 26.6572C189.214 26.2195 190.886 21.4057 192.134 20.2761C193.377 20.8002 191.024 24.7792 190.814 26.6572ZM218.596 -49.7583C218.195 -50.7485 218.203 -52.3305 218.413 -54.2085C219.283 -54.0285 220.15 -53.9202 220.388 -55.1522C221.646 -54.2691 220.236 -48.3158 218.596 -49.7583ZM223.9 -85.2054C222.207 -84.417 222.658 -87.4551 221.509 -87.408C219.715 -78.563 221.381 -69.5004 216.543 -66.498C218.387 -74.1228 216.538 -77.1386 215.364 -82.9859C215.951 -84.448 217.001 -85.1381 217.197 -87.375C218.631 -85.7082 218.098 -84.6799 217.782 -81.8629C220.118 -82.7496 221.361 -85.7483 221.517 -90.7156C223.782 -91.5993 224.175 -89.0272 223.9 -85.2054ZM-132.653 -546.685C-132.566 -548.055 -128.676 -546.129 -127.022 -546.125C-127.582 -545.743 -128.213 -545.357 -129.068 -545.178C-130.091 -545.568 -131.042 -545.96 -132.061 -546.278C-132.067 -546.421 -132.217 -546.559 -132.653 -546.685ZM-53.6579 -540.146C-49.4665 -537.874 -49.9955 -538.499 -45.0265 -536.546C-43.5891 -534.808 -45.4504 -532.862 -49.3517 -535.075C-44.7598 -537.06 -54.2373 -536.744 -53.6579 -540.146ZM183.937 -254.969C185.456 -254.744 186.679 -249.473 187.641 -247.068C184.301 -247.866 185.478 -250.718 183.937 -254.969ZM211.68 -199.092C212.508 -192.943 211.764 -190.037 211.831 -183.137C208.472 -186.163 209.64 -192.754 207.293 -199.128C208.804 -199.118 209.93 -197.942 211.68 -199.092ZM213.495 -165.375C215.611 -164.599 213.719 -161.646 213.462 -160.916C212.119 -160.358 212.474 -163.967 211.257 -163.845C210.739 -167.707 214.081 -161.589 213.495 -165.375ZM212.161 -178.621C213.688 -178.181 214.452 -175.336 215.98 -174.896C214.471 -173.108 217.732 -165.477 215.468 -164.593C216.336 -169.734 211.965 -172.862 212.161 -178.621ZM203.811 -170.083C204.817 -166.601 206.095 -163.49 207.123 -157.708C204.139 -155.07 202.785 -160.047 200.947 -166.298C199.252 -172.556 197.929 -180.267 196.944 -183.246C197.612 -188.018 199.855 -189.405 201.906 -183.234C201.398 -183.357 201.075 -184.206 200.507 -184.039C201.863 -177.264 202.805 -173.564 203.811 -170.083ZM214.221 -159.941C216.629 -152.059 217.463 -133.472 214.122 -137.792C216.115 -143.554 212.731 -150.677 214.221 -159.941ZM198.859 -189.148C197.378 -188.44 196.842 -191.007 196.188 -192.921C197.755 -193.273 199.563 -191.262 198.859 -189.148ZM180.08 -196.502C181.46 -189.153 182.484 -181.718 183.509 -176.008C184.617 -173.537 185.968 -177.403 185.303 -179.605C187.198 -178.964 185.985 -175.247 186.561 -173.473C185.496 -173.142 185.081 -174.491 183.95 -174.013C182.685 -173.314 184.733 -168.941 184.75 -166.785C180.463 -173.151 178.747 -179.911 177.49 -187.768C176.898 -191.698 176.294 -195.916 175.609 -200.345C174.708 -204.766 173.366 -209.456 171.718 -214.565C172.574 -214.744 173.429 -214.923 173.164 -216.134C174.636 -213.534 175.983 -210.498 177.198 -207.169C177.84 -205.541 178.416 -203.768 178.92 -201.991C179.284 -200.136 179.716 -198.357 180.08 -196.502ZM117.741 50.5759C117.651 50.1481 117.702 49.6428 117.9 49.2033C118.047 49.2692 118.187 49.1915 118.337 49.3292C118.105 50.7047 117.988 51.3566 117.788 51.7243C117.77 51.2936 117.827 50.9318 117.741 50.5759ZM95.6285 109.216C95.9274 109.491 96.2293 109.838 96.5281 110.114C96.3963 110.407 96.2646 110.7 96.1328 110.993C95.9116 110.858 95.6904 110.723 95.4692 110.589C95.248 110.454 95.0268 110.319 94.8055 110.184C95.0809 109.885 95.3561 109.587 95.6285 109.216ZM-582.512 -47.0299C-581.691 -46.2727 -581.21 -45.0702 -580.99 -43.2099C-580.978 -42.9228 -580.966 -42.6357 -580.954 -42.3486C-581.209 -41.5472 -580.941 -40.2641 -580.744 -38.978C-582.214 -41.506 -582.613 -44.2218 -582.512 -47.0299ZM-362.581 -557.243C-359.958 -558.141 -358.783 -557.543 -357.677 -556.869C-360.872 -555.875 -364.236 -555.521 -367.425 -554.384C-368.074 -554.429 -368.651 -554.478 -369.088 -554.604C-362.423 -556.89 -362.888 -554.211 -362.581 -557.243ZM-356.973 -558.983C-354.906 -559.427 -353.413 -559.848 -352.061 -560.191C-352.127 -560.044 -352.196 -559.97 -352.187 -559.754C-352.744 -559.3 -353.303 -558.918 -353.866 -558.607C-355.708 -557.956 -357.342 -557.458 -356.973 -558.983ZM-204.861 -561.267C-206.446 -561.345 -207.367 -561.02 -207.921 -560.494C-210.585 -560.6 -213.112 -560.856 -215.002 -561.354C-214.302 -561.814 -213.527 -562.205 -212.752 -562.597C-213.834 -562.696 -215.396 -562.201 -216.826 -561.998C-216.972 -562.064 -217.19 -562.127 -217.337 -562.193C-217.621 -562.109 -217.977 -562.023 -218.333 -561.936C-218.838 -561.987 -219.278 -562.185 -219.582 -562.604C-217.435 -562.836 -217.569 -564.34 -213.879 -563.773C-209.332 -559.861 -211.885 -562.488 -204.861 -561.267ZM-581.291 -168.011C-581.118 -167.299 -581.318 -166.931 -581.597 -166.704C-581.758 -167.129 -581.85 -167.628 -582.014 -168.125C-581.655 -168.14 -581.294 -168.082 -581.291 -168.011ZM-477.298 -465.327C-477.365 -463.455 -477.803 -461.856 -480.094 -461.618C-480.166 -461.615 -480.165 -461.615 -480.237 -461.612C-479.354 -462.871 -478.399 -464.132 -477.298 -465.327ZM-239.912 -558.679C-241.701 -558.462 -243.561 -558.242 -245.421 -558.021C-245.568 -558.087 -245.714 -558.153 -245.858 -558.147C-247.239 -558.522 -248.438 -559.695 -249.633 -560.796C-247.767 -560.873 -245.829 -560.952 -243.966 -561.101C-239.809 -561.415 -235.801 -561.867 -232.023 -562.669C-231.913 -561.739 -232.082 -560.582 -229.719 -560.822C-229.542 -561.764 -230.172 -563.104 -228.667 -563.238C-225.276 -562.946 -222.519 -562.34 -220.322 -561.352C-225.799 -559.905 -232.674 -559.263 -239.912 -558.679ZM-256.081 -560.245C-255.794 -560.256 -255.435 -560.271 -255.151 -560.355C-255.504 -560.196 -255.791 -560.185 -256.081 -560.245ZM-450.09 -492.614C-451.469 -491.191 -453.491 -491.396 -454.925 -493.063C-455.003 -493.203 -455.081 -493.344 -455.089 -493.559C-452.731 -495.669 -450.009 -497.65 -446.924 -499.574C-446.316 -497.01 -447.19 -495.537 -450.09 -492.614ZM-458.333 -490.263C-458.822 -488.158 -460.13 -486.738 -462.182 -485.935C-461.021 -487.42 -459.785 -488.837 -458.333 -490.263ZM-206.913 -560.463C-205.558 -560.735 -204.048 -560.725 -202.528 -560.499C-203.964 -560.441 -205.471 -560.379 -206.913 -560.463ZM-313.052 -569.699C-313.925 -569.951 -314.876 -570.344 -315.758 -570.811C-313.823 -570.962 -312.16 -570.742 -311.482 -569.979C-311.981 -569.887 -312.552 -569.792 -313.052 -569.699ZM-324.262 -567.802C-324.621 -567.787 -325.123 -567.766 -325.413 -567.826C-324.928 -568.278 -324.154 -568.669 -323.164 -569.069C-323.436 -568.698 -323.777 -568.253 -324.262 -567.802ZM-336.457 -563.635C-333.094 -562.263 -329.234 -564.578 -329.709 -565.637C-328.196 -565.555 -327.676 -565.145 -327.584 -564.646C-328.209 -564.117 -328.834 -563.588 -329.463 -563.131C-329.887 -562.97 -330.315 -562.88 -330.743 -562.791C-331.437 -562.187 -332.057 -561.514 -332.604 -560.845C-333.236 -560.46 -333.795 -560.077 -334.148 -559.919C-335.348 -559.366 -337.057 -560.734 -336.904 -562.25C-336.847 -562.612 -336.793 -563.046 -336.664 -563.411C-336.598 -563.557 -336.526 -563.56 -336.457 -563.635ZM-368.909 -553.748C-368.978 -553.673 -369.121 -553.667 -369.262 -553.59C-369.755 -553.354 -370.114 -553.339 -370.548 -553.393C-369.979 -553.56 -369.408 -553.656 -368.909 -553.748ZM-581.291 -54.054C-581.333 -53.3333 -581.453 -52.7532 -581.717 -52.1672C-581.597 -52.7473 -581.479 -53.3992 -581.291 -54.054ZM186.192 -231.551C188.741 -232.518 186.899 -228.345 188.667 -225.541C186.832 -226.473 186.594 -228.764 186.192 -231.551ZM63.7884 -462.066C65.751 -463.297 67.2914 -459.046 71.2704 -456.693C70.5103 -455.943 71.5652 -454.764 70.6586 -454.079C68.1004 -456.85 65.327 -459.612 63.7884 -462.066ZM56.3096 -467.367C56.9319 -467.968 57.4795 -468.637 56.5082 -469.532C57.6006 -470.943 62.4517 -466.612 63.0936 -464.985C61.6187 -464.134 59.2806 -465.044 56.3096 -467.367ZM-138.259 -548.396C-138.125 -548.617 -138.062 -548.836 -137.927 -549.057C-136.247 -548.407 -136.092 -548.126 -136.292 -547.758C-137.019 -547.944 -137.605 -548.207 -138.259 -548.396ZM-184.451 -559.731C-185.381 -559.621 -186.239 -559.514 -187.023 -559.338C-187.397 -559.682 -187.698 -560.029 -187.857 -560.382C-186.777 -560.355 -185.617 -560.114 -184.451 -559.731ZM-191.863 -561.656C-193.29 -561.382 -195.147 -561.09 -197.151 -560.864C-198.817 -561.155 -200.342 -561.524 -202.533 -562.369C-197.425 -562.29 -195.754 -561.856 -192.03 -562.224C-191.953 -562.083 -191.872 -561.871 -191.863 -561.656ZM-292.083 -572.069C-294.906 -572.528 -297.714 -572.629 -301.139 -571.985C-299.913 -575.415 -291.816 -574.309 -288.874 -572.704C-289.945 -572.516 -291.013 -572.257 -292.083 -572.069ZM-309.2 -570.432C-307.952 -571.562 -305.466 -572.311 -302.544 -572.934C-301.092 -570.837 -307.307 -569.863 -309.2 -570.432ZM-365.765 -559.485L-365.022 -557.143C-366.924 -556.202 -370.21 -557.433 -370.63 -555.403C-374.56 -554.811 -369.759 -556.949 -370.07 -557.511C-371.589 -557.736 -372.418 -556.911 -373.525 -555.86C-373.901 -556.276 -374.275 -556.62 -374.649 -556.964C-372.342 -558.568 -369.443 -559.766 -365.765 -559.485ZM-385.097 -554.019C-385.136 -553.226 -387.2 -552.71 -388.833 -552.212C-388.836 -552.284 -388.839 -552.356 -388.842 -552.427C-388.937 -552.999 -389.388 -553.483 -389.906 -553.822C-386.738 -555.461 -386.954 -553.727 -385.097 -554.019ZM-396.034 -543.721C-396.186 -543.93 -396.138 -544.507 -395.935 -544.803C-394.656 -546.94 -392.99 -548.375 -390.426 -548.983C-389.215 -549.249 -388.825 -550.271 -388.801 -551.423C-387.876 -551.676 -386.877 -551.861 -385.586 -551.914C-385.418 -551.345 -384.419 -551.53 -384.043 -551.114C-389.221 -549.392 -387.309 -546.595 -384.941 -550.215C-384.229 -550.388 -383.517 -550.561 -382.805 -550.734C-382.797 -548.793 -382.718 -546.855 -382.854 -544.908C-382.902 -544.331 -384.302 -543.411 -384.954 -543.528C-386.694 -543.888 -388.482 -545.396 -389.908 -545.122C-391.547 -544.767 -392.682 -542.636 -394.853 -542.978C-395.284 -542.96 -395.729 -543.302 -396.034 -543.721ZM-433.162 -521.635C-433.491 -520.903 -433.749 -520.173 -433.361 -519.47C-434.42 -518.996 -435.26 -518.458 -436.032 -517.995C-436.744 -517.822 -437.531 -517.718 -438.248 -517.688C-436.717 -518.901 -434.834 -520.345 -433.162 -521.635ZM-537.049 -439.151C-536.565 -439.602 -536.011 -440.128 -535.526 -440.58C-535.38 -440.514 -535.162 -440.451 -535.012 -440.313C-535.411 -437.78 -538.663 -436.425 -541.76 -434.788C-540.165 -436.219 -538.57 -437.651 -537.049 -439.151ZM-548.621 -396.976C-548.486 -397.197 -548.205 -397.353 -547.924 -397.508C-548.118 -396.997 -548.313 -396.486 -548.436 -395.977C-548.732 -396.181 -548.89 -396.534 -548.621 -396.976ZM-579.254 -30.6991C-578.752 -30.7197 -578.25 -30.7403 -577.822 -30.8297C-577.869 -31.9782 -578.544 -32.6694 -579.423 -33.0648C-579.503 -35.0027 -579.51 -36.9436 -579.521 -38.9563C-577.913 -38.3033 -576.849 -36.9089 -575.86 -35.5835C-574.258 -33.3484 -575.052 -31.6623 -577.532 -30.7697C-577.212 -29.992 -576.962 -29.1394 -576.57 -28.3646C-574.476 -24.64 -574.492 -23.2733 -576.994 -21.1576C-577.063 -21.0828 -577.203 -21.0052 -577.272 -20.9305C-578.481 -24.1163 -578.973 -27.3315 -579.254 -30.6991ZM-573.653 -2.81704C-574.435 -6.09224 -574.851 -9.23867 -574.969 -12.1097C-574.294 -11.4184 -573.825 -10.503 -573.835 -8.99274C-573.796 -8.05965 -573.743 -6.76771 -573.152 -6.36062C-568.928 -3.29845 -572.09 2.00782 -569.358 5.49067C-567.461 7.92925 -568.335 9.40304 -569.649 10.6792C-571.416 6.15025 -572.684 1.52892 -573.653 -2.81704ZM13.7173 212.152C13.6632 212.586 12.3142 213.001 11.5936 212.958C11.2317 212.901 10.8641 212.701 10.4964 212.5C10.1286 212.3 9.82964 212.024 9.46192 211.824C10.165 211.435 10.7875 210.835 11.4994 210.662C12.6389 210.399 14.0085 210.487 13.7173 212.152ZM49.2821 197.537C49.934 197.654 50.4 198.497 50.9949 198.976C50.6477 199.278 50.384 199.864 50.0252 199.879C48.7391 200.075 47.4473 200.128 46.1583 200.253C46.1612 200.325 46.1642 200.397 46.1671 200.468C46.0953 200.471 45.9517 200.477 45.8799 200.48C45.6193 201.138 45.3587 201.796 45.0234 202.385C44.9575 202.531 44.0872 202.351 44.0843 202.279C43.8043 200.709 44.8062 200.596 45.8799 200.48C45.877 200.408 45.9459 200.334 45.9429 200.262C46.0147 200.259 46.0865 200.256 46.1583 200.253C46.0729 198.172 47.1053 197.051 49.2821 197.537ZM56.8214 188.528C56.4201 189.263 56.019 189.999 55.6207 190.806C55.1576 190.034 54.4075 189.274 54.4469 188.482C54.4146 187.692 55.1746 186.942 55.6447 186.132C55.9642 186.91 56.4301 187.753 56.8214 188.528ZM62.7558 182.461C63.8354 182.489 64.9148 182.516 64.6954 184.179C64.6984 184.251 63.8459 184.501 63.7682 184.361C63.3858 183.801 63.0724 183.167 62.7558 182.461C62.684 182.464 62.5404 182.47 62.4686 182.473C62.4657 182.401 62.4627 182.329 62.4598 182.257C60.7401 182.4 59.0262 182.686 57.6036 181.306C56.7788 180.477 56.664 177.678 57.4565 177.717C58.1771 177.76 59.0473 177.94 59.5675 178.35C60.9036 179.374 62.5209 180.242 62.4627 182.329C62.5345 182.326 62.6063 182.323 62.6781 182.32C62.6781 182.32 62.7529 182.389 62.7558 182.461ZM64.9464 171.011C69.6225 172.833 73.3131 176.923 78.7858 177.13C79.0729 177.119 79.5742 178.824 79.3884 179.55C79.2025 180.277 78.1699 181.398 77.6645 181.346C72.2254 180.203 67.1039 178.041 62.5154 174.85C62.1448 174.577 62.4419 173.055 62.6218 172.185C62.6218 172.185 62.6218 172.185 62.6189 172.113C62.8254 171.889 63.0319 171.665 63.2354 171.369C63.376 171.292 63.4449 171.217 63.5108 171.07C64.0879 171.119 64.5787 170.811 64.9464 171.011ZM98.8561 126.555C99.9533 127.013 100.413 127.713 100.099 128.804C99.1538 128.555 98.3406 128.014 98.0664 126.587C97.6075 124.161 99.0708 123.023 101.236 123.222C101.523 123.21 101.663 123.132 101.879 123.123C101.122 123.945 100.155 124.92 98.8561 126.555ZM102.57 108.428C102.642 108.425 102.789 108.491 102.86 108.488L102.654 108.712C102.651 108.64 102.648 108.569 102.57 108.428C102.352 108.365 102.134 108.302 101.915 108.239C102.05 108.018 102.113 107.8 102.251 107.65C102.406 107.931 102.49 108.216 102.57 108.428ZM174.246 8.35581C170.52 17.4238 166.784 26.2765 165.279 36.9071C163.841 40.4171 161.755 43.8819 159.608 47.6366C159.336 48.0073 159.066 48.4497 158.868 48.8892C159.159 47.2236 159.451 45.5581 159.745 43.9643C160.444 39.9812 161.15 36.1418 162.142 32.2905C162.988 28.3734 164.115 24.301 165.876 19.9149C162.349 12.798 174.776 2.00709 173.56 -4.84518C169.294 -1.93812 172.406 -13.713 172.922 -20.4206C174.904 -19.4234 177.384 -20.316 180.883 -20.8909C180.242 -10.2238 177.245 -0.89813 174.246 8.35581ZM191.276 -126.862C189.824 -128.959 192.57 -130.366 191.765 -134.215C191.194 -134.12 191.46 -132.909 191.351 -132.041C190.481 -132.222 190.866 -135.113 189.864 -135C188.622 -133.727 190.275 -128.474 190.175 -125.666C186.986 -129.778 186.769 -140.337 184.69 -143.703C185.839 -145.476 187.879 -144.841 188.336 -144.212C190.298 -145.443 188.17 -146.506 189.095 -148.485C187.976 -151.243 188.229 -145.071 186.321 -145.999C185.423 -153.871 185.993 -155.763 183.698 -159.12C184.062 -162.515 184.775 -159.165 183.158 -165.281C187.205 -166.526 185.433 -158.904 187.04 -156.525C189.468 -160.435 182.416 -169.349 186.552 -170.166C187.044 -166.951 187.9 -163.607 188.762 -160.119C189.408 -156.622 190.133 -152.985 190.788 -149.274C192.025 -141.919 192.845 -134.188 191.276 -126.862ZM216.013 -130.249C217.921 -129.321 216.844 -132.799 216.836 -134.74C217.988 -131.193 218.516 -125.319 219 -118.796C219.055 -112.184 218.994 -104.92 219.689 -98.4774C214.849 -106.044 218.644 -118.709 216.013 -130.249ZM221.475 -95.2434C222.224 -101.529 221.732 -103.019 222.032 -109.718C219.202 -103.346 219.957 -123.509 221.325 -125.218C223.262 -120.049 223.156 -113.862 223.036 -108.033C222.987 -102.208 222.921 -96.8125 224.512 -93.0672C222.613 -92.0547 222.644 -94.7881 221.475 -95.2434ZM227.003 -91.9471C224.883 -92.7949 226.339 -95.8742 226.989 -97.5545C228.436 -97.3263 227.335 -92.6078 227.003 -91.9471ZM227.271 -167.809L225.345 -167.443C225.509 -166.946 225.601 -166.447 225.765 -165.95C226.296 -163.528 226.686 -161.027 227.154 -158.386C228.015 -153.173 228.816 -147.67 229.404 -142.086C230.512 -130.844 231.575 -118.952 229.95 -107.742C230.143 -106.527 231.202 -107.002 231.19 -105.564C231.011 -102.896 230.448 -100.86 229.959 -98.7548C228.081 -98.9654 228.94 -104.321 228.727 -107.763C227.863 -107.8 226.998 -107.836 226.908 -106.538C226.173 -117.437 225.436 -137.178 220.398 -153.076C220.678 -156.755 221.037 -160.292 222.387 -162.433C221.536 -165.633 220.559 -161.423 219.387 -161.95C218.698 -164.726 220.96 -167.407 218.966 -168.691C218.903 -171.996 219.628 -170.084 221.133 -170.218C219.183 -175.674 217.658 -179.566 217.364 -183.22C215.179 -183.922 217.152 -179.617 217.241 -177.464C214.455 -180.513 213.704 -188.319 214.355 -191.725C216.456 -193.105 219.347 -187.472 218.295 -193.828C221.424 -189.426 219.824 -175.844 222.918 -174.03C222.774 -182.795 217.58 -197.249 220.239 -202.535C225.45 -191.173 224.022 -180.402 227.271 -167.809ZM210.596 -218.532C209.525 -218.344 209.73 -216.843 208.582 -216.796C206.689 -220.888 209.362 -220.566 207.468 -224.659C208.724 -223.847 209.517 -220.285 210.596 -218.532ZM198.332 -247.579C200.958 -234.385 204.872 -223.114 208.156 -209.66C209.215 -210.135 207.428 -213.369 208.039 -214.257C209.893 -214.621 211.1 -207.984 209.246 -207.62C211.083 -204.892 211.663 -204.772 213.821 -206.514C212.735 -201.436 211.197 -200.367 209.762 -202.033C208.253 -203.769 206.988 -208.318 205.365 -214.579C204.767 -213.404 205.516 -210.918 205.813 -208.917C204.129 -207.914 203.894 -213.656 202.452 -213.74C202.175 -215.239 203.691 -215.085 204.466 -215.477C200.743 -225.605 200.211 -226.302 196.451 -237.364C198.16 -239.519 194.794 -242.688 196.399 -245.63C194.995 -248.305 196.119 -241.952 194.135 -244.746C192.241 -252.362 193.972 -252.217 189.856 -259.669C188.223 -259.171 193.282 -253.267 190.31 -253.864C189.239 -258.925 187.226 -262.437 184.641 -265.854C185.826 -266.766 186.84 -266.591 187.868 -266.058C186.892 -268.822 185.66 -269.059 184.332 -268.142C181.542 -273.061 182.691 -274.833 183.094 -277.294C189.423 -273.743 193.342 -253.557 198.332 -247.579ZM167.399 -346.175C164.247 -345.902 163.775 -350.412 160.801 -352.807C162.629 -353.816 165.233 -348.171 167.399 -346.175ZM159.351 -377.623C163.878 -375.94 158.561 -375.865 161.05 -373.02C160.195 -372.841 158.949 -375.162 157.885 -376.557C158.657 -377.02 159.36 -377.408 158.664 -378.602C159.376 -378.775 159.633 -377.779 159.351 -377.623ZM150.314 -373.586L147.715 -377.362L149.178 -378.5C150.194 -376.529 151.795 -374.294 150.314 -373.586ZM146.54 -377.961C145.28 -377.118 143.213 -380.197 141.247 -382.561L142.638 -383.696C144.524 -381.545 146.263 -379.459 146.54 -377.961ZM143.665 -376.189C148.075 -370.331 152.204 -364.317 154.986 -361.339C152.46 -361.595 148.372 -366.604 143.884 -372.603C139.327 -378.528 133.879 -385.135 129.962 -389.503C133.866 -387.219 138.905 -381.818 143.665 -376.189ZM132.798 -418.522C131.519 -416.385 131.606 -416.029 128.927 -416.494C128.692 -418.713 129.552 -422.272 132.798 -418.522ZM127.632 -421.761C127.674 -420.757 128.955 -419.299 127.83 -418.678C127.427 -419.74 127.025 -420.802 126.319 -420.485C125.557 -421.533 126.622 -421.864 125.567 -423.043C126.362 -422.932 127.157 -422.821 127.708 -423.418C128.542 -422.374 128.905 -420.519 127.632 -421.761ZM118.629 -437.929C117.78 -437.606 116.184 -439.698 114.842 -440.865C114.51 -440.204 115.998 -438.971 116.978 -437.861C116.971 -436.279 113.052 -438.922 115.252 -436.136C113.807 -436.293 113.257 -440.944 113.12 -442.52C116.256 -439.701 116.392 -441.647 118.629 -437.929ZM82.1057 -457.209L83.2699 -458.623L87.7384 -454.852C86.8701 -453.234 84.0102 -456.352 82.1057 -457.209ZM89.2338 -463.972C86.405 -464.575 88.6349 -462.797 91.1636 -460.744C88.4714 -459.771 85.8554 -465.703 83.3149 -468.043C84.3533 -469.02 87.3923 -465.047 89.2338 -463.972ZM73.3705 -466.844C78.5708 -466.267 83.364 -465.097 88.4221 -457.468C85.0162 -458.119 80.0564 -465.106 75.8528 -462.417C68.9521 -469.395 62.2379 -473.578 59.4203 -477.416C64.1605 -477.539 71.3907 -471.293 73.3705 -466.844ZM48.6901 -486.61C53.3768 -482.776 54.5448 -480.596 59.2061 -479.133L57.4371 -476.688C52.8644 -481.246 45.0343 -484.591 39.6398 -489.906C43.085 -490.047 45.5013 -485.473 48.6901 -486.61ZM-28.1329 -531.343C-28.1223 -529.331 -30.6874 -530.52 -30.6738 -528.435C-31.8958 -530.183 -38.0616 -531.511 -36.1284 -533.46C-38.5158 -532.068 -43.1455 -536.264 -46.8856 -538.052C-39.9138 -534.599 -33.0803 -534.52 -28.1329 -531.343ZM-7.92434 -532.963C-8.46324 -532.078 -7.84793 -531.097 -6.58944 -530.214C-7.33484 -529.105 -9.76239 -530.443 -12.3393 -531.919C-9.97365 -532.088 -12.6163 -533.418 -10.2507 -533.587C-12.101 -534.877 -16.9719 -536.187 -15.0123 -537.489C-14.0144 -535.949 -10.7166 -534.43 -7.92434 -532.963ZM-20.9625 -538.827C-24.6142 -538.462 -25.4057 -540.227 -28.6493 -542.179C-24.9945 -542.472 -24.206 -540.779 -20.9625 -538.827ZM-64.3426 -541.218C-65.5481 -540.809 -67.4979 -541.017 -70.1977 -541.985C-69.9095 -543.722 -65.5588 -542.822 -64.3426 -541.218ZM-80.6664 -539.542C-83.7498 -539.344 -84.8223 -540.953 -89.5978 -541.692C-88.9536 -543.516 -82.0143 -540.853 -80.6664 -539.542ZM-105.321 -544.642C-103.812 -546.43 -100.946 -543.168 -97.3662 -543.531C-97.0478 -541.027 -102.719 -544.318 -105.321 -544.642ZM-86.1444 -545.141C-90.4244 -544.319 -92.4696 -545.098 -99.0454 -545.906C-97.1939 -546.342 -91.1235 -545.584 -97.3304 -547.918C-95.116 -550.022 -90.2798 -546.05 -86.1444 -545.141ZM-136.313 -551.783C-125.091 -549.871 -120.9 -551.121 -115.508 -551.127C-112.904 -550.73 -114.636 -549.149 -112.6 -548.586C-113.809 -551.772 -105.32 -549.891 -99.6597 -548.613C-100.585 -546.634 -100.541 -545.557 -101.686 -545.439C-102.664 -546.477 -106.647 -547.176 -108.429 -546.816C-105.611 -544.702 -112.192 -545.655 -112.564 -544.202C-114.759 -545.118 -114.71 -545.695 -113.224 -546.259C-121.726 -546.702 -131.655 -550.393 -140.079 -550.694C-139.819 -551.352 -137.889 -551.647 -139.794 -552.503C-138.471 -550.041 -143.622 -552.922 -143.413 -551.348C-142.161 -550.609 -142.499 -550.092 -143.492 -549.763C-146.111 -550.519 -148.731 -551.274 -151.416 -551.883C-152.297 -554.076 -146.563 -551.004 -146.627 -552.583C-151.618 -553.313 -159.331 -557.31 -161.109 -555.08C-156.175 -553.988 -154.097 -554.146 -151.706 -551.943C-151.852 -552.009 -151.996 -552.003 -152.142 -552.069C-156.49 -552.897 -160.973 -553.504 -165.593 -553.962C-165.631 -554.895 -166.094 -555.667 -166.772 -556.43C-166.701 -556.433 -166.701 -556.433 -166.626 -556.364C-164.256 -558.187 -161.083 -557.957 -157.824 -557.372C-154.562 -556.715 -151.279 -555.555 -148.351 -556.035C-145.705 -554.633 -145.96 -553.832 -145.35 -552.994C-143.19 -554.665 -132.703 -553.154 -130.445 -552.455C-130.219 -550.451 -135.574 -553.036 -136.313 -551.783ZM-79.8943 -554.025C-83.7779 -555.807 -85.7346 -554.433 -87.7608 -556.506C-88.384 -559.429 -77.8235 -556.123 -79.8943 -554.025ZM-90.2071 -556.55C-92.0328 -558.992 -96.7837 -560.882 -96.8985 -563.681C-92.5753 -561.701 -88.3957 -559.716 -90.2071 -556.55ZM-285.946 -573.183C-285.946 -573.183 -285.874 -573.186 -285.802 -573.189C-285.802 -573.189 -285.874 -573.186 -285.946 -573.183ZM-291.082 -575.705C-292.897 -576.134 -286.153 -576.482 -281.801 -577.308C-282.909 -574.53 -288.247 -574.958 -291.082 -575.705Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M248.735 -72.2047C250.239 -72.3383 250.681 -70.3433 250.966 -68.6295C249.683 -68.3612 250.317 -63.4263 249.192 -62.805C249.604 -61.5277 251.369 -62.3191 250.706 -59.2003C248.384 -38.6863 247.07 -23.3903 243.559 -9.08258C241.984 -1.9002 240.403 5.13861 238.768 12.611C237.914 16.3128 237.065 20.1582 236.15 24.15C234.945 28.0819 233.746 32.1573 232.416 36.5257C236.465 37.0786 230.7 40.2628 231.87 42.5155C235.624 41.1393 235.8 38.4 238.531 33.1114C236.959 31.5942 236.412 35.7866 235.123 35.9114C235.635 34.3805 235.591 33.3039 235.552 32.3708C237.656 34.5852 238.995 26.9092 239.809 30.974C241.762 22.482 242.593 12.9575 244.397 2.60221C245.262 -2.60983 246.193 -7.96838 247.252 -13.6917C247.783 -16.5175 248.383 -19.4179 248.977 -22.462C249.428 -25.5001 249.878 -28.5383 250.395 -31.7229C249.315 -31.7505 248.912 -32.8125 248.854 -34.248C250.683 -36.9832 249.806 -37.3067 250.384 -42.507C252.028 -40.9927 252.579 -41.5905 253.678 -44.5833C253.02 -44.8439 251.956 -44.5127 251.968 -45.9511C252.58 -52.0874 252.606 -60.2129 252.027 -67.307C251.478 -73.6833 250.031 -79.16 248.765 -81.9839C249.287 -79.7765 248.408 -74.9234 248.735 -72.2047Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M155.339 82.0347C156.75 77.8787 159.651 73.2302 159.053 77.928C160.684 75.6323 162.502 72.61 161.351 70.8597C164.03 67.8021 168.537 67.2578 169.425 62.62C170.445 62.9376 171.115 63.4854 171.299 64.4844C172.238 61.0667 171.09 59.3882 171.263 56.5771C172.266 54.7386 173.781 56.6177 174.578 53.2777C173.44 51.8146 174.58 46.3037 176.309 41.1281C176.608 41.4034 176.978 41.6758 177.268 41.7358C178.061 41.7752 178.827 41.1686 179.679 40.9179C179.156 40.4361 178.622 39.6672 178.119 39.6878C177.688 39.7054 177.189 39.7978 176.767 40.0308C178.903 34.2634 181.649 29.3337 182.951 31.2934C183.549 28.3211 184.576 25.3312 185.679 22.4101L185.682 22.4819C185.768 22.8378 186.285 23.1761 186.587 23.5232C187.188 24.1456 188.037 23.8232 188.275 22.5912C188.812 19.909 187.898 16.9268 190.325 14.7422C188.502 12.3725 189.207 10.2586 190.396 7.69347C191.055 6.22851 190.292 5.1813 188.762 4.66891C188.681 4.45652 188.675 4.31295 188.595 4.10057C188.529 4.24707 188.463 4.39354 188.397 4.54003C187.889 4.41709 187.386 4.43771 186.737 4.39242C187.022 2.5833 187.443 0.552954 186.282 0.312946C186.048 1.61669 185.82 3.064 185.589 4.43952C184.306 4.70784 182.535 5.35562 183.067 6.05278C183.826 7.02821 184.301 8.08721 184.632 9.15208C184.458 10.1658 184.281 11.1077 184.035 12.1244C182.905 16.125 181.637 20.2751 180.292 24.2847C177.672 32.3007 175.113 40.0267 173.204 46.0725C172.673 45.3753 172.207 44.5316 172.091 43.4579C172.9 40.4051 175.942 39.2019 174 37.4123C173.05 40.5428 171.745 42.0342 170.607 44.094C172.035 45.6171 171.507 48.5147 170.545 51.3581C169.44 54.2074 168.047 57.0685 168.339 58.9259C168.134 57.4245 166.747 56.9062 165.493 57.8922C164.297 62.0394 161.428 67.4774 158.505 69.8261C157.764 69.2814 158.207 67.8252 157.606 67.2028C155.126 73.3438 156.309 75.8836 155.339 82.0347Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M202.256 53.2209C202.667 47.4523 203.038 42.4762 206.762 36.8593C205.961 36.6046 205.329 36.99 204.701 37.4471C205.273 35.6262 205.086 34.5554 204.485 33.933C203.251 40.67 201.727 43.8241 200.631 50.4117C202.783 43.2775 202.26 51.5671 202.256 53.2209Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M195.362 63.9268C194.646 65.7535 193.912 67.1497 193.08 67.9028C194.302 69.6501 198.896 64.2132 196.652 65.5993C195.047 68.541 196.358 63.6702 195.362 63.9268Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M200 87.6078C203.488 90.2687 205.712 77.8831 208.924 77.32L207.758 76.9364C208.019 76.2787 208.208 75.6238 207.633 75.6474C206.226 78.1496 205.007 81.7225 202.6 86.1351C201.655 85.8863 200.692 85.2068 200 87.6078Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M228.878 122.082C228.975 120.928 227.823 117.38 226.625 119.73C227.607 122.637 225.509 124.089 226.253 126.431C227.253 124.521 228.082 123.696 229.009 123.514C228.166 127.503 227.224 127.326 225.089 131.368C225.983 132.122 226.932 130.717 227.888 131.253C225.084 134.748 225.656 138.175 224.766 141.016C226.353 137.643 227.812 138.159 229.471 134.783C228.87 130.638 231.345 127.876 233.829 120.081C232.6 119.916 233.385 118.015 233.128 117.019C231.741 120.023 230.258 120.659 228.878 122.082Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M114.178 96.9517C114.652 94.4878 117.629 93.4311 116.52 92.6857C114.229 96.4464 113.57 94.3884 112 94.6685C112.581 96.5858 112.022 96.9683 114.178 96.9517Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M245.161 28.2377C243.536 30.677 242 33.5439 240.613 36.5486C237.843 42.6296 235.757 49.6173 235.812 56.2295C240.854 56.4541 241.413 61.3202 240.389 67.9048C237.603 66.5812 236.109 73.976 233.623 74.725C236.302 75.1903 233.596 79.3274 235.097 79.1221C234.033 79.4533 232.994 80.4306 231.976 81.9103C234.952 82.5791 230.853 89.5774 229.528 94.0894C231.714 94.7906 231.658 93.4269 232.96 95.3866C236.941 90.7657 242.08 79.339 244.158 75.6589C244.543 63.9958 257.596 50.9505 260.363 36.0262C262.11 26.0328 257.539 19.7495 249.439 22.0948C248.137 23.6581 246.712 25.7296 245.161 28.2377Z"
                            fill="currentColor" />
                    </g>
                </svg>
            </span>
            <span class="footer__overlay-img two">
                <img src="{{ asset('client/images/overlay/leaf-02.png') }}" alt="overlay" />
            </span>
            <span class="footer__overlay-img three">
                <svg width="73" height="71" viewBox="0 0 73 71" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M54.6095 64.9148C57.4946 66.8734 60.5472 67.1558 63.7675 65.9206C64.6763 65.5765 65.5056 65.1177 65.7791 64.0855C66.2997 62.118 67.5172 60.874 69.37 59.9917C71.2316 59.1006 72.6609 57.4684 72.5903 55.3774C72.5285 53.4893 72.6256 51.4072 71.5757 50.1808C71.6904 48.7251 72.105 47.5516 71.7609 46.6958C71.1786 45.2401 70.2611 43.8461 69.2024 42.6815C68.0642 41.4198 66.9879 40.1758 66.3438 38.5965C65.9027 37.4937 65.0998 36.8232 63.9881 36.4967C63.2999 36.2938 62.6118 36.0997 61.9589 35.9056C61.6236 32.8706 61.4471 32.6765 58.7386 31.2031C58.1563 30.8855 57.4857 30.2591 57.371 29.6679C57.0623 28.1151 56.2329 27.0476 55.2183 26.4741C55.7565 23.6861 56.33 21.1452 56.727 18.5689C57.0005 16.7955 57.4681 15.1633 58.5974 13.7517C60.0267 11.9695 60.4943 9.89616 60.6355 7.64636C60.7855 5.1407 59.7708 3.36733 57.6446 2.28213C56.1712 1.52337 54.539 1.0646 52.995 0.438177C50.4893 -0.567614 48.1601 0.244085 46.6161 1.99981C44.3134 4.62899 41.993 7.20523 39.3374 9.48149C38.958 9.80794 38.7109 10.2932 38.3492 10.6461C37.0964 11.8636 35.8524 13.0988 34.529 14.2369C33.4791 15.1369 32.3586 15.3839 30.9028 14.8104C27.7619 13.5664 24.9034 14.1399 22.583 16.8485C20.7478 16.6191 18.9656 16.6367 17.5628 18.1895C14.5366 21.5422 14.5102 21.3393 16.3717 25.0713C14.5366 25.283 13.3897 26.4829 12.2956 27.7887C10.5223 29.9061 8.45775 31.5295 5.53742 31.8207C4.6375 31.9089 3.70228 32.3677 2.9347 32.8794C0.376104 34.5646 0.226135 36.5673 2.29066 38.4995C2.29066 39.4788 2.26417 40.3523 2.29946 41.2169C2.3524 42.6109 2.87295 43.8725 4.09931 44.5343C5.74034 45.4253 6.15502 46.8105 6.36676 48.4868C7.03729 53.7893 9.85175 57.5302 14.8366 59.4888C16.6188 60.1858 17.9863 61.2445 19.0803 62.762C21.2243 65.753 24.1534 67.3146 27.8325 67.3411C30.8763 67.3675 33.6379 68.0645 36.3729 69.5556C40.4049 71.7524 44.5428 70.2261 46.7573 66.1941C47.1367 65.5059 47.5955 64.8442 48.0895 64.2266C49.3777 62.6297 49.9688 62.4268 51.8215 63.2208C52.8097 63.6531 53.7184 64.306 54.6095 64.9148ZM52.2891 61.271C49.2188 60.1417 46.7132 61.3239 45.3545 64.2972C44.9663 65.1442 44.5075 66.0176 43.8811 66.697C42.24 68.4792 40.2196 69.0085 37.9169 68.091C37.3787 67.8792 36.8229 67.6587 36.3465 67.3322C34.132 65.85 31.6792 65.3295 29.0677 65.4177C25.4415 65.55 22.5036 64.2707 20.4214 61.2445C19.2656 59.5682 17.7393 58.4566 15.8159 57.7331C11.2898 56.0391 8.87241 52.5718 8.12248 47.9222C7.78722 45.8577 7.152 44.1549 5.19335 43.1138C3.99345 42.4786 3.94052 41.2257 3.92287 40.0435C3.91405 39.1436 4.60221 38.8083 5.29039 38.5348C6.13737 38.2083 7.01965 37.9437 7.88427 37.6613C3.4729 37.8996 3.47289 37.8996 2.02596 37.1496C2.51121 35.1116 3.75522 33.744 5.83739 33.4882C9.28708 33.0735 11.6957 31.1149 13.8308 28.6092C15.6659 26.4476 17.3864 26.1388 20.0244 27.0652C21.7272 27.6652 23.5358 27.9916 25.318 28.3533C26.7385 28.6445 28.0531 28.2298 29.3147 27.5681C30.0647 27.1711 30.8411 26.8446 31.7322 26.6682C29.6235 30.0208 27.3384 33.1353 23.474 34.591C21.9036 35.1821 20.3155 35.7115 18.7539 36.3203C18.1098 36.5673 17.5187 36.9291 16.5923 37.3878C17.1834 37.5731 17.3952 37.7231 17.5364 37.6613C20.5802 36.4614 23.6241 35.2439 26.6591 34.0264C29.2177 33.0029 30.7705 30.7972 32.535 28.8915C33.779 27.5593 34.926 26.7652 36.8935 27.4093C37.811 27.7093 39.0374 27.3299 40.0432 26.9946C41.0578 26.6594 41.7989 26.58 42.5135 27.524C43.9605 29.4297 45.8221 30.7884 48.1248 31.3795C48.4865 32.5618 48.8747 33.6646 49.1482 34.7851C49.2806 35.3233 49.3512 35.9674 49.1924 36.4791C48.3101 39.2494 49.1041 41.6669 50.7011 43.8902C51.848 45.4871 53.0214 47.1017 54.389 48.4957C56.2417 50.3749 57.5387 52.4659 58.1475 55.0333C58.5974 56.939 59.7179 58.2977 61.6766 58.8447C61.9324 58.9153 62.2236 58.8536 62.7441 58.8536C62.2941 58.3771 62.0471 58.0242 61.7207 57.7772C60.6796 56.992 60.0443 55.9509 59.7797 54.6981C59.1621 51.8218 57.7328 49.4662 55.6594 47.384C54.3272 46.0518 53.2685 44.446 52.095 42.955C51.0716 41.6492 50.5775 40.1494 50.4981 38.4995C50.3834 36.285 50.2335 34.0793 50.1011 31.7589C52.8185 31.0531 53.3479 34.2028 55.1654 35.1733C55.3242 34.9439 55.483 34.8204 55.4742 34.7234C55.1477 32.4912 52.5097 29.5797 50.2952 29.4474C47.419 29.2709 45.1868 27.8681 43.0517 26.2271C42.09 25.4859 41.049 25.2566 39.9814 25.4859C38.0669 25.9006 36.2318 25.6977 34.3613 25.2654C32.7468 24.8948 31.141 25.133 29.7206 26.033C28.2472 26.9593 26.7297 26.9858 25.0975 26.6153C22.9624 26.1212 20.8272 25.6712 19.0274 24.2949C17.457 23.095 16.9629 22.2568 17.3687 21.304C17.9863 19.8217 19.8744 18.4719 21.2419 18.5425C21.533 18.5601 21.833 18.5689 22.1065 18.666C23.2976 19.063 24.2152 19.0718 24.6475 17.5543C24.771 17.1043 25.4415 16.7426 25.9356 16.4868C27.4002 15.7545 28.9354 15.8692 30.3911 16.5044C33.3908 17.8102 36.3994 17.3602 39.3991 16.6103C40.0873 16.4426 40.7843 16.0897 41.3401 15.6486C43.3164 14.087 44.6398 12.0489 45.3721 9.59619C43.8458 10.1873 42.84 11.3696 41.8783 12.5871C40.9078 13.8135 39.805 14.8545 38.1727 15.0839C37.8992 15.1192 37.6081 15.0928 37.0964 15.0928C38.8786 13.2047 40.3167 11.2284 42.1871 9.81676C44.4016 8.14926 45.9721 6.02298 47.6749 3.94081C48.2836 3.19088 49.2012 2.6615 50.0482 2.14096C50.3746 1.93804 50.9393 1.90275 51.3187 2.01745C53.0479 2.57328 54.7595 3.17323 56.4623 3.81729C57.4328 4.18785 57.6269 4.96425 57.5034 5.9524C57.2563 7.86693 56.674 9.61382 55.5447 11.2107C54.6625 12.4548 53.9478 13.8135 53.2243 15.1633C52.9685 15.6398 52.9156 16.2309 53.1361 16.9367C53.842 15.7721 54.4596 14.5457 55.2624 13.4517C56.1271 12.2871 57.1593 11.2549 58.4827 10.3285C58.1386 11.0166 57.918 11.8019 57.4416 12.3842C55.8094 14.4046 55.2712 16.7426 54.9448 19.2571C54.6889 21.2599 54.1066 23.2361 53.4979 25.1771C52.9068 27.0476 52.8362 26.9858 54.2655 28.3004C54.7154 28.7151 55.1477 29.2974 55.2977 29.8797C55.7035 31.5031 56.577 32.553 58.1563 33.1882C60.1943 34.0175 60.3884 35.1821 58.9415 36.8849C58.4298 37.4849 57.9004 38.0584 57.1858 38.8612C58.4386 39.1524 59.1974 38.6054 59.9738 38.2083C61.4825 37.4496 63.3793 37.776 64.1204 39.2847C65.1615 41.4286 66.5555 43.2285 68.2054 44.9048C68.7083 45.4077 69.0259 46.1047 69.3788 46.7399C70.2434 48.2839 70.1199 48.6015 68.4789 49.325C68.223 49.4397 67.9848 49.572 67.3584 49.8985C68.2848 50.2867 68.8936 50.5337 69.7053 50.8778C69.8994 52.2277 70.2346 53.7099 70.2787 55.2098C70.3228 56.5685 69.3788 57.5655 68.223 58.0772C65.9467 59.0741 64.6498 60.7593 64.191 63.1502C63.9969 64.1737 63.1676 64.3149 62.4 64.4737C59.9297 65.003 57.6445 64.6148 55.5447 63.1061C54.4948 62.3915 53.4273 61.6857 52.2891 61.271Z"
                        fill="currentColor" />
                    <path
                        d="M60.5033 61.0595C58.6417 61.4212 57.2919 60.6977 55.9773 59.6743C55.1303 59.0126 54.1157 58.5009 53.1099 58.1303C50.8071 57.2922 48.3721 57.0892 46.0517 57.8304C43.0608 58.792 42.1079 61.2977 42.152 64.2092C42.1697 65.6738 41.8873 66.7943 40.1934 67.2619C42.5314 67.5001 43.0255 67.0678 43.1402 65.0121C43.1843 64.218 43.2813 63.424 43.3519 62.6299C43.4931 61.1477 44.3577 60.2301 45.7164 59.8155C46.5281 59.5684 47.3927 59.4096 48.2485 59.3655C50.9659 59.2067 53.3481 60.2213 55.6155 61.6065C56.4008 62.0917 57.3007 62.4888 58.2006 62.6652C59.224 62.877 60.1945 62.6211 60.5033 61.0595Z"
                        fill="currentColor" />
                </svg>
            </span>
            <span class="footer__overlay-img four">
                <svg width="82" height="151" viewBox="0 0 82 151" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M39.5852 1.86394C38.7029 0.655226 37.5824 0.717009 36.7531 2.00513C35.7297 3.58441 35.7032 5.3313 35.9855 7.12231C36.1884 8.39279 36.3561 9.66325 36.1884 11.0837C35.8885 10.7926 35.5444 10.5279 35.2973 10.1926C33.8592 8.26044 32.4741 6.29298 31.0007 4.37845C30.6213 3.88438 30.0478 3.41678 29.4743 3.22267C29.0067 3.06387 28.248 3.16089 27.8774 3.46968C26.8981 4.28137 26.2187 5.3754 26.3776 6.72528C26.6158 8.72804 26.801 10.7573 27.2775 12.7071C28.495 17.6655 29.042 22.6062 27.8951 27.6529C27.5598 29.1174 27.4363 30.6349 27.1098 32.0995C26.5981 34.4287 26.5099 36.7491 26.8805 39.1136C26.9687 39.6959 26.8099 40.4017 26.5364 40.9311C25.31 43.3132 23.8719 45.5983 22.7691 48.0246C21.1545 51.5713 18.9223 54.7122 16.7872 57.9237C14.458 61.4263 12.6141 65.1671 10.9995 69.0403C9.34966 73.0017 8.29093 77.1132 7.79686 81.3569C7.12633 87.1799 5.15884 92.5177 2.23851 97.582C1.3033 99.1965 0.782781 101.067 0.165189 102.849C-0.0377344 103.44 -0.0201018 104.146 0.0416574 104.781C0.279872 107.058 1.5327 107.763 3.54429 106.74C4.47068 106.272 5.3706 105.716 6.22641 105.117C8.27329 103.705 10.276 102.24 12.3053 100.802C14.5198 99.2229 16.3196 97.2467 17.8636 95.041C18.6312 93.9382 19.6193 93.2323 20.7486 92.5089C23.7219 90.6208 26.5452 88.4945 29.4214 86.4564C29.792 86.1917 30.1184 85.8741 30.7183 85.3712C31.0095 86.4741 31.2565 87.3828 31.4947 88.3004C32.4035 91.7324 32.8446 95.2086 32.8887 98.7642C32.9858 106.528 34.0269 114.186 36.5502 121.527C38.0148 125.779 40.0705 129.838 42.0379 133.905C43.9878 137.92 45.8141 141.96 46.8375 146.328C47.0581 147.263 47.4639 148.216 47.9845 149.019C49.1138 150.748 50.6225 150.624 51.6106 148.833C52.3341 147.527 52.4664 146.134 52.4841 144.66C52.5017 142.772 52.687 140.884 52.8193 139.005C52.8811 138.158 53.1105 137.311 53.1017 136.473C53.0399 132.37 53.8163 128.417 54.8574 124.474C55.4838 122.092 55.7396 119.621 56.2249 116.824C57.8394 119.709 59.3129 122.33 60.7686 124.959C62.842 128.709 65.5946 131.947 68.4356 135.114C69.1237 135.881 69.9619 136.552 70.8353 137.125C72.8381 138.449 75.185 138.008 76.4996 135.996C80.6463 129.688 82.3843 122.727 81.3874 115.254C80.6286 109.537 78.9876 104.005 76.7378 98.676C73.5175 91.0531 71.2236 83.1479 69.9001 74.978C69.3443 71.5636 69.2296 68.0786 68.5944 64.6819C67.6151 59.4853 66.424 54.3152 65.1535 49.1803C64.6418 47.0982 63.7595 45.0954 62.8949 43.1279C60.451 37.552 57.9718 31.9936 55.4044 26.4794C54.6368 24.8296 53.5957 23.3032 52.5811 21.7769C51.8576 20.6917 51.5224 19.6153 51.7165 18.2831C51.99 16.4127 52.2723 14.507 51.3283 12.7071C51.2136 12.4777 51.0724 12.266 50.9665 12.0895C49.5637 11.6484 48.9197 12.7953 47.9756 13.4129C45.5141 10.8808 43.4319 8.15458 41.6938 5.14602C41.0586 4.01672 40.3528 2.91385 39.5852 1.86394ZM28.3009 37.7549C28.4244 36.3962 28.4685 35.0375 28.6803 33.6964C29.1038 30.979 29.6331 28.2881 30.1008 25.5795C30.5507 22.915 30.6478 20.2417 30.0919 17.5861C29.492 14.7099 28.8215 11.8425 28.2303 8.96629C27.9568 7.6517 27.8774 6.31946 28.6097 5.04016C29.9508 6.9194 31.1683 8.64863 32.4035 10.3602C33.471 11.8425 34.5739 13.3071 35.6061 14.8069C35.8179 15.1069 35.8002 15.5657 35.9414 16.1921C33.9386 14.754 32.9505 12.6277 30.8154 11.7631C31.0271 12.7512 31.3448 13.6599 31.8477 14.4364C32.527 15.4774 33.3475 16.4215 34.1151 17.392C35.0415 18.5566 35.5444 19.8712 35.5532 21.3711C35.5708 24.6178 35.3326 27.891 36.4002 30.9261C33.7357 33.3082 31.2124 35.5668 28.6979 37.8166C28.5744 37.7902 28.4421 37.7726 28.3009 37.7549ZM52.8105 123.653C51.7429 127.597 51.1254 131.576 51.2224 135.67C51.2401 136.578 51.1871 137.514 51.0106 138.405C50.5872 140.478 50.5166 142.551 50.7371 144.651C50.8695 145.886 50.7813 147.113 49.8108 148.648C49.3255 147.307 48.8932 146.354 48.6462 145.357C47.7021 141.599 46.317 138.017 44.5965 134.54C42.8496 131.029 41.1733 127.473 39.6028 123.874C38.7382 121.906 37.9618 119.859 37.4678 117.777C35.9238 111.213 34.7239 104.596 34.7856 97.8113C34.7945 96.5055 34.7239 95.1821 34.4857 93.9117C34.0004 91.2825 33.4446 88.6621 32.8005 86.0594C32.4388 84.6125 32.5711 83.492 33.5946 82.2833C35.068 80.5452 36.2767 78.5777 37.5913 76.7073C39.3205 74.2458 41.041 71.7842 42.7879 69.3315C43.0702 68.9256 43.4407 68.5904 43.926 68.0522C44.5789 71.1931 45.1876 74.1134 45.7876 77.0337C45.8405 77.2896 45.8582 77.5543 45.867 77.8101C45.9199 78.9042 45.9464 80.007 45.9993 81.101C46.0346 81.8156 46.1934 82.5392 46.1229 83.2362C45.6641 87.8504 45.3376 92.4912 44.6318 97.0614C43.6878 103.123 43.4231 109.149 44.4995 115.21C44.923 117.592 45.417 119.983 45.5229 122.383C45.7876 128.885 46.7669 135.255 48.6374 141.484C48.7256 141.784 48.902 142.057 49.0344 142.34C49.299 141.413 49.2726 140.575 49.2638 139.746C49.2549 138.961 49.1843 138.175 49.2814 137.399C49.7049 134.161 50.2166 130.932 50.6313 127.694C51.1606 123.547 51.7429 119.401 51.1342 115.192C50.9489 113.904 50.9577 112.572 51.0724 111.275C51.24 109.387 51.5929 107.516 51.8664 105.646C52.0517 105.646 52.2282 105.646 52.4135 105.637C52.7135 107.349 53.2075 109.051 53.2605 110.772C53.3046 112.034 52.7664 113.313 52.5017 114.583C52.3958 115.095 51.937 115.66 52.5988 116.136C52.9958 115.863 53.331 115.633 53.8075 115.307C53.8075 118.262 53.5251 120.998 52.8105 123.653ZM48.4344 84.7713C48.5756 85.1948 48.7785 85.6095 48.8403 86.0418C49.1932 88.3622 49.5373 90.6913 49.8461 93.0117C50.1019 94.9615 49.3343 95.5792 47.1286 95.1557C47.4727 91.7413 47.8256 88.318 48.1785 84.886C48.2668 84.8595 48.355 84.8154 48.4344 84.7713ZM50.543 96.6379C50.2607 100.017 50.0401 103.317 49.6872 106.599C49.5814 107.622 48.0109 108.54 46.9698 108.372C46.2817 108.257 45.7347 107.975 45.77 107.119C45.9023 103.67 46.0082 100.229 46.8287 96.8761C47.9844 96.7967 49.0696 96.735 50.543 96.6379ZM48.9109 110.004C49.1402 113.004 49.3696 115.863 49.5726 118.721C49.6873 120.38 49.2726 120.671 47.4286 120.274C46.9169 116.983 46.114 113.701 46.017 110.322C47.0581 110.207 47.958 110.11 48.9109 110.004ZM49.5196 122.497C49.2373 125.524 48.9638 128.391 48.6991 131.267C47.7462 128.32 47.4904 124.782 47.8697 122.55C48.3462 122.541 48.8403 122.524 49.5196 122.497ZM53.7369 27.2735C56.5513 33.5465 59.3305 39.8282 62.1185 46.11C62.2773 46.4718 62.4008 46.8423 62.5155 47.2217C65.03 55.3651 66.7857 63.6849 67.6063 72.1548C68.3297 79.5747 70.2178 86.6858 72.6352 93.6734C74.5586 99.2317 77.0554 104.57 78.3876 110.348C79.464 115.007 79.8875 119.586 79.0935 124.332C78.4759 128.02 76.9672 131.32 75.4232 134.637C75.0438 135.449 74.5762 136.261 73.6322 136.508C70.456 134.814 69.5031 133.649 65.7446 128.638C60.848 122.109 57.2572 114.839 54.8133 107.022C53.2075 101.879 52.3429 96.5849 51.7782 91.256C51.3106 86.8446 49.9872 82.7068 48.6021 78.5424C47.5521 75.3927 46.8993 72.1107 45.9729 68.908C45.32 66.6582 45.7082 64.7172 47.1375 62.8732C47.7286 62.1145 48.0286 61.1351 48.4785 60.2617C48.655 59.9088 48.8756 59.5735 49.0697 59.2294C49.6872 62.9085 50.0402 66.4818 50.2343 70.0638C50.4637 74.2193 51.2753 78.216 52.7929 82.098C54.1692 85.6271 55.4661 89.2003 56.816 92.747C56.9572 93.1264 57.1954 93.4793 57.5924 94.2293C58.0071 92.2353 58.0247 90.7002 57.5042 89.2003C56.966 87.6564 56.4102 86.1124 55.7573 84.6213C53.5692 79.5924 52.1223 74.4222 52.0429 68.8815C51.99 64.6907 51.3459 60.544 50.3137 56.4768C49.8637 54.7034 50.4019 53.1859 51.4253 51.3066C51.7076 52.1095 51.8929 52.4624 51.9459 52.8418C52.3605 55.8856 52.8546 58.9206 53.1193 61.9821C53.7457 69.2433 54.7427 76.425 57.3719 83.2626C59.454 88.6798 60.5922 94.2734 61.1392 100.043C61.7303 106.237 62.7802 112.351 65.427 118.068C65.6123 118.474 65.7005 118.942 65.7799 119.392C66.6269 123.9 68.7091 127.915 70.8001 131.911C71.2324 132.741 72.0176 133.455 72.794 134.011C73.6939 134.664 74.5586 134.293 74.9732 133.235C75.1409 132.811 75.185 132.344 75.282 131.902C76.3937 126.547 76.129 121.218 74.8409 115.951C73.8792 112.016 72.644 108.152 71.55 104.252C70.6677 101.102 69.5825 97.9966 69.0091 94.7939C68.2944 90.7619 67.5886 86.73 67.5004 82.5656C67.3327 75.2163 65.2682 68.1139 63.6536 60.9763C62.1891 54.4828 59.2158 48.5627 56.3043 42.6162C54.9897 39.9253 53.7545 37.1196 53.0664 34.2346C52.3252 31.1643 52.2635 27.9263 51.9106 24.7678C52.0429 24.7149 52.1753 24.6708 52.2988 24.6178C52.7752 25.4913 53.3222 26.3559 53.7369 27.2735ZM64.6947 75.331C64.9065 76.6102 65.1271 77.5631 65.2065 78.5336C65.4711 81.7186 65.7005 84.9037 65.8946 88.0887C65.9211 88.5033 65.7887 89.0503 65.5152 89.3326C64.5536 90.3208 63.4772 91.1678 62.0038 90.9384C60.548 86.5006 59.1276 82.1509 57.6277 77.5719C60.4598 78.0748 62.489 76.9455 64.6947 75.331ZM57.0101 75.1369C56.2514 71.3872 55.6073 67.5669 55.2632 63.4555C57.91 64.1702 59.6658 62.7232 61.7479 61.3204C62.542 64.9113 63.2743 68.211 63.9889 71.5107C64.2448 72.6841 63.5125 73.5223 62.8067 74.2634C61.3156 75.8338 59.207 76.125 57.0101 75.1369ZM55.1397 61.2234C55.0868 60.7205 55.0603 60.2 54.9809 59.6882C54.4515 56.3444 54.2927 52.9036 52.9252 49.7715C52.3958 48.5539 52.6164 47.804 53.4634 47.0541C54.0369 46.5423 54.6721 46.11 55.3161 45.6071C55.6514 45.8894 55.7926 45.9512 55.8367 46.0571C57.4424 49.895 59.0482 53.7417 60.6363 57.5973C60.7598 57.8884 60.8304 58.2413 60.7863 58.5501C60.4951 60.7293 57.2572 62.2645 55.1397 61.2234ZM66.2299 91.3972C67.1651 95.3057 68.0915 99.2141 69.0355 103.167C68.118 104.305 67.1033 105.39 65.3917 105.346C64.1389 105.319 63.7242 105.081 63.5654 103.828C63.1066 100.088 62.7184 96.3467 62.3214 92.7382C63.7066 92.253 65.0123 91.8119 66.2299 91.3972ZM69.9443 105.593C70.7119 108.143 71.4971 110.825 72.3352 113.489C72.7499 114.813 72.2823 115.792 71.2236 116.498C70.5795 116.93 69.8561 117.283 69.1238 117.504C67.8974 117.865 66.8298 117.38 66.4769 116.145C65.6388 113.216 64.9506 110.243 64.2713 107.552C66.2299 106.881 67.968 106.281 69.9443 105.593ZM73.3234 117.786C73.5351 119.824 73.7645 121.827 73.9498 123.83C74.0027 124.412 74.0204 125.012 73.9674 125.594C73.8969 126.362 72.8293 127.447 72.0353 127.579C71.3559 127.685 70.6589 127.597 70.3501 126.891C69.3267 124.527 68.0297 122.241 67.7915 119.868C69.6619 119.154 71.3383 118.527 73.3234 117.786ZM74.0292 128.038C73.491 129.529 73.8351 130.808 72.944 132.035C72.3441 130.914 71.8411 129.97 71.303 128.964C72.2205 128.647 72.8911 128.426 74.0292 128.038ZM53.0223 44.9983C53.1105 44.1778 53.1369 43.6661 53.2163 43.172C53.2869 42.7044 53.4104 42.2545 53.5604 41.531C54.0192 42.5103 54.3456 43.1897 54.7427 44.0367C54.2133 44.3367 53.7192 44.6102 53.0223 44.9983ZM50.049 14.7981C49.9166 16.245 49.7755 17.7008 49.6431 19.1477C49.6431 19.1565 49.6431 19.1742 49.6431 19.183C49.6519 19.2977 49.6608 19.4036 49.6784 19.5183C50.0225 23.8767 50.146 28.2704 50.7724 32.5847C51.5312 37.7637 51.787 42.8633 50.3489 47.9452C49.5637 50.7067 48.6726 53.4329 47.8697 56.1944C46.6434 60.4117 44.3495 64.0379 41.7291 67.514C39.647 70.2755 37.5736 73.0812 35.7561 76.0192C32.2976 81.6039 27.7098 85.9712 21.9574 89.6415C23.0955 87.7975 24.9218 86.8182 25.3982 84.7801C24.0219 84.5596 23.1573 85.3713 22.4691 86.1653C20.6781 88.2387 18.9488 90.3737 17.3254 92.5794C15.6138 94.9086 13.8846 97.1761 11.6083 99.0112C9.42025 100.767 7.31162 102.611 5.15887 104.411C4.22365 105.187 3.30606 106.025 2.01794 106.043C1.31212 105.072 1.47976 104.128 1.80621 103.299C2.45909 101.596 3.11198 99.867 4.02072 98.2966C6.86165 93.3735 9.01438 88.2298 9.73784 82.5391C10.4878 76.6455 12.1465 71.0166 14.8639 65.723C15.6668 64.1613 16.5843 62.6615 17.546 61.1969C20.1575 57.209 23.1308 53.4329 25.0012 48.9863C27.4628 43.1191 31.2212 38.2931 36.2061 34.3493C40.3351 31.0849 43.326 26.9205 45.3729 22.0592C46.1317 20.2594 47.111 18.5478 48.0638 16.8273C48.4873 16.0598 49.0785 15.3804 49.5902 14.6569C49.7402 14.701 49.899 14.754 50.049 14.7981ZM44.473 19.1124C44.0848 18.0537 43.7407 17.1273 43.3349 16.0245C45.17 17.4273 45.2494 17.6391 44.473 19.1124ZM45.4964 13.7659C45.9199 14.3305 46.6257 14.8069 46.2817 15.998C45.6641 15.398 45.2318 14.9481 44.773 14.5422C44.0407 13.8893 43.379 13.1129 42.532 12.6718C41.7379 12.2571 41.3674 11.7366 41.1909 10.9161C41.0321 10.1485 40.8027 9.39856 40.5645 8.64863C40.3087 7.83694 40.0352 7.01645 38.6765 6.46943C38.8 7.5811 38.8088 8.40164 38.9853 9.18686C39.6646 12.1954 40.8204 15.0275 41.9409 17.8949C42.8584 20.2418 43.3261 22.8268 41.8262 25.2178C41.1292 26.3206 40.3351 27.3705 39.5234 28.3851C39.1441 28.8615 38.6059 29.1968 37.856 29.8497C37.7148 28.7733 37.5295 28.0851 37.5471 27.397C37.6266 23.4797 37.6618 19.5624 37.8912 15.6627C38.0677 12.6101 38.65 9.57504 37.8471 6.51355C37.5913 5.51657 37.503 4.40492 38.1206 3.10797C39.0823 4.74901 39.8146 6.21361 40.7498 7.53702C42.2673 9.6633 43.9172 11.6837 45.4964 13.7659Z"
                        fill="currentColor" />
                    <path
                        d="M49.0433 18.6363C48.6904 18.9098 48.2934 19.2098 48.0993 19.598C47.2876 21.1596 46.2994 22.6859 45.8318 24.3622C44.976 27.3796 44.279 30.4588 43.8291 33.5556C43.2556 37.5082 41.9322 41.1343 40.0265 44.6193C38.6766 47.0808 37.4679 49.6218 36.3033 52.1804C34.9975 55.0654 33.4094 57.7564 31.1772 60.0238C25.3542 65.9351 21.1634 72.9138 17.8284 80.4396C16.5932 83.2276 14.9434 85.7244 12.9495 87.9919C9.50858 91.9092 6.67647 96.1882 4.70018 101.032C4.36492 101.852 3.93262 102.629 3.4209 103.67C3.90615 103.529 4.17081 103.52 4.33844 103.396C5.52069 102.479 6.65883 101.491 7.86754 100.617C9.31447 99.5762 10.435 98.2528 11.5996 96.9117C14.5905 93.4532 17.7667 90.1535 20.837 86.7656C23.1662 84.1981 25.5395 81.6748 27.7275 78.9927C31.8213 73.9814 35.8445 68.9083 39.7971 63.7735C42.0292 60.8796 44.2967 57.9593 46.0965 54.7919C48.7169 50.1776 50.0932 45.1222 49.7403 39.7403C49.4492 35.3113 49.0256 30.8911 48.7257 26.4709C48.6198 24.9799 48.5845 23.4712 48.7345 21.9978C48.8227 21.1508 49.3609 20.3479 49.6873 19.5274C49.6697 19.4127 49.6609 19.3068 49.6521 19.1921C49.6521 19.1833 49.6521 19.1657 49.6521 19.1569C49.4315 18.9716 49.0874 18.601 49.0433 18.6363ZM14.8993 90.03C12.7112 92.7827 10.5144 95.5265 8.31751 98.2704C9.96736 95.0766 11.7495 91.9974 14.5111 89.6065C14.7316 89.8535 14.9081 90.0123 14.8993 90.03ZM22.2927 82.5748C20.2988 84.5599 18.4372 86.4303 16.5403 88.2654C16.4344 88.3713 16.0639 88.2037 15.711 88.1507C17.105 85.8657 18.446 83.66 19.8047 81.4278C20.5105 81.7543 21.2693 82.1072 22.2927 82.5748ZM25.0719 79.4074C24.2514 80.5543 23.1397 80.6514 21.9487 80.4396C20.8017 80.2367 20.4047 79.4956 20.9429 78.4545C22.0457 76.3194 23.2544 74.2461 24.3749 72.2345C25.9983 73.1873 27.3041 73.9549 28.6187 74.7313C27.4364 76.2841 26.21 77.8105 25.0719 79.4074ZM36.3827 64.8146C34.6975 67.0467 32.9683 69.5524 30.992 71.8551C29.7391 73.3197 26.5188 72.2609 26.0159 70.3641C25.9454 70.0817 25.963 69.6759 26.1218 69.4553C27.8687 66.9585 29.5715 64.4263 31.636 62.5736C33.3212 63.3676 34.8034 64.0735 36.3827 64.8146ZM45.0819 52.4451C43.3615 55.7359 41.4116 58.7974 39.0824 61.5942C38.1031 62.7677 35.3592 62.7942 34.1946 61.7884C33.577 61.259 33.3829 60.712 33.9564 59.9444C34.9622 58.5857 35.915 57.1829 36.7885 55.7359C37.4855 54.5802 38.0237 53.3274 38.6501 52.0834C40.7764 52.7009 42.8409 53.4861 45.0819 52.4451ZM47.7199 39.9168C47.9316 42.5018 47.6934 45.0075 46.8906 47.469C45.7877 50.8217 42.1704 52.2774 39.1089 50.4599C40.2911 48.2896 41.5616 46.1545 42.6291 43.9223C43.6967 41.699 44.5525 39.3786 45.5671 36.9612C46.9876 37.4641 47.5964 38.4257 47.7199 39.9168ZM47.1817 35.6818C46.5553 35.523 46.1318 35.4172 45.7171 35.3113C45.77 33.0262 45.9818 31.9763 46.7405 30.4588C46.8994 32.3028 47.0317 33.9261 47.1817 35.6818Z"
                        fill="currentColor" />
                    <path
                        d="M33.6475 39.2822C35.659 39.1499 37.3001 38.7176 39.0117 38.1882C38.6676 36.8913 37.8383 36.8295 36.9913 36.9442C35.6502 37.1295 34.3356 37.4118 33.6475 39.2822Z"
                        fill="currentColor" />
                    <path
                        d="M32.7383 42.1753C34.0882 41.743 34.9704 41.4695 35.9586 41.1519C34.6969 40.0314 33.8941 40.2519 32.7383 42.1753Z"
                        fill="currentColor" />
                </svg>
            </span>
            <span class="footer__overlay-img five">
                <svg width="95" height="86" viewBox="0 0 95 86" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M47.295 82.7607C53.2504 80.2021 59.3027 77.767 64.2082 73.3203C64.4199 73.1262 64.6758 72.9586 64.8523 72.7292C67.1638 69.7736 70.4194 67.8943 73.128 65.4063C77.857 61.0832 81.5184 56.1248 82.2066 49.4636C82.3124 48.3872 82.6124 47.3109 82.9565 46.2874C83.9888 43.2612 83.9799 40.3233 82.5948 37.3676C82.0478 36.1942 81.7478 34.8884 81.4566 33.618C81.1655 32.3387 81.6419 31.2094 82.3477 30.1242C84.527 26.798 87.2179 23.9747 90.2441 21.4161C91.2323 20.578 92.0792 19.5633 92.9439 18.5928C94.9819 16.3166 94.9201 13.6433 94.1437 10.97C93.6409 9.23191 92.838 7.57322 92.1145 5.90573C91.6293 4.76759 91.0205 3.68241 90.5176 2.55309C89.6265 0.567974 88.7178 0.215069 87.0326 1.67082C85.0563 3.37361 83.1595 5.21756 81.4831 7.2115C79.1451 9.99067 77.2747 13.1757 74.0632 15.4608C71.5134 14.1727 69.2018 12.4169 66.1845 12.3816C63.2994 12.3463 60.785 13.4139 58.3234 14.7726C57.8646 14.5432 57.3441 14.402 56.9912 14.0756C55.1031 12.3199 52.8268 11.8434 50.3388 11.7729C46.5362 11.667 42.7689 11.6846 39.0898 12.9286C37.4664 13.4756 35.9401 14.1285 34.8108 15.4343C34.2814 16.0431 33.7256 16.2901 32.9315 16.3078C29.9406 16.3872 27.435 17.6488 25.2646 19.6075C24.0735 20.6838 22.9707 21.8484 21.8414 22.9777C18.4976 26.3304 15.0832 29.6124 11.8628 33.0798C10.4512 34.6061 9.4013 36.4765 8.29845 38.2676C7.5397 39.5027 7.26618 40.8614 8.34256 42.0437C7.36323 43.3318 6.20745 44.3553 5.66927 45.6346C4.35468 48.7843 3.25183 52.0399 3.56945 55.5778C3.61356 56.0895 3.40184 56.7247 3.09304 57.1571C1.18733 59.8745 0.446205 62.9801 0.0756499 66.1827C-0.294905 69.3854 0.666774 70.9382 3.60475 72.1645C3.86943 72.2704 4.1253 72.3851 4.35469 72.4822C4.75171 76.9729 5.30754 77.4935 10.31 78.0405C10.1512 80.3697 11.6511 81.7196 13.3892 82.8842C16.186 84.7634 19.1151 86.1221 22.6266 85.1163C23.0765 84.984 23.6235 85.1252 24.1088 85.2134C29.5701 86.2015 34.8373 85.9545 39.628 82.743C39.8045 82.6195 39.9986 82.5048 40.1927 82.4166C40.722 82.1784 41.2691 81.949 41.8778 81.6931C43.4394 83.7488 45.4599 83.5547 47.295 82.7607ZM55.3237 76.9553C53.1092 78.0581 50.9035 79.1698 48.6449 80.1668C47.4626 80.6873 46.1921 81.0226 44.9393 81.349C44.6305 81.4284 44.2247 81.1549 43.3953 80.9079C46.0863 78.9492 48.3802 77.2023 50.7447 75.5613C55.2972 72.4116 60.485 70.2235 64.6581 66.2974C64.7464 67.5679 64.8258 68.6266 64.9052 69.8618C62.2407 72.7204 58.9939 75.129 55.3237 76.9553ZM33.9197 77.0965C34.6785 75.5437 42.6807 67.5944 44.4276 66.5886C46.3951 67.8679 48.4861 67.7973 50.6829 67.1973C52.2887 66.765 53.9473 66.518 55.5884 66.2004C57.45 65.8386 59.3116 65.4946 61.1732 65.1416C61.6937 65.0446 62.2231 64.974 62.7524 64.8946C61.9055 66.0327 60.9526 66.9062 59.8762 67.612C58.1117 68.7766 56.2324 69.7648 54.4943 70.9558C51.5564 72.9674 48.4949 74.8731 45.8481 77.2288C44.3394 78.5699 42.7777 79.5492 40.9867 80.2374C38.9134 81.0226 36.7342 81.252 34.5373 80.7226C33.8756 80.5638 33.0462 80.5373 32.8521 79.4168C36.8047 79.0816 40.175 77.4317 40.6338 75.5701C38.2164 75.1025 36.4518 77.8199 33.9197 77.0965ZM31.2552 67.6473C29.0584 68.4061 26.9056 69.306 24.6999 70.0559C23.7471 70.3824 22.7148 70.6029 21.7178 70.6206C20.1297 70.647 19.4063 69.4824 20.2268 68.1502C20.6944 67.3914 21.4708 66.7297 22.2472 66.2886C24.1706 65.2034 25.9528 63.9947 27.3556 62.2654C27.6203 61.939 27.9908 61.7096 28.1937 61.5331C33.4168 62.8036 38.4017 62.5742 43.263 60.9597C43.4483 62.1066 43.6071 63.1565 43.7659 64.1358C42.0278 65.7151 40.325 67.2856 38.5869 68.8207C37.9958 69.3413 37.387 69.9677 36.6724 70.2059C33.6286 71.2117 30.4965 71.7763 27.2056 71.6617C29.7024 70.0559 32.861 69.606 34.8285 67.0297C33.5668 67.0474 32.3845 67.2591 31.2552 67.6473ZM15.0655 59.9803C16.0183 58.3922 17.28 57.7041 18.9916 57.5188C21.012 57.2982 23.0236 56.9453 25.0087 56.4953C26.0233 56.266 26.9762 55.7278 27.8232 55.3925C27.4615 57.1129 27.1174 58.7628 26.6762 60.8891C24.894 62.0272 22.6972 63.43 20.5003 64.8593C20.0768 65.1328 19.6092 65.4151 19.3092 65.8033C18.3387 67.0738 16.9359 66.9944 15.736 66.6768C14.8802 66.4474 13.9185 65.6269 13.5303 64.824C13.0098 63.7565 13.945 62.9007 14.8361 62.3537C15.8243 61.7449 16.8918 61.2773 17.9417 60.7744C18.6122 60.4479 19.3092 60.1744 19.9886 59.8745C19.9268 59.6804 19.8651 59.4774 19.8033 59.2833C18.2858 59.5039 16.7594 59.7333 15.0655 59.9803ZM16.4154 50.9106C19.3622 47.7255 21.0032 43.8788 22.1237 39.6792C24.9911 40.1027 27.1791 39.3616 29.1378 38.0029C30.5671 37.0147 31.864 35.8237 33.258 34.7826C33.7609 34.412 34.3609 33.9974 34.9432 33.9444C36.1342 33.8297 37.3517 33.9532 38.7016 33.9797C38.4722 35.9472 37.4311 37.8794 38.4458 39.7321C37.3164 40.7203 36.2136 41.4879 35.3666 42.4672C34.2373 43.773 32.8169 45.114 32.3757 46.6756C31.5287 49.693 29.6407 51.4223 27.0733 52.8692C24.6558 54.2279 22.1149 54.9602 19.3886 55.0749C18.4976 55.1102 17.5888 54.8014 16.6712 54.6426C17.2094 52.5957 17.3418 52.5957 18.8151 51.2723C20.6503 49.6313 22.3619 47.8491 24.0912 46.0933C24.3911 45.7934 24.5058 45.3169 24.7088 44.9199C21.5061 46.3933 19.7504 49.6313 16.4154 50.9106ZM26.3057 29.1801C29.3319 25.2275 32.3228 22.0072 36.9371 20.9397C37.3959 20.8338 37.9517 20.825 38.3752 20.9926C40.4574 21.7955 42.5925 22.0778 44.807 21.9367C46.0775 21.8573 47.3567 21.9014 48.6272 21.8837C48.3449 22.3337 48.0273 22.466 47.7361 22.6425C44.3747 24.6364 41.4102 27.0362 39.5839 30.5918C38.9575 31.8093 38.0223 32.1799 36.2136 31.8975C36.6283 30.7418 38.2958 30.4418 38.4105 28.7037C37.7311 29.1184 37.29 29.3389 36.9106 29.6389C34.6432 31.4652 32.4551 33.3974 30.1171 35.109C28.6702 36.1677 27.0203 36.9971 25.3793 37.747C24.4705 38.1617 23.3148 38.3823 22.5736 37.3676C21.9119 36.4589 22.3531 35.4796 22.9354 34.7385C23.9676 33.4327 24.9646 32.0034 26.288 31.0594C28.7672 29.2948 31.4758 27.8391 34.0785 26.2422C34.5638 25.9422 35.0226 25.6069 35.4902 25.2805C31.9611 25.2805 29.4113 27.2921 26.3057 29.1801ZM31.5111 54.6514C32.4816 52.3398 33.3374 50.4429 34.0609 48.5019C35.2431 45.3081 37.59 43.0671 39.8309 40.9497C44.9746 42.3525 50.083 41.9378 55.0237 42.5554C52.3681 46.8874 49.6771 51.2105 47.0744 55.569C46.4215 56.663 45.6628 57.51 44.5335 58.1629C40.4309 60.5362 36.0372 61.0302 31.4493 60.4127C30.7082 60.3156 30.0024 59.9362 29.0054 59.601C30.0553 58.357 30.8053 57.2894 31.7405 56.4159C32.7375 55.4719 33.9197 54.722 35.0049 53.8573C35.9666 53.0898 37.2723 52.7192 37.9517 51.3429C35.4372 51.6781 33.7874 53.3192 31.5111 54.6514ZM72.131 16.4489C72.8721 16.9518 73.7809 17.2165 74.4337 17.5165C75.2101 16.7577 75.7748 16.2195 76.3218 15.6725C77.6011 14.3932 78.951 13.158 80.1332 11.7905C81.2272 10.5289 82.1095 9.08192 83.1594 7.76733C84.5623 6.00278 86.1327 4.40586 88.0031 3.04716C88.7178 4.52056 89.3265 5.67634 89.8559 6.87623C90.5353 8.41139 91.2323 9.93773 91.7528 11.5258C92.5292 13.8815 92.3086 16.1666 90.6764 18.1341C89.6089 19.4222 88.506 20.7103 87.2355 21.7778C85.0299 23.6306 83.2565 25.8098 81.6243 28.1567C79.3304 31.4476 78.6422 34.7738 80.345 38.6205C81.1126 40.3497 81.4125 42.4407 81.3508 44.3464C81.2714 46.7197 80.592 49.0842 80.1597 51.4487C79.745 53.7162 78.6598 55.6748 77.4864 57.6335C75.3425 61.1979 72.3428 63.9329 69.2019 66.5621C68.3725 67.2503 67.4814 67.8414 65.9639 67.7267C66.7138 66.2445 67.2697 64.9034 68.0373 63.6947C69.043 62.0978 70.2076 60.5979 71.3105 59.0628C72.6957 57.1394 73.622 55.0661 73.9573 52.6751C74.3543 49.7901 74.9896 46.9403 75.5719 44.0906C76.1189 41.3996 75.8013 38.8234 74.7602 36.256C74.3632 37.2088 74.1602 38.1793 74.072 39.1587C73.9485 40.4644 74.0367 41.7878 73.825 43.076C73.2427 46.5962 72.5633 50.0989 71.9016 53.6015C71.5134 55.6484 70.79 57.7129 69.2019 58.9745C67.0579 60.6773 64.7728 62.3537 61.976 62.9448C57.5647 63.8712 53.1356 64.7711 48.7154 65.6445C48.1596 65.7504 47.542 65.7239 46.9862 65.5916C46.5715 65.4946 46.2186 65.1505 45.6363 64.7887C49.2184 62.8654 53.0739 61.8066 55.0943 58.1276C51.5652 59.0892 49.1389 62.2831 45.0716 63.28C45.8304 61.3479 46.5009 59.9715 47.4538 58.6658C49.5889 55.719 51.8652 52.8251 53.6033 49.6401C55.2619 46.5962 57.4323 43.9759 59.4263 41.2055C59.7174 40.7997 60.1056 40.4027 60.5467 40.1821C63.273 38.841 65.4522 36.8383 67.6138 34.7561C69.2725 33.1592 71.337 32.5239 73.675 33.0886C74.1338 33.2033 74.6367 33.1504 75.2631 33.1768C74.6808 31.6417 73.3044 31.6329 72.2987 31.3417C71.187 31.0153 69.9165 31.2535 68.7166 31.2447C68.5225 30.1153 69.5107 28.8802 68.3549 27.6185C68.1696 28.4302 68.1343 29.1007 67.8784 29.6654C65.911 34.015 62.7877 37.2529 58.4469 39.2822C56.5765 40.1556 54.6355 40.835 52.5445 40.6144C49.9771 40.3497 47.4097 39.9704 44.7011 39.6263C46.5098 37.6323 48.2831 35.6737 50.0565 33.715C49.9506 33.6003 49.8359 33.4945 49.7301 33.3798C49.086 33.9356 48.4067 34.4561 47.8155 35.0561C46.6421 36.256 45.5745 37.5529 44.3746 38.7175C43.2277 39.838 41.9661 39.7233 40.7309 38.5411C39.9368 37.7823 39.9545 36.4854 41.0573 35.4619C42.0013 34.5885 43.1218 33.8297 44.2952 33.3092C45.6804 32.6916 47.1979 32.3651 48.6625 31.9152C49.3948 31.6946 50.1271 31.5005 50.8594 31.2976C47.4008 30.927 44.2864 31.8711 41.1896 33.4062C41.3661 32.2857 41.4808 31.1211 42.0719 30.3094C45.0099 26.3039 49.0066 23.7365 53.7091 22.2366C54.1767 22.0866 54.7149 22.1043 55.2178 22.1396C56.2324 22.2102 57.247 22.3425 58.2617 22.4396C59.7527 22.5807 61.1026 22.9689 62.1878 24.1159C62.7612 24.7158 63.4671 25.2628 64.6934 24.9364C64.1376 23.86 63.6612 22.9248 63.07 21.769C64.6493 21.8484 66.0962 21.9367 67.5432 21.9808C69.0695 22.0249 70.6047 22.1484 72.1222 22.0249C73.9838 21.8749 75.7571 21.3014 77.2394 19.9427C76.313 19.7574 75.4043 19.7398 74.5043 19.8104C73.0486 19.9251 71.5752 20.3574 70.1635 20.2074C66.5991 19.8369 63.0612 19.4134 59.5233 20.3045C59.3204 20.3574 59.091 20.2956 58.8704 20.2692C57.6264 20.1368 56.8853 19.4928 56.7618 18.1076C57.3176 17.7459 57.8646 17.4106 58.394 17.04C62.7965 13.855 67.3579 13.211 72.131 16.4489ZM39.2751 15.1343C43.8276 13.5462 48.5037 14.0315 53.1356 14.5167C54.1767 14.6226 55.1384 15.4872 56.0207 15.946C55.3766 17.2253 54.8649 18.2311 54.3179 19.3251C41.719 20.8073 41.3926 19.8721 35.9666 17.6576C36.6724 16.1137 37.9517 15.5931 39.2751 15.1343ZM14.0068 33.9885C16.7242 31.2535 19.3886 28.4743 22.0884 25.7393C23.6677 24.1335 25.2381 22.5101 26.9144 21.0014C28.7319 19.3692 30.8317 18.2576 33.4168 18.1958C33.6374 18.6811 33.8403 19.1134 33.955 19.3516C32.3845 20.3927 30.77 21.1691 29.5348 22.3425C27.0556 24.6894 24.8411 27.2656 23.2177 30.3624C22.0884 32.5151 21.162 34.9679 18.8504 36.2207C16.3007 37.597 13.6362 38.7793 11.0158 40.0321C10.7776 40.1468 10.4865 40.1292 9.92183 40.2174C10.76 37.5176 12.304 35.709 14.0068 33.9885ZM6.35744 54.1132C7.14266 51.9693 8.3602 50.0812 9.96594 48.4402C10.61 47.7873 11.1747 47.0638 12.0834 46.0139C9.0131 46.5256 8.12199 48.9431 6.55154 50.3459C6.4192 46.9756 8.58961 44.7435 10.6188 42.4584C10.8923 42.1584 11.2982 41.9466 11.6776 41.7702C14.5802 40.4468 17.4918 39.1498 20.5444 37.7823C20.7121 38.0558 20.9591 38.4705 21.0914 38.6911C20.518 39.8204 19.8915 40.7291 19.5828 41.7437C18.8769 44.0818 17.7476 46.1639 16.3448 48.1402C15.639 49.146 14.8802 50.2047 14.5361 51.3517C13.5392 54.7043 10.8835 55.6837 7.92789 56.1954C6.34862 56.4777 5.79278 55.6572 6.35744 54.1132ZM2.16664 67.0738C2.3872 65.0005 2.82835 62.936 3.38418 60.9244C3.69297 59.7951 4.42527 58.7716 4.96346 57.7041C5.15756 57.7658 5.36047 57.8364 5.55457 57.8982C5.11343 59.6715 4.68996 61.4537 4.22235 63.2183C3.6224 65.4593 3.1195 67.6914 4.57526 69.9589C2.47544 69.253 1.98136 68.8295 2.16664 67.0738ZM6.05747 68.062C6.56919 64.33 9.5601 62.089 11.9599 58.9834C9.11014 59.2128 8.01613 61.0832 6.3751 62.9448C6.69272 61.392 6.81623 60.2362 7.19561 59.1598C7.37207 58.6393 7.93671 58.1099 8.45726 57.8893C10.31 57.1041 12.2246 56.4424 14.3067 55.666C14.5361 55.8778 14.942 56.266 15.339 56.6453C14.0421 58.454 12.7098 60.0156 11.7217 61.7714C10.31 64.2858 11.3247 66.8621 13.9891 68.0443C14.5979 68.309 15.2331 68.5119 15.9743 68.7943C11.6864 71.2382 8.98662 71.0088 6.05747 68.062ZM6.78977 71.2999C7.78674 71.6175 8.79252 71.9352 9.69244 72.2175C9.68361 73.3821 9.67479 74.4496 9.66597 75.6584C6.16334 76.4524 5.36049 74.0967 6.78977 71.2999ZM14.3508 76.5936C13.3715 76.3818 11.8011 74.6437 11.7923 73.8497C11.7834 72.9498 12.7804 71.9175 14.095 71.5558C15.3478 71.2117 16.6183 70.9294 18.074 70.5765C18.7887 72.3939 20.7032 72.7557 22.7589 72.8351C22.8119 73.038 22.8736 73.2497 22.9266 73.4527C20.5709 74.5202 18.2329 75.6231 15.8596 76.6377C15.4361 76.8141 14.8361 76.6994 14.3508 76.5936ZM18.8063 77.0523C20.5003 75.9319 22.1943 74.8202 23.9235 73.7615C24.2588 73.5585 24.7617 73.4615 25.1411 73.5321C27.5585 73.9997 29.923 73.5497 32.2963 73.2409C32.7463 73.1792 33.1962 73.2056 33.9991 73.188C32.3757 74.8025 31.4935 76.3995 31.8199 78.3316C28.9878 79.8756 22.8207 80.8638 19.9974 80.2815C18.8593 80.0433 18.0035 79.4698 17.5623 78.1023C18.0299 77.6876 18.3917 77.3259 18.8063 77.0523ZM14.1126 80.6961C13.2921 80.2109 12.1716 79.6904 12.304 78.3052C13.4068 78.4375 14.4038 78.561 15.3655 78.6757C16.8742 81.5343 16.9977 81.6137 21.709 82.8048C18.4358 83.7576 16.3183 82.0019 14.1126 80.6961ZM34.8814 83.0342C30.9641 83.4135 27.5056 84.4811 24.0735 82.5842C26.3145 82.1166 28.5555 81.6402 30.8053 81.2079C31.0523 81.1549 31.3699 81.2784 31.617 81.402C32.561 81.8519 33.4874 82.3372 34.8814 83.0342Z"
                        fill="currentColor" />
                </svg>
            </span>
            <span class="footer__overlay-img six">
                <svg width="104" height="68" viewBox="0 0 104 68" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M75.8612 52.8389C79.7962 54.2241 82.99 56.368 85.0899 60.0824C86.228 62.1028 87.6661 63.9644 88.9013 65.9319C89.5894 67.0259 90.5423 67.5817 91.7775 67.6258C93.3038 67.6788 94.839 67.6964 96.3741 67.6347C99.1533 67.5288 102.921 64.4938 103.115 60.6823C103.326 56.4033 101.191 53.5006 98.2445 50.9156C96.7623 49.6186 95.2448 48.3746 93.7273 47.1218C90.6923 44.6073 87.2161 42.9927 83.3782 42.1634C74.5996 40.2577 66.1121 37.3462 57.6864 34.3112C55.1101 33.3848 52.728 31.8937 50.0812 30.5703C50.8576 27.5176 50.0988 24.9679 49.3665 22.3387C48.6343 19.6919 48.4578 16.8862 47.9196 14.1776C47.5667 12.4043 47.1344 10.6133 46.4815 8.92812C45.5639 6.54598 43.9406 4.6932 41.5496 3.60801C41.0202 3.36979 40.5085 3.07863 40.0233 2.76101C34.9855 -0.591638 29.6212 -0.662195 24.1335 1.32292C20.1633 2.76103 16.1754 4.19031 12.9816 7.16357C10.7229 9.26339 8.72016 11.5485 7.09677 14.1688C5.10283 17.398 3.3471 20.7153 1.88253 24.2444C-2.03477 33.6936 -0.27022 49.2392 11.2876 57.0562C13.7668 58.7325 16.193 60.4706 18.6281 62.2087C21.672 64.3791 25.0334 64.8643 28.6331 64.1408C30.7594 63.7174 32.4357 62.641 33.2915 60.5765C34.3238 58.0884 36.0001 56.1563 38.0293 54.4094C40.6938 52.1154 42.8906 49.3804 44.5405 46.2483C44.9463 45.4807 45.4757 44.7661 45.9345 44.025C46.8874 42.481 47.8226 40.937 48.9254 39.146C49.8077 39.6225 50.9282 40.0989 51.9163 40.7606C59.3804 45.8072 67.3649 49.848 75.8612 52.8389ZM45.6169 40.3988C44.6728 41.8722 43.6759 43.3103 42.6613 44.7308C41.0026 47.0335 39.441 49.4157 37.597 51.5508C35.356 54.1535 32.9563 56.5974 31.624 59.8442C31.0505 61.2382 29.8948 61.9793 28.4743 62.3057C25.2805 63.038 22.2719 62.7998 19.5192 60.7706C17.64 59.3854 15.7166 58.0532 13.705 56.8797C1.95313 50.0157 -0.605482 35.6257 2.85303 25.0649C4.32643 20.5741 6.89384 16.6745 9.38186 12.7307C9.99945 11.7602 10.8288 10.9044 11.6493 10.0751C14.7284 6.98711 18.3281 4.81671 22.4395 3.21097C26.3127 1.69347 30.0624 1.04057 34.165 1.85226C36.3442 2.28457 37.994 3.53743 39.8556 4.49028C43.4377 6.31659 45.1934 9.29867 45.8904 13.0836C46.6844 17.3715 46.958 21.7564 48.449 25.9207C48.8284 26.9794 48.9254 28.1794 48.2461 29.2204C46.658 28.6293 45.1757 28.0735 43.6582 27.5088C43.5965 27.103 43.5347 26.75 43.4994 26.3883C43.1289 22.3828 42.6348 18.4302 40.3762 14.9099C39.7056 13.86 39.5204 12.4925 39.0439 11.0544C41.7349 12.1043 42.6083 14.3982 43.9494 16.3216C43.8435 14.4776 43.2171 12.8895 41.8937 11.6014C41.382 11.1073 40.7467 10.6485 40.4291 10.0398C39.4851 8.23993 37.9411 7.34884 36.053 7.15474C33.5209 6.89006 30.9711 6.82831 28.4214 6.69597C26.2686 6.59009 24.4776 7.40179 22.8189 8.76049C21.3014 10.0045 19.7045 11.1691 18.0282 12.1749C15.3019 13.8071 13.3256 15.9863 12.011 18.8978C11.1111 20.8741 9.89358 22.7093 8.83485 24.615C8.55253 25.1179 8.19962 25.6472 8.14668 26.1942C7.97905 28.047 7.32617 29.538 5.70279 30.588C4.89992 31.1085 4.51171 31.9731 5.03225 32.873C6.18803 34.8846 6.16157 37.0462 6.11746 39.2519C6.04688 42.5075 6.92032 45.4984 9.08189 47.9599C10.8994 50.0245 12.7698 52.089 15.2225 53.4918C17.5429 54.8152 19.4927 56.4739 20.6662 58.9972C21.0279 59.7736 21.8837 60.6294 22.6866 60.85C26.1274 61.8028 29.8242 60.8323 30.8388 56.8356C31.5446 54.0388 33.0268 51.7978 34.9678 49.751C35.9119 48.754 36.8206 47.6688 37.5352 46.5042C39.3263 43.6103 41.2673 40.7694 41.4878 37.205C41.4967 37.108 41.6819 37.0197 41.9731 36.755C43.42 37.1874 44.9816 37.655 46.6756 38.1579C46.2345 39.1107 46.0051 39.8077 45.6169 40.3988ZM31.7387 20.9976C32.3122 22.4357 32.8945 23.918 33.4591 25.3472C33.0709 25.5943 32.9562 25.6825 32.8327 25.7443C30.4418 26.9795 30.1506 27.5882 30.7241 30.1909C30.7858 30.4644 30.8564 30.7909 30.777 31.0379C30.1594 32.8642 29.4977 34.6729 28.836 36.5433C29.2595 36.7992 29.7095 37.0638 30.1683 37.3462C27.195 41.0429 27.195 41.0429 27.3979 41.7223C28.3331 41.0694 29.3477 40.443 30.2565 39.7019C30.9182 39.1637 31.4475 38.4755 32.021 37.8402C32.3475 37.4785 32.568 36.905 32.9651 36.7462C35.4178 35.7404 37.8882 35.8375 40.5438 36.658C40.0938 38.4314 40.0674 40.3018 39.1939 41.5987C37.4029 44.2367 36.106 47.2188 33.6885 49.4422C31.7299 51.242 30.4065 53.5095 29.7977 56.1563C29.6212 56.9239 29.2948 57.6914 28.8713 58.3531C27.9802 59.7559 26.745 60.0912 25.104 59.7912C23.6041 59.5089 22.8718 58.5119 22.2984 57.2856C20.9132 54.33 18.5928 52.7419 15.3902 52.2213C14.6667 52.1066 13.9697 51.5684 13.3521 51.092C12.6639 50.5626 12.1169 49.8568 11.464 49.2745C8.36726 46.5571 6.84974 43.1074 6.84974 39.0402C6.84974 36.7551 6.78799 34.5229 5.59692 32.3702C5.94983 31.9555 6.09982 31.6731 6.32039 31.5232C8.05847 30.3497 9.08191 28.8146 9.18778 26.6442C9.21425 26.0619 9.59361 25.312 10.0524 24.9767C11.8875 23.6356 13.0345 21.7917 14.0668 19.8507C15.4431 17.2568 17.4194 15.3158 19.9868 13.8953C21.2573 13.1983 22.4925 12.369 23.5512 11.3897C27.3979 7.83409 31.9416 8.24876 36.5559 8.94576C37.4911 9.08692 38.0117 9.6604 38.1705 10.7103C38.5499 13.1719 39.4763 15.4393 40.6409 17.6715C42.1848 20.6359 42.1054 23.9621 42.3966 27.5088C40.782 27.2353 39.3616 27.2265 38.1264 26.7236C36.5647 26.0883 35.0031 25.3737 34.8972 23.1151C34.7737 21.0506 33.8032 20.6271 31.7387 20.9976ZM39.4233 34.4435C37.1118 34.1347 34.7737 34.0553 32.5769 35.2023C32.1887 35.4052 31.6593 35.3169 31.2005 35.3611C30.68 34.1259 31.2976 33.2259 31.527 32.2643C31.7211 31.4438 31.9593 30.5085 31.7387 29.7586C31.4476 28.7793 31.5005 28.0647 32.2151 27.403C32.9562 26.7148 33.7679 26.4942 34.8178 26.8383C36.5471 27.3941 38.3117 27.8529 40.085 28.2146C42.8995 28.7881 45.4845 29.8116 47.9726 31.285C51.4134 33.3142 54.9072 35.3346 58.5952 36.8609C62.8918 38.6343 67.3914 39.9312 71.8469 41.3076C74.9702 42.2781 78.1199 43.3456 81.3314 43.8485C87.7367 44.8455 92.5274 48.5422 97.0447 52.7242C98.2975 53.88 99.215 55.4593 100.036 56.9856C100.909 58.6178 100.812 60.4 100.036 62.6763C97.274 54.3652 92.4127 48.8775 83.9694 47.4218C84.4987 47.66 85.0193 47.8893 85.5486 48.1187C89.7747 49.9892 93.5332 52.3801 95.483 56.8356C96.2153 58.5031 96.9388 60.1706 97.6005 61.8646C97.8034 62.394 97.8211 63.0027 97.874 63.5762C97.9622 64.4497 97.5476 65.0408 96.6829 65.0849C95.086 65.1643 93.4891 65.1555 91.8922 65.1114C91.5834 65.1025 91.1952 64.8379 91.0011 64.5732C89.5806 62.641 88.0543 60.7706 86.8456 58.7149C84.5517 54.7887 81.2078 52.3537 76.9729 50.9067C69.2883 48.2776 61.9919 44.7396 55.2513 40.2489C50.3635 37.0021 45.114 35.2199 39.4233 34.4435Z"
                        fill="currentColor" />
                </svg>
            </span>
            <span class="footer__overlay-img seven">
                <svg width="24" height="63" viewBox="0 0 24 63" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M23.0219 3.71851C23.2954 4.34492 23.5072 4.98016 23.666 5.62422L23.666 2.14806C22.519 1.00111 21.0191 0.480563 19.1046 0.5335C17.9576 0.56879 16.8019 0.32175 15.6637 0.136474C13.6257 -0.189969 11.9847 0.480564 11.173 2.36863C10.7318 3.38325 10.5995 4.60961 10.6083 5.73892C10.6171 6.96528 10.9259 8.19165 11.1377 9.41801C11.3053 10.4062 11.1377 11.1914 10.3877 11.9854C8.43792 14.0676 7.33507 16.5732 7.17626 19.4583C7.13214 20.3317 7.01745 21.2052 6.90275 22.0698C6.24987 27.0547 6.34692 32.0836 5.68521 37.095C4.5559 45.6618 2.67666 54.0082 0.144531 62.231L2.93252 62.231C3.13544 61.5604 3.33837 60.8811 3.54129 60.2105C5.74698 52.9583 6.94687 45.4942 7.89973 37.9419C8.56144 32.6483 8.33205 27.3194 9.11727 22.061C9.2849 20.9052 9.37313 19.7406 9.55841 18.5937C9.95543 16.0439 10.0878 15.8057 12.7081 12.5765C14.2256 14.0058 15.7431 13.4412 17.2165 12.6912C18.2576 12.1619 19.2634 12.0207 20.3663 12.4266C20.7015 12.5501 21.0809 12.656 21.4338 12.6295C22.2984 12.5589 23.0307 12.6648 23.6748 12.903L23.6748 10.2738C23.6395 10.4326 23.613 10.5914 23.5689 10.7502C22.3514 10.5738 21.4338 10.4414 20.6398 10.3267C20.578 8.51808 20.5251 6.86823 20.481 5.2272C20.3222 5.20956 20.1545 5.19191 19.9957 5.17426C19.8987 5.5801 19.7487 5.98596 19.7134 6.40063C19.4487 9.67387 19.4575 9.67387 16.0166 10.7326C16.0255 7.63581 15.302 4.75077 13.7492 2.04219C14.0757 1.93632 14.305 1.78633 14.4639 1.83926C16.5548 2.57155 18.6811 2.7833 20.8868 2.57155C21.7514 2.4745 22.6072 2.76565 23.0219 3.71851ZM14.1551 11.2708C13.9962 11.3149 13.8463 11.359 13.6874 11.4031C13.4757 11.0943 13.061 10.7679 13.0787 10.4679C13.211 8.03284 11.7376 5.60657 12.9728 3.16267C14.2609 5.79185 14.455 8.50926 14.1551 11.2708Z"
                        fill="currentColor" />
                    <path
                        d="M14.7643 38.9385C15.6818 46.7025 16.5729 54.4488 15.426 62.2217L16.6347 62.2217C16.9964 59.6543 17.1817 57.0604 17.0229 54.4577C16.6788 48.9346 16.1053 43.4204 15.6642 37.8974C15.276 33.1066 14.9142 28.307 14.579 23.5075C14.5084 22.537 14.6143 21.5577 14.6407 20.5872C14.4907 20.5783 14.3319 20.5607 14.1819 20.5519C14.032 22.0341 13.6879 23.5251 13.7584 24.9897C13.9967 29.6481 14.2172 34.3153 14.7643 38.9385Z"
                        fill="currentColor" />
                </svg>
            </span>
        </div>
    </footer>
    <!--Footer Section end  -->
    <!-- Shopping Cart Sidebar Start -->
    <div class="shopping-cart">
        <div class="shopping-cart-top">
            <div class="shopping-cart-header">
                <h5 class="font-body--xxl-500">Giỏ Hàng (<span class="count">0</span>)</h5>
                <!-- Số lượng sản phẩm trong giỏ -->
                <button class="close">
                    <svg width="45" height="45" viewBox="0 0 45 45" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="22.5" cy="22.5" r="22.5" fill="white" />
                        <path d="M28.75 16.25L16.25 28.75" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M16.25 16.25L28.75 28.75" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <div class="shopping-cart__product-content-popup">
                <!-- Các sản phẩm sẽ được hiển thị ở đây sau khi gọi API -->
            </div>
        </div>

        <div class="shopping-cart-bottom">
            <div class="shopping-cart-product-info">
                <p class="product-count font-body--lg-400">0 Sản Phẩm</p> <!-- Số lượng sản phẩm sẽ được cập nhật -->
                <span class="product-price font-body--lg-500">₫0.00</span> <!-- Tổng giá trị sẽ được cập nhật -->
            </div>

            <form action="{{ route('client.cart.shopping-cart') }}" method="get">
                <button class="button button--lg w-100" type="submit">
                    Thanh Toán
                </button>
            </form>

            <form action="{{ route('client.cart.shopping-cart') }}" method="get">
                <button class="button button--lg w-100" type="submit"
                    style="background-color: #f5f5f5; color: #333; border: 1px solid #ccc;">
                    Đi đến giỏ hàng
                </button>
            </form>

        </div>
    </div>
    <!-- Shopping Cart Sidebar End -->
    @yield('js')
    <script src="{{ asset('client/lib/js/jquery.min.js') }}"></script>
    <script src="{{ asset('client/lib/js/countfect.min.js') }}"></script>
    <script src="{{ asset('client/lib/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('client/lib/js/bvselect.js') }}"></script>
    <script src="{{ asset('client/lib/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('client/lib/js/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('client/js/main.js') }}"></script>


    <!-- Overlay to cover the background -->
    <div class="overlay" onclick="closeChat()"></div>

    <!-- Purchase Button -->
    <div class="templatecookie-btn">
        <a href="javascript:void(0)" onclick="openChat()" class="purchase-btn">
            Chat
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 2C6.48 2 2 5.58 2 9c0 1.26.46 2.42 1.24 3.38L2 18l5.12-1.24c.56.17 1.14.32 1.74.32 5.52 0 10-3.58 10-8s-4.48-8-10-8z" />
                </svg>
            </span>
        </a>
    </div>


    <!-- Chat Box -->
    <div id="chatBox" class="chat-box">
        <div class="chat-header">
            <h3>Synergy 4.0</h3>
            <button onclick="closeChat()" class="close-btn">X</button>
        </div>
        <div class="chat-body">
            <div class="chat-message">
                <strong>Support:</strong> Xin chào, hôm nay chúng tôi có thể giúp gì cho bạn?
            </div>
            <!-- Additional chat messages can be added here -->
        </div>
        <div class="chat-footer">
            <input type="text" placeholder="Type a message..." />
            <button>Gửi</button>
        </div>
    </div>
    <script>
        window.isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
    </script>
</body>

</html>
