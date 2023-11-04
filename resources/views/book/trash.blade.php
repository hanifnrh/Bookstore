@extends('book.layout')

@section('content')

<h4 class="mt-5">Book Data</h4>

<a href="{{ route('book.create') }}" type="button" class="btn btn-success rounded-3">Add Data</a>
<a href="{{ route('book.ascending') }}" type="button" class="btn btn-secondary rounded-3">Ascending</a>
<a href="{{ route('book.descending') }}" type="button" class="btn btn-secondary rounded-3">Descending</a>

@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif

<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>Book Title</th>
            <th>Author</th>
            <th>Publish Date</th>
            <th>Language</th>
            <th>Genre</th>
            <th>Shelf Number</th>
            
        </tr>
    </thead>
    
    <div class="mt-3">
    <form method="GET" action="{{ route('book.search') }}">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Search Book">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    </div>


    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->book_title }}</td>
            <td>{{ $data->author }}</td>
            <td>{{ $data->publication_date }}</td>
            <td>{{ $data->book_language }}</td>
            <td>{{ $data->category_name }}</td>
            <td>{{ $data->shelf_number }}</td>
            <td>
                <a href="{{ route('book.edit', $data->book_id) }}" type="button" class="btn btn-warning rounded-3">Update</a>


                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $data->book_id }}">
                    Delete
                </button>

                <!-- Modal -->
                <div class="modal fade" id="hapusModal{{ $data->book_id }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Confirm</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('book.deletereal', $data->book_id) }}">
                                @csrf
                                <div class="modal-body">
                                    Are you sure you want do delete this data?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Yes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop