@extends('dashboard.layouts.app')
@section('content')
    @push('css')
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ admin_assets("select2.min.css") }}">
    @endpush
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-8">
                @csrf

                <div class="card">
                    <div class="card-header">
                        <h3 class="title-header float-left">{{ __('Product Detials') }}</h3>
                        <button type="submit"
                                class="btn btn-primary btn-block float-right w-auto">{{ __('Create Product') }}</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group ">
                                <label for="title">{{ __("Title") }}</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="title" placeholder="{{ __("Title") }}" name="title"
                                       value="{{ old('title') }}">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- ./col-12 -->
                        <div class="col-12">
                            <div class="form-group ">
                                <label for="description">{{ __("Description") }}</label>
                                <textarea class="form-control @error('Description') is-invalid @enderror"
                                          id="description" placeholder="{{ __("Description") }}" name="Description"
                                          value="">{{ old('Description') }}</textarea>
                                @error('Description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- ./col-12 -->
                        <div class="col-12">
                            <div class="form-group ">
                                @php use App\Models\Product\Category\Category; $categories = Category::all()->pluck("title","id") @endphp
                                <label for="category">{{ __('Select Category') }}</label>
                                <select name="categories[]" id="category" multiple="multiple"
                                        class="form-control @error('categories') is-invalid @enderror">
                                    <option value="">{{ __('Select Category') }}</option>
                                    {!! select_options($categories,"categories") !!}
                                </select>
                                @error('categories')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- ./col-12 -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- ./card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="title-header">{{ __('Product Varients') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-12 varient-card">
                            <div class="varient-tools"><i class="fas fa-times"></i></div>
                            <div class="form-group ">

                                <div class="row">
                                    <div class="col-8"><label for="varientName">{{ __('Varient Name') }}</label><input
                                                type="text"
                                                class="form-control varient-name @error('varient_name') is-invalid @enderror"
                                                id="varientName" placeholder="{{ __('Varient Name') }}"
                                                name="varient_name[]">
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="varientType">{{ __('Varient type') }}</label>
                                            <select name="varient-type" id="varientType" class="form-control">
                                                @foreach(['checkboxs','selections',"options",'images'] as $item)
                                                    <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @error('varient_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <ul class="list-unstyled" style="padding: 12px 18px;">
                                    <li class="varient-details">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group ">
                                                    <label for="varientValue">{{ __('Varient Value') }}</label>
                                                    <input type="text"
                                                           class="form-control varient-value @error('varient_value') is-invalid @enderror"
                                                           id="varientValue" placeholder="{{ __('Varient Value') }}"
                                                           name="varient_value[]">
                                                    @error('varient_value')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- ./col-6 -->
                                            <div class="col-5">
                                                <div class="form-group ">
                                                    <label for="varientQuntity">{{ __('Varient Quntity') }}</label>
                                                    <input type="text"
                                                           class="form-control varient-quntity @error('varient_quntity') is-invalid @enderror"
                                                           id="varientQuntity" placeholder="{{ __('Varient Quntity') }}"
                                                           name="varient_quntity[]">
                                                    @error('varient_quntity')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror

                                                </div>
                                            </div>
                                            <!-- ./col-5 -->
                                            <div class="col-1 varient-row"><i class="fas fa-times"></i></div>
                                            <!-- ./col-5 -->
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- ./col-12 -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- ./card -->
            </div>
            <!-- ./col-8 -->
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title-header">{{ __('Price & Quntity') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group ">
                                <label for="sale_price">{{ __('Sale Price') }}</label>
                                <input type="text" class="form-control @error('sale_price') is-invalid @enderror"
                                       id="sale_price" placeholder="{{ __('Sale Price') }}" name="sale_price"
                                       value="{{ old('sale_price') }}">
                                @error('sale_price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- ./col-12 -->
                        <div class="col-12">
                            <div class="form-group ">
                                <label for="buy_price">{{ __('Buy Price') }}</label>
                                <input type="text" class="form-control @error('buy_price') is-invalid @enderror"
                                       id="buy_price" placeholder="{{ __('Buy Price') }}" name="buy_price"
                                       value="{{ old('buy_price') }}">
                                @error('buy_price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- ./col-12 -->
                        <div class="col-12">
                            <div class="form-group ">
                                <label for="quntity">{{ __('Quntity') }}</label>
                                <input type="text" class="form-control @error('quntity') is-invalid @enderror"
                                       id="quntity" placeholder="{{ __('Quntity') }}" name="quntity"
                                       value="{{ old('quntity') }}">
                                @error('quntity')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- ./col-12 -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        {{ __('Estimated Profit') }} : <span class="profit">0.0$</span>
                    </div>
                </div>
                <!-- ./card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="title-header">{{ __('Discussion & Reviews') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="icheck-primary">
                                <input type="checkbox" name="has_comments" id="has_comments"
                                        {{ old('has_comments') ? 'checked' : '' }}>
                                <label for="has_comments">
                                    {{ __('Allow Comments') }}
                                </label>
                            </div>
                        </div>
                        <!-- ./col-md-12 -->
                        <div class="col-md-12 mt-5">
                            <div class="icheck-primary">
                                <input type="checkbox" name="has_reviews" id="has_reviews"
                                        {{ old('has_reviews') ? 'checked' : '' }}>
                                <label for="has_reviews">
                                    {{ __('Allow Reviews') }}
                                </label>
                            </div>
                        </div>
                        <!-- ./col-md-12 -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- ./card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="title-header">{{ __('New Product') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="icheck-primary">
                                <input type="checkbox" name="new" id="new"
                                        {{ old('new') ? 'checked' : '' }}>
                                <label for="new">
                                    {{ __('New Products') }}
                                </label>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- ./card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="title-header">{{ __('Permalink') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group ">
                                <label for="permalink">URL Slug</label>
                                <input type="text" class="form-control @error('url') is-invalid @enderror"
                                       id="permalink" placeholder="{{ __('URL Slug') }}" name="url"
                                       value="{{ old('url') }}">
                                @error('url')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- ./col-12 -->
                        <a href="" id="pageUrl">{{ request()->getScheme() }}://{{ request()->getHost() }}/</a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- ./card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="title-header">{{ __("Featured Image") }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-md-12">

                            <div class="btn btn-default btn-select-media">{{ __("Select Image") }}</div>

                        </div>
                        <!-- ./col-md-12 -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- ./card -->
            </div>
            <!-- ./col-4 -->
        </div>
        <!-- ./row -->

    </form>
    <!-- /.row -->

    @include("dashboard.modals.select_media")
    @push('js')
        <script src="{{ admin_assets("select2.full.min.js") }}"></script>
        <!-- Select2 -->
        <script>
            var body = $("body");
            body.on("change", ".varient-name", function (e) {
                var node = $(this).parent().parent().parent().parent();
                if ($(this).val() != "") {
                    node.clone().insertAfter(node).find("input").val("")
                } else {
                    node.next().remove()
                }
            });
            body.on("change", ".varient-value", function (e) {
                var node = $(this).parent().parent().parent().parent(), name = node.parent().prev().val();
                if ($(this).val() != "") {
                    node.find("input:first").attr("name", `${name}[]`);
                    node.find("input:last").attr("name", `${name}_quntity[]`)

                    var newNode = node.clone().insertAfter(node).find("input").val("")

                    newNode.find("input:first").attr("name", `${name}[]`)
                    newNode.find("input:last").attr("name", `${name}_quntity[]`)
                } else {
                    node.next().remove()
                }
            });

            body.on("click", ".varient-tools i", function () {

                if ($(".varient-card").length > 1) {
                    $(this).parent().parent().remove();
                }
            });
            body.on("click", ".varient-row i", function () {

                if ($(".varient-details").length > 1) {
                    $(this).parent().parent().parent().remove();
                }
            })

            //initialize select  plugin
            $("#category").select2({placeholder: "Select Category", "height": "auto"});

            $("#sale_price,#buy_price,#quntity").change(function () {
                var sale = parseInt($("#sale_price").val()) ?? 0,
                    buy = parseInt($("#buy_price").val()) ?? 0,
                    quntity = parseInt($("#quntity").val()) ?? 1;

                $(".profit").text(`${(sale - buy) * quntity}$`)
            })
        </script>
    @endpush
@endsection
