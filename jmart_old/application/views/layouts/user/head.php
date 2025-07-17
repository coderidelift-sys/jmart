<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
   <title>Dashboard User</title>
   <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
   <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5" />
   <!-- Canonical SEO -->
   <link rel="canonical" href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/" />
   <!-- Favicon -->
   <link rel="icon" type="image/x-icon" href="<?= base_url('') ?>public/template/img/favicon/favicon.ico" />
   <!-- <link rel="manifest" href="<?= base_url() ?>public/manifest.json"> -->
   <link href="<?= base_url() ?>public/template/css/tabler.min.css?1692870487" rel="stylesheet" />
   <link href="<?= base_url() ?>public/template/css/tabler-flags.min.css?1692870487" rel="stylesheet" />
   <link href="<?= base_url() ?>public/template/css/tabler-payments.min.css?1692870487" rel="stylesheet" />
   <link href="<?= base_url() ?>public/template/css/tabler-vendors.min.css?1692870487" rel="stylesheet" />
   <link href="<?= base_url() ?>public/template/css/demo.min.css?1692870487" rel="stylesheet" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.1/css/font-awesome.min.css">
   <style>
      @import url('https://rsms.me/inter/inter.css');

      :root {
         --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }

      body {
         font-feature-settings: "cv03", "cv04", "cv11";
      }
   </style>
   <!-- Global site tag (gtag.js) - Google Analytics -->
   <script async="async" src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
   <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
         dataLayer.push(arguments);
      }
      gtag("js", new Date());
      gtag("config", "GA_MEASUREMENT_ID");
   </script>
   <style>
      @font-face {
         font-family: 'gotham_fonts';
         src: url('<?= base_url('') ?>public/fonts/GothamBook.ttf');
      }

      .navbar {
         width: 100%;
         height: 4rem;
         color: #fff;
         z-index: 1;
      }

      .nav-bar__center__title {
         position: absolute;
         font-size: 1.1rem;
         font-weight: normal;
         text-align: center;
         width: 100%;
         margin: 0;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
      }

      .footer-nav {
         position: fixed;
         bottom: 0;
         background-color: #fff;
         width: 100%;
         z-index: 32;
         height: 60;
      }

      .footer-nav__link {
         text-align: center;
         padding: 0.8rem 0;
         display: block;
         color: #474645;
      }

      .footer-nav__link i {
         display: block;
         font-size: 2.8rem;
         margin-bottom: 0.5rem;
      }

      .footer-nav__link._active {
         color: #2F5596;
         position: relative;
         font-weight: bold;
         font-size: 16px;
      }

      a:focus,
      a:hover {
         text-decoration: none;
         color: #2F5596;
      }

      .greeting-cs {
         background-color: #00b0d1;
         border-radius: 50%;
         width: 40px;
         height: 40px;
      }

      .row--5 {
         margin-left: -0.5rem !important;
         margin-right: -0.5rem !important;
      }

      .row--5>* {
         padding-left: 0.5rem !important;
         padding-right: 0.5rem !important;
      }

      .container {
         padding-right: 1.6rem;
         padding-left: 1.6rem;
      }

      @media (min-width: 576px) {
         .container {
            max-width: 550px;
         }
      }

      .card {
         border-radius: 0.25rem;
         border: 1px solid rgba(0, 0, 0, .125);
         background-color: #fff;
         flex-direction: column;
         box-shadow: 0 2px 4px 0 rgb(71 70 69 / 40%) !important;
         background-clip: border-box;
      }

      .card-img-top {
         width: 100%;
         border-top-left-radius: calc(0.25rem - 1px);
         border-top-right-radius: calc(0.25rem - 1px);
      }

      .avatar {
         border-radius: 50%;
         object-fit: cover;
      }
   </style>
