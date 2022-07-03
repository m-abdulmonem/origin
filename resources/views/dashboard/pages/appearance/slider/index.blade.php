@extends("dashboard.layouts.app")
@section("content")
    @push("css")
        {!! datatable_files("css") !!}
    @endpush
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <a class="btn btn-info" href="{{ route("sliders.create") }}"><i class="fa fa-plus"></i> Create Slider</a>

                    <button class="btn btn-secondary btn-refresh"  type="button"><i class="fa fa-redo-alt"></i> Refresh</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="productsTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Text</th>
                            <th>status</th>
                            <th>Buttons</th>
                            <th>Html</th>
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

            $("#productsTable").table({
                columns: [
                    {data: 'image', name: 'image'},
                    {data: 'title', name: 'title'},
                    {data: 'text', name: 'text'},
                    {data: 'status', name: 'status'},
                    {data: 'buttons', name: 'buttons'},
                    {data: 'html', name: 'html'},
                ],
                url: "{{ route("appearance.sliders.index") }}",
                actionColumnWidth: "250px",
            });
        </script>
    @endpush
@endsection
