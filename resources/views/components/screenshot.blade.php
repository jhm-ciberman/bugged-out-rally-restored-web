@props(['src'])

<a href="{{ $src }}" class="screenshot-link" data-screenshot>
    <img src="{{ $src }}" {{ $attributes->class('framed-image') }}>
</a>
