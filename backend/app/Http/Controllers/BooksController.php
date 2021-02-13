<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Book;

class BooksController extends Controller
{
    public function index(Request $request)
    {
        //akan diurutkan dari yang terbaru berdasarkan tabel
        $book = Book::orderBy('created_at', 'DESC')->when($request->q, function($book) {
            $book->where('title', $request->title);
        })->paginate(10);
        return response()->json(['status' => 'success', 'data' => $book]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|unique:books,title',
            'type' => 'required',
            'photo' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        $user = $request->user();
        $file = $request->file('photo');
        $filename = $request->title . '-' . time() . '.' . $file->getClientOriginalExtension();
        $file->move('book', $filename);

        Book::create([
            'title' => $request->title,
            'type' => $request->type,
            'photo' => $filename,
            'user_id' => $user->id
        ]);
        return response()->json(['status' => 'success']);
    }

    public function edit($id)
    {
        $book = Book::find($id);
        return response()->json(['status' => 'success', 'data' => $book]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|unique:books,title,' . $id,
            'type' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $book = Book::find($id);
        $filename = $book->photo;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = $request->title . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move('book', $filename);
            File::delete(base_path('public/book/' . $book->photo));
        }
        $book->update([
            'title' => $request->title,
            'type' => $request->type,
            'photo' => $filename
        ]);
        return response()->json(['status' => 'success']);
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        File::delete(base_path('public/book/' . $book->photo));
        $book->delete();
        return response()->json(['status' => 'success']);
    }
}
