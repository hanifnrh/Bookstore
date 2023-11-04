@extends('book.layout')

@section('content')

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach
    </ul>
</div>
@endif

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title fw-bolder mb-3">Change Data</h5>
        <form method="post" action="{{ route('book.update', $data->book_id) }}">
            @csrf
            <div class="mb-3">
                <label for="book_id" class="form-label">Book ID</label>
                <input type="text" class="form-control" id="book_id" name="book_id" value="{{ $data->book_id }}">
            </div>
            <div class="mb-3">
                <label for="book_title" class="form-label">Book Title</label>
                <input type="text" class="form-control" id="book_title" name="book_title"
                    value="{{ $data->book_title }}">
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" value="{{ $data->author }}">
            </div>
            <div class="mb-3">
                <label for="publication_date" class="form-label">Publish Date</label>
                <input type="text" class="form-control" id="publication_date" name="publication_date"
                value="{{ $data->publication_date }}">
            </div>
            <div class="mb-3">
                <label for="book_language" class="form-label">Language</label>
                <input type="text" class="form-control" id="book_language" name="book_language"
                value="{{ $data->book_language }}">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Genre</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value = "1">History</option>
                    <option value = "2">Physical Science</option>
                    <option value = "3">Novel</option>
                    <option value = "4">Philosophy</option>>
                    <option value = "5">Romance</option>
                    <option value = "6">Conspiracy</option>
                    <option value = "7">Religion</option>
                </select>
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Change" />
            </div>
        </form>
    </div>
</div>
@stop
