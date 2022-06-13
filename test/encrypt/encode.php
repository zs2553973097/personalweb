<?php

/*
by凤凰张傻 2022、6、13，qq：2553973097
 */
//跨域请求设置
header('Access-Control-Allow-Origin:http://localhost:801');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST,GET,OPTIONS');
header('Access-Control-Allow-Headers:Authorization');
header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With,X-PINGOTHER,Content-Type');
//可以到这儿加密root文件夹里对应的文件，为测试方便，简单替换encode为ancode
$array = array();
$dir = __DIR__ . '\root';
$dir = str_replace('\\', '/', $dir);
$root = $dir;
$array = getFile($dir, $array, $root);
/*
  echo '<pre>';
  print_r($array);
  echo '</pre>';
 */
if (isset($_POST['getFlag']) && $_POST['getFlag'] == true) {
    $code = 200;
    $data = $array;
    echo json_encode(array(
        'code' => $code,
        'data' => $data
    ));
    exit();
}

function getFile($dir, &$array, $root) {
    $files = scandir($dir);
    foreach ($files as $k => $v) {
        $subPath = $dir . '/' . $v;
        if ($v == '.' || $v == '..') {
            continue;
        } else if (is_dir($subPath)) {
            getFile($subPath, $array, $root);
        } else {
            $web = str_replace($root, 'http://localhost:801/root', $subPath);
            
            $array[] = array(
                'Root' => $root,
                'Dir' => $dir,
                'File' => $web,
                'FileName' => $v
            );
        }
    }
    return $array;
}
