@extends('layouts.frontend.master')
@section('content')
<!-- Product -->
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
            @include('errors.message')
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="mtext-106 cl6 hov1 bor3 trans-04 m-l-32 m-tb-5 how-active1" data-filter="*">
						همه دسته بندی ها
					</button>
					@foreach ($categories as $category)
					<button class="mtext-106 cl6 hov1 bor3 trans-04 m-l-32 m-tb-5" data-filter=".category{{$category->id}}">
						{{$category->title}}
					</button>
					@endforeach

					

					
				</div>

				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-filter">
						<i class="icon-filter cl2 m-l-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
						<i class="icon-close-filter cl2 m-l-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						فیلتر کردن
					</div>

					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 m-r-8 js-show-search">
                        <form method="post" action="{{route('home.search')}}">
                            <i class="icon-search cl2 m-l-6 fs-15 trans-04 zmdi zmdi-search"></i>
                            <i class="icon-close-search cl2 m-l-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                            جستجو
                        </form>
						
					</div>
				</div>
				
				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
                        <form class="flex-w p-l-15" method="post" action="{{route('home.search')}}">
                            @csrf
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search" placeholder="متن خود را اینجا بنویسید و ...">
                    </form>
					</div>	
				</div>

				<!-- Filter -->
				<div class="dis-none panel-filter w-full p-t-10">
					<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">

                        <div class="filter-col1 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                نوع محصول
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="{{route('home.popular.search.free')}}" class="filter-link stext-106 trans-04 ">
                                        رایگان
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{route('home.popular.search.money')}}" class="filter-link stext-106 trans-04">
                                        پولی
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-col2 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                قیمت
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="{{route('home.popular.search.all')}}" class="filter-link stext-106 trans-04">
                                        همه
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{route('home.popular.search.200')}}" class="filter-link stext-106 trans-04">
                                         تا 200 هزار تومان
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{route('home.popular.search.201to400')}}" class="filter-link stext-106 trans-04">
                                        201 الی 400 هزار تومان
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{route('home.popular.search.401toup')}}" class="filter-link stext-106 trans-04">
                                        بیشتر از401 هزار تومان
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-col3 p-r-15 p-b-27 mr-auto">
                            <div class="mtext-102 cl2 p-b-15">
                                مرتب سازی براساس
                            </div>

                            <ul>

                                <li class="p-b-6">
                                    <a href="{{route('home.search.newest')}}" class="filter-link stext-106 trans-04 filter-link-active">
                                        جدیدترین
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{route('home.search.lesstomore')}}" class="filter-link stext-106 trans-04">
                                        قیمت:‌ کم به زیاد
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{route('home.search.moretoless')}}" class="filter-link stext-106 trans-04">
                                        قیمت:‌زیاد به کم
                                    </a>
                                </li>
                            </ul>
                        </div>

					</div>
				</div>
			</div>

			<div class="row isotope-grid">
				@foreach ($products as $product)
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item  category{{$product->category_id}}">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="/{{$product->demo_url}}" alt="IMG-PRODUCT">

						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="{{route('home.product.show',$product->id)}}" class="mtext-106 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									{{$product->title}}
								</a>

								<span class="stext-105 cl3">
									{{$product->price}} هزار تومان
								</span>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>


    <!-- Modal1 -->
    <div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
        <div class="overlay-modal1 js-hide-modal1"></div>

        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="/images/icons/icon-close.png" alt="CLOSE">
                </button>

                <div class="row">
                    <div class="col-md-6 col-lg-7 p-b-30">
                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                            <div class="wrap-slick3 flex-sb flex-w">
                                <div class="wrap-slick3-dots"></div>
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                <div class="slick3 gallery-lb">
                                    <div class="item-slick3" data-thumb="/{{$product->thumbnail_url}}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="/{{$product->thumbnail_url}}" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="/{{$product->thumbnail_url}}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="item-slick3" data-thumb="/{{$product->demo_url}}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="/{{$product->demo_url}}" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="/{{$product->demo_url}}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="item-slick3" data-thumb="/{{$product->source_url}}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="/{{$product->source_url}}" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="/{{$product->source_url}}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-l-50 p-t-5 p-lr-0-lg">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                {{$product->title}}
                            </h4>

                            <span class="mtext-106 cl2">
								{{$product->price}} هزار تومان
							</span>

                            <p class="stext-102 cl3 p-t-23">
                                {{$product->description}}
                            </p>

                            <!--  -->
                            <div class="p-t-33">

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="flex-w flex-m respon6-next">
                                        <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                            افزودن به سبد خرید
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	@endsection