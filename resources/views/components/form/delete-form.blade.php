<form method="POST" action="{{ $route }}" id="delete-form" style="display: none" onsubmit="confirm('Är du säker på att radera denna post?');">
    @csrf
    @method("DELETE")
</form>