<?php

// Hata raporlamayı etkinleştir
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "bulutsemih96@gmail.com";
    $from = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $name = htmlspecialchars($_POST['name']);
    $subject = htmlspecialchars($_POST['subject']);
    $cmessage = htmlspecialchars($_POST['message']);

    // E-posta başlıklarını ayarla
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . $from . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    // E-posta konusu
    $email_subject = "Bitmap Photography'den mesajınız var.";

    // E-posta içeriğini oluştur
    $logo = 'img/logo.png';
    $link = '#';

    $body = "<!DOCTYPE html><html lang='tr'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
    $body .= "<table style='width: 100%;'>";
    $body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
    $body .= "<a href='{$link}'><img src='{$logo}' alt=''></a><br><br>";
    $body .= "</td></tr></thead><tbody><tr>";
    $body .= "<td style='border:none;'><strong>İsim:</strong> {$name}</td>";
    $body .= "<td style='border:none;'><strong>Email:</strong> {$from}</td>";
    $body .= "</tr>";
    $body .= "<tr><td style='border:none;'><strong>Konu:</strong> {$subject}</td></tr>";
    $body .= "<tr><td colspan='2' style='border:none;'>{$cmessage}</td></tr>";
    $body .= "</tbody></table>";
    $body .= "</body></html>";

    // E-posta gönder
    $send = mail($to, $email_subject, $body, $headers);

    if ($send) {
        echo "Mesajınız gönderildi.";
    } else {
        echo "Mesajınız gönderilirken bir hata oluştu.";
    }
} else {
    echo "Geçersiz istek.";
}
?>
