@extends('admin.layouts.base')

@section('mainContent')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>

                    <td>
                        <a href="#" class="btn btn-primary">View</a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-warning">Edit</a>
                    </td>
                    <td>
                        <form action="#" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- AGGIUNGI IL DELETE CONFIRM --}}
@endsection
