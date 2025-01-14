@extends('layouts.client')
@section('title', 'Cửa Hàng | Synergy 4.0')
@section('css')
    <link rel="stylesheet" href="{{ asset('client/lib/css/nouislider.min.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

@endsection
@section('content')
    <!-- Banner Section Start  -->
    <section class="banner-sales">
        <div class="container">
            <div class="banner-sales__content">
                <img src="{{ asset('client/images/banner/banner-lg-17.jpg') }}" alt="banner" />
                <div class="text-content">
                    <span class="title">Ưu Đãi Tốt Nhất</span>
                    <h2 class="font-title--lg">Khuyến Mãi Của Tháng</h2>
                    <div id="countdown" class="countdown-clock"></div>
                    <a href="#" class="button button--md">
                        Mua ngay
                        <span>
                            <svg width="17" height="15" viewBox="0 0 17 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </a>
                </div>

                <div class="sale-off">
                    <h5>56%</h5>
                    <p>off</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End  -->


    <!-- Filter  -->
    <div class="filter--search">
        <div class="container">
            <div class="filter--search__content row">
                <div class="col-lg-3 d-none d-lg-block">
                    <button class="button button--md" id="filter">
                        Filter
                        <span>
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
                        </span>
                    </button>
                </div>
                <div class="col-lg-9">
                    <div class="filter--search-result">
                        <!-- Phần Sắp Xếp -->
                        <div class="sort-list">
                            <label for="sort">Sắp Xếp Theo:</label>
                            <form action="{{ route('client.shop.shop') }}" method="get" class="d-inline">
                                <select id="sort" name="sort" class="sort-list__dropmenu"
                                    onchange="this.form.submit()">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới Nhất
                                    </option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Cũ Nhất
                                    </option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá
                                        Thấp -> Cao</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá
                                        Cao -> Thấp</option>
                                </select>
                            </form>
                        </div>

                        <!-- Phần Kết Quả Tìm Thấy -->
                        <div class="result-found">
                            <p><span class="number">{{ $products->total() }}</span> Kết Quả Được Tìm Thấy</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Shop list Section Start  -->
    <section class="shop shop--one">
        <div class="container">
            <div class="row shop-content">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <!-- filter button -->
                        <button class="filter">
                            <svg width="22" height="19" viewBox="0 0 22 19" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18 5.75C18.4142 5.75 18.75 5.41421 18.75 5C18.75 4.58579 18.4142 4.25 18 4.25V5.75ZM9 4.25C8.58579 4.25 8.25 4.58579 8.25 5C8.25 5.41421 8.58579 5.75 9 5.75V4.25ZM18 4.25H9V5.75H18V4.25Z"
                                    fill="white"></path>
                                <path
                                    d="M13 14.75C13.4142 14.75 13.75 14.4142 13.75 14C13.75 13.5858 13.4142 13.25 13 13.25V14.75ZM4 13.25C3.58579 13.25 3.25 13.5858 3.25 14C3.25 14.4142 3.58579 14.75 4 14.75V13.25ZM13 13.25H4V14.75H13V13.25Z"
                                    fill="white"></path>
                                <circle cx="5" cy="5" r="4" stroke="white" stroke-width="1.5"></circle>
                                <circle cx="17" cy="14" r="4" stroke="white" stroke-width="1.5"></circle>
                            </svg>
                        </button>
                        <div class="shop__sidebar-content">
                            <div class="accordion shop" id="shop">
                                <form action="{{ route('client.shop.shop') }}" method="get">
                                    <div class="accordion-item shop-item">
                                        <h2 class="accordion-header" id="shop-item-accordion--one">
                                            <button class="accordion-button shop-button font-body--xxl-500" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Tất cả Danh Mục
                                                <span class="icon">
                                                    <svg width="14" height="8" viewBox="0 0 14 8" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M13 7L7 1L1 7" stroke="#1A1A1A" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </h2>

                                        <div id="collapseOne" class="accordion-collapse shop-collapse collapse show"
                                            aria-labelledby="shop-item-accordion--one" data-bs-parent="#shop">
                                            <div class="accordion-body shop-body">
                                                <div class="categories">
                                                    @foreach ($categories as $category)
                                                        <div class="categories-item">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="category" value="{{ $category->id }}"
                                                                    id="category-{{ $category->id }}"
                                                                    {{ request('category') == $category->id ? 'checked' : '' }}
                                                                    onchange="this.form.submit()" />
                                                                <label class="form-check-label"
                                                                    for="category-{{ $category->id }}">{{ $category->name }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="d-flex justify-content-between mt-3">
                                                    <!-- Nút Lọc -->
                                                    <button type="submit" class="btn btn-primary btn-lg"
                                                        style="border-radius: 50px; padding: 10px 20px; font-size: 16px;">
                                                        <i class="bi bi-filter"></i> Lọc
                                                    </button>

                                                    <!-- Nút bỏ lọc -->
                                                    <a href="{{ route('client.shop.shop') }}"
                                                        class="btn btn-outline-secondary px-4"
                                                        style="border-radius: 50px; padding: 10px 20px; font-size: 16px;">
                                                        Bỏ lọc</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form method="GET" action="{{ route('client.shop.shop') }}">
                                    <!-- Đảm bảo gửi yêu cầu GET đến route đúng -->
                                    <!-- Price Range -->
                                    <div class="accordion-item shop-item">
                                        <h2 class="accordion-header" id="shop-item-accordion--two">
                                            <button class="accordion-button shop-button font-body--xxl-500 collapsed"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Giá
                                                <span class="icon">
                                                    <svg width="14" height="8" viewBox="0 0 14 8" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M13 7L7 1L1 7" stroke="#1A1A1A" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse shop-collapse collapse show"
                                            aria-labelledby="shop-item-accordion--two" data-bs-parent="#shop">
                                            <div class="price-range-inputs">
                                                <div class="mb-3">
                                                    <label for="minPrice" class="form-label">Giá từ:</label>
                                                    <input type="number" name="min_price" id="minPrice"
                                                        class="form-control" value="{{ request('min_price') }}"
                                                        placeholder="Ví dụ: 1000000">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="maxPrice" class="form-label">Đến:</label>
                                                    <input type="number" name="max_price" id="maxPrice"
                                                        class="form-control" value="{{ request('max_price') }}"
                                                        placeholder="Ví dụ: 5000000">
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <!-- Nút Lọc -->
                                                    <button type="submit" class="btn btn-primary btn-lg"
                                                        style="border-radius: 50px; padding: 10px 20px; font-size: 16px;">
                                                        <i class="bi bi-filter"></i> Lọc
                                                    </button>

                                                    <!-- Nút bỏ lọc -->
                                                    <a href="{{ route('client.shop.shop') }}"
                                                        class="btn btn-outline-secondary px-4"
                                                        style="border-radius: 50px; padding: 10px 20px; font-size: 16px;">
                                                        Bỏ lọc</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Rating -->
                            <div class="accordion-item shop-item">
                                <h2 class="accordion-header" id="shop-item-accordion--three">
                                    <button class="accordion-button shop-button font-body--xxl-500 collapsed"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        Đánh Giá
                                        <span class="icon">
                                            <svg width="14" height="8" viewBox="0 0 14 8" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13 7L7 1L1 7" stroke="#1A1A1A" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse shop-collapse collapse show"
                                    aria-labelledby="shop-item-accordion--three" data-bs-parent="#shop">
                                    <div class="accordion-body shop-body">
                                        <form method="GET" action="{{ route('client.shop.shop') }}">
                                            <div class="ratings">
                                                <div class="ratings--list-item">
                                                    <!-- Lọc đánh giá 5 sao -->
                                                    <div class="form-check d-flex align-items-center">
                                                        <input class="form-check-input" type="checkbox" name="ratings[]"
                                                            value="5" id="five"
                                                            @if (in_array(5, request()->input('ratings', []))) checked @endif />
                                                        <label
                                                            class="form-check-label ratings-star d-flex align-items-center"
                                                            for="five">
                                                            <span>
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <svg width="18" height="19"
                                                                        viewBox="0 0 18 19" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M9 0L7.093 5.188H1.65L5.532 8.312L3.728 13.594L9 10.5L14.272 13.594L12.468 8.312L16.35 5.188H10.907L9 0Z"
                                                                            fill="{{ $i <= 5 ? '#FFD700' : '#D3D3D3' }}" />
                                                                    </svg>
                                                                @endfor
                                                            </span>
                                                            <span>5 sao</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="ratings--list-item">
                                                    <!-- Lọc đánh giá 4 sao -->
                                                    <div class="form-check d-flex align-items-center">
                                                        <input class="form-check-input" type="checkbox" name="ratings[]"
                                                            value="4" id="four"
                                                            @if (in_array(4, request()->input('ratings', []))) checked @endif />
                                                        <label
                                                            class="form-check-label ratings-star d-flex align-items-center"
                                                            for="four">
                                                            <span>
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <svg width="18" height="19"
                                                                        viewBox="0 0 18 19" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M9 0L7.093 5.188H1.65L5.532 8.312L3.728 13.594L9 10.5L14.272 13.594L12.468 8.312L16.35 5.188H10.907L9 0Z"
                                                                            fill="{{ $i <= 4 ? '#FFD700' : '#D3D3D3' }}" />
                                                                    </svg>
                                                                @endfor
                                                            </span>
                                                            <span>4 sao</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="ratings--list-item">
                                                    <!-- Lọc đánh giá 3 sao -->
                                                    <div class="form-check d-flex align-items-center">
                                                        <input class="form-check-input" type="checkbox" name="ratings[]"
                                                            value="3" id="three"
                                                            @if (in_array(3, request()->input('ratings', []))) checked @endif />
                                                        <label
                                                            class="form-check-label ratings-star d-flex align-items-center"
                                                            for="three">
                                                            <span>
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <svg width="18" height="19"
                                                                        viewBox="0 0 18 19" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M9 0L7.093 5.188H1.65L5.532 8.312L3.728 13.594L9 10.5L14.272 13.594L12.468 8.312L16.35 5.188H10.907L9 0Z"
                                                                            fill="{{ $i <= 3 ? '#FFD700' : '#D3D3D3' }}" />
                                                                    </svg>
                                                                @endfor
                                                            </span>
                                                            <span>3 sao</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="ratings--list-item">
                                                    <!-- Lọc đánh giá 2 sao -->
                                                    <div class="form-check d-flex align-items-center">
                                                        <input class="form-check-input" type="checkbox" name="ratings[]"
                                                            value="2" id="two"
                                                            @if (in_array(2, request()->input('ratings', []))) checked @endif />
                                                        <label
                                                            class="form-check-label ratings-star d-flex align-items-center"
                                                            for="two">
                                                            <span>
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <svg width="18" height="19"
                                                                        viewBox="0 0 18 19" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M9 0L7.093 5.188H1.65L5.532 8.312L3.728 13.594L9 10.5L14.272 13.594L12.468 8.312L16.35 5.188H10.907L9 0Z"
                                                                            fill="{{ $i <= 2 ? '#FFD700' : '#D3D3D3' }}" />
                                                                    </svg>
                                                                @endfor
                                                            </span>
                                                            <span>2 sao</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="ratings--list-item">
                                                    <!-- Lọc đánh giá 1 sao -->
                                                    <div class="form-check d-flex align-items-center">
                                                        <input class="form-check-input" type="checkbox" name="ratings[]"
                                                            value="1" id="one"
                                                            @if (in_array(1, request()->input('ratings', []))) checked @endif />
                                                        <label
                                                            class="form-check-label ratings-star d-flex align-items-center"
                                                            for="one">
                                                            <span>
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <svg width="18" height="19"
                                                                        viewBox="0 0 18 19" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M9 0L7.093 5.188H1.65L5.532 8.312L3.728 13.594L9 10.5L14.272 13.594L12.468 8.312L16.35 5.188H10.907L9 0Z"
                                                                            fill="{{ $i <= 1 ? '#FFD700' : '#D3D3D3' }}" />
                                                                    </svg>
                                                                @endfor
                                                            </span>
                                                            <span>1 sao</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <!-- Nút Lọc -->
                                                <button type="submit" class="btn btn-primary btn-lg"
                                                    style="border-radius: 50px; padding: 10px 20px; font-size: 16px;">
                                                    <i class="bi bi-filter"></i> Lọc
                                                </button>

                                                <!-- Nút bỏ lọc -->
                                                <a href="{{ route('client.shop.shop') }}"
                                                    class="btn btn-outline-secondary px-4"
                                                    style="border-radius: 50px; padding: 10px 20px; font-size: 16px;">
                                                    Bỏ lọc</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!-- banner  -->
                            <div class="shop-item">
                                <div class="shop-img-banner">
                                    <img src="{{ asset('client/images/banner/banner-sm-19.jpg') }}" alt="banner-sm" />
                                    <div class="text-content">
                                        <h5><span>79%</span> Giảm giá</h5>
                                        <p>cho Đơn Hàng Nhanh Của Bạn</p>
                                        <a href="#" class="button button--md">
                                            Mua Ngay
                                            <span>
                                                <svg width="17" height="15" viewBox="0 0 17 15" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <!-- Desktop Version  -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row shop__product-items">
                        @foreach ($productData as $product)
                            <div class="col-xl-4 col-md-6">
                                <div class="cards-md cards-md--four w-100">
                                    <div class="cards-md__img-wrapper">
                                        <a href="product-details.html">
                                            @if (isset($product['image']) && $product['image'])
                                                <img src="{{ asset('' . $product['image']) }}"
                                                    alt="{{ $product['name'] }}" style="width: 300px; height: auto;">
                                            @else
                                                <p>Chưa có ảnh</p>
                                            @endif
                                        </a>
                                        <span class="tag danger font-body--md-400">sale 50%</span>
                                        <div class="cards-md__favs-list">
                                            <span class="action-btn">
                                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z"
                                                        stroke="currentColor" stroke-width="1.5"></path>
                                                </svg>
                                            </span>
                                            <span class="action-btn" data-bs-toggle="modal"
                                                data-bs-target="#productView">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10 3.54102C3.75 3.54102 1.25 10.0001 1.25 10.0001C1.25 10.0001 3.75 16.4577 10 16.4577C16.25 16.4577 18.75 10.0001 18.75 10.0001C18.75 10.0001 16.25 3.54102 10 3.54102V3.54102Z"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path
                                                        d="M10 13.125C10.8288 13.125 11.6237 12.7958 12.2097 12.2097C12.7958 11.6237 13.125 10.8288 13.125 10C13.125 9.1712 12.7958 8.37634 12.2097 7.79029C11.6237 7.20424 10.8288 6.875 10 6.875C9.1712 6.875 8.37634 7.20424 7.79029 7.79029C7.20424 8.37634 6.875 9.1712 6.875 10C6.875 10.8288 7.20424 11.6237 7.79029 12.2097C8.37634 12.7958 9.1712 13.125 10 13.125V13.125Z"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="cards-md__info d-flex justify-content-between align-items-center">
                                        <a href="product-details.html" class="cards-md__info-left">
                                            <h6 class="font-body--md-400">
                                                {{ \Illuminate\Support\Str::limit($product['name'], 50, '...') }}</h6>
                                            <div class="cards-md__info-price">
                                                <p>Giá: {{ number_format($product['price'], 0, ',', '.') }} VND</p>
                                            </div>
                                            <ul class="cards-md__info-rating d-flex">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <li>
                                                        <svg width="12" height="13" viewBox="0 0 12 13"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            class="{{ $i <= $product['rating'] ? 'filled' : 'empty' }}">
                                                            <path
                                                                d="M6.20663 9.44078L8.57101 10.9385C8.87326 11.1298 9.24826 10.8452 9.15863 10.4923L8.47576 7.80541C8.45647 7.73057 8.45869 7.6518 8.48217 7.57816C8.50566 7.50453 8.54945 7.43902 8.60851 7.38916L10.7288 5.62478C11.007 5.39303 10.8638 4.93066 10.5056 4.90741L7.73701 4.72741C7.66246 4.72212 7.59096 4.69577 7.53081 4.65142C7.47066 4.60707 7.42435 4.54656 7.39726 4.47691L6.36451 1.87666C6.33638 1.80276 6.28647 1.73916 6.22137 1.69428C6.15627 1.6494 6.07907 1.62537 6.00001 1.62537C5.92094 1.62537 5.84374 1.6494 5.77864 1.69428C5.71354 1.73916 5.66363 1.80276 5.63551 1.87666L4.60276 4.47691C4.57572 4.54663 4.52943 4.60722 4.46928 4.65164C4.40913 4.69606 4.33759 4.72246 4.26301 4.72778L1.49438 4.90778C1.13663 4.93066 0.992631 5.39303 1.27126 5.62478L3.39151 7.38953C3.4505 7.43936 3.49424 7.50481 3.51772 7.57837C3.54121 7.65193 3.54347 7.73062 3.52426 7.80541L2.89126 10.2973C2.78363 10.7207 3.23401 11.0623 3.59626 10.8324L5.79376 9.44078C5.85552 9.40152 5.92719 9.38066 6.00038 9.38066C6.07357 9.38066 6.14524 9.40152 6.20701 9.44078H6.20663Z"
                                                                class="{{ $i <= $product['rating'] ? 'filled' : 'empty' }}"
                                                                fill="{{ $i <= $product['rating'] ? '#FF8A00' : '#dcdcdc' }}">
                                                            </path>
                                                        </svg>
                                                    </li>
                                                @endfor
                                            </ul>

                                        </a>
                                        <div class="cards-md__info-right">
                                            <span class="action-btn">
                                                <!-- Button thêm vào giỏ hàng -->

                                                <form action="{{ route('cart.add', $product['id']) }}" method="POST">
                                                    @csrf

                                                    <button type="submit" class="btn btn-primary">
                                                        <svg width="20" height="21" viewBox="0 0 20 21"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M6.66667 8.83333H4.16667L2.5 18H17.5L15.8333 8.83333H13.3333M6.66667 8.83333V6.33333C6.66667 4.49239 8.15905 3 10 3V3C11.8409 3 13.3333 4.49238 13.3333 6.33333V8.83333M6.66667 8.83333H13.3333M6.66667 8.83333V11.3333M13.3333 8.83333V11.3333"
                                                                stroke="currentColor" stroke-width="1.3"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <nav aria-label="Page navigation pagination--one" class="pagination-wrapper section--xl"
                        style="padding-top: 20px;">
                        <ul class="pagination justify-content-center">

                            {{ $products->links() }}

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop list Section End   -->
@endsection
@section('js')
    <script src="{{ asset('client/lib/js/nouislider.min.js') }}"></script>

@endsection
