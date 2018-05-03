# İnternetin Ön Sayfasına Hoş Geldiniz!

[telve.net](https://telve.net/) internette bulduğunuz bağlantıları veya kendi özgün içeriklerinizi paylaşabileceğiniz kapsamlı bir sosyal yorumlama ağıdır. **telve.net** kısaca anlatmak gerekirse [reddit.com](https://www.reddit.com/)'un başarılı bir şekilde CodeIgniter framework'ü ile yeniden yazılmış halidir.

<p align="center">
  <img src="https://i.imgur.com/izW0W16.png" alt="telve.net ekran görüntüsü"/>
</p>


**Yazılım Bağımlılıkları:**

 - LAMP(Linux, Apache, MySQL, PHP) kurulu bir sunucu
 - PHP versiyon 7.0.8 (Ubuntu 16.04)
 - CodeIgniter versiyon 3.1.2
 - PHP BC Math kütüphanesi
 - phpMyAdmin (veritabanını içe aktarmak için, pratik)


### Kurulum

 - Öncelikle [VestaCP'yi sunucunuza kurunuz](https://vestacp.com/install/)
 - `sudo apt-get install php-bcmath` komutu ile PHP BC Math kütüphanesini kurun
 - Daha sonra VestaCP'nin arayüzünden gerekli kullanıcı ve alan adı ekleme işlemlerini gerçekleştirin
 - Alan adı oluştururken **Lets Encrypt** ile SSL desteğini de eklemeyi unutmayın
 - Alan adı sağlayıcınızın DNS ayarlarında A host kaydının sizin sunucunuza yönlendirilmiş olduğundan emin olun
 - Bu depoyu alan adının bağlı olduğu dizine klonlayın: `git clone https://github.com/mertyildiran/telve.net.git .`
 - `application/config/database.php` içerisindeki [şu satırları](https://github.com/mertyildiran/telve.net/blob/master/application/config/database.php#L52-L54) kendi veritabanı kullanıcı bilgileriniz ile değiştirin
 - Eğer SSL desteği istiyorsanız `application/config/config.php` içerisindeki [şu satırları](https://github.com/mertyildiran/telve.net/blob/master/application/config/config.php#L17-L19) `$config['base_url']	= 'https://alanadiniz.com/';` ve `$config['https_enabled'] = TRUE;` olarak değiştirmeyi unutmayın
 - Eğer e-posta servisini kullanacaksınız (kullanıcıların şifrelerini sıfırlamaları için gerekli) [şu satırları](https://github.com/mertyildiran/telve.net/blob/master/application/config/config.php#L361-L365) kendi e-posta servisinizin verdiği bilgiler ile değiştirmeyi unutmayın
 - Şimdi [admin_telve.sql](https://raw.githubusercontent.com/mertyildiran/telve.net/master/db/admin_telve.sql) (temiz veritabanı) dosyasını indirip phpMyAdmin arayüzünden içeri aktarın
 - Bu noktada [https://alanadiniz.com/](https://alanadiniz.com/) sayfasını açtığınızda "**Hiç bir gönderi bulunamadı**" şeklinde bir uyarı görüyor olmalısınız
 - Eğer kurulumu bir de örnek verilerle test etmek istiyorsanız; [admin_telve_data.sql](https://github.com/mertyildiran/telve.net/blob/master/db/admin_telve_data.sql) (örnek veriler) dosyasını indirip phpMyAdmin arayüzünden içeri aktarın
