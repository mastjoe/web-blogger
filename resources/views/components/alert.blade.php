@props([
    'type', 
    'dismissable'
])

<div class="alert alert-{{ $type }} alert-dismissible" role="alert">
    <div>{{ $slot }}</div>
    @isset($dismissable)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endisset
</div>