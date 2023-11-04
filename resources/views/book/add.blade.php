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
        <h5 class="card-title fw-bolder mb-3">Add Book</h5>
        <form method="post" action="{{route('book.store')}}">
            @csrf
            <div class="mb-3">
                <label for="book_id" class="form-label">Book ID</label>
                <input type="text" class="form-control" id="book_id" name="book_id">
            </div>
            <div class="mb-3">
                <label for="book_title" class="form-label">Book Title</label>
                <input type="text" class="form-control" id="book_title" name="book_title">
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author">
            </div>
            <div class="mb-3">
                <label for="publication_date" class="form-label">Publish Date</label>
                <input type="text" class="form-control" id="publication_date" name="publication_date">
            </div>
            <div class="mb-3">
                <label for="book_language" class="form-label">Language</label>
                <input type="text" class="form-control" id="book_language" name="book_language">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Genre</label>
                <select class="form-control" id="category_id" name="category_id">
                    @foreach ($datas as $data)
                    <option value="{{ $data->category_id }}">{{ $data->category_name }}</option>
                    @endforeach
                    <!-- <option value = "1">History</option>
                    <option value = "2">Physical Science</option>
                    <option value = "3">Novel</option>
                    <option value = "4">Philosophy</option>>
                    <option value = "5">Romance</option>
                    <option value = "6">Conspiracy</option>
                    <option value = "7">Religion</option> -->
                </select>
            </div>
            <!-- <div class="mb-3">
                <label for="category_name" class="form-label">Genre</label>
                <input type="text" class="form-control" id="category_name" name="category_name">
            </div>
            <div class="mb-3">
                <label for="shelf_number" class="form-label">Shelf Number</label>
                <input type="text" class="form-control" id="shelf_number" name="shelf_number">
            </div>
            <div class="mb-3">
                <label for="parent_category" class="form-label">Category</label>
                <input type="text" class="form-control" id="parent_category" name="parent_category">
            </div> -->
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Add" />
            </div>
        </form>
    </div>
</div>
@stop