<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        $title = $request->input('title');
        $author = $request->input('author');
        $filter = $request->input('filter', '');


        $books = Book::when($title, function ($query) use ($title) {
        return $query->where('title', 'like', '%'.$title.'%');
})


        ->when($author, function ($query) use ($author) {
        return $query->where('author', 'like', '%'.$author.'%');
});
$books = match ($filter) {
    'popular_last_month' => $books->popularLastMonth(),
    'popular_last_6months' => $books->popularLast6Months(),
    'highest_rated_last_month' => $books->highestRatedLastMonth(),
    'highest_rated_last_6months' => $books->highestRatedLast6Months(),
    default => $books->latest()
};
$books = $books->get();

// $cacheKey = 'books:' . $filter . ':' . $title;
// $books = cache()->remember($cacheKey, 3600, fn() => $books->get());

return view('books.index', ['books' => $books]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
     
        return view(
            'books.show',
            [
                'book' => $book->load([
                    'reviews' => fn($query) => $query->latest()
                ])
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
