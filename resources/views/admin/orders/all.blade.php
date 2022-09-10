@extends('layouts.admin.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 mt-4">
          <div class="col-12">
            <h1 class="m-0 text-dark">
                <a class="nav-link drawer" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                سفارشات</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title">لیست سفارشات</h3>

                          <div class="card-tools">
                              <div class="input-group input-group-sm" style="width: 150px;">
                                  <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

                                  <div class="input-group-append">
                                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="table table-striped table-valign-middle mb-0">
                          <table class="table table-hover mb-0">
                              <tbody>
                              <tr>
                                <th>آیدی</th>
                                  <th>کاربر</th>
                                  <th>مبلغ</th>
                                  <th>کد رهگیری</th>
                                  <th>وضعیت</th>
                                  <th>تاریخ</th>
                                  <th>مشاهده سفارش</th>
                                 
                                  
                                  
                                  
                                  
                              </tr>
                              @foreach ($orders as $key => $order)
                              <tr>
                                <td>{{$key+1}}</td>
                                  <td>{{$order->user->name}}</td>
                                  <td>{{$order->amount}} تومان </td>
                                  <td>{{$order->ref_code}}</td>
                                  <td>
                                    @if($order->status=="paid")
                                    <span class="badge bg-success">موفق</span>
                                    @else
                                    <span class="badge bg-danger">ناموفق</span>
                                    @endif
                                  </td>
                                  <td>{{Verta::instance($order['created_at'])}}</td>
                                  <td>
                                   <a href="{{route('admin.orders.items.all',$order->id)}}"><i class="fa fa-shopping-cart"></i></a> 
                                  </td>
                              </tr>
                              @endforeach
                              </tbody>
                          </table>
                      </div>
                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                  <div class="d-flex justify-content-center">
                     {{$orders->links()}}
                  </div>
              </div>
          </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



   

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

@endsection