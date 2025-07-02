<?php
if(!function_exists('addic_custom_accodeon')){
    add_shortcode('addic_custom_accodeon', 'addic_custom_accodeon_fn');
    add_shortcode('addic_custom_accodeon_item', 'addic_custom_accodeon_item_fn');

    function addic_custom_accodeon_fn($atts, $content = null){
        $atts = shortcode_atts(array(
            'accordeon_title' =>'',
            'accordeon_text' =>'',
        ), $atts, 'addic_custom_accodeon');
        $html = '';
        $html .= '<div class="acordeon-seo faq-list" itemscope itemtype="https://schema.org/FAQPage">';
        $html.= '<div class="acordeon-seo-wraper">';
        $html .= '<div class="acordeon-seo-text" >';
        if (!empty($atts['accordeon_title'])) {
            $html .= '<h2 class="acordeon-title" itemprop="name">' . $atts['accordeon_title'] . '</h2>';
        }
        if(!empty($atts['accordeon_text'])){
            $html .= '<p class="acordeon-text" itemprop="description">' . $atts['accordeon_text'] . '</p>';
        }
        $html .= '</div>';
        $html .= '<div class="acordeon-seo-content">';
        $html .= do_shortcode($content);
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    function addic_custom_accodeon_item_fn($atts, $content = null){
        $atts = shortcode_atts(array(
            'title_item' => 'Título del elemento',
            'opened' => '',
            'id' => 'acordeon-' . uniqid()
        ),$atts ,'addic_custom_accodeon_item');

        $open = $atts['opened']==''?'':'open';
      //  var_dump($open);
         return '
            <div class="acordeon-item '.  $open  . '" id="' . esc_attr($atts['id']) .'" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h3 class="acordeon-item-title" itemprop="name">
                    <button class="acordeon-item-button" aria-expanded="false" aria-controls="' . esc_attr($atts['id']) . '">
                        ' . esc_html($atts['title_item']) . '
                        <div class="faq-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                            <g clip-path="url(#clip0_108_4978)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.7073 16.2069C12.5198 16.3943 12.2655 16.4996 12.0003 16.4996C11.7352 16.4996 11.4809 16.3943 11.2933 16.2069L5.63634 10.5499C5.54083 10.4576 5.46465 10.3473 5.41224 10.2253C5.35983 10.1033 5.33225 9.97204 5.33109 9.83926C5.32994 9.70648 5.35524 9.5748 5.40552 9.4519C5.4558 9.329 5.53006 9.21735 5.62395 9.12346C5.71784 9.02957 5.82949 8.95531 5.95239 8.90503C6.07529 8.85475 6.20696 8.82945 6.33974 8.8306C6.47252 8.83176 6.60374 8.85934 6.72575 8.91175C6.84775 8.96416 6.9581 9.04034 7.05034 9.13585L12.0003 14.0859L16.9503 9.13585C17.1389 8.9537 17.3915 8.8529 17.6537 8.85518C17.9159 8.85746 18.1668 8.96263 18.3522 9.14804C18.5376 9.33344 18.6427 9.58426 18.645 9.84645C18.6473 10.1087 18.5465 10.3613 18.3643 10.5499L12.7073 16.2069Z" fill="#1A1A1A"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0_108_4978">
                                <rect width="24" height="24" fill="white" transform="translate(0 0.5)"></rect>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    </button>
                </h3>
                <div id="' . esc_attr($atts['id']) . '" class="acordeon-item-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div class="text" itemprop="text">' . do_shortcode($content) . '</div>
                </div>
            </div>';

    }

}