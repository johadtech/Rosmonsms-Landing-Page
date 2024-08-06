<h2>User Details</h2>
<p>ID: {{ $user->id }}</p>
<p>Name: {{ $user->name }}</p>
<p>Email: {{ $user->email }}</p>
<p>Status: {{ $user->status }}</p>
<a href="{{ route('admin.users.edit', $user->id) }}">Edit</a>