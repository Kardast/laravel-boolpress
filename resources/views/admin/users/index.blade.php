@extends('admin.layouts.base')


@section('mainContent')
    <h1>Users</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Birth</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr data-id="{{ $user->id }}">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                    @php
                        $details = $user->userDetails()->first()
                    @endphp
                    <td>{{ $details ? ($details->address ?: '-') : '-' }}</td>
                    <td>{{ $details ? ($details->phone ?: '-') : '-' }}</td>
                    <td>{{ $details ? ($details->birth ?: '-') : '-' }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
