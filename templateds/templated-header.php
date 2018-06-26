<?php
@session_start();
if (isset($_GET['lang']) && $_GET['lang'] == 'en') {
    $_SESSION["lang"] = 'en';
} else if (isset($_GET['lang']) && $_GET['lang'] == 'th') {
    $_SESSION["lang"] = 'th';
} else {
    if ($_SESSION["lang"] == NULL || $_SESSION["lang"] == "") {
        $_SESSION["lang"] = 'th';
    }
}
require_once '../../api/Common/i18n.class.php';
try {
    $i18n = new i18n('../../lang/lang_' . $_SESSION["lang"] . '.json', '../../langcache/', 'th');
    $i18n->init();
} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
}


$contextPath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/' . ($_SERVER['SERVER_NAME'] != 'localhost' ? "" : "PEXP01");
$_SESSION['CONTEXT'] = $contextPath;

if ($_SESSION[u_level] == NULL || $_SESSION[u_level] == "") {
    header("Location: ../../index.php");
    exit();
}
?>

<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <title>
            <?= L::browserTitle ?>
        </title>
        <meta name="description" content="Latest updates and statistic charts">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <?php
        $jsonStringLang = file_get_contents('../../lang/lang_' . $_SESSION["lang"] . '.json');
        ?>
        <script>
            var contextPath = '<?= $contextPath ?>';
            var L = <?= $jsonStringLang ?>;
        </script>
        <!--end::Web font -->
        <!--begin::Base Styles -->  
        <link href="../../assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
        <link href="../../css/common.css" rel="stylesheet" type="text/css" />
        <!--end::Base Styles -->

        <!--begin::Base Scripts -->
        <script src="../../assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
        <script src="../../assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
        <!--end::Base Scripts -->   



        <link rel="shortcut icon" href="../../assets/demo/default/media/img/logo/favicon.ico" />
        <script>
            $(document).ready(function () {
                blockui_always();
            });
        </script>
    </head>



</html>