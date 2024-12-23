<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::all();
        if (sizeof($books) > 0) {
            return response()->json($books);
        } else {
            return response()->json([
                "messsage" => "no book found!!!"
            ]);
        }
    }

    public function show($bookidtemp)
    {
        $book = Book::find($bookidtemp);
        if ($book) {
            return response()->json($book);
        } else {
            return response()->json([
                "message" => "no book found!!!"
            ]);
        }
    }

    public function store(Request $request)
    {
        $book = new Book();
        $book->name = $request->name;
        $book->author = $request->author;
        $book->publish_date = $request->publish_date;
        $book->save();
        return response()->json([
            "message" => "book added"
        ], 201);
    }

    public function update(Request $request, $id)
    {
        if (Book::where("id", $id)->exists()) {
            $book = Book::find($id);
            $book->name = is_null($request->name) ? $book->name : $request->name;
            $book->author = is_null($request->author) ? $book->author : $request->author;
            $book->publish_date = is_null($request->publish_date) ? $book->publish_date : $request->publish_date;

            $book->save();
            return response()->json([
                "messsge" => "Book Updated..."
            ]);
        } else {
            return response()->json([
                "error" => "Book Not Found!!!"
            ]);
        }
    }
}
