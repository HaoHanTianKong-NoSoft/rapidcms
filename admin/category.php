<?php
include("../resource/variable.php");
function encode($string = '', $skey = 'cxphp')
{
    $strArr = str_split(base64_encode($string));
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
        $key < $strCount && $strArr[$key] .= $value;
    return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
}

define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");
define('BASE_PATH1',str_replace('\\','/',realpath(dirname(BASE_PATH).'/'))."/");
$json_string = file_get_contents(BASE_PATH1.'/install/sql-config/sql.json');
$dataxxx = json_decode($json_string, true);
$link = mysqli_connect($dataxxx['server'], $dataxxx['dbusername'], $dataxxx['dbpassword'], $dataxxx['dbname']);
$sql = "select password from `rapidcmsadmin` where username=\"admin\"";
$result = mysqli_query($link, $sql);
$pass = mysqli_fetch_row($result);
$pa = $pass[0];

if ($_COOKIE["admin"] != encode('admin',$pa)) {
    Header("Location: login.php"); 
}
?>

<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="utf-8">
    <title>RapidCMS管理后台</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="shortcut icon"" href=" ../../../../../resource/img/icon.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdui@1.0.2/dist/css/mdui.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mtu/dist/mtu.min.css">
    <link rel="stylesheet" href="../../../../resource/css/style.css">
    <link rel="stylesheet" href="../../../../../template/default/theme.css">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<body class=" mdui-appbar-with-toolbar mdui-theme-accent-indigo mdui-theme-primary-indigo mdui-text-color-white mdui-drawer-body-left" style="--color-primary: 63, 81, 181; --color-accent: 63, 81, 181;">
    <div class="mdui-toolbar mdui-color-theme mdui-text-color-white mdui-appbar mdui-appbar-fixed mdui-headroom">
        <button class="drawer mdui-btn mdui-btn-icon mdui-ripple" mdui-drawer="{target: '#drawer', swipe: true}"><i class="mdui-icon material-icons">menu</i></button>
        <span class="mdui-typo-title">RapidCMS管理后台</span>
    </div>

    <? include("drawer.php"); ?>
    <script type="text/javascript" language="javascript"> 
function confirmAct() 
{ 
  if(confirm('确定要删除吗?')) 
  { 
    return true; 
  } 
  return false; 
} 

</script> 
    <style>
        * {
            font-family: "MiSans", system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
    </style>
    <div style="    position: absolute;left: 60%;top:10%;text-align:center;    transform: translateX(-50%  );">

        <div class="mdui-card" style="overflow:scroll">

            <div class="mdui-card-primary">
                <div class="mdui-card-primary-title" style="font-size:30px;">分类设置   <a href="cate-add.php"><button class="mdui-btn mdui-btn-icon mdui-ripple"><i style="color:#6E6E6E" class="mdui-icon material-icons">&#xe147;</i></button></a></div>
             
            </div>
           
                <m-scrollbar style="height: 650px;width:900px;">
                    <div style="width:80%;position: absolute;left: 50%;    transform: translateX(-50%  );"  class="mdui-table-fluid">
                        <table class="mdui-table">
                            <thead>
                                <tr>
                                    <th>分类ID</th>
                                    <th>名称</th>
                                    <th>图标</th>
                                    <th>权重</th>
                                    <th  class="mdui-table-col-numeric"> </th>
                                </tr>
                            </thead>
                            <tbody>

                    <?php
                    $table_name = "rapidcmscategory";
                    $json_string = file_get_contents('../install/sql-config/sql.json');
                    $data = json_decode($json_string, true);
                    $conn = mysqli_connect($data['server'], $data['dbusername'], $data['dbpassword'], $data['dbname']);
                    $sql = 'select * from `' . $table_name . '`';
                    $res = mysqli_query($conn, $sql);
                    $colums = mysqli_num_fields($res);
                    while ($row = mysqli_fetch_row($res)) {
                       echo "<tr>";
                        echo "</tr>";
                        echo "<td>$row[0]</td>";
                        echo "<td>$row[1]</td>";
                        echo "<td><i class='mdui-list-item-icon mdui-icon material-icons'>$row[2]</i></td>";
                        echo "<td>$row[3]</td>";
                        echo '<td><a href="cate-edit.php?id='.$row[0].'"><button class="mdui-btn mdui-btn-icon mdui-ripple">   <i style="color:#6E6E6E" class="mdui-icon material-icons">&#xe3c9;</i></button></a>';
                  
                        echo '<a onclick="return confirmAct();" href="cate-del.php?id='.$row[0].'"><button class="mdui-btn mdui-btn-icon mdui-ripple"><i style="color:#6E6E6E" class="mdui-icon material-icons">&#xe872;</i></button></a>&nbsp;&nbsp;&nbsp;&nbsp;';
                            echo "</td>";
                    }
                    ?>
                                  
                               
                            </tbody>
                        </table>
                    </div>
                </m-scrollbar>
  
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/mtu/dist/mtu.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/mdui@1.0.2/dist/js/mdui.min.js"></script>
</body>

</html>