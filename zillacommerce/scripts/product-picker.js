'use strict';

(function () {

  window.addEventListener('message', receiveMessage, false);

  function receiveMessage(event) {
    var ed = tinymce;
    if (event.origin !== 'https://widgets.shopifyapps.com') {
      return;
    }

    var resourceType = event.data.resourceType;
    var handle = event.data.resourceHandles[0];

    if (handle != null && handle != '') {
      window.send_to_editor('[shopify-product type="' + resourceType + '" handle="' + handle + '"]');
    } else {
      alert(ZillaCommerce.productPickerError);
    }

    jQuery.ajax({
      url: ajaxurl,
      type: 'post',
      data: {
        action: 'zillacommerce_update_shop',
        shop: event.data.shop
      },
      success: function success(html) {
        tb_remove();
      }
    });
  }
})(jQuery);