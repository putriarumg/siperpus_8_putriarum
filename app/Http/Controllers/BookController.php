<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookshelf;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $data['books'] = Book::with('bookshelf')->get();
        return view('books.index', $data);
    }

    public function create(){
        $data['bookshelves'] = Bookshelf::pluck('name','id');
        return view('books.create', $data);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required',
            'publisher' => 'required',
            'city' => 'required',
            'bookshelf_id' => 'required',
            'cover' => 'required',
        ]);
        if($request->hasFile('cover')){
            $path = $request->file('cover')->storeAs(
                'public/cover_buku',
                'cover_buku_' . time() . '.' . $request->file('cover')->extension()
            );
            $validated['cover'] = basename($path);
        }
        Book::create($validated);
        $notification = array(
            'message' => 'Data Buku Berhasil disimpan',
            'alert-type' => 'success',
        );
        return redirect()->route('book')->with($notification);
    }
}
