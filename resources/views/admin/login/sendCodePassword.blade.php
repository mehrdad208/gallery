<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/login.css')}}">
  <title>ارسال کد</title>
</head>


<body>
    <div class="login">
        <h1>ارسال کد به ادمین</h1>
        <form action="{{route('sendSmsForAdminLogin')}}" method="post">
        @csrf
            <input type="text" name="national_code" placeholder="کدملی" required="required" />
            @error('national_code')
            <div class="alert alert-success"  style="color: red;">
                    {{ $message }}
                    </div>
            @enderror
            @if (session('response'))
                <div class="alert alert-success"  style="color: red;">
                    {{ session('response') }}
                </div>
                @endif
            <button type="submit" class="btn btn-primary btn-block btn-large ">ارسال رمز </button>
         
        </form>
    </div>
    

</body>
</html>