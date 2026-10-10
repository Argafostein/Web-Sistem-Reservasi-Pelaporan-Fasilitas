@if (session('success'))
    <div class="admin-alert">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="admin-alert error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
