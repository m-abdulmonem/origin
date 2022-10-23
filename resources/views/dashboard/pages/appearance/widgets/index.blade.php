@extends("dashboard.layouts.app")
@section("content")
    @push('css')
        <link rel="stylesheet" href="{{ admin_assets("grapes.min.css",true) }}">
        <script src="{{ admin_assets("grapes.min.js",true) }}"></script>
        <script src="{{ admin_assets("grapesjs-blocks-basic.min.js",'grapes') }}"></script>
        <script src="{{ admin_assets("grapesjs-blocks-bootstrap4.min.js",'grapes') }}"></script>

    @endpush
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12">
                @csrf
                <div id="gjs" style="height:1000px !important; overflow:hidden;">
{{--                    @include("frontend.layouts.header")--}}
{{--                    @include("frontend.pages.home.home")--}}
{{--                    @include("frontend.layouts.footer")--}}
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- ./row -->

    </form>
    <!-- /.row -->


    @push('js')
        <script type="text/javascript">
            var editor = grapesjs.init({
                showOffsets: 1,
                noticeOnUnload: 0,
                container: '#gjs',
                height: '1200px',
                fromElement: 1,
                plugins: ["gjs-blocks-basic",'grapesjs-blocks-bootstrap4'],
                pluginsOpts: {
                    "gjs-blocks-basic": {
                        /* ...options */
                    },
                    'grapesjs-blocks-bootstrap4': {
                        blocks: {
                            // ...
                        },
                        blockCategories: {
                            // ...
                        },
                        labels: {
                            // ...
                        },
                        // ...
                    },
                },
                canvas: {
                    styles: [
                        'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css',
                        "{{ frontend_assets("abuabdo.css") }}",
                        "{{ frontend_assets("all.css") }}",
                        "{{ frontend_assets("jquery.bxslider.css") }}",
                        "{{ frontend_assets("app.css") }}"
                    ],
                    scripts: [

                        'https://code.jquery.com/jquery-3.3.1.slim.min.js',
                        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',
                        'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js',
                        "{{ frontend_assets("jquery.bxslider.min.js") }}",
                        "{{ frontend_assets("shuffle.js") }}",
                        "{{ frontend_assets("imgPreview.js") }}",
                        "{{ frontend_assets("slider.js") }}",
                        "{{ frontend_assets("toast.js") }}",
                        "{{ frontend_assets("loading.js") }}",
                        "{{ frontend_assets("app.js") }}"
                    ],
                },
                storageManager: {
                    id: 'gjs-',             // Prefix identifier that will be used inside storing and loading
                    type: 'local',          // Type of the storage
                    autosave: true,         // Store data automatically
                    autoload: false,         // Autoload stored data on init
                    stepsBeforeSave: 0,     // If autosave enabled, indicates how many changes are necessary before store method is triggered
                    storeComponents: true,  // Enable/Disable storing of components in JSON format
                    storeStyles: true,      // Enable/Disable storing of rules in JSON format
                    storeHtml: true,        // Enable/Disable storing of components as HTML string
                    storeCss: true,
                },
                styleManager : {
                    sectors: [{
                        name: 'General',
                        open: false,
                        buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom']
                    },{
                        name: 'Flex',
                        open: false,
                        buildProps: ['flex-direction', 'flex-wrap', 'justify-content', 'align-items', 'align-content', 'order', 'flex-basis', 'flex-grow', 'flex-shrink', 'align-self']
                    },{
                        name: 'Dimension',
                        open: false,
                        buildProps: ['width', 'height', 'max-width', 'min-height', 'margin', 'padding'],
                    },{
                        name: 'Typography',
                        open: false,
                        buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-shadow'],
                    },{
                        name: 'Decorations',
                        open: false,
                        buildProps: ['border-radius-c', 'background-color', 'border-radius', 'border', 'box-shadow', 'background'],
                    },{
                        name: 'Extra',
                        open: false,
                        buildProps: ['transition', 'perspective', 'transform'],
                    }
                    ],
                },
                commands: {
                    defaults: [
                        {
                            id: 'store-data',
                            run(editor) {
                                editor.store();
                            },
                        }
                    ]
                },
                buttons: [
                    {
                        id: 'save-button',
                        className: 'btn-save-button',
                        label: 'Save Changes',
                        command(editor) {
                            console.log(editor) }
                    }
                ],
                panels: {
                    // options
                }
            });

            editor.BlockManager.add('testBlock', {
                label: 'Block',
                attributes: { class:'gjs-fonts gjs-f-b1' },
                content: `<div style="padding-top:50px; padding-bottom:50px; text-align:center">Test block</div>`
            })

            const pn = editor.Panels;
            const panelViews = pn.addPanel({
                id: "views"
            });
            editor.Commands.add("save",{
                run: function (editor1,sender){
                    console.log(editor.getHtml());
                }
            })
            panelViews.get("buttons").add([
                {
                    attributes: {
                        title: "Save"
                    },
                    className: "fa fa-save",
                    command: "save",
                    togglable: false, //do not close when button is clicked again
                    id: "save"
                }
            ]);
                editor.Panels.addButton('myNewPanel',{
                    id: 'myNewButton',
                    className: 'someClass',
                    command: 'someCommand',
                    attributes: { title: 'Some title'},
                    active: false,
                });

            editor.Panels.addPanel({
                id: 'basic-actions',
                el: '.panel__basic-actions',
                buttons: [
                    {
                        id: 'alert-button',
                        className: 'btn-alert-button',
                        label: 'Click my butt(on)',
                        command(editor) { alert('Hello World'); }
                    }
                ]
            });


            const js= (editor.getJs() != null) ? `\<script>${editor.getJs()}<\/script>` : '',
                content = `<style>${editor.getCss()}</style> ${editor.getHtml()} ${js}`;


            $("form").submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                formData.append("content",content)
                $.ajax({
                    type:'POST',
                    url: "{{ route("dashboard.appearance.pages.store") }}",
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    success:function(data) {
                        Swal.fire(
                            'Congratulation',
                            'Page was created successfully',
                            'success'
                        )
                        const form =  $("form");
                        form[0].reset();
                        form.trigger("reset");

                    },
                    error: function(data, textStatus, jqXHR) {
                        const  response = data.responseJSON;
                        console.log(response);
                        console.log(textStatus);
                        console.log(jqXHR);
                        Swal.fire(
                            response.message,
                            response.errors['title'][0],
                            'error'
                        )
                    },
                });
            })

        </script>
    @endpush
@endsection
