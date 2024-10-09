<head>
        <!-- Meta tags  -->
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="google" content="notranslate">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />

        <title><?=isset($title) ? $title : TITLE;?></title>
        <link rel="icon" type="image/png" href="<?=resource_url($dataSitus->logo_favicon);?>" />

        <!-- CSS Assets -->
        <link rel="stylesheet" href="<?=resource_url();?>assets-cat/css/app.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="<?=resource_url('assets-cat/css/custom.css');?>" />
        <!-- Javascript Assets -->
        <script src="<?=resource_url();?>assets-cat/js/app.js" defer></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com/" />
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />

        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
        <script src="https://cdn.tailwindcss.com/"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            var datatablesLanguage = "<?=resource_url('assets-cat/js/language.dataTables.json');?>"
        </script>

        <style>
            table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before, 
            table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before {
                content: "+";
                font-size: 18px;
                border: 1px solid#848df8;
                color: #848df8;
                border-radius: 100%;
                width: 17px;
                height: 17px;
                line-height: 15px;
                padding-left: 1.5px;           
            }
            table.dataTable.dtr-inline.collapsed>tbody>tr.parent>td.dtr-control:before, 
            table.dataTable.dtr-inline.collapsed>tbody>tr.parent>th.dtr-control:before {
                content: "-";
                font-size: 18px;
                border: 1px solid#848df8;
                background: #848df8;
                color: #fff;
                border-radius: 100%;
                width: 17px;
                height: 17px;
                line-height: 15px;
                padding-left: 3px;           
            }
            .miw-100{
                min-width: 100px;
            }
            .miw-200{
                min-width: 200px;
            }
            .miw-300{
                min-width: 300px;
            }
            .miw-400{
                min-width: 400px;
            }
            .miw-500{
                min-width: 500px;
            }

            .maw-100{
                max-width: 100px;
            }
            .maw-200{
                max-width: 200px;
            }
            .maw-300{
                max-width: 300px;
            }
            .maw-400{
                max-width: 400px;
            }
            .maw-500{
                max-width: 500px;
            }
            .maw-600{
                max-width: 600px;
            }
            .table-pw{
                max-height: 52px;
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                white-space: pre-wrap;
            }
        </style>
    </head>
