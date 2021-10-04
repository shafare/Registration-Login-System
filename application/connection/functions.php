<?php

$connect = mysqli_connect("localhost", "root", "", "list_alumni");


function registrasi($data){
    global $connect;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($connect, $data["password"]);
    $konfirmasi = mysqli_real_escape_string($connect, $data["konfirmasi"]);

    //cek user ada/tidak dalam database
    $result = mysqli_query($connect, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('Username yang dipilih sudah ada')
            </script>";
        return false;
    }

    //cek konfirmasi password
    if($password !== $konfirmasi){
        echo "<script>
                alert('Konfirmasi password tidak sama!');
            </script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambah user baru ke database
    mysqli_query($connect, "INSERT INTO user VALUES('','$username','$password')");
    return mysqli_affected_rows($connect);
}

?>