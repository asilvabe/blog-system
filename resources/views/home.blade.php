{{ auth()->user() }}
@if(session('status'))
    <div class="card-header">
        {{ session('status') }}
    </div>
@endif
<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">Salir</button>
</form>
