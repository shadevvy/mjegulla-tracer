<form action="{{ route('sites.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Site Name:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="url">Site URL:</label>
        <input type="url" id="url" name="url" required>
    </div>
    <button type="submit">Register Site</button>
</form>
