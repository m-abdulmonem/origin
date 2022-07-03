<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Products\CreateRequest;
use App\Http\Requests\Dashboard\Products\UpdateRequest;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->permName = "product";

        $this->middleware(['role:superAdmin']);

        $this->folder = $this->dPath . ".products.products.";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->can("read");

        $data = [
            'title' => 'Products'
        ];

        return $this->view("index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->can("create");

        $data = [
            'title' => 'Create Product'
        ];
        return $this->view("create",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $this->can("create");

        $data = [
            'code' => str_rand(6),
            'user_id' => auth()->id(),
            'has_comments' => checkbox_val_bool($request->has_comments),
            'has_reviews' => checkbox_val_bool($request->has_reviews),
            'new' => checkbox_val_bool($request->new),
        ];

        $product = Product::create(request_merge($data,$request));


        return $this->back("Product",$product->title);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $this->can("view");

        $data = [
            'title' => trans($product->title),
            'product' => $product
        ];

        return $this->view("view",$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->can("update");

        $data = [
            'title' => trans('Update ', ['title' => $product->title]),
            'product' => $product
        ];

        return $this->view("update",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $this->can("update");

        $data = [
            'code' => strval(str_rand(6)),
            'user_id' => auth()->id(),
            'has_comments' => checkbox_val_bool($request->has_comments),
            'has_reviews' => checkbox_val_bool($request->has_reviews),
            'new' => checkbox_val_bool($request->new),
        ];

        $product->update(request_merge($request->all(),$data));

        return $this->back("Product",$product->title,true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->can("delete");
        $product->delete();

        return response()->json(['status' => 1]);
    }


    public function json(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(Product::all())
                ->addIndexColumn()
                ->addColumn('code', function ($data) {
                return "<a class='text-primary' href='" . route("products.edit", $data->id) . "'>" . $data->title . "</a>";
            })
                ->addColumn('title', function ($data) {
                return "<a class='text-primary' href='" . route("products.edit", $data->id) . "'>" . $data->title . "</a>";
            })
                ->addColumn('buy_price', function ($data) {
                return "<span >" . $data->sale_price . "</span>";
            })
                ->addColumn('sale_price', function ($data) {
                return "<span >" . $data->sale_price . "</span>";
            })
                ->addColumn('quntity', function ($data) {
                return "<span >" . $data->quntity . "</span>";
            })
                ->addColumn('category', function ($data) {
                return "<a href='" . route("users.show", $data->category->id) . "' class='text-blue'>" . $data->category->title . "</a>";
            })
                ->addColumn('user', function ($data) {
                return "<a href='" . route("users.show", $data->user->id) . "' class='text-blue'>" . $data->user->name . "</a>";
            })
                ->addColumn('action', function ($data) use ($request) {
                $route = route("products.edit", $data->id);
                $btn = "<a class='btn btn-primary mr-1' title='Edit Page' href='$route'><i class='fa fa-edit'></i></a>";
                $btn .= btn_delete("products", $data, "title");
                return $btn;
            })
                ->rawColumns(['action', 'title', 'image', 'status', 'user', 'parent'])
                ->make(true);
        } //end if cond
        return abort(404);
    }
}
