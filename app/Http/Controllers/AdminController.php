<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function create()
    {
        $datas = DB::select('select book.category_id, category.category_name from book inner join category on book.category_id = category.category_id');

        return view('book.add')->with('datas', $datas);
    }
    // public function store the value to a table
    public function store(Request $request)
    {
        $request->validate([
            'book_title' => 'required',
            'category_id' => 'required',
            'author' => 'required',
            'publication_date' => 'required',
            'book_language' => 'required',
        ]);

        $bookId = $request->book_id;
        $bookTitle = $request->book_title;
        $categoryId = $request->category_id;
        $author = $request->author;
        $publicationDate = $request->publication_date;
        $bookLanguage = $request->book_language;

        DB::insert(
            'INSERT INTO book(book_id, book_title, author, publication_date, book_language, category_id, deleted) VALUES (?, ?, ?, ?, ?, ?, 0)',
            [$bookId, $bookTitle, $author, $publicationDate, $bookLanguage, $categoryId]
        );

        return redirect()->route('book.index')->with('success', 'Book Data has been added with status "deleted"');
    }

    // public function show all values from a table
    public function index()
    {
        $datas = DB::select
        ('SELECT book.book_id, book.book_title, book.author, book.publication_date, book.book_language, category.category_id, category.category_name, category.shelf_number
        FROM book INNER JOIN category ON book.category_id = category.category_id WHERE deleted = 0', );

        return view('book.index')->with('datas', $datas);

    }

    public function trash()
    {
        $datas = DB::select
        ('SELECT book.book_id, book.book_title, book.author, book.publication_date, book.book_language, category.category_id, category.category_name, category.shelf_number
        FROM book INNER JOIN category ON book.category_id = category.category_id WHERE deleted = 1', );

        return view('book.trash')->with('datas', $datas);

    }

    public function ascending()
    {
        $datas = DB::select
        (
            'SELECT book.book_id, book.book_title, book.author, book.publication_date, book.book_language, category.category_id, category.category_name, category.shelf_number
                FROM book
                INNER JOIN category ON book.category_id = category.category_id
                ORDER BY book_title ASC;
                '
        );

        return view('book.index')->with('datas', $datas);
    }

    public function descending()
    {
        $datas = DB::select
        (
            'SELECT book.book_id, book.book_title, book.author, book.publication_date, book.book_language, category.category_id, category.category_name, category.shelf_number
                FROM book
                INNER JOIN category ON book.category_id = category.category_id
                ORDER BY book_title DESC;
                '
        );

        return view('book.index')->with('datas', $datas);
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $datas = DB::table('book')
            ->where('book_title', 'LIKE', "%$query%")
            ->get();
        return view('book.index', compact('datas'));
    }

    // public function edit a row from a table
    public function edit($id)
    {
        $data = DB::table('book')->where('book_id', $id)->first();
        return view('book.edit')->with('data', $data);
    }


    // public function to update the table value
    public function update($id, Request $request)
    {
        $request->validate([
            // 'book_id' => 'required',
            'book_title' => 'required',
            'category_id' => 'required',
            'author' => 'required',
            'publication_date' => 'required',
            'book_language' => 'required',
            // 'category_name' => 'required',
            // 'shelf_number' => 'required',
            // 'parent_category' => 'required',
        ]);

        DB::update(
            'UPDATE book SET book_id = :book_id, book_title = :book_title, category_id = :category_id, author = :author, publication_date = :publication_date, book_language = :book_language WHERE book_id = :id',
            [
                'id' => $id,
                'book_id' => $request->book_id,
                'book_title' => $request->book_title,
                'category_id' => $request->category_id,
                'author' => $request->author,
                'publication_date' => $request->publication_date,
                'book_language' => $request->book_language,
                // 'category_name' => $request->category_name,
                // 'shelf_number' => $request->shelf_number,
                // 'parent_category' => $request->parent_category,
            ]
        );
        //     DB::statement('
        //     UPDATE book 
        //     SET book_id = :new_book_id, 
        //         book_title = :new_book_title, 
        //         category_id = :new_category_id, 
        //         author = :new_author, 
        //         publication_date = :new_publication_date, 
        //         book_language = :new_book_language
        //     WHERE category_id = :old_category_id;
        // ', [
        //     'new_book_id' => $request->input('book_id'),
        //     'new_book_title' => $request->input('book_title'),
        //     'new_category_id' => $request->input('category_id'),
        //     'new_author' => $request->input('author'),
        //     'new_publication_date' => $request->input('publication_date'),
        //     'book_language' => $request->input('book_language'),
        //     'old_book_id' => $id,
        // ]);

        return redirect()->route('book.index')->with('success', 'Book data has been changed');
    }

    // public function to delete a row from a table
    public function delete($id)
    {
        $sql = "UPDATE book SET deleted = 1 WHERE book_id = :book_id";

        DB::update($sql, ['book_id' => $id]);

        return redirect()->route('book.index')->with('success', 'Book Data has been sent to trash');
    }

    public function deletereal($id)
    {
        DB::delete('DELETE FROM book WHERE book_id = :book_id', ['book_id' => $id]);
        return redirect()->route('book.trash')->with('success', 'Data Admin berhasil dihapus');
    }
}
