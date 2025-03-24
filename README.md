# Library CRM - Laravel Project

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

## Proje Hakkında

Library CRM, Laravel kullanılarak geliştirilmiş bir kütüphane yönetim sistemidir. Bu proje, kitapların, kategorilerin, yazarların, yayınevlerinin ve kullanıcıların yönetimini sağlar. Ayrıca, ödünç alma ve iade işlemlerini takip etmek için bir sistem içerir.

## Özellikler

- Kullanıcı kimlik doğrulama sistemi (Admin)
- Kitap ekleme, düzenleme, silme ve kategoriye göre listeleme
- Kategoriler oluşturma ve düzenleme
- Yazar ve yayınevi yönetimi (ekleme, düzenleme)
- Okuyucu yönetimi
- Kitap ödünç alma ve iade işlemleri
- Bildirim sistemi (Ödünç süresi dolmak üzere olan kitaplar için)
- Ajax ile dinamik kategori ekleme
- Admin paneli ile tüm yönetim işlemleri

## Özellikler

- Backend: Laravel 10
- Frontend: Blade, JavaScript 
- Veritabanı: MySQL
- Authentication: Laravel Multi-Guard Authentication
- Arayüz Teması: Majestic Teması
  
## Kurulum

Projeyi çalıştırmak için aşağıdaki adımları takip edebilirsiniz:

### 1. Depoyu Klonlayın
```sh
git clone https://github.com/kullaniciAdi/library-crm.git
cd library-crm
```

### 2. Bağımlılıkları Yükleyin
```sh
composer install
npm install
```

### 3. Ortam Değişkenlerini Ayarlayın
```sh
cp .env.example .env
```
`.env` dosyasında DB_DATABASE, DB_USERNAME ve DB_PASSWORD alanlarını düzenleyin.

### 4. Uygulamayı Başlatın
```sh
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Kullanım

- Admin olarak giriş yaparak kitap, kategori, yazar, yayınevi ve okuyucu ekleyebilirsiniz.
- Ödünç alınan kitaplar, Kitaplar modülünden takip edilir.
- Bildirimler, süresi dolmak üzere olan kitaplar için adminlere iletilir.

## Katkıda Bulunma
Bu projeye katkıda bulunmak isterseniz, lütfen bir "pull request" oluşturun veya bir "issue" açarak önerilerinizi paylaşın.

## Lisans
Bu proje, [MIT Lisansı](https://opensource.org/licenses/MIT) altında lisanslanmıştır.
