<?php




$moFolderName = "erp2";

$sourceDir = __DIR__ . "/../../../$moFolderName/public/build";
$destDir = __DIR__ . '/../../';

// تأكد أن المجلدين موجودين
if (!is_dir($sourceDir)) {
    die("❌ مجلد المصدر غير موجود: $sourceDir");
}

if (!is_dir($destDir)) {
    die("❌ مجلد الوجهة غير موجود: $destDir");
}

// تنفيذ النسخ باستخدام shell_exec
shell_exec("chmod -R 777 $sourceDir");
$output2 = shell_exec("cp -r $sourceDir $destDir 2>&1");

if ($output2 === null) {
    echo "تم النسخ بنجاح!";
} else {
    echo "خطأ في النسخ: " . htmlspecialchars($output2);
}










?>
