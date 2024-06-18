<html>
<head>
    <title>login</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="stylesheet" type="text/css" href="simple-grid.css"/>
</head>
<body>
    <div class="container">
      <div class="row" style="padding-top: 90px;">
        <div class="col-4" style="margin-top:50px;">
        <h4 style="font-size: 21;">SELAMAT DATANG KEMBALI</h4>
        <form action="proseslogin.php" method="get" class="loginform">
        <br><br>
            <table>
                <tr>
                    <td></td>
                    <td>Username<br><br><input type="text" name="username" size="20" placeholder="  Username Anda" style="height: 50px; width: 300px; border-radius: 10px; border-color:bisque; margin-right:25px" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><br>Password<br><br><input type="text" name="password" size="20" placeholder="  ******" style="height: 50px; width: 300px; border-radius: 10px; border-color:bisque;" required></td>
                </tr>
            </table>
            <br>
            <input type="submit" name="kirim" value="MASUK" style="width: 305px; height:40px; color: white; background-color: #83D3D3; border-radius:12px; border-color:white; font-size:15px;">
            <br>Don’t have an account? 
            <a href="registrasi.php" style="text-decoration: black;"> Sign up fo free!</a>
        </form>
        </div>
            <div class="col-8" >
                <img src="asset/logo.jpg">
            </div>
      </div>
    </div>
</body>
</html>