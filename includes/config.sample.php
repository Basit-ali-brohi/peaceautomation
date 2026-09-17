<?php
/**
 * Site constants + credentials.
 *
 * This file is gitignored. Copy config.sample.php → config.php on a new
 * environment and fill in the real values.
 */

declare(strict_types=1);

return [
    // --- Identity -------------------------------------------------------
    'name'    => 'Peace Automation',
    'tagline' => 'Smart security and automation built for Pakistani businesses',
    'url'     => 'https://peaceautomation.com',

    // --- Contact --------------------------------------------------------
    'phone'      => '+92 3XX XXXXXXX',
    'phone_href' => '+923210000000',     // TODO: digits only, for tel:
    'whatsapp'   => '923210000000',      // TODO: country code + number, no +
    'whatsapp_msg' => 'Hi, I would like to book a free site survey.',
    'email'      => 'support@peaceautomation.com',
    'address'    => 'Office #605, 6th Floor, Al Fasi Glass Tower, Gulshan-e-Iqbal, Karachi',
    'hours'      => 'Mon–Sat, 10:00am – 8:00pm',

    // --- Socials --------------------------------------------------------
    'social' => [
        'facebook'  => '#',   // TODO
        'instagram' => '#',   // TODO
        'linkedin'  => '#',   // TODO
        'youtube'   => '#',   // TODO
    ],

    // --- Mail (PHPMailer / SMTP) ---------------------------------------
    'mail' => [
        'to'        => 'support@peaceautomation.com',
        'from'      => 'website@peaceautomation.com',
        'from_name' => 'Peace Automation Website',
        'smtp'      => false,            // set true once SMTP details are filled in
        'host'      => '',               // TODO: smtp.hostinger.com etc
        'port'      => 587,
        'username'  => '',               // TODO
        'password'  => '',
        'encryption'=> 'tls',
    ],

    // --- Bank transfer details shown on the order confirmation page -----
    'bank' => [
        'title'   => 'Peace Automation',   // TODO: registered account title
        'bank'    => 'Meezan Bank',        // TODO
        'account' => '0000 0000 0000 0000',// TODO
        'iban'    => 'PK00 MEZN 0000 0000 0000 0000', // TODO
    ],

    // Where newsletter signups are appended when no DB is configured
    'newsletter_csv' => __DIR__ . '/../storage/subscribers.csv',
];
