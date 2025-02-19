@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">User List</h2>

    <!-- Form Search -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search by name...">
    </div>

    <!-- Bootstrap Table -->
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        let searchValue = this.value;

        fetch("{{ route('admin.users.search') }}?search=" + searchValue)
            .then(response => response.json())
            .then(data => {
                let tableBody = document.getElementById('userTableBody');
                tableBody.innerHTML = "";

                if (data.length > 0) {
                    data.forEach((user, index) => {
                        let row = `<tr>
                            <td>${index + 1}</td>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>${user.role}</td>
                            <td>${user.phone}</td>
                            <td><a href="#" class="btn btn-danger btn-sm">Delete</a></td>
                        </tr>`;
                        tableBody.innerHTML += row;
                    });
                } else {
                    tableBody.innerHTML = '<tr><td colspan="6" class="text-center">No users found.</td></tr>';
                }
            });
    });
</script>
@endsection
