<?php

namespace App\Http\Controllers\Dashboard\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Services\ServicesRequest;
use App\Models\Service\Service;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
    public function index(): View|Factory|Application
    {
        $this->can("r");

        $data = [
            'title' => 'Services'
        ];

        return $this->view("index", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ServicesRequest $request
     * @return JsonResponse
     */
    public function store(ServicesRequest $request): JsonResponse
    {
        $this->any(['c','u']);

        $service = service::updateOrCreate(['id' => $request->id],$request->all());

        return response()->json(['status' => 1, 'msg' => 'success', 'data' => $service]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Service $service
     * @return JsonResponse
     */
    public function destroy(Service $service): JsonResponse
    {
        $this->can("d");

        $service->delete();

        return response()->json(['status' => 1]);
    }

    public function json(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(Service::orderByDesc("id")->get())
                ->addIndexColumn()
                ->addColumn('title', function ($data) {
                    return  $data->title;
                })
                ->addColumn('price', function ($data) {
                    return $data->price . " EGP";
                })
                ->addColumn('description', function ($data) {
                    return "<span >" . $data->description . "</span>";
                })
                ->addColumn('action', function ($data) use ($request) {
                    $btn = "<div class='btn btn-primary mr-1 btn-edit-service' title='" . trans("Edit") . "' data-data='".$data."'><i class='fa fa-edit'></i></div>";
                    $btn .= btn_delete("dashboard.services", $data, "title");
                    return $btn;
                })
                ->rawColumns(['action', 'title', 'description'])
                ->make(true);
        } //end if cond

        return abort(404);
    }
}
