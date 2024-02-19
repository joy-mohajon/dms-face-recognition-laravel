@props(['messages'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <small {{ $attributes->merge(['class' => 'd-block form-text text-danger']) }}>{{ $message }}</small>
    @endforeach
    {{-- <ul {{ $attributes->merge(['class' => '']) }}>
        @foreach ((array) $messages as $message)
            <li></li>
        @endforeach
    </ul> --}}
@endif
