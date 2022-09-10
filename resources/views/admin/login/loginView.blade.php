<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <title>ورود ادمین</title>
</head>


<body>
    <div class="login">
        <h1> ورود ادمین</h1>
        <form action="{{route('adminLogin')}}" method="post">
            @csrf

            <input type="text" name="national_code" value="{{old('national_code')}}" placeholder="کدملی" required="required" />
            @error('national_code')
            <span class="alert_required bg-danger text-white p-1 rounded" style="margin-bottom: 5px;" role="alert">
                <strong style="color: red;">
                    {{ $message }}
                </strong>
            </span>
            @enderror
            <input type="password" name="password" placeholder="رمز عبور" required="required" />
            @error('password')
            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                <strong style="color: red;">
                    {{ $message }}
                </strong>
            </span>
            @enderror
            
                @if (session('response'))
                <div class="alert alert-success"  style="color: red;">
                    {{ session('response') }}
                </div>
                @endif
            
            <button type="submit" class="btn btn-primary btn-block btn-large ">ورود</button>
            <a class="btn btn-primary btn-block btn-large " href="{{route('sendPasswordView')}}">فراموشی رمز</a>
        </form>
    </div>


</body>

</html>