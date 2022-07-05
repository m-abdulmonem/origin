<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Products\Categories\CreateRequest;
use App\Http\Requests\Dashboard\Products\Categories\UpdateRequest;
use App\Models\Product\Category\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->permName = "product";

        $this->middleware(['role:superAdmin']);

        $this->folder = $this->dPath . ".products.categories.";
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $this->can("read");

        $data = [
            'title' => 'Categories'
        ];
        return view($this->folder . "index", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function store(CreateRequest $request, Category $category)
    {
        $this->can("create");

        $category->create($request->all());

        return $this->back("Category", $category->title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $this->can("create");

        $data = [
            'title' => 'Create Category'
        ];
        return view($this->folder . "create", $data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $menu
     * @return Application|Factory|View
     */
    public function edit(Category $menu)
    {
        $this->can("update");

        $data = [
            'title' => 'Edit ' . $menu->title,
            'menu' => $menu,
        ];
        return view($this->folder . "update", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $this->can("update");

        $category->update($request->all());

        return $this->back("Category", $category->title, true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $menu
     * @return JsonResponse
     */
    public function destroy(Category $menu): JsonResponse
    {
        $this->can("delete");

        $menu->delete();

        return response()->json(['status' => 1]);
    }


    public function jsonIndex(Request $request)
    {
        $this->can("read");

        if ($request->ajax()) {
            return datatables()->of(Category::orderByDesc("id")->get())
                ->addIndexColumn()
                ->addColumn('title', function ($data) {
                    return $data->title;
                })
                ->addColumn('subcategory', function ($data) {

                    return $data->category_id != null ? '<p class="text-primary">' . trans("Subcategory to ",['category' => $data->title]) . '</p>' : '-';
                })
                ->addColumn('link', function ($data) {
                    return $data->link;
                })
                ->addColumn('description', function ($data) {
                    return substr($data->description, 0, 60);
                })
                ->addColumn('action', function ($data) use ($request) {
//                    $route = route("categories.edit", $data->id);
                    $btn = "<div class='btn btn-primary mr-1 btn-edit' title='Edit {$data->title}' data-data='$data' data-id='{$data->id}'><i class='fa fa-edit'></i></div>";
                    $btn .= btn_delete("categories", $data, "title");
                    return $btn;
                })
                ->rawColumns(['action', 'subcategory','description'])
                ->make(true);
        }//end if cond
        return abort(404);
    }
}
