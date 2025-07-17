(function(window, $) {
  // Helper untuk show/hide loading
  var LoadingHelper = {
    showGlobal: function() {
      $('#global-loading-overlay').fadeIn(150);
    },
    hideGlobal: function() {
      $('#global-loading-overlay').fadeOut(150);
    },
    showButton: function($btn) {
      if ($btn.data('loading')) return;
      $btn.data('loading', true);
      $btn.data('original-html', $btn.html());
      $btn.html('<span class="spinner-border spinner-border-sm me-1"></span>Loading...').prop('disabled', true);
    },
    hideButton: function($btn) {
      if (!$btn.data('loading')) return;
      $btn.html($btn.data('original-html')).prop('disabled', false).data('loading', false);
    }
  };

  // Event delegation untuk form submit (AJAX & non-AJAX)
  $(document).on('submit', 'form:not([data-loading-exclude])', function(e) {
    var $form = $(this);
    var $btn = $form.find('[type=submit]:focus, [type=submit]:not([disabled]):first');
    // Show local loading di tombol jika ada, else global
    if ($btn.length) {
      LoadingHelper.showButton($btn);
    } else {
      LoadingHelper.showGlobal();
    }
    // Untuk AJAX, handler harus panggil LoadingHelper.hideButton/hideGlobal di success/error
    // Untuk non-AJAX, loading akan hilang otomatis saat reload
  });

  // Event delegation untuk button click (AJAX)
  $(document).on('click', 'button[data-loading], a[data-loading]', function(e) {
    var $btn = $(this);
    if ($btn.is('[data-loading-exclude]')) return;
    LoadingHelper.showButton($btn);
    // Handler AJAX harus panggil LoadingHelper.hideButton($btn) di success/error
  });

  // Helper global untuk dipanggil di handler AJAX
  window.LoadingHelper = LoadingHelper;

  // Optional: hide loading global saat page load
  $(window).on('load', function() {
    LoadingHelper.hideGlobal();
  });

})(window, jQuery); 
