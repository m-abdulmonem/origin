@extends("dashboard.layouts.app")
@section("content")
    @push("css")
        {!! datatable_files("css") !!}
    @endpush
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <a class="btn btn-info" href="{{ route("pages.create") }}"><i class="fa fa-plus"></i> {{__("Create Page")}}</a>

                    <button class="btn btn-secondary btn-refresh"  type="button"><i class="fa fa-redo-alt"></i> {{__("Refresh")}}</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="pages" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __("Title") }}</th>
                            <th>{{ __("Image")  }}</th>
                            <th>{{ __("Status") }}</th>
                            <th>{{ __("Author") }}</th>
                            <th>{{ __("Subpage") }}</th>
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

    @push("js")
        {!! datatable_files() !!}
        <script >

            $("#pages").table({
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'image', name: 'image'},
                    {data: 'status', name: 'status'},
                    {data: 'user', name: 'user'},
                    {data: 'parent', name: 'parent'},
                ],
                url: "{{ route("pages.json.index") }}",
                actionColumnWidth: "250px",
            });
        </script>
    @endpush
@endsection
