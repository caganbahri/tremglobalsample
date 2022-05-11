<?php
require_once("db.php"); // veritabanı bağlantısını yaptığınız dosya 
header('Content-Type: application/json; charset=utf-8');

$isimsoyisim = $_POST["isimsoyisim"]; // Formdan gelen input bilgilerini çekiyoruz
$eposta = $_POST["eposta"]; // Formdan gelen input bilgilerini çekiyoruz
$telefon = $_POST["telefon"]; // Formdan gelen input bilgilerini çekiyoruz
$adres = $_POST["adres"];  // Formdan gelen input bilgilerini çekiyoruz



$query = $db->query("SELECT * FROM kayitdefteri WHERE eposta = '{$eposta}'")->fetch(PDO::FETCH_ASSOC);
if ( $query ){

$jsoncikti = array(
"islem" => false,
"mesaj" => "Eposta Adresi Kayitli"
);
echo json_encode($jsoncikti);

die();
}
$query = $db->query("SELECT * FROM kayitdefteri WHERE telefon = '{$telefon}'")->fetch(PDO::FETCH_ASSOC);
if ( $query ){

$jsoncikti = array(
"islem" => false,
"mesaj" => "Telefon Numarası Kayitli"
);
echo json_encode($jsoncikti);

die();
}




if($_COOKIE["kayit"]){
	$jsoncikti = array(
"islem" => false,
"mesaj" => "Yeni bir kayit eklemek için 1 dakika beklemelisiniz..."
);
}else{



if (!filter_var($eposta, FILTER_VALIDATE_EMAIL)) {
	
		$jsoncikti = array(
"islem" => false,
"mesaj" => "Bilinmeyen eposta türü"
);
}else{

if($isimsoyisim and $eposta and $telefon and $adres){
// veritabanına ekleniyor 
$query = $db->prepare("INSERT INTO kayitdefteri SET adsoyad=?, adres=?,telefon=?,eposta=?");
$insert = $query->execute(array($isimsoyisim,$adres,$telefon,$eposta));

if ( $insert ){
$sonid = $db->lastInsertId();
// bu kısımda bir dizi oluşturalım
$jsoncikti = array(
"islem" => true,
"isimsoyisim" => $isimsoyisim,
"telefon" => $telefon,
"mesaj" => "Kayit Başarıyla Eklenmiştir"
);
setcookie("kayit","1",60); 

}

}else{
$jsoncikti = array(
"islem" => false,
"mesaj" => "Lütfen tüm bilgileri giriniz..."
);

}

}
echo json_encode($jsoncikti);

}
?>