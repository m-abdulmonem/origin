<?php


if (!function_exists("file_tree")) {
    function file_tree($folder, bool $recursive = false): string
    {
        $extensions = ['.', 'blade', 'php', 'css', 'js', 'min', 'png', 'gif', 'jpg', 'svg', 'jpeg'];
        $html = '<table class="table table-hover"><tbody>';
        if ($folder['is_file']) {
            $html .= '<tr><td class="border-0 file" data-path="' . $folder['path'] . '">' . str_replace($extensions, "", $folder['name']) . '  <i class="fa fa-minus btn-delete-file float-right"></i></td></tr>';
        } else {
            $html .= '<tr data-widget="expandable-table" aria-expanded="false">
                        <td data-path="' . $folder['path'] . '" class="folder">
                            <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                            ' . $folder['name'] . '

                            <i class="fa fa-minus btn-delete-file float-right"></i>
                            <i class="fa fa-plus btn-add-file float-right mr-2"></i>
                        </td>
                    </tr>';
            $html .= file_tree_files($folder, $extensions);
        }
        $html .= $recursive ? '' : '</tbody></table>';
        return $html;
    }
}

if (!function_exists("file_tree_files")) {
    function file_tree_files($folder, $extensions): string
    {
        $html = '<tr class="expandable-body d-none">';
        $html .= '<td>';
        $html .= '<div class="p-0" style="display: none;">';
        $html .= '<table class="table table-hover">';
        $html .= '<tbody>';
        foreach ($folder['children'] as $file) {
            if ($file['is_file']) {
                $html .= '<tr><td class="file" data-path="' . $file['path'] . '">' . str_replace($extensions, "", $file['name']) . '  <i class="fa fa-minus btn-delete-file float-right"></i></td></tr>';
            } else {
                $html .= file_tree($file, true);
            }
        }
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';
        $html .= '</td>';
        $html .= '</tr>';
        return implode(',', array_unique(explode(',', $html)));
    }
}




if (!function_exists("get_template_files")) {
    function _get_template_files($dir, $level): array
    {
        $files = [];
        foreach (scandir($dir) as $file) {
            if ($file == '.' || $file == '..') continue;
            if (is_file($file)) {
                $files[] = [
                    'level' => $level,
                    'name' => $file,
                    'path' => "$dir/$file"
                ];
            }
        }
        return $files;
    }

}

if (!function_exists("delete_dir")) {

    function delete_dir($dirPath): void
    {
        if (!is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (!str_ends_with($dirPath, '/')) {
            $dirPath .= '/';
        }

        $files = glob($dirPath . '*', GLOB_MARK);

        foreach ($files as $file) {
            if (is_dir($file)) {
                delete_dir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
}


if (!function_exists("_directories_data")) {

    /**
     * @param $dir
     * @param $file
     * @param $level
     * @return array
     */
    function _directories_data($dir, $file, $level): array
    {
        if (is_dir($dir)) {
            $children = expandDirectoriesMatrix($dir, $level + 1);
            $files = _get_template_files($dir, $level);
        } else {
            $children = null;
            $files = null;
        }
        return [
            'level' => $level,
            'name' => $file,
            'path' => $dir,
            'children' => $children,
            'files' => $files,
            'is_file' => !is_dir($dir) //(!$children && !$files)
        ];
    }
}

if (!function_exists("expandDirectoriesMatrix")) {
    function expandDirectoriesMatrix($base_dir, $level = 0): array
    {
        $directories = [];
        if ($base_dir){
            foreach (scandir($base_dir) as $file) {
                if ($file == '.' || $file == '..') continue;
                $dir = $base_dir . DIRECTORY_SEPARATOR . $file;
                $directories[] = _directories_data($dir, $file, $level);
            }
        }

        return $directories;
    }
}


if (!function_exists("_assets")) {
    function _assets($path, $folder, $plugin = null, bool $fullPath = false): string
    {
        $assets = "assets/$folder/";
        $imgTypes = ['jpeg', 'jpg', 'png', 'ico', 'svg'];
        $extension = array_reverse(explode(".", $path));

        if ($fullPath) {
            return asset($assets . "plugin/$plugin/$path");
        }
        if ($plugin) {
            $pluginFolder = is_string($plugin) ? $plugin : $extension[count($extension) - 1];
            return asset($assets . "plugin/$pluginFolder/" . $extension[0] . "/$path");
        }
        if (in_array($extension[0], $imgTypes)) {
            return asset($assets . "img/$path");
        }
        return asset($assets . $extension[0] . "/$path");
    }
}

if (!function_exists("admin_assets")) {
    function admin_assets($path, $plugin = null, bool $fullPath = false): string
    {
        return _assets($path, "dashboard", $plugin, $fullPath);
    }
}

if (!function_exists("frontend_assets")) {
    /**
     * @param $path
     * @param string|null $plugin
     * @param false $fullPath
     * @return string
     */
    function frontend_assets($path, string $plugin = null, bool $fullPath = false): string
    {
        return _assets($path, "frontend", $plugin, $fullPath);
    }
}
