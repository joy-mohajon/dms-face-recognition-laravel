@if (session('success'))
    <div
        {{ $attributes->merge(['class' => 'alert alert-default-success alert-dismissible fade show', 'role' => 'alert']) }}>
        {{ session('success') }}
    </div>
@elseif (session('error'))
    <div
        {{ $attributes->merge(['class' => 'alert alert-default-danger alert-dismissible fade show', 'role' => 'alert']) }}>
        {{ session('error') }}
    </div>
@endif
