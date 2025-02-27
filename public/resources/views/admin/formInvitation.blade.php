<form method="POST" action="{{ route('admin.sendInvitation') }}">
    @csrf
    <input type="email" name="email" value="{{ old('email') }}" required>

    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <select name="role" required>
        <option value="developer">Développeure</option>
        <option value="client">Client</option>
    </select>
    <button type="submit">Envoyer l'invitation</button>
</form>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
