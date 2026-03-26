@if (Session::has('warning'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-cloak
     class="alert alert-warning alert-dismissible" role="alert">
    {{ Session::get('warning') }}
    <button type="button" class="btn-close" @click="show = false" aria-label="Close"></button>
</div>
@endif

@if (Session::has('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-cloak
     class="alert alert-success alert-dismissible" role="alert">
    {{ Session::get('success') }}
    <button type="button" class="btn-close" @click="show = false" aria-label="Close"></button>
</div>
@endif

@if (count($errors) > 0)
@foreach ($errors->all() as $error)
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 8000)" x-cloak
     class="alert alert-danger alert-dismissible" role="alert">
    {{ $error }}
    <button type="button" class="btn-close" @click="show = false" aria-label="Close"></button>
</div>
@endforeach
@endif