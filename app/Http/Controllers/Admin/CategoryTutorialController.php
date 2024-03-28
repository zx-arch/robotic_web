<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryTutorial;

class CategoryTutorialController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data['currentAdminMenu'] = 'tutorials';
        $this->data['currentAdminSubMenu'] = 'category_tutorial';
    }

    public function index()
    {
        $categoryTutorial = CategoryTutorial::latest();

        $totalCatTutorials = $categoryTutorial->count();

        // Menentukan jumlah item per halaman
        $itemsPerPage = 15;
        //print_r();
        // Menentukan jumlah halaman maksimum untuk semua data
        $totalPagesAll = ceil($totalCatTutorials / $itemsPerPage);
        $categoryTutorial = $categoryTutorial->paginate($itemsPerPage);

        if ($totalPagesAll >= 15) {
            $totalPages = 15;
        }

        $getCategory = $categoryTutorial->all();

        if ($categoryTutorial->count() > 15) {
            $categoryTutorial = $categoryTutorial->paginate($itemsPerPage);
            //dd($categoryTutorial);
            if ($categoryTutorial->currentPage() > $categoryTutorial->lastPage()) {
                return redirect($categoryTutorial->url($categoryTutorial->lastPage()));
            }
        }

        return view('admin.CategoriesTutorial.index', $this->data, compact('categoryTutorial', 'getCategory'));
    }
    public function search(Request $request)
    {
        // Mendapatkan data pencarian dari request
        $searchData = $request->input('search');
        // Lakukan sesuatu dengan data pencarian, contoh: mencari data di database
        $category = $searchData['category'] ?? null;
        $status = $searchData['status'] ?? null;
        $created_at = $searchData['created_at'] ?? null;
        $updated_at = $searchData['updated_at'] ?? null;
        //dd($searchData);
        // Misalnya, Anda ingin mencari data user berdasarkan username, category, status, created_at, atau updated_at
        $categoryTutorial = CategoryTutorial::latest();
        $getCategory = $categoryTutorial->get();

        $categoryTutorial->where(function ($query) use ($status, $category, $created_at, $updated_at) {

            if ($status !== null) {
                $query->where('status_id', $status);
            }

            if ($category !== null) {
                $query->where('id', $category);
            }

            if ($created_at !== null) {
                $query->where('created_at', 'like', "$created_at%");
            }

            if ($updated_at !== null) {
                $query->Where('updated_at', 'like', "$updated_at%");
            }
        });

        $totalcategoryTutorial = $categoryTutorial->count();

        // Menentukan jumlah item per halaman
        $itemsPerPage = 15;

        // Menentukan jumlah halaman maksimum untuk semua data
        $totalPagesAll = ceil($totalcategoryTutorial / $itemsPerPage);
        $categoryTutorial = $categoryTutorial->paginate($itemsPerPage);

        // Mendapatkan URI lengkap dari request
        $fullUri = $request->getRequestUri();

        if ($totalPagesAll >= 15) {
            $totalPages = 15;
        }

        $categoryTutorial->setPath($fullUri);

        if ($categoryTutorial->count() > 15) {
            $categoryTutorial = $categoryTutorial->paginate($itemsPerPage);
            //dd($categoryTutorial);
            if ($categoryTutorial->currentPage() > $categoryTutorial->lastPage()) {
                return redirect($categoryTutorial->url($categoryTutorial->lastPage()));
            }
        }
        return view('Admin.CategoriesTutorial.index', $this->data, compact('categoryTutorial', 'getCategory', 'searchData', 'itemsPerPage'));

    }
    public function addSubmit(Request $request)
    {
        //dd($request->all());
        try {
            if ($request->status_id != '11' || $request->status_id != '12') {
                CategoryTutorial::create([
                    'category' => $request->category_name,
                    'status_id' => $request->status,
                ]);
                return redirect()->route('category_tutorial.index')->with('success_submit_save', 'Category berhasil ditambah!');

            } else {
                return redirect()->route('category_tutorial.index')->with('error_submit_save', 'Status ID tidak valid!');
            }

        } catch (\Throwable $e) {
            return redirect()->route('category_tutorial.index')->with('error_submit_save', 'Status ID tidak valid. ' . $e->getMessage());
        }

    }
}