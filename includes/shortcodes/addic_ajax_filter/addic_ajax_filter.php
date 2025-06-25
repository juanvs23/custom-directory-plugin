<?php
require __DIR__ . '/display__filter_sections.php';
require __DIR__ . '/addic_ajax_base_content.php';
require __DIR__ . '/getTermButtons.php';
require __DIR__ . '/addic_ajax_filter_callback.php';
require __DIR__ . '/rehab_ajax_item.php';
require __DIR__ . '/addic_get_ajax_rehabs.php';


if(!function_exists('addic_ajax_filter_fn')){
    function addic_ajax_filter_fn($atts){

        ob_start();
        ?>
        <div class="addic_ajax_filter">
            <form class="addic_ajax_form">
               <div class="form_content">
                    <button type="submit" class="ajax_button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.4408 4C10.3339 4.00009 9.24311 4.26489 8.25939 4.77228C7.27567 5.27968 6.42755 6.01497 5.7858 6.91681C5.14404 7.81864 4.72726 8.86087 4.57022 9.95655C4.41318 11.0522 4.52044 12.1696 4.88305 13.2153C5.24565 14.2611 5.8531 15.205 6.65469 15.9683C7.45629 16.7316 8.4288 17.2921 9.49108 17.6031C10.5534 17.9141 11.6746 17.9666 12.7613 17.7561C13.848 17.5456 14.8685 17.0783 15.7379 16.3932L18.7202 19.3755C18.8742 19.5243 19.0805 19.6066 19.2947 19.6047C19.5088 19.6029 19.7136 19.517 19.865 19.3656C20.0164 19.2142 20.1023 19.0094 20.1042 18.7952C20.106 18.5811 20.0237 18.3748 19.8749 18.2208L16.8926 15.2385C17.6994 14.2149 18.2018 12.9849 18.3422 11.6892C18.4826 10.3934 18.2554 9.08436 17.6866 7.91174C17.1177 6.73912 16.2302 5.75033 15.1257 5.05854C14.0211 4.36675 12.7441 3.99991 11.4408 4ZM6.13267 10.9414C6.13267 9.53357 6.69192 8.18343 7.68738 7.18797C8.68284 6.19251 10.033 5.63326 11.4408 5.63326C12.8486 5.63326 14.1987 6.19251 15.1942 7.18797C16.1896 8.18343 16.7489 9.53357 16.7489 10.9414C16.7489 12.3492 16.1896 13.6993 15.1942 14.6948C14.1987 15.6902 12.8486 16.2495 11.4408 16.2495C10.033 16.2495 8.68284 15.6902 7.68738 14.6948C6.69192 13.6993 6.13267 12.3492 6.13267 10.9414Z" fill="#1A1A1A"/>
                        </svg>
                    </button>
                    <input type="hidden" name="action" class="ajax_action" value="addic_ajax_filter">
                    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'addic_ajax_filter' ); ?>">
                    <input type="text" name="search" class="search" placeholder="Search a Rehab or Location">
                    <div class="loader"></div>
               </div>
            </form>
            <div class="addic_ajax_result">
                <div class="addic_ajax_content">
                    <?php echo addic_ajax_base_content(); ?>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
  
    add_shortcode('addic_ajax_filter', 'addic_ajax_filter_fn');
}