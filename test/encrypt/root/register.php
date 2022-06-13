


include 'conn.php';
if(isset($_POST['name'])&&isset($_POST['password'])&&isset($_POST['age'])){
    $name = test_input($_POST['name']);
    //var_dump(strlen($name));exit();
    $password = test_input($_POST['password']);
    $age = test_input($_POST['age']);
    //以下为数据验证
    if(strlen($name)<6){
        echo '<script>alert("姓名长度不能小于6");</script>';
        echo '<script>window.location.href = "register.html"</script>';
        exit();
    }
    if(strlen($name)>20){
        echo '<script>alert("姓名长度不能大于20");</script>';
        echo '<script>window.location.href = "register.html"</script>';
        exit();
    }
    if(strlen($password)<6){
        echo '<script>alert("密码长度不能小于6");</script>';
        echo '<script>window.location.href = "register.html"</script>';
        exit();
    }
    if(strlen($password)>20){
        echo '<script>alert("密码长度不能大于20");</script>';
        echo '<script>window.location.href = "register.html"</script>';
        exit();
    }
    if(!is_numeric($age)){
        echo '<script>alert("年龄必须是数字");</script>';
        echo '<script>window.location.href = "register.html"</script>';
        exit();
    }
    if(intval($age)<0){
        echo '<script>alert("年龄必须为正数");</script>';
        echo '<script>window.location.href = "register.html"</script>';
        exit();
    }
    if(strlen($age)>3){
        echo '<script>alert("年龄最大位数为3");</script>';
        echo '<script>window.location.href = "register.html"</script>';
        exit();
    }
    //判断用户是否存在
    $query = 'select * from user where name='.'"'.$name.'"';
    $data = mysqli_query($conn, $query);
    //var_dump($data);exit();
    if($data->num_rows!=0){
        echo '<script>alert("此用户已经存在");</script>';
        echo '<script>window.location.href = "register.html"</script>';
        exit();
    }
    //如果没有则写入数据
    $regtime = time();
    $query = 'insert into user (name,password,age,regtime) values ('.'"'.$name.'",'.'"'.$password.'",'.$age.','.$regtime.')';
    $data = mysqli_query($conn, $query);
    //var_dump($data);exit();
    if($data){
        echo '<script>alert("用户注册成功，将跳转新网址");</script>';
        echo '<script>window.location.href = "https://www.baidu.com/"</script>';
        exit();
    }else{
        echo '<script>alert("注册用户失败");</script>';
        echo '<script>window.location.href = "register.html"</script>';
        exit();
    }
}
function test_input($data)
{
   $data = trim($data);//去除数据两头的空格
   $data = stripslashes($data);//去除用户输入数据中的反斜杠 (\)
   $data = htmlspecialchars($data);//把一些预定义的字符转换为 HTML 实体
   return $data;
}
//时间戳转换字符串时间格式
$time = time();
function changeTime($time){
    $format = 'Y-m-d H:i:s';
    $data = date($format, $time);
    return $data;
}
