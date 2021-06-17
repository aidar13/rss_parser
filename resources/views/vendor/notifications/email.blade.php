@component('mail::layout')
{{-- Header --}}
@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        {{ config('app.name') }}
{{--        <br>--}}
{{--        before urled logo--}}
{{--        <img src="{{ $url_img }}" class="logo" alt="{{config('app.name')}}">--}}

    @endcomponent
@endslot

{{--Greeting--}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hello!')
@endif
@endif

{{--Intro Lines--}}
@foreach ($introLines as $line)
{{ $line }}
@endforeach

{{-- Action Button--}}
@isset($actionText)
<?php
switch ($level) {
    case 'success':
    case 'error':
        $color = $level;
        break;
    default:
    $color = 'primary';
}
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{--Outro Lines--}}
@foreach ($outroLines as $line)
{{ $line }}
@endforeach

{{--Salutation--}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('default.auth.register.email.verify.regards'),<br>
{{ config('app.name') }}
@endif

{{--Subcopy--}}
@isset($actionText)
@slot('subcopy')
@lang('default.auth.register.email.verify.open_in_browser',
[
'actionText' => $actionText,
]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset

{{--Footer--}}
@slot('footer')
@component('mail::footer')
© 2021 <a href="https://agrobilim.kz/">Agrobilim.kz</a>. All rights reserved.
@endcomponent
@endslot
@endcomponent
