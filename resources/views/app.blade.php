<!doctype html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body>
<div class="container">
    {{--    <ul class="nav nav-pills mb-3">--}}
    {{--        <li class="nav-item">--}}
    {{--            <a class="nav-link active" href="{{route('phone-book.index')}}">На главную</a>--}}
    {{--        </li>--}}
    {{--    </ul>--}}
    <div class="card">
        <div class="card-header">
            @isset($backUrl)
                <a class="btn btn-info" style="color: white;" href="{{$backUrl}}"><i class="fas fa-arrow-left"></i></a>
            @endisset
            {{$bladeTitle??''}}
        </div>
        <div class="card-body">
            {!! $content !!}
        </div>
    </div>
</body>
@include('partials.footer')
</html>
