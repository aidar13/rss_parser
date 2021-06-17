{{--<!DOCTYPE html>--}}
{{--<html lang="ru">--}}
{{--<head>--}}
{{--    @include('admin.layouts.partials.head')--}}
{{--</head>--}}
{{--<body>--}}
{{--<input id="lang" type="hidden" value="ru">--}}
{{--    <div class="main-wrapper">--}}
{{--    @include('admin.layouts.partials.sidebar')--}}

{{--        <main class="main">--}}

{{--            @yield('content')--}}

{{--        </main>--}}

{{--        @include('admin.layouts.partials.footer')--}}
{{--    </div>--}}

{{--    @include('admin.layouts.partials.scripts')--}}

{{--    @yield('scripts')--}}

{{--</body>--}}
{{--</html>--}}



<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.layouts.partials.head')
</head>
<body>

<input id="lang" type="hidden" value="ru">
<div class="main-wrapper">
    @include('admin.layouts.partials.sidebar')

    <div class="right-wrapper">
        @include('admin.layouts.partials.header')

        <main class="main">

            @yield('content')

        </main>

        @include('admin.layouts.partials.footer')

    </div>
</div>

@include('admin.layouts.partials.scripts')

@yield('scripts')

</body>
</html>
