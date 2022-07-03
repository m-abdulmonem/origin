<?php

namespace App\Http\Controllers\Dashboard\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Services\CreateRequest;
use App\Http\Requests\Dashboard\Services\UpdateRequest;
use App\Models\Service\Service;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->permName = "services";

        $this->middleware(['role:superAdmin']);

        $this->folder = $this->dPath . ".services.";
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
            'title' => 'Services'
        ];
        return $this->view("index", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return JsonResponse
     */
    public function store(CreateRequest $request)
    {
        $this->can("create");

        $service = service::create($request->all());


        return response()->json(['status' => 1, 'msg' => 'success', 'data' => $service]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->can("create");

        $data = [
            'title' => 'Create Service'
        ];
        return $this->view("create", $data);
    }

    public function json(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(Service::all())
                ->addIndexColumn()
                ->addColumn('title', function ($data) {
                    return "<a class='text-primary' href='" . route("services.edit", $data->id) . "'>" . $data->title . "</a>";
                })
                ->addColumn('description', function ($data) {
                    return "<span >" . $data->description . "</span>";
                })
                ->addColumn('action', function ($data) use ($request) {
                    $route = route("services.edit", $data->id);
                    $btn = "<a class='btn btn-info mr-1' title='" . trans("View") . "' href='" . url($data->title) . "'><i class='fa fa-edit'></i></a>";
                    $btn .= "<a class='btn btn-primary mr-1' title='" . trans("Edit") . "' href='$route'><i class='fa fa-edit'></i></a>";
                    $btn .= btn_delete("services", $data, "title");
                    return $btn;
                })
                ->rawColumns(['action', 'title', 'description'])
                ->make(true);
        } //end if cond
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param Service $service
     * @return Response
     */
    public function show(Service $service)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @return Response
     */
    public function edit(Service $service)
    {
        $this->can("update");

        $data = [
            'title' => trans('Update ', ['title' => $service->title]),
            'service' => $service
        ];

        return $this->view("update", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Service $service
     * @return Response
     */
    public function update(UpdateRequest $request, Service $service)
    {
        $this->can("update");

        $service->update($request->all());

        return $this->back("Service", $service->title, true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Service $service
     * @return Response
     */
    public function destroy(Service $service)
    {
        $this->can("delete");
        $service->delete();

        return response()->json(['status' => 1]);
    }
}
