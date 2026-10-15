/**
 * KLK Radio 47 - Admin Media Uploader for Events & Dials
 */
jQuery(document).ready(function($) {
  var mediaUploader;

  $('#fuego_dial_image_btn').on('click', function(e) {
    e.preventDefault();
    if (mediaUploader) {
      mediaUploader.open();
      return;
    }

    mediaUploader = wp.media({
      title: 'Seleccionar Imagen del Evento',
      button: {
        text: 'Usar esta Imagen'
      },
      multiple: false
    });

    mediaUploader.on('select', function() {
      var attachment = mediaUploader.state().get('selection').first().toJSON();
      $('#fuego_dial_image').val(attachment.url);
      $('#fuego_dial_image_preview').html('<img src="' + attachment.url + '" style="max-width:260px;height:auto;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,0.2);display:block;margin-top:6px;" />');
      $('#fuego_dial_image_remove').show();
    });

    mediaUploader.open();
  });

  $('#fuego_dial_image_remove').on('click', function(e) {
    e.preventDefault();
    $('#fuego_dial_image').val('');
    $('#fuego_dial_image_preview').html('');
    $(this).hide();
  });
});
