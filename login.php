<?php
if(isset($_POST['name']) && !isset($display_case)){
 $name=htmlspecialchars($_POST['name']);
 $sql=$dbh->prepare("SELECT name FROM chatters WHERE name=?");
 $sql->execute(array($name));
 if($sql->rowCount()!=0){
  $ermsg="<h2 class='error'>Nama sudah dipakai pengguna lain <a href='index.php'>Ubah</a></h2>";
 }else{
  $sql=$dbh->prepare("INSERT INTO chatters (name,seen) VALUES (?,NOW())");
  $sql->execute(array($name));
  $_SESSION['user']=$name;
 }
}elseif(isset($display_case)){
 if(!isset($ermsg)){
?>
 <h2>Nama Diperlukan Untuk Mengobrol</h2>
 Anda harus memberikan nama untuk mengobrol. Nama ini akan terlihat oleh pengguna lain.<br/><br/>
 <form action="index.php" method="POST">
  <div>Nama Kamu : <input name="name" placeholder="Namamu..."/></div>
  <button>Submit & Start Chatting</button>
 </form>
<?php
 }else{
  echo $ermsg;
 }
}
?>
