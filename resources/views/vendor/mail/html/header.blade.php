@props(['url'])
<tr>
<td class="header">
    <div>
        <img src="{{ asset('img/logo/logo_transparent.png') }}" alt="Vyuctovano Logo" class="logo">
    </div>
    <a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo" style="height: 60px">
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>
