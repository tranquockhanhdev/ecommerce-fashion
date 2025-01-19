@extends('layouts.client')
@section('title', 'Chi Tiết Bài Viết | Synergy 4.0')
@section('content')
    <!-- Single blog section start  -->
    <section class="single-blog section">
        <div class="container">
            <div class="row single-blog__content">
                <div class="col-lg-8">
                    <div class="single-blog__product-content">
                        
                        <div class="single-blog--tag-info">
                            <div class="single-blog--tag-item">
                                <span class="icon">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.1584 11.6753L11.1834 17.6503C11.0286 17.8053 10.8448 17.9282 10.6425 18.0121C10.4402 18.096 10.2233 18.1391 10.0042 18.1391C9.78522 18.1391 9.56834 18.096 9.36601 18.0121C9.16368 17.9282 8.97987 17.8053 8.82508 17.6503L1.66675 10.5003V2.16699H10.0001L17.1584 9.32533C17.4688 9.6376 17.6431 10.06 17.6431 10.5003C17.6431 10.9406 17.4688 11.3631 17.1584 11.6753V11.6753Z"
                                            stroke="#00B307" stroke-width="1.2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M5.8335 6.33398H5.84183" stroke="#00B307" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                {{ optional($article->category)->name }} <!-- Hiển thị tên thể loại từ cơ sở dữ liệu -->
                            </div>
                            <div class="single-blog--tag-item">
                                <span class="icon">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.99984 9.66667C11.8408 9.66667 13.3332 8.17428 13.3332 6.33333C13.3332 4.49238 11.8408 3 9.99984 3C8.15889 3 6.6665 4.49238 6.6665 6.33333C6.6665 8.17428 8.15889 9.66667 9.99984 9.66667Z"
                                            stroke="#00B307" stroke-width="1.2" />
                                        <path
                                            d="M12.4999 12.167H7.49995C5.19828 12.167 3.13745 14.292 4.65161 16.0245C5.68161 17.2028 7.38495 18.0003 9.99995 18.0003C12.6149 18.0003 14.3174 17.2028 15.3474 16.0245C16.8624 14.2912 14.8008 12.167 12.4999 12.167Z"
                                            stroke="#00B307" stroke-width="1.2" />
                                    </svg>
                                </span>
                                <p>by <span>{{ optional($article->author)->name }}</span></p>
                                <!-- Hiển thị tên tác giả từ cơ sở dữ liệu -->
                            </div>
                            <div class="single-blog--tag-item">
                                <span class="icon">
                                    <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.25 3.5H3.75C2.92157 3.5 2.25 4.17157 2.25 5V15.5C2.25 16.3284 2.92157 17 3.75 17H14.25C15.0784 17 15.75 16.3284 15.75 15.5V5C15.75 4.17157 15.0784 3.5 14.25 3.5Z"
                                            stroke="#00B307" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M12 2V5" stroke="#00B307" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M6 2V5" stroke="#00B307" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M2.25 8H15.75" stroke="#00B307" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <p>{{ \Carbon\Carbon::parse($article->created_at)->format('d F, Y') }}</p>
                                <!-- Hiển thị ngày tháng tạo bài viết -->
                            </div>

                        </div>
                        <h2 class="font-title--sm blog-head-title">
                            {{ $article->title }}<!-- Hiển thị tiêu đề bài viết từ cơ sở dữ liệu -->
                        </h2>
                    </div>

                    <!-- Text Contents of Blogs  -->
                    <div class="single-blog__inner-content">
                        <p>
                            {{ $article->content }}
                        </p>
                        <div class="single-blog--sm-img">
                            <div class="single-blog__img-wrapper two">
                                <img src="{{ asset('storage/' . $article->image_url) }}" />
                            </div>
                            <div class="single-blog__img-wrapper three">
                                <img src="{{ asset('storage/' . $article->image_url) }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
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
                                                    {{ Str::limit($recentArticle->title, 50) }}
                                                    <!-- Giới hạn tiêu đề nếu quá dài -->
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
                                                            <path d="M2.25 8H15.75" stroke="#00B307"
                                                                stroke-linecap="round" stroke-linejoin="round" />
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
                </div>
            </div>

        </div>
    </section>
    <!-- Single blog section  end  -->

@endsection
