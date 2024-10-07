@props(['name'])

@error($name)
    <p {{ $attributes->merge(['class' => 'text-sm text-red-500 font-semibold']) }}>{{ $message }}</p>
@enderror