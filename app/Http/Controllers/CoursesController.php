<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HierarchyCategoryBook;
use App\Models\BookTranslation;

class CoursesController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data['currentActive'] = 'courses_by_id';
    }
    public function index($jenis_materi)
    {
        //dd($jenis_materi);
        if ($jenis_materi == 'block_programming' || $jenis_materi == 'ai_programming' || $jenis_materi == 'python_programming') {
            $getLanguage = BookTranslation::select('book_translation.language_id', 'translations.language_name')
                ->leftJoin('translations', 'translations.id', '=', 'book_translation.language_id')
                ->with('translations')
                ->groupBy('book_translation.language_id', 'translations.language_name')
                ->get();
            session(['getLanguage' => $getLanguage]);
            return redirect()->back()->with('valid', true);

        } else {
            return redirect()->back()->with('error_access', 'Materi tidak tersedia!');
        }
    }

    public function submitBook(Request $request)
    {
        try {
            if ($request->isMethod('POST')) {
                //dd($request->all());
                $getBook = HierarchyCategoryBook::select('book_translation.*')
                    ->leftJoin('book_translation', 'book_translation.hierarchy_id', '=', 'hierarchy_category_book.id')
                    ->where('hierarchy_category_book.parent_id', $request->level)
                    ->where('hierarchy_category_book.language_id', $request->terjemahan)
                    ->with('bookTranslations') // Menggunakan with() untuk memuat relasi
                    ->distinct() // Menggunakan distinct() untuk menghindari duplikasi
                    ->get();
                //dd($getBook);
                session(['getBook' => $getBook, 'request' => $request->all()]);

                return redirect()->back()->with('valid', true);

            } else {
                return redirect()->back()->with('error_access', 'Request data tidak valid!');
            }

        } catch (\Throwable $e) {
            //dd($e->getMessage());
            return redirect()->back()->with('error_access', 'Request data tidak valid. ' . $e->getMessage());
        }
    }
}