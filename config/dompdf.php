<?php

return [

    "public_path" => null,

    "convert_entities" => true,

    "show_warnings" => false,

    "options" => [

        "chroot" => realpath(base_path()),

        "temp_dir" => sys_get_temp_dir(),

        "font_dir" => storage_path("font"),

        "font_cache" => storage_path("font"),

        "log_output_file" => null,

        "allowed_protocols" => [

            "file://" => [ "rules" => [], ],
            "http://" => [ "rules" => [], ],
            "https://" => [ "rules" => [], ],
        ],

        "pdf_backend" => "CPDF",

        "default_media_type" => "screen",

        "default_paper_size" => "a4",

        "default_paper_orientation" => "portrait",

        "enable_font_subsetting" => false,

        "default_font" => "serif",

        "font_height_ratio" => 1.1,

        "dpi" => 96,

        "enable_remote" => true,

        "enable_php" => false,

        "enable_javascript" => true,

        "enable_html5_parser" => true,

        // "DOMPDF_PDFLIB_LICENSE" => "your license key here", //
    ],

];
