<?php




if (!function_exists("datatable_files")) {
    /**
     * get datatable js files
     *
     * @param string $file_type
     * @return String
     */
    function datatable_files(string $file_type = "js"): String
    {
        if ($file_type == "css")
            echo '<!-- DataTables -->
                <link rel="stylesheet" href="' . admin_assets("datatable/dataTables.bootstrap4.min.css") . '">
                 <link rel="stylesheet" href="' . admin_assets("datatable/responsive.dataTables.min.css") . '">';

        if ($file_type == "js")
            echo '  <!-- DataTables -->
                <script src="' . admin_assets("datatable/jquery.dataTables.min.js") . '"></script>
                <script src="' . admin_assets("datatable/dataTables.bootstrap4.min.js") . '"></script>
                <script src="' . admin_assets("datatable/table.js") . '"></script>';

        return "";
    }
}// end of datatable_files

if (!function_exists("btn_delete")) {
    /**
     *
     * @param $url
     * @param $data
     * @param null $property
     * @param bool $back
     * @param null $title
     * @return string
     */
    function btn_delete($url, $data, $property = null, $title = null, bool $back = false): string
    {
        return '<button class="btn btn-danger btn-delete " type="button"
                       data-url="' . route("$url.destroy", $data->id) . '"
                       data-name="' . ($property ? $data->$property : $data->name) . '"
                       data-token="' . csrf_token() . '"
                       data-title="Are you Sure"
                       data-text="Delete ' . ($property ? $data->$property : $data->name) . '"
                       ' . ($back ? 'data-back=' . route("$url.index") : null) . '>
                       <i class="fa fa-trash"></i> ' . ($title ? "Delete $title" : null) . '</a>';
    }
}
