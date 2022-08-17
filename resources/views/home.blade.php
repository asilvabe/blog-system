{{ auth()->user() }}
<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">Salir</button>
</form>
