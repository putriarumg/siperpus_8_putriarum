<?php

namespace App\Http\Controllers;

use App\Exports\BooksExport;
use App\Imports\BooksImport;
use App\Models\Book;
use App\Models\Bookshelf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


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

    public function edit($id){
        // dd($id);
        $data['book'] = Book::findOrFail($id);
        $data['bookshelves'] = Bookshelf::pluck('name', 'id');
        return view('books.edit', $data);
    }
    
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required',
            'publisher' => 'required',
            'city' => 'required',
            'bookshelf_id' => 'required',
        ]);
        if($request->hasFile('cover')){
            if($book->cover != null){
                Storage::delete('public/cover_buku/'. $book->cover);
            }
            $path = $request->file('cover')->storeAs(
                'public/cover_buku',
                'cover_buku_' . time() . '.' . $request->file('cover')->extension()
            );
            $validated['cover'] = basename($path);
        }
        $book->update($validated);

        $notification = array(
            'message' => 'Data Buku Berhasil diubah',
            'alert-type' => 'success',
        );
        return redirect()->route('book')->with($notification);
    }

    public function destroy($id){
        $book = Book::findOrFail($id);
        Storage::delete('public/cover_buku/'. $book->cover);
        $book->delete();
        $notification = array(
            'message' => 'Data Buku Berhasil Dihapus',
            'alert-type' => 'success',
        );
        return redirect()->route('book')->with($notification);
    }

    public function print(){
        $data['books'] = Book::all();
        $pdf = Pdf::loadView('books.print', $data);
        return $pdf->stream('daftar_buku.pdf');
    }

    public function export(){
        return Excel::download(new BooksExport, 'dataBuku.xlsx');
    }
    
    public function import(Request $request){
        $request->validate([
            'file' => 'required'
        ]);
        Excel::import(new BooksImport, $request->file('file'));
        $notification = array(
            'message' => 'Data Buku Berhasil diimport',
            'alert-type' => 'success',
        );
        return redirect()->route('book')->with($notification);
    }
}               
