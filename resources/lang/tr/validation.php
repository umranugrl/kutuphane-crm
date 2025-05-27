<?php

return [
    'required' => ':attribute alanı zorunludur.',
    'confirmed' => ':attribute alanı, doğrulama ile eşleşmiyor.',
    'max'        => [
        'string' => ':attribute en fazla :max karakter olabilir.',
    ],
    'min'        => [
        'string' => ':attribute en az :min karakter olmalıdır.',
    ],
    'custom'     => [
        'year' => [
            'max' => 'Yıl alanı en fazla 2099 olabilir.',
            'min' => 'Yıl alanı en az 1000 olmalıdır.',
        ],
        'g-recaptcha-response' => [
        'required' => 'Lütfen reCAPTCHA doğrulamasını tamamlayın.',
        ],
    ],
    'unique'     => ':attribute zaten kullanılıyor.',
    'exists'     => 'Seçilen :attribute geçerli değil.',
    'numeric'    => ':attribute sayısal bir değer olmalıdır.',
    'string'     => ':attribute metin olmalıdır.',
    'date'       => ':attribute geçerli bir tarih olmalıdır.',
    'url'        => ':attribute geçerli bir URL olmalıdır.',
    'email'      => ':attribute geçerli bir e-posta adresi olmalıdır.',

    'attributes' => [
        // Kategoriler
        'category_name'         => 'Kategori adı',
        'description'           => 'Açıklama',

        // Kitaplar
        'title'                 => 'Kitap adı',
        'author_id'             => 'Yazar',
        'category_id'           => 'Kategori',
        'publisher_id'          => 'Yayın evi',
        'year'                  => 'Yıl',
        'isbn'                  => 'ISBN',
        'page_count'            => 'Sayfa sayısı',

        // Yazarlar
        'full_name'             => 'Ad Soyad',

        // Yayın evleri
        'publisher_name'        => 'Yayın evi',
        'address'               => 'Adres',
        'phone'                 => 'Telefon',
        'website'               => 'Web sitesi',

        // Kullanıcılar
        'email'                 => 'E-posta',
        'password'              => 'Şifre',
        'password_confirmation' => 'Şifre doğrulama',
        'user_id'               => 'Kullanıcı',

        // Okuyucular
        'reader_full_name'      => 'Ad Soyad',
        'reader_id'             => 'Okuyucu',

        // Ödünç alma
        'book_id'               => 'Kitap',
        'borrower_id'           => 'Ödünç alan kişi',
        'loan_date'             => 'Ödünç alma tarihi',
        'return_date'           => 'İade tarihi',

        'current_password'      => 'Mevcut şifre',
    ],
];
