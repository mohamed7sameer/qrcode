<?php

$moFolderName = "erp2" ;


$source1 = escapeshellarg(__DIR__ . "/../../$moFolderName") . '/';
$destination1 = escapeshellarg(__DIR__ . "/../../../$moFolderName") . '/';


if (!is_dir(__DIR__ . "/../../$moFolderName")) {
    die("المجلد غير موجود في المسار");
}

// استخدام rsync لنسخ الملفات والمجلدات مع الحفاظ على الملفات الموجودة
// $command = "rsync -a --ignore-existing $source1 $destination1 2>&1";
$command = "rsync -au $source1 $destination1 2>&1";
$output = shell_exec($command);

// التحقق من نجاح العملية
if ($output === null) {
    echo "تم النسخ بنجاح!";
} else {
    echo "خطأ في النسخ: " . htmlspecialchars($output);
}
    
    


$source2 = __DIR__ . "/../../$moFolderName/public/*";
$destination2 = __DIR__ . '/../../';
$output2 = shell_exec("cp -r $source2 $destination2 2>&1");
if ($output2 === null) {
    echo "تم النسخ بنجاح!";
} else {
    echo "خطأ في النسخ: " . htmlspecialchars($output2);
}






$source3 = __DIR__ . "/../../$moFolderName/webpack/public/";
$destination3 = __DIR__ . '/../../';
$output3 = shell_exec("rsync -a $source3 $destination3 2>&1");
if ($output3 === null) {
    echo "تم النسخ بنجاح!";
} else {
    echo "خطأ في النسخ: " . htmlspecialchars($output3);
}




    $source4 = __DIR__ . "/../../$moFolderName/webpack/main/env";
    $destination4 = __DIR__ . "/../../../$moFolderName/.env";

    if (!file_exists($source4)) {
        die("المجلد غير موجود في المسار: $source4");
    }

    shell_exec("rm -rf $destination4");
    // استخدام shell_exec لتنفيذ أمر نسخ المجلد بالكامل
    $output4 = shell_exec("cp -r $source4 $destination4 2>&1");

    if ($output4 === null) {
        echo "تم النسخ بنجاح!";
    } else {
        echo "خطأ في النسخ: " . htmlspecialchars($output4);
    }






?>
