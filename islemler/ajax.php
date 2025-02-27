<?php
require 'baglan.php';

if (isset($_POST['ayarkaydet'])) {
    $sorgu = $db->prepare("UPDATE ayarlar SET 
        site_baslik=:site_baslik,
        site_aciklama=:site_aciklama,
        site_link=:site_link,
        site_sahip_mail=:site_sahip_mail,
        site_mail_host=:site_mail_host,
        site_mail_mail=:site_mail_mail,
        site_mail_port=:site_mail_port,
        site_mail_sifre=:site_mail_sifre
    ");
    $sonuc = $sorgu->execute(array(
        'site_baslik' => $_POST['site_baslik'],
        'site_aciklama' => $_POST['site_aciklama'],
        'site_link' => $_POST['site_link'],
        'site_sahip_mail' => $_POST['site_sahip_mail'],
        'site_mail_host' => $_POST['site_mail_host'],
        'site_mail_mail' => $_POST['site_mail_mail'],
        'site_mail_port' => $_POST['site_mail_port'],
        'site_mail_sifre' => $_POST['site_mail_sifre']
    ));

    if ($_FILES['site_logo']['error'] == "0") {
        // dosya yükleme olmaz ise herhangi bir değişiklik yapmma yükleme başarılı olursa db değiştir
        $gecici_isim = $_FILES['site_logo']['tmp_name'];
        $dosya_ismi = rand(1000000, 9999999999) . $_FILES['site_logo']['name'];
        move_uploaded_file($gecici_isim, "../dosyalar/$dosya_ismi");
        // tmp_name tarayıcıya yapılan dosyanın geçici ismidir
        $sorgu = $db->prepare("UPDATE ayarlar SET site_logo=:site_logo WHERE id=1");
        $sonuc = $sorgu->execute(array(
            'site_logo' => $dosya_ismi,
        ));
    }

    if ($sonuc) {
        header("location:../ayarlar.php?durum=success");
    } else {
        header("location:../ayarlar.php?durum=error");
    }
    exit;

}
//**************************************************************************************************

if (isset($_POST['oturumacma'])) {
    $sorgu = $db->prepare("SELECT * FROM kullanicilar WHERE kul_mail=:kul_mail AND kul_sifre=:kul_sifre");
    $sorgu->execute(array(
        'kul_mail' => $_POST['kul_mail'],
        'kul_sifre' => md5($_POST['kul_sifre'])
        // md5 şifre çözümlenmesi yapıldı
    ));
    $sonuc = $sorgu->rowcount();
    $kullanici = $sorgu->fetch(PDO::FETCH_ASSOC);

    if ($sonuc == 0) {
        header("location:../index.php?durum=error");
    } else {
        $_SESSION['kul_isim'] = $kullanici['kul_isim'];
        $_SESSION['kul_mail'] = $kullanici['kul_mail'];
        $_SESSION['kul_id'] = $kullanici['kul_id'];
        header("location:../index.php?durum=success");

    }
    exit;
}
// **************************************************************************************************

if (isset($_POST['profilkaydet'])) {
    $sorgu = $db->prepare("UPDATE kullanicilar SET
        kul_isim=:kul_isim,
        kul_mail=:kul_mail,
        kul_telefon=:kul_telefon WHERE kul_id=:kul_id
    ");
    $sonuc = $sorgu->execute(array(
        'kul_isim' => $_POST['kul_isim'],
        'kul_mail' => $_POST['kul_mail'],
        'kul_telefon' => $_POST['kul_telefon'],
        'kul_id' => $_SESSION['kul_id']

    ));

    if (strlen($_POST['kul_sifre']) > 0) {
        $sorgu = $db->prepare("UPDATE kullanicilar SET kul_sifre=:kul_sifre WHERE kul_id=:kul_id");
        $sonuc = $sorgu->execute(array(
            'kul_sifre' => md5($_POST['kul_sifre']),
            'kul_id' => $_SESSION['kul_id']

        ));
    }

    if ($sonuc) {
        header("location:../profil.php?durum=success");
    } else {
        header("location:../profil.php?durum=error");
    }
    exit;

}
// **************************************************************************************************
if (isset($_POST['musteriekle'])) {
    $sorgu = $db->prepare("INSERT INTO musteri SET
        musteri_isim = :musteri_isim,
        musteri_mail = :musteri_mail,
        musteri_telefon = :musteri_telefon,
        musteri_detay = :musteri_detay
    ");

    $ekleme = $sorgu->execute(array(
        'musteri_isim' => $_POST['musteri_isim'],
        'musteri_mail' => $_POST['musteri_mail'],
        'musteri_telefon' => $_POST['musteri_telefon'],
        'musteri_detay' => $_POST['musteri_detay']
    ));

    if ($ekleme) {
        header("location:../musteriler.php?durum=success");
    } else {
        header("location:../musteriler.php?durum=error");
    }
    exit;
}
// **************************************************************************************************
if (isset($_POST['musteriguncelle'])) {
    $sorgu = $db->prepare("UPDATE musteri SET
        musteri_isim = :musteri_isim,
        musteri_mail = :musteri_mail,
        musteri_telefon = :musteri_telefon,
        musteri_detay = :musteri_detay WHERE musteri_id=:musteri_id
    ");

    $ekleme = $sorgu->execute(array(
        'musteri_isim' => $_POST['musteri_isim'],
        'musteri_mail' => $_POST['musteri_mail'],
        'musteri_telefon' => $_POST['musteri_telefon'],
        'musteri_detay' => $_POST['musteri_detay'],
        'musteri_id' => $_POST['musteri_id']
    ));

    if ($ekleme) {
        header("location:../musteriler.php?durum=success");
    } else {
        header("location:../musteriler.php?durum=error");
    }
    exit;
}



?>