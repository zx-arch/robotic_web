<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HierarchyCategoryBook;
use App\Models\BookTranslation;
use App\Models\Levels;

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
            // $getLanguage = BookTranslation::select('book_translation.language_id', 'translations.language_name')
            //     ->leftJoin('translations', 'translations.id', '=', 'book_translation.language_id')
            //     ->with('translations')
            //     ->groupBy('book_translation.language_id', 'translations.language_name')
            //     ->get();
            $getLevels = Levels::select('levels.*', 'translations.language_name')
                ->leftJoin('translations', 'translations.id', '=', 'levels.language_id')
                ->with('translations')
                ->get();

            $getLanguages = Levels::select('levels.language_id', 'translations.language_name')
                ->leftJoin('translations', 'translations.id', '=', 'levels.language_id')
                ->with('translations')
                ->groupBy('levels.language_id', 'translations.language_name')
                ->get();
            //dd($getLevels);
            session(['getLevels' => $getLevels, 'getLanguages' => $getLanguages]);
            return redirect()->back()->with('valid_book', true);

        } else {
            return redirect()->back()->with('error_access_book', 'Materi tidak tersedia!');
        }
    }

    public function submitBook(Request $request)
    {
        try {
            if ($request->isMethod('POST')) {
                //dd($request->all());
                $getIDHierarchy = HierarchyCategoryBook::select('id')
                    ->where('hierarchy_category_book.parent_id', $request->level)
                    ->where('hierarchy_category_book.language_id', $request->terjemahan)->get()->pluck('id');

                $getBook = BookTranslation::whereIn('hierarchy_id', $getIDHierarchy)->where('status_id', true)
                    ->get();
                //dd($request->all(), $getIDHierarchy, $getBook);
                if (count($getIDHierarchy) == 0) {
                    session(['not_available_book' => 'Versi buku saat ini belum tersedia', 'request' => $request->all()]);

                } else {
                    session(['getBook' => $getBook, 'request_input_book' => $request->all()]);
                }

                return redirect()->back()->with('valid_book', true);

            } else {
                return redirect()->back()->with('error_access_book', 'Request data tidak valid!');
            }

        } catch (\Throwable $e) {
            session()->forget('valid');
            //dd($e->getMessage());
            return redirect()->back()->with('error_access_book', 'Request data tidak valid. ' . $e->getMessage());
        }
    }
}