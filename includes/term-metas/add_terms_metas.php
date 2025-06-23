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
                        'add_image' => 'false',
                        'default' => '',
                        'description' => 'Add ours blocks sections here: <br> Add <b>Block Title = title</b>, <b>Block Content = content</b>'
                    ],
                    'top_blocks_image'=>[
                        'label' => 'Top blocks text and Images',
                        'type' => 'separator',
                        'id' => 'top_blocks_image',
                    ],
                    'top_image_text' =>[
                        'label' => 'Top blocks Images with title and description',
                        'type' => 'accordion',
                        'default' => '',
                        'id' => 'top_image_text',
                        'description' => 'Add top image text here'
                    ],
                     'tap_separator'=>[
                        'label' => 'Tabs Section',
                        'type' => 'separator',
                        'id' => 'tap_separator',
                    ],
                    'middle_title_taps' =>[
                        'label' => 'Middle title with tabs',
                        'type' => 'text',
                        'id'=>'middle_title_taps',
                        'default' => '',
                        'description' => 'Title this tabs section'
                    ],
                    
                    'middle_description_taps' =>[
                        'label' => 'Middle description with tabs',
                        'type' => 'textarea',
                        'id'=>'middle_description_taps',
                        'default' => '',
                        'description' => 'Description this tabs section'
                    ],
                    'middle_taps' =>[
                        'label' => 'Middle tabs',
                        'type' => 'accordion',
                        'add_image' => 'false',
                        'id'=>'middle_taps',
                        'default' => '',
                        'description' => 'Add middle tabs here'
                    ],
                    // bottom
                    'bottom_blocks_image'=>[
                        'label' => 'Bottom blocks text and Images',
                        'type' => 'separator',
                        'id' => 'bottom_blocks_image',
                    ],

                    'bottom_image_text' =>[
                        'label' => 'Bottom blocks Images with title and description',
                        'type' => 'accordion',
                        'default' => '',
                        'description' => 'Add bottom image text here'
                    ],
                    // faqs
                     'faq_separator'=>[
                        'label' => 'Frequently Asked Questions',
                        'type' => 'separator',
                        'id' => 'faq_separator',
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