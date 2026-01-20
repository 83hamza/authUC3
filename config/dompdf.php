<?php

return [

    'show_warnings' => false,

    'public_path' => null,

    'convert_entities' => true,

    'options' => [

        // ✅ مكان تخزين ملفات الخطوط (metrics) الخاصة بـ dompdf
        // لازم يكون موجود وقابل للكتابة
        'font_dir'   => storage_path('fonts'),
        'font_cache' => storage_path('fonts'),

        'temp_dir' => sys_get_temp_dir(),

        'chroot' => realpath(base_path()),

        'allowed_protocols' => [
            'data://' => ['rules' => []],
            'file://' => ['rules' => []],
            'http://' => ['rules' => []],
            'https://' => ['rules' => []],
        ],

        'log_output_file' => null,

        'enable_font_subsetting' => true,

        'pdf_backend' => 'CPDF',

        'default_media_type' => 'screen',

        'default_paper_size' => 'a4',

        'default_paper_orientation' => 'portrait',

        // ✅ اسم الخط (سيُستخدم إذا HTML ما حددش خط)
        'default_font' => 'amiri',

        'dpi' => 96,
'enable_php' => true,

        

        'enable_javascript' => true,

        // ✅ لازم تكون true باش dompdf يقدر يقرأ ملفات fonts والصور من public_path()
        'enable_remote' => true,

        'allowed_remote_hosts' => null,

        'font_height_ratio' => 1.1,

        'enable_html5_parser' => true,
    ],
];
