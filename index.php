

<style type="text/css">
.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #40c0c0;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  text-align: center;
  color: black;
  font-weight: bold;
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #ffffff;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
button {
    width: 80px;
    height: 30px;
    background: black;
    color: white;
    border: none;
    font-size: 16px;
  }
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
body {
  background: #76b852; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #76b852, #8DC26F);
  background: -moz-linear-gradient(right, #76b852, #8DC26F);
  background: -o-linear-gradient(right, #76b852, #8DC26F);
  background: linear-gradient(to left, #76b852, #8DC26F);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}
</style>

<div class="login-page">
  <div class="form">


<?php if($_POST){
    $data = array(
                  'userName' => $_POST['username'],
                  'password' => $_POST['password'],
                  'terminal' => "WEB-TMONEY",
              );
    $url = "http://tmoney3.mozaik.id/index.php/api/sign-in";
    $context = stream_context_create(array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($data),
            'timeout' => 60
        )
    ));
    $resp = file_get_contents($url, FALSE, $context);
    $return = json_decode($resp, true);

    if($return['resultCode']){ ?>
      <table style="width:100%">
        <tr>
          <td>Hasil</td>
          <td><?php echo $return['resultCode'] ?></td>
        </tr>
        <tr>
          <td>Deskripsi</td> 
          <td><?php echo $return['resultDesc'] ?></td>
        </tr>
        <tr>
          <td>Tipe Pesan</td>
          <td><?php echo $return['messageType'] ?></td>
        </tr>
        <tr>
          <td>Waktu</td>
          <td><?php echo $return['timeStamp'] ?></td>
        </tr>
      </table>
    <?php }else{ ?>
      <table style="width:100%">
        <tr>
          <td>Hasil</td>
          <td><?php echo $return['resultCode'] ?></td>
        </tr>
        <tr>
          <td>Deskripsi</td> 
          <td><?php echo $return['resultDesc'] ?></td> 
        </tr>
        <tr>        
          <td>Tipe Pesan</td>
          <td><?php echo $return['messageType'] ?></td>
        </tr>
        <tr>
          <td>Waktu</td>
          <td><?php echo $return['timeStamp'] ?></td>
        </tr>
      </table>
      <br>
      <h3>User Data</h3>
      <table style="width:100%">
        <tr>
          <td>Login Terakhir</td>
          <td><?php echo $return['user']['lastLogin'] ?></td>
        </tr>
        <tr>
          <td>Saldo</td> 
          <td><?php echo $return['user']['balance'] ?></td>
        </tr>
        <tr>
          <td>ID Tmoney</td> 
          <td><?php echo $return['user']['idTmoney'] ?></td>
        </tr>
        <tr>
          <td>ID Fusi</td> 
          <td><?php echo $return['user']['idFusion'] ?></td>
        </tr>
        <tr>
          <td>Nama Custumer</td> 
          <td><?php echo $return['user']['custName'] ?></td>
        </tr>
        <tr>
          <td>Token</td>
          <td><?php echo $return['user']['token'] ?></td>
        </tr>
        <tr>
          <td>Handphone</td>
          <td><?php echo $return['user']['custPhone'] ?></td>
        </tr>
        <tr>
        </tr>
      </table>

    <?php } ?>

<?php }else{ ?>
    <form class="login-form"  action="index.php" method="post">
      <input type="text" name="username" placeholder="username"/>
      <input type="password" name="password" placeholder="password"/>
      <button>Login</button>
    </form>
<?php } ?>

  </div>
</div>







