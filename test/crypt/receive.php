<?php

/*
by凤凰张傻 2022、6、13，qq：2553973097
 */
if (isset($_POST['data']) && !empty($_POST['data'])) {
    $data = $_POST['data'];
    /*
      echo '<pre>';
      print_r($data);
      echo '</pre>';
     */
    $time = time();
    $time = date('Ymd',$time);
    $dir = randStr().$time;
    $root = __DIR__ . '/path/' . $dir;
    $root = str_replace('\\', '/', $root);
    $msg = '返回数据正确';
    $code = 200;
    $dataRes = 'path/'.$dir;
    try {
        if (!file_exists($root)) {
            mkdir($root, 777);
        }
        foreach ($data as $key => $val) {
            $Root = $val['Root'];
            $File = $val['File'];
            $Dir = $val['Dir'];
            $FileName = $val['FileName'];

            chdir($root);
            $path = str_replace($Root, '', $Dir);
            //var_dump($path);
            $filename = '';
            if (!empty($path)) {
                $newPath = $root . $path;
                //var_dump($path);
                if(!file_exists($newPath)){
                    mkdir($newPath, 777,true);
                }
                //var_dump($path);
                $filename = $newPath . '/' . $FileName;
                //var_dump($filename);
            } else {
                $filename = $root . '/' . $FileName;
                //var_dump($filname);
            }
            $content = file_get_contents($File);
            $str = substr($FileName, -4);
            if($str=='.php'){
                $content = '<?php '.$content;
            }
            //var_dump($filename);
            file_put_contents($filename, $content);
            
        }
    } catch (Exception $e) {
        $msg = '返回数据有误';
        $code = 1;
        $data = '';
    }
    $result = array(
        'msg' =>$msg,
        'code'=>$code,
        'data'=>$dataRes
    );
    echo json_encode($result);
    exit();
}

function randStr() {
    $str = 'abcdefghijklmnopqrstuvwxyz123456789';
    $result = '';
    for ($i = 0; $i<10; $i++) {
        $j = mt_rand(0, 34);
        $result .= $str[$j];
    }
    return $result;
}
