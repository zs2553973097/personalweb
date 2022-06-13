

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$host = "localhost";
$user = "root";
$password = "zwp666";
$database = "lession";
$port = 3306;
$conn = mysqli_connect($host, $user, $password, $database, $port);
if(!$conn){
    echo "连接数据库错误！";
    exit();
}
echo '数据库成功连接！';
