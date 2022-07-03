@extends("dashboard.layouts.app")
@section("content")
    @push("css")
        {!! datatable_files("css") !!}
    @endpush
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <a class="btn btn-info" href="{{ route("menus.create") }}"><i class="fa fa-plus"></i> Create Menu</a>

                    <button class="btn btn-secondary btn-refresh"  type="button"><i class="fa fa-redo-alt"></i> Refresh</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Link</th>
                            <th>Submenu</th>
                            <th>Description</th>
                            <th>Actions</th>
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

            $("#table").table({
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'link', name: 'link'},
                    {data: 'submenu', name: 'submenu'},
                    {data: 'description', name: 'description'},
                ],
                url: "{{ route("appearance.menus.index") }}",
                actionColumnWidth: "250px",
            });
        </script>
    @endpush
@endsection
