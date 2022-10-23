@extends("dashboard.layouts.app")
@section("content")
    @push("css")
        {!! datatable_files("css") !!}
    @endpush
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <button class="btn btn-info" type="button" data-toggle="modal" data-target="#serviceModel"><i class="fa fa-plus"></i> {{ __("Create Service") }}</button>
                    <button class="btn btn-secondary btn-refresh"  type="button"><i class="fa fa-redo-alt"></i> {{ __("Refresh") }}</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="servicesTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __("Title")}}</th>
                            <th>{{ __("Price")}}</th>
                            <th>{{ __("Description")}}</th>
                            <th>{{ __("Actions") }}</th>
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
    @include('dashboard.pages.services.model')

    @push("js")
        {!! datatable_files() !!}
        <script >

            $("#servicesTable").table({
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'price', name: 'price'},
                    {data: 'description', name: 'description'},
                ],
                url: "{{ route("dashboard.services.json.index") }}",
                actionColumnWidth: "250px",
            });
        </script>
    @endpush
@endsection
