<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>AUTH - JMART</title>
  <!-- CSS files -->
  <link href="<?= base_url() ?>public/template/css/tabler.min.css?1692870487" rel="stylesheet" />
  <link href="<?= base_url() ?>public/template/css/tabler-flags.min.css?1692870487" rel="stylesheet" />
  <link href="<?= base_url() ?>public/template/css/tabler-payments.min.css?1692870487" rel="stylesheet" />
  <link href="<?= base_url() ?>public/template/css/tabler-vendors.min.css?1692870487" rel="stylesheet" />
  <link href="<?= base_url() ?>public/template/css/demo.min.css?1692870487" rel="stylesheet" />
  <style>
    @import url('https://rsms.me/inter/inter.css');

    :root {
      --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    body {
      font-feature-settings: "cv03", "cv04", "cv11";
    }
  </style>
</head>

<body class=" d-flex flex-column">
  <script src="<?= base_url() ?>public/template/js/demo-theme.min.js?1692870487"></script>
	<div id="loading-screen" style="
    position: fixed;
    z-index: 9999;
    top: 0; left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(255,255,255,0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    transition: opacity 0.3s ease;
    visibility: hidden;
    opacity: 0;
">
    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<style>
	#loading-screen.show {
    visibility: visible !important;
    opacity: 1 !important;
}
</style>
<script>
    function showLoading() {
        document.getElementById('loading-screen').classList.add('show');
    }

    function hideLoading() {
        document.getElementById('loading-screen').classList.remove('show');
    }
</script>
