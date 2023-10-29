<?php
    $HelperModel    = new \App\Models\HelperModel();
    $db             = \Config\Database::connect();
    $dataSitus = $db->table('tb_pengaturan_situs')->where('website_id', 1)->get()->getRow();
    echo view('template/default', [
        "panelsidebar"  => "home/panelsidebar",
        "dataSitus"     => $dataSitus,
        "HelperModel"   => $HelperModel
    ]);

