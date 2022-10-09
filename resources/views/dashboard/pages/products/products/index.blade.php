@extends("dashboard.layouts.app")
@section("content")
    @push("css")
        {!! datatable_files("css") !!}
    @endpush
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <a class="btn btn-info" href="{{ route("products.create") }}"><i class="fa fa-plus"></i> {{ __("Create Product") }}</a>

                    <button class="btn btn-secondary btn-refresh"  type="button"><i class="fa fa-redo-alt"></i> {{ __("Refresh") }}</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="pages" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __("Code")}}</th>
                            <th>{{ __("title")}}</th>
                            <th>{{ __("Buy Price")}}</th>
                            <th>{{ __("Sale Price")}}</th>
                            <th>{{__("Auantity")}}</th>
                            <th>{{__("category")}}</th>
                            <th>{{ __("Author") }}</th>
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
                    {data: 'code', name: 'code'},
                    {data: 'title', name: 'title'},
                    {data: 'buy_price', name: 'buy_price'},
                    {data: 'sale_price', name: 'sale_price'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'category', name: 'category'},
                    {data: 'user', name: 'user'},
                ],
                url: "{{ route("products.json.index") }}",
                actionColumnWidth: "250px",
            });
        </script>
    @endpush
@endsection
