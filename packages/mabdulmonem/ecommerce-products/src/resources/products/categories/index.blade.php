@extends("dashboard.layouts.app")
@section("content")
    @push("css")
        {!! datatable_files("css") !!}
    @endpush
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <div class="btn btn-info" href="{{ route("categories.create") }}" data-toggle="modal"
                         data-target="#categoryModel"><i class="fa fa-plus"></i> @lang("Create Menu")</div>

                    <button class="btn btn-secondary btn-refresh"  type="button"><i class="fa fa-redo-alt"></i> @lang("Refresh")</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="categoriesTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang("Title")</th>
                            <th>@lang("Link")</th>
                            <th>@lang("Submenu")</th>
                            <th>@lang("Description")</th>
                            <th>@lang("Actions")</th>
                        </tr>
                        </thead>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    @include('dashboard.pages.products.categories.model')
    @push("js")
        {!! datatable_files() !!}
        <script >

            $("#categoriesTable").table({
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'link', name: 'link'},
                    {data: 'subcategory', name: 'subcategory'},
                    {data: 'description', name: 'description'},
                ],
                url: "{{ route("categories.json.index") }}",
                actionColumnWidth: "250px",
            });
        </script>
    @endpush
@endsection
