<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="popup-overlay" style="display: none;">
    <div class="popup-salon">
        <div class="popup-form">
            <img src="<?php echo get_template_directory_uri() . '/images/Contactheader.png'; ?>" class="imgForm">
            <span class="popup-close"></span>
        </div>

        <?php
        // On insère le formulaire de demandes de renseignements
        echo do_shortcode('[contact-form-7 id="2a201c2" title="Formulaire de contact 1"]');
        ?>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    $('#popup-trigger').on('click', function(e) {
        e.preventDefault(); 
        $('.popup-overlay').show();
    });

    $('.popup-overlay').on('click', function() {
        $('.popup-overlay').hide();
    });

    $('.popup-salon').on('click', function(e) {
        e.stopPropagation(); 
    });

    $('.popup-close').click(function() {
        $('.popup-overlay').hide();
    });
});

</script>
