@extends("layouts.common")
@section("content")

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h6 class="my-4 text-center font-weight-bold">Add a New Book</h6> 
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="/add-info" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Book Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>BooK Desription</label>
                    <textarea rows="8" cols="10" name ="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Listing Status</label>
                    <select name="status" class="form-control">
                        <option value="listing">Listing</option>
                        <option value="unlisting">Un Listing</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Upload Image</label>
                    <input type="file" name="file" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
    <!-- <div class="col-offset-4">
        <form>
            <div class="form-group">
                <label>Book Name</label>
                <input type="text" class="form-control">
            </div>
        </form>
    </div> -->
</div>

@endsection