<?php
include("../resource/variable.php");
include("../resource/head-message.php");
include('../template/' . $data_index["template"] . '/header.php');
echo '</head>';
$cid = $_GET["id"];
include("../template/" . $data_index["template"] . "/category.php");
include('../template/' . $data_index["template"] . '/footer.php');
include("../resource/foot-message.php");