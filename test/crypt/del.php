<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['path'])&&!empty($_POST['path'])){
    $msg = '删除操作完成';
    $code = 200;
    $path = $_POST['path'];
    $index = strpos($path, '/');
    $path = substr($path,$index+1);
    $path = __DIR__.'/path/'.$path;
    $endDir = __DIR__.'/path';
    $endDir = str_replace('\\', '/', $endDir);
    $path = str_replace('\\', '/', $path);
    
    //var_dump($path);
    //var_dump($endDir);
    //exit();
    try{
        delFile($path);//先删除文件
        delDir($path, $endDir);//再删除空目录
        delDir($path, $endDir);//为安全，删两次空目录，保留原始目录
    }
    catch(Exception $e){
        $msg = '删除操作失败';
    }
    $result = array(
        'msg' =>$msg,
        'code'=>$code
    );
    echo json_encode($result);
    exit();
}
function delFile($path){
    $files = scandir($path);
    foreach($files as $v){
        $subPath = $path.'/'.$v;
        if($v=='.'||$v=='..'){
            continue;
        }else if(is_dir($subPath)){
            delFile($subPath);
        }else{
            unlink($subPath);
        }
    }
    return true;
}
function delDir($path,$endDir){
    //echo 'path:'.$path.'<br>';
    if($path===$endDir){
        echo 'return';
        return true;
    }
    $files = scandir($path);
    $i = 0;
    foreach($files as $v){
        $i = $i + 1;
        //echo $v.'<br>';
    }
    
    //echo 'i:='.$i.'<br>';
    if($i==2){
        $index = strripos($path,'/');
        $dir = substr($path, 0,$index);
        //echo '上级目录：'.$dir.'<br>';
        chdir($dir);
        //echo '删除目录：'.$path.'<br>';
        rmdir($path);
        $i = 0;
    }else{
        foreach($files as $v){
            $subPath = $path.'/'.$v;
            if($v=='.'||$v=='..'){
                continue;
            }else{
                delDir($subPath,$endDir);
            }
        }
        $i = 0;
    }
    return true;
}