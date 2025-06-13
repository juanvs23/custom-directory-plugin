<?php
use Class\AddicClinicDirectory;
if (class_exists('ColtmanTermMeta') ) {
   
    function coltman_add_terms_metas(array $taxonomies) {
        foreach ($taxonomies as $taxonomy) {
            $config = [
                'taxonomy' => $taxonomy,
                'fields' => [
                    'header_title' => [
                        
                            'label' => 'Header title',
                            'type' => 'text',
                            'default' => ''
                    
                    ],
                    'banner_image' => [
                        'label' => 'Image Banner',
                        'type' => 'media',
                        'button-text' => 'Upload',
                        'return' => 'url',
                        'default' => ''
                    ],
                    'content_blocks_ama' => [
                    'label' => 'Content Blocks',
                    'type' => 'accordion',
                    'add_image' => 'true',
                    'default' => '',
                        'description' => 'Add ours blocks sections here: <br> Add <b>Block Title = title</b>, <b>Block Content = content</b>'
                    ],
                     'faq_accordeon' => [
                    'label' => 'Frequently Asked Questions',
                    'type' => 'accordion',
                    'add_image' => 'false',
                    'default' => '',
                    'description' => 'Add frequently asked questions here: <br> Add <b>Question = title</b>, <b>Answer = content</b>'
                    ]
                ]
                ];
            new ColtmanTermMeta($config);
        }
    }
}

if (function_exists('coltman_add_terms_metas')) {
    $remove_filters = ['coltman_languages'];
 $add_filter_fields = array_filter(ADDIC_CLINIC_FILTERS, function($value) use ($remove_filters) {
        return !in_array($value, $remove_filters);
      });
    coltman_add_terms_metas($add_filter_fields);
}