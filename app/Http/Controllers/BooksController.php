<?php

namespace App\Http\Controllers;
use App\Models\Book;
use DB;

use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        if(Auth()->id()=="")
        {
            $book = Book::where('status','listing')->get();

            return view('bookList',compact("book"));
        }
        else
        {
            $book = Book::where('user_id',auth()->id())->get();

            return view('book.index',compact("book"));
        }
    }
    public function create()
    {
        return view("book.add");
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'description' => 'required',
            'file' => 'required|mimes:jpg,png,jpeg'
        ]);
        // dd($request->status);
        
        $fileName = time().'_'.$request->file->getClientOriginalName();
        
        $request->file->move(public_path('uploads'), $fileName);
        
        $books = new Book();

        $books->book_name = $request->name;
        $books->book_detail = $request->description;
        $books->user_id = Auth()->id();
        $books->status = $request->status;
        $books->book_image = $fileName;

        $books->save();

        return redirect('/home');
    }

    public function delete($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect("/home");
    }
    public function edit($id)
    {
        $book = Book::find($id);

        // dd($book);

        return view("book.edit",compact("book"));
    }
    public function update(Request $request)
    {
        
        $book = Book::find($request->book_id);
        if($request->file)
        {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $request->file->move(public_path('uploads'), $fileName);

            $book->book_name = $request->name;
            $book->book_detail = $request->description;
            $book->status = $request->status;
            // $books->user_id = Auth()->id();
            $book->book_image = $fileName;

            $book->update();

        }
        else
        {
            $book->book_name = $request->name;
            $book->book_detail = $request->description;
            $book->status = $request->status;
            $book->update();
        }

        

        return redirect('/home');
    }

    public function search()
    {
        return view("welcome");
    }

    public function autocompleteSearch(Request $request)
    {
        if($request->get('query'))
        {
         $query = $request->get('query');
         $data = DB::table('books')
           ->where('book_name', 'LIKE', "%{$query}%")
           ->get();
         $output = '<ul class="dropdown-menu form-control" style="display:block; position:relative">';
         foreach($data as $row)
         {
          $output .= '
          <li><a href="#" class="mx-2">'.$row->book_name.'</a></li>
          ';
         }
         $output .= '</ul>';
         echo $output;
        }
    } 

    public function searching(Request $request)
    {
        $name = $request->key;

        $data = Book::where('book_name',$name)->get();

        $output = '
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
        ';

        foreach($data as $row)
        {
            $output.='<tr>
            <th scope="row">'.$row->id.'</th>
            <td>'.$row->book_name.'</td>
            <td>'.$row->book_detail.'</td>
            <td><img src="'.asset('uploads/'.$row['book_image']).'" height="100px" width="100px"></td>
        </tr>';
        }
        $output.='
        </tbody>
        </table>
        ';
        echo $output;
    }
    public function unlist(Request $request)
    {
        $query = $request->get("query");
        
        $data = Book::where('status','unlisting')->where('book_name','LIKE','%'.$query.'%')->get();
        $output = '
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
        ';

        foreach($data as $row)
        {
            $output.='<tr>
            <th scope="row">'.$row->id.'</th>
            <td>'.$row->book_name.'</td>
            <td>'.$row->book_detail.'</td>
            <td><img src="'.asset('uploads/'.$row['book_image']).'" height="100px" width="100px"></td>
        </tr>';
        }
        $output.='
        </tbody>
        </table>
        ';
        echo $output;
    }
}
