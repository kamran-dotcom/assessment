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
                    <a href="/search" class="btn btn-success">Go For Another Search</a>
                </div>
                <div class="col-md-3 text-right">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Un Listed Book Search">
                </div>
            </div>
            <div class="col-md-12 my-4">
                <div id="bookList">
                </div>
            </div>
            
        </div>
        <div class="col-md-12 my-4" id="already-listed">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                    <th scope="col">ID</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Book Detail</th>
                    <th scope="col">Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($book as $books)
                    <tr>
                    <th scope="row">{{$books['id']}}</th>
                    <td>{{$books['book_name']}}</td>
                    <td>{{$books['book_detail']}}</td>
                    <td><img src="{{asset('uploads/'.$books['book_image'])}}" height="100px" width="100px"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ csrf_field() }}
    </div>
</div>
<script>
$(document).ready(function(){

 $('#search').keyup(function(){ 
        var query = $(this).val();
        // alert(query);
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"/api/unlisted",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
              $('#already-listed').hide();
           $('#bookList').fadeIn();  
            $('#bookList').html(data);
          }
         });
        }
    });
});
    </script>
@endsection