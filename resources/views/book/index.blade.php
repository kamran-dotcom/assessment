@extends('layouts.common')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h6 class="my-4 text-center font-weight-bold">Books and Information</h6> 
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <a href="/add-book" class="btn btn-success">Add New Book</a>
                </div>
                <div class="col-md-3 text-right">
                    <!-- <input type="text" id="search" class="form-control" placeholder="Search Term"> -->
                </div>
            </div>
        </div>
        <div class="col-md-12 my-4">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                    <th scope="col">ID</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Book Detail</th>
                    <th scope="col">Book Status</th>
                    <th scope="col">Image</th>
                    <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($book as $books)
                    <tr>
                    <th scope="row">{{$books['id']}}</th>
                    <td>{{$books['book_name']}}</td>
                    <td>{{$books['book_detail']}}</td>
                    <td>{{$books['status']}}</td>
                    <td><img src="{{asset('uploads/'.$books['book_image'])}}" height="100px" width="100px"></td>
                    <td>
                        <a href="edit-book/{{$books['id']}}" class="btn btn-warning">Edit</a>
                    </td>
                    <td>
                        <a href="delete-book/{{$books['id']}}" class="btn btn-danger">Delete</a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection