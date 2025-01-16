@extends('layouts.client')
@section('title', 'Danh Sách Bài Viết | Synergy 4.0')

@section('content')
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
                    <div class="filter--search-result justify-content-end">
                        <div class="sort-list">
                            <form method="GET" action="{{ route('client.blog.blog-list') }}" id="sortForm">
                                <div class="filter--search-result d-flex justify-content-end align-items-center">
                                    <div class="sort-list">
                                        <label for="sort" class="me-2">Sắp Xếp Theo:</label>
                                        <select name="sort" id="sort" class="form-select sort-list__dropmenu"
                                            onchange="document.getElementById('sortForm').submit()">
                                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới
                                                Nhất</option>
                                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Cũ
                                                Nhất
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog-list section start  -->
    <section class="blog-list section">
        <div class="container">
            <div class="row blog-list__wrapper shop-content">
                <div class="col-lg-3">
                    <div class="sidebar">
                        <!-- filter btn  -->
                        <button class="filter">
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
                        <div class="blog__sidebar">
                            <!-- Search Field  -->
                            <div class="blog__sidebar--item">
                                <form action="{{ route('client.blog.search') }}" method="GET">
                                    <div class="blog__search-field">
                                        <input type="text" name="search" value="{{ request()->input('search') }}"
                                            placeholder="Search..." />
                                        <div class="icon">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9.80577 17.2971C13.9428 17.2971 17.2966 13.9433 17.2966 9.80626C17.2966 5.66919 13.9428 2.31543 9.80577 2.31543C5.6687 2.31543 2.31494 5.66919 2.31494 9.80626C2.31494 13.9433 5.6687 17.2971 9.80577 17.2971Z"
                                                    stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M15.0149 15.4043L17.9516 18.3335" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Top Categories  -->
                        <div class="blog__sidebar--item">
                            <h5 class="font-body--xxl-500">Danh Mục Hàng Đầu</h5>
                            <div class="blog__top-categories">
                                @foreach ($categories as $category)
                                    <div class="blog__top-categories-item">
                                        <p class="font-body--md-400">{{ $category->name }}</p>
                                        <p class="font-body--md-400 number">{{ $category->articles_count }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Gallery  -->
                        <div class="blog__sidebar--item">
                            <h5 class="font-body--xxl-500">Bộ Sưu Tập</h5>
                            <div class="blog-gallery">
                                <div class="blog-gallery__item">
                                    <a href="#" class="cards-ig">
                                        <div class="cards-ig__img">
                                            <img src="{{ asset('client/images/instagram//img-01-sm.png') }}"
                                                alt="ig" />
                                            <div class="cards-ig__overlay">
                                                <span>
                                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.0027 24.0548C8.72269 24.0548 8.33602 24.0375 7.05602 23.9815C6.05785 23.9487 5.07259 23.7458 4.14269 23.3815C3.34693 23.0718 2.62426 22.6 2.02058 21.9961C1.4169 21.3922 0.945397 20.6694 0.636019 19.8735C0.28576 18.9402 0.0968427 17.9542 0.0773522 16.9575C0.00268554 15.6802 0.00268555 15.2615 0.00268555 12.0068C0.00268555 8.7175 0.0200189 8.3335 0.0773522 7.06017C0.0972691 6.06486 0.28618 5.08018 0.636019 4.14817C0.945042 3.35128 1.41686 2.62761 2.02134 2.02335C2.62583 1.4191 3.34968 0.947556 4.14669 0.638836C5.07821 0.287106 6.06315 0.0976949 7.05869 0.0788358C8.33202 0.0068358 8.75069 0.00683594 12.0027 0.00683594C15.3094 0.00683594 15.6894 0.0241691 16.9494 0.0788358C17.9467 0.0975025 18.936 0.286836 19.8694 0.638836C20.6661 0.947914 21.3898 1.41958 21.9943 2.02379C22.5987 2.628 23.0706 3.35149 23.38 4.14817C23.736 5.09484 23.9267 6.09484 23.9414 7.10417C24.016 8.3815 24.016 8.79883 24.016 12.0522C24.016 15.3055 23.9974 15.7322 23.9414 16.9948C23.9214 17.9924 23.7321 18.9794 23.3814 19.9135C23.0712 20.7099 22.5988 21.4332 21.9942 22.0373C21.3896 22.6414 20.666 23.1133 19.8694 23.4228C18.936 23.7722 17.9507 23.9615 16.9547 23.9815C15.6814 24.0548 15.264 24.0548 12.0027 24.0548ZM11.9574 2.1175C8.69602 2.1175 8.35735 2.1335 7.08402 2.19084C6.32355 2.20078 5.57042 2.34103 4.85735 2.6055C4.33726 2.80486 3.86471 3.11098 3.47017 3.50414C3.07563 3.89731 2.76786 4.36878 2.56669 4.88817C2.30002 5.60817 2.16002 6.3695 2.15202 7.1375C2.08135 8.4295 2.08135 8.76817 2.08135 12.0068C2.08135 15.2068 2.09335 15.5948 2.15202 16.8788C2.16402 17.6388 2.30402 18.3922 2.56669 19.1055C2.97469 20.1548 3.80669 20.9842 4.85869 21.3868C5.57083 21.653 6.32382 21.7933 7.08402 21.8015C8.37469 21.8762 8.71469 21.8762 11.9574 21.8762C15.228 21.8762 15.5667 21.8602 16.8294 21.8015C17.5899 21.7923 18.3432 21.652 19.056 21.3868C19.5733 21.186 20.0432 20.8796 20.4357 20.4873C20.8282 20.095 21.1348 19.6254 21.336 19.1082C21.6027 18.3882 21.7427 17.6255 21.7507 16.8575H21.7654C21.8227 15.5828 21.8227 15.2428 21.8227 11.9855C21.8227 8.72817 21.808 8.3855 21.7507 7.11217C21.7386 6.35278 21.5984 5.60088 21.336 4.88817C21.1353 4.37023 20.8289 3.89977 20.4364 3.50677C20.0438 3.11376 19.5737 2.80682 19.056 2.6055C18.3427 2.33884 17.5894 2.20017 16.8294 2.19084C15.54 2.1175 15.2027 2.1175 11.9574 2.1175ZM12.0027 18.1655C10.7834 18.1663 9.59136 17.8055 8.5772 17.1287C7.56304 16.4519 6.77236 15.4896 6.30517 14.3634C5.83798 13.2373 5.71526 11.9978 5.95254 10.8019C6.18982 9.60598 6.77644 8.50729 7.63819 7.64478C8.49995 6.78228 9.59814 6.19471 10.7939 5.9564C11.9896 5.71808 13.2291 5.83973 14.3557 6.30594C15.4823 6.77216 16.4453 7.56201 17.1229 8.57558C17.8006 9.58916 18.1624 10.7809 18.1627 12.0002C18.1606 13.6337 17.5111 15.1999 16.3565 16.3555C15.2018 17.5111 13.6363 18.162 12.0027 18.1655ZM12.0027 7.9975C11.2116 7.9975 10.4382 8.2321 9.78041 8.67162C9.12261 9.11115 8.60992 9.73586 8.30717 10.4668C8.00442 11.1977 7.9252 12.0019 8.07954 12.7779C8.23388 13.5538 8.61485 14.2665 9.17426 14.8259C9.73367 15.3853 10.4464 15.7663 11.2223 15.9206C11.9982 16.075 12.8025 15.9958 13.5334 15.693C14.2643 15.3903 14.889 14.8776 15.3286 14.2198C15.7681 13.562 16.0027 12.7886 16.0027 11.9975C16.0002 10.9374 15.578 9.92141 14.8284 9.1718C14.0788 8.42219 13.0628 7.99997 12.0027 7.9975ZM18.4027 7.04683C18.2139 7.04613 18.0272 7.00826 17.8531 6.93538C17.6789 6.8625 17.5209 6.75604 17.3879 6.62208C17.1193 6.35153 16.9693 5.98537 16.9707 5.60417C16.9721 5.22296 17.1249 4.85793 17.3954 4.58938C17.666 4.32083 18.0321 4.17075 18.4134 4.17217C18.7946 4.17358 19.1596 4.32637 19.4281 4.59693C19.6967 4.86748 19.8468 5.23363 19.8454 5.61484C19.8439 5.99604 19.6912 6.36107 19.4206 6.62962C19.15 6.89817 18.7839 7.04825 18.4027 7.04683Z"
                                                            fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Recent Added Products  -->
                        <div class="blog__sidebar--item">
                            <h5 class="font-body--xxl-500">Đã Thêm Gần Đây</h5>
                            <div class="blog__recent-product">
                                @foreach ($recentArticles as $recentArticle)
                                    <a href="{{ route('article.show', $recentArticle->id) }}"
                                        class="blog__recent-product__item">
                                        <div class="blog__recent-product__img-wrapper">
                                            <!-- Hiển thị ảnh đại diện của bài viết -->
                                            <img src="{{ asset($recentArticle->image_url) }}" />
                                        </div>
                                        <div class="blog__recent-product__item-info">
                                            <h5 class="font-body--lg-500">
                                                {{ Str::limit($recentArticle->title, 50) }}<!-- Giới hạn tiêu đề nếu quá dài -->
                                            </h5>
                                            <div class="date">
                                                <span class="icon">
                                                    <svg width="18" height="19" viewBox="0 0 18 19"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M14.25 3.5H3.75C2.92157 3.5 2.25 4.17157 2.25 5V15.5C2.25 16.3284 2.92157 17 3.75 17H14.25C15.0784 17 15.75 16.3284 15.75 15.5V5C15.75 4.17157 15.0784 3.5 14.25 3.5Z"
                                                            stroke="#00B307" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M12 2V5" stroke="#00B307" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M6 2V5" stroke="#00B307" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M2.25 8H15.75" stroke="#00B307" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </span>

                                                <p>{{ $recentArticle->created_at->format('M d, Y') }}</p>
                                                <!-- Hiển thị ngày tạo -->
                                            </div>
                                        </div>
                                    </a>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <!-- Desktop Version  -->
                    <div class="row blog-list__content--desktop">

                        @if (isset($query) && $query)
                            <h3>Kết quả tìm kiếm cho: "{{ $query }}"</h3>
                        @endif
                        <!-- Hiển thị các bài viết -->
                        @foreach ($articles as $article)
                            <div class="col-xl-6 custom-col">
                                <div class="cards-blog">
                                    <div class="cards-blog__img-wrapper">
                                        <img src="{{ asset('storage/' . $article->image_url) }}" />
                                        <div class="date">
                                            <h3 class="font-body--xxl-500">
                                                {{ \Carbon\Carbon::parse($article->created_at)->format('d') }}
                                            </h3>
                                            <span
                                                class="font-body--sm-500">{{ \Carbon\Carbon::parse($article->created_at)->format('M') }}</span>

                                        </div>
                                    </div>
                                    <div class="cards-blog__info">
                                        <div class="cards-blog__info-tags d-flex">
                                            <div class="cards-blog__info-tags-item">
                                                <span class="icon">
                                                    <svg width="20" height="21" viewBox="0 0 20 21"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M17.1584 11.6753L11.1834 17.6503C11.0286 17.8053 10.8448 17.9282 10.6425 18.0121C10.4402 18.096 10.2233 18.1391 10.0042 18.1391C9.78522 18.1391 9.56834 18.096 9.36601 18.0121C9.16368 17.9282 8.97987 17.8053 8.82508 17.6503L1.66675 10.5003V2.16699H10.0001L17.1584 9.32533C17.4688 9.6376 17.6431 10.06 17.6431 10.5003C17.6431 10.9406 17.4688 11.3631 17.1584 11.6753V11.6753Z"
                                                            stroke="#00B307" stroke-width="1.2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M5.8335 6.33398H5.84183" stroke="#00B307"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                                {{ optional($article->category)->name }}
                                                <!-- Sử dụng optional để tránh lỗi nếu không có category -->
                                            </div>
                                            <div class="cards-blog__info-tags-item">
                                                <span class="icon">
                                                    <svg width="20" height="21" viewBox="0 0 20 21"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9.99984 9.66667C11.8408 9.66667 13.3332 8.17428 13.3332 6.33333C13.3332 4.49238 11.8408 3 9.99984 3C8.15889 3 6.6665 4.49238 6.6665 6.33333C6.6665 8.17428 8.15889 9.66667 9.99984 9.66667Z"
                                                            stroke="#00B307" stroke-width="1.2" />
                                                        <path
                                                            d="M12.4999 12.167H7.49995C5.19828 12.167 3.13745 14.292 4.65161 16.0245C5.68161 17.2028 7.38495 18.0003 9.99995 18.0003C12.6149 18.0003 14.3174 17.2028 15.3474 16.0245C16.8624 14.2912 14.8008 12.167 12.4999 12.167Z"
                                                            stroke="#00B307" stroke-width="1.2" />
                                                    </svg>
                                                </span>
                                                By {{ $article->author }} <!-- Thay 'author' nếu có trường tác giả -->
                                            </div>
                                        </div>
                                        <a href="{{ route('article.show', $article->id) }}"
                                            class="blog-title font-body--xl-500">{{ $article->title }}</a>
                                        <a href="{{ route('article.show', $article->id) }}">
                                            Read More
                                            <span>
                                                <svg width="17" height="15" viewBox="0 0 17 15" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <nav aria-label="Page navigation pagination--one" class="pagination-wrapper">
                <ul class="pagination justify-content-center">
                    <!-- Nút Prev -->
                    @if ($articles->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link pagination-link" href="#" tabindex="-1">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.91663 1.16634L1.08329 6.99967L6.91663 12.833" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link pagination-link" href="{{ $articles->previousPageUrl() }}">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.91663 1.16634L1.08329 6.99967L6.91663 12.833" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                    @endif

                    <!-- Hiển thị số trang -->
                    @foreach ($articles->links()->elements[0] as $page => $url)
                        <li class="page-item {{ $articles->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link pagination-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    <!-- Nút Next -->
                    @if ($articles->hasMorePages())
                        <li class="page-item">
                            <a class="page-link pagination-link" href="{{ $articles->nextPageUrl() }}">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.08337 1.16634L6.91671 6.99967L1.08337 12.833" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link pagination-link" href="#">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.08337 1.16634L6.91671 6.99967L1.08337 12.833" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </section>
    <!-- Blog-list section  end  -->
@endsection
