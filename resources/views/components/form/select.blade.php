@php
    $input_name = $attributes->get('name');
    $invalid_class = null;
@endphp

@error($input_name)
    @php
        $invalid_class = "is-invalid";
    @endphp
@enderror

<select {{ $attributes->merge(['class' => 'form-control '.$invalid_class]) }}>
    {{ $slot }}
</select>
@error($input_name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror