@push("css")
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ admin_assets("select2.min.css") }}">
@endpush
<style>
    .select2 {
        width: 100% !important;
    }
</style>
<div class="modal fade" id="categoryModel" style="display: none;" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Portfolio</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="#" method="post">
                @csrf
                <div class="modal-body">
                    <div class="col-12">
                        <div class="form-group ">
                            <label for="title">{{ __("Title") }}</label>
                            <input type="text" class="form-control " id="title" placeholder="{{ __("Title") }}" name="title"
                                   value="{{ old("title") }}" required>
                            <div class="alert alert-danger d-none" style="display: none"></div>
                        </div>
                    </div>
                    <!-- ./col-12 -->
                    <div class="col-12">
                        <div class="form-group ">
                            @php $categories = \App\Models\Product\Category\Category::all()->pluck("title","id") @endphp
                            <label for="category_id">@lang("Select Parent Category")</label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">@lang("Select Parent Category")</option>
                                {!! select_options($categories,"category_id") !!}
                            </select>
                            @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- ./col-12 -->

                    <div class="col-12">
                        <div class="form-group ">
                            <label for="link">@lang("Permalink")</label>
                            <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" placeholder="@lang("Permalink")" name="link" value="{{ old("link") }}">
                            @error('link')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <a href="" id="pageUrl">{{ request()->getScheme() }}://{{ request()->getHost() }}/</a>
                    </div>
                    <!-- ./col-12 -->

                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">{{ __("Description") }}</label>
                            <textarea class="form-control" id="description" placeholder="{{ __("Description") }}"
                                      name="description"
                                      style="min-height: 125px">{{ old("description") }}</textarea>
                            <div class="alert alert-danger d-none"></div>
                        </div>
                    </div>
                    <!-- ./col-12 -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Close") }}</button>
                    <button type="submit" class="btn btn-primary">{{ __("Save") }}</button>
                </div>
            </form>
        </div>

    </div>

</div>

@push("js")
    <!-- Summernote -->
    <script src="{{ admin_assets("summernote-bs4.min.js") }}"></script>
    <!-- Select2 -->
    <script src="{{ admin_assets("select2.full.min.js") }}"></script>

    <script>

            let id, body = $("body"),
                $btnSubmit = $("button[type=submit]"),
                $table = $("#categoriesTable"),
                $form = $("form"),
                $title = $("#title"),
                $description = $("#description"),
                $method = `<input type="hidden" name="_method" value="PUT">`,
                $model = $("#categoryModel")

            $('#category_id').select2()
            $("textarea").summernote({
                height: 300,
            });

            $model.on('hidden.bs.modal', function () {
                const $textarea = $("textarea");

                $("select").val(null).trigger('change');
                $textarea.summernote('destroy')
                $textarea.summernote('code', null)
                $form[0].reset();
                $form.trigger("reset");
            });


            $form.submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);

                if ($btnSubmit.data("method") === "put") {
                    ajax(`{{ url("dashboard/products/categories") }}/${$btnSubmit.data("id")}`, "put")
                } else {
                    ajax("{{ route("categories.store") }}", "POST", formData)
                }
            })



            body.on("click", ".btn-edit", function () {

                $btnSubmit.attr("data-method", "put")
                    .attr("data-id", $(this).data("id"));

                $("form").prepend($method);

                var data = JSON.parse(JSON.stringify($(this).data("data")));


                for (const [key, value] of Object.entries(data)) {

                    if (key !== "deleted_at") {
                        var $node= $(`#${key}`);

                        $node.val(value);

                        if (key === "description") {
                            $node.summernote('code', value)
                        }
                        if (key === "category_id") {
                            $node.val(value).trigger('change');
                        }
                    }
                }

                $model.modal("show");
            });

            $title.keyup(function () {
                if ($(this).length > 0) {
                    $(this).removeClass("is-invalid").next(".alert").hide();
                }
            })

            $("input[name=title]").keyup(function () {
                const scheme = "{{ request()->getScheme() }}://",
                    host = "{{ request()->getHost() }}/",
                    permalink = $(this).val().replaceAll(" ","-"), //strReplace([" ","-","/","_","@",".","#","$","!","%","^","&","*","(",")","+","="],"-", $(this).val()),
                    url = scheme + host + permalink;
                $("#link").val(permalink)
                $("#pageUrl").text(url).attr("href",url)
            })
            function ajax(url, method, formData = null) {
                $.ajax({
                    type: method,
                    url: url,
                    data: method === "put" ? JSON.stringify({
                        title: $title.val(),
                        description: $description.val(),
                        _method: method
                    }) : formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: method === "put" ? "application/json" : false,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        if (data.status === 1) {
                            Swal.fire(
                                'Congratulation',
                                data.message,
                                'success'
                            )
                            if ($btnSubmit.data("method") === "put") {
                                $btnSubmit.removeAttr("data-method");
                                $("input[name=_method]").remove();
                                $title.val("")
                            }
                            $model.modal("hide");
                            $table.DataTable().draw();
                            $form[0].reset();
                            $form.trigger("reset");
                        }
                    },
                    error: function (data, textStatus, jqXHR) {
                        const response = data.responseJSON;
                        console.log(response)
                        if (response) {
                            console.log(response.errors)
                            for (const [key, value] of Object.entries(response.errors)) {
                                $(`#${key}`)
                                    .addClass("is-invalid")
                                    .parent()
                                    .find(".alert")
                                    .removeClass("d-none")
                                    .text(value[0])
                                    .show()
                            }
                        }
                    },
                });
            }
        </script>
@endpush
