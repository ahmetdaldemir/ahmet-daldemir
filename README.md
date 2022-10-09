## Case Hakkında

- [Proje laravel 9 ve php 8.0 versiyonu kullanılarak geliştirilmiştir.]
- [Herhangi bir ek kaynak kullanmadan çok zaman harcamamak adına sadece istenilen görevleri yerine getiren bir uygulama geliştirmeyi öngördüm.]
- [Projede laravel sail kullanıldı.]


## Nasıl Çalıştırılır.

1 - composer install
2 .vendor/bin/sail up
3. php artisan migrate

Komutları ile çalıştırabilirsiniz. Mysqbağlantısı için .env dosyasında mysq host alanını
DB_HOST=127.0.0.1 yapmanız gerekebilir.
Kurulum sonrası DB_HOST=mysql yaparak kullanabilirsiniz. 
Postman collection repo içerisinde mevcuttur. 

Ürün Ekleme
Kategori ekleme
Müşteri Ekleme 
Sipariş Ekleme 
Sipariş ekleme aşamasında stok kontrolü sipariş ekleme sonrası indirimleri optimize eden bir sınıf geliştirilmiştir. 

İndirimler için veritabanı şeması kullanmadım algoritmik olması için üzerinde düşünmek gerekiyor bununda süreyi uzatacağından dolayı hızlı bitimeye yönelik çalışma yaptım. 

## Neler Kullanabilirim

1 - Siparişleri ödeme işleminden sonra kuyruk yapısına atıp sistematik şekilde eklenmesini sağlayarak veritabanı yükünü azaltabilirim.
2 - Ürünlerin eklenmesi kuyruk içerisine atarak veritabanı yükünü azaltarabilirim.
3 - Sipariş ile ilgili log kayıtları için NOSQL (mongodb,greylog) gibi teknoloji ile log kayıtlarını düzenli ve ulaşılabilir tutabilirim.
4 - Cart yapısı kullanmadım fakat sepete eklenen ürünleri redis üzerinde tutarak ödeme adımına geçiş sırasında veritabanına ekleyerek hem veri aktarımını kolay ve güvenli hale getirebilirim,
    bu sayede ürünlerin ödeme işlemine geçmeden önce stok ve fiyat kontrolllerini hızlı yapabilmek ve sistem yükünü hafifletebilirim.
 
