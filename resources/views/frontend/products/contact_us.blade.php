@extends('layouts.frontend.master')
@section('content')
 @include('errors.message')   
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-t-30">
            <a href="{{route('home.products.all')}}" class="mtext-106 cl8 hov-cl1 trans-04">
                خانه
                <i class="fa fa-angle-left m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{route('home.product.contact_us')}}" class="mtext-106 cl8 hov-cl1 trans-04">
                تماس با ما
                <i class="fa fa-angle-left m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

           
        </div>
    </div>
    <div class="container">
<section class="p-t-30">
   <p>آدرس:ساری کمربندی غربی کوی شهید بخشی</p><br>
   <p>09387589696</p><br>
   <p>09112580898</p><br>
   <p>m.ebrahimi.talo1990@gmail.com</p><br>
</section>
</div>

    @endsection
