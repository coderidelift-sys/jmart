<!doctype html>
<!--
   * Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
   * @version 1.0.0-beta20
   * @link https://tabler.io
   * Copyright 2018-2023 The Tabler Authors
   * Copyright 2018-2023 codecalm.net Paweł Kuna
   * Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
   -->
<html lang="en">
   <head>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
      <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
      <title>JMART APP</title>
      <!-- CSS files -->
      <link rel="icon" href="<?= base_url('') ?>public/template/img/favicon/favicon.ico" type="image/x-icon"/>
      <link href="<?= base_url('') ?>public/template/css/tabler.min.css?1692870487" rel="stylesheet"/>
      <link href="<?= base_url('') ?>public/template/css/tabler-flags.min.css?1692870487" rel="stylesheet"/>
      <link href="<?= base_url('') ?>public/template/css/tabler-payments.min.css?1692870487" rel="stylesheet"/>
      <link href="<?= base_url('') ?>public/template/css/tabler-vendors.min.css?1692870487" rel="stylesheet"/>
      <link href="<?= base_url('') ?>public/template/css/demo.min.css?1692870487" rel="stylesheet"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <style>
         @import url('https://rsms.me/inter/inter.css');
         :root {
         --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
         }
         body {
         font-feature-settings: "cv03", "cv04", "cv11";
         }
         .navbar-brand-text {
         margin-left: 1rem !important;
         padding-top: 0.5rem !important;
         }

         .navbar-dark {
           background: #1e293b;
           color: rgba(255, 255, 255, 0.7);
        }

        .navbar-dark .navbar-nav .nav-link {
           color: rgba(255, 255, 255, 0.7);
        }

        .navbar-dark .navbar-nav .nav-link:hover, .navbar-dark .navbar-nav .nav-link:focus {
           color: #ffffff;
        }

         @media (min-width: 768px){
               .navbar-expand-md.navbar-dark .nav-item.active .nav-link, .navbar-expand-md .navbar-dark .nav-item.active .nav-link {
                background-color: rgba(0, 0, 0, 0.1);
            }
         }
      </style>