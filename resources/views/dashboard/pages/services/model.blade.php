<div class="modal fade" id="serviceModel" style="display: none;" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __("Services") }}</h4>
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
                            <input type="text" class="form-control " id="title" placeholder="{{ __("Title") }}"
                                   name="title"
                                   value="{{ old("title") }}" required>
                            <div class="alert alert-danger d-none" style="display: none"></div>
                        </div>
                    </div>
                    <!-- ./col-12 -->
                    <div class="col-12">
                        <div class="form-group ">
                            <label for="price">{{ __("Price") }}</label>
                            <input type="text" class="form-control " id="price" placeholder="{{ __("Price") }}"
                                   name="price"
                                   value="{{ old("price") }}" required>
                            <div class="alert alert-danger d-none" style="display: none"></div>
                        </div>
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
    <script>
        let body = $("body"),
            $btnSubmit = $("button[type=submit]"),
            $table = $("#servicesTable"),
            $form = $("form"),
            $model = $("#serviceModel")


        $form.submit(function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            ajax(formData)
        })


        body.on("click", ".btn-edit-service", function () {

            resetForm();

            const data = JSON.parse(JSON.stringify($(this).data("data")));

            $form.append(`<input type=hidden value=${data.id} name="id" >`)

            for (const [key, value] of Object.entries(data)) {
                if (key !== "deleted_at") {
                    $(`#${key}`).val(value)
                }
            }

            $model.modal("show");
        });


        $(".btn-add").click(function () {
            resetForm()
        })


        function resetForm() {
            $form[0].reset();
            $form.trigger("reset");
            $('input[name=id]').remove();
        }

        function ajax(formData = null) {
            $.ajax({
                type: "POST",
                url: "{{ route("dashboard.services.store") }}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                cache: false,
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

                        $model.modal("hide");
                        $table.DataTable().draw();
                        resetForm();
                    }
                },
                error: function (data, textStatus, jqXHR) {
                    const response = data.responseJSON;
                    if (response) {
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
