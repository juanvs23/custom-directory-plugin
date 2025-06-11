<?php

if ( class_exists( 'ColtmanCreateMetabox' ) && ! function_exists( 'coltman_add_clinic_add_metas' ) ) {
    function coltman_add_clinic_add_metas() {
        $config = [
            'title' => __('Clinic information', 'addic-clinic-directory'),
            'description' => __('Add clinic information', 'addic-clinic-directory'),
            'prefix' => 'addic_clinic_directory_',
            'domain' => 'addic_clinic_directory',
            'class_name' => 'addic-clinic-directory',
            'context' => 'normal',
            'priority' => 'high',
            'cpt' => 'coltman_addic_clinic',
            'fields' => [
                [
                    'label' => __('Show on Slider Ads', 'addic-clinic-directory'),
                    'id' => 'show_on_slider_ads',
                    'type' => 'checkbox',
                    'default' => '',
                    'description' => 'Show on Slider Ads'
                ],
                [
                    'label' => __('Rehab Range price', 'addic-clinic-directory'),
                    'id' => 'rehab_price_range',
                    'type' => 'text',
                    'default' => '',
                    'description' => 'Rehab range price'
                ],
                [
                    'label' => __('Google review title', 'addic-clinic-directory'),
                    'id' => 'google_review_title',
                    'type' => 'text',
                    'default' => '',
                    'description' => 'Enter the exact name of the rehab here, which it has in Google My Business. If it is empty, it will take the title name of the rehab.'      
                ],
                [
                    'label' => __('Google Place ID', 'addic-clinic-directory'),
                    'id' => 'google_place_id',
                    'type' => 'text',
                    'default' => '',
                    'description' => 'This field is automatically loaded by the system. If you have this identifier at hand, please add it to avoid using the  <b>Google Place API.</b>'
                ],
                [
                    'label' => __('Rehab rating', 'addic-clinic-directory'),
                    'id' => 'rehab_rating',
                    'type' => 'number',
                    'step' => 0.1,
                    'min' => 0,
                    'max' => 5,
                    'default' => '',
                    'description' => 'This field adds the <b>Google review rating</b>, and can be modified from here. If you want to update <b>the Google Rating</b> value of this field, leave this <b>field</b> blank.'
                ],
                [
                    'label' => __('Rehab Verified', 'addic-clinic-directory'), 
                    'id' => 'rehab_verified', 
                    'type' => 'checkbox', 
                    'default' => '', 
                    'description' => __('Rehab verified', 'addic-clinic-directory'),
                ],
                [
                    'label' => __('Rehab Claimed', 'addic-clinic-directory'),
                    'id' => 'rehab_claimed',
                    'type' => 'checkbox',
                    'default' => '',
                    'description' => 'Rehab claimed'
                ],
                [
                    'label' => __('Acept Insurance', 'addic-clinic-directory'),
                    'id' => 'rehab_insurance',
                    'type' => 'checkbox',
                    'default' => '',
                    'description' => 'Rehab insurance'
                ],
                [
                    'label' => __('Rehab language', 'addic-clinic-directory'),
                    'id' => 'rehab_language',
                    'type' => 'get_terms',
                    'taxonomy' => 'coltman_languages',
                    'default' => '',
                    'description' => 'Get terms from taxonomy'
                ],
                [
                    'label' => __('Rehab address', 'addic-clinic-directory'),
                    'id' => 'rehab_address',
                    'type' => 'text',
                    'default' => '',
                    'description' => 'Complete address'
                ],
                [
                    'label' => __('Rehab description', 'addic-clinic-directory'),
                    'id' => 'rehab_description',
                    'type' => 'editor',
                    'default' => '',
                    'description' => 'Rehab description'
                ],
                [
                    'label' => __('Rehab city', 'addic-clinic-directory'),
                    'id' => 'rehab_city',
                    'type' => 'text',
                    'default' => '',
                    'description' => 'Rehab city'
                ],
                [
                    'label' => __('Rehab state or county', 'addic-clinic-directory'),
                    'id' => 'rehab_state',
                    'type' => 'text',
                    'default' => '',
                    'description' => 'Rehab state'
                ],
                [
                    'label' => __('Rehab phone', 'addic-clinic-directory'),
                    'id' => 'rehab_phone',
                    'type' => 'text',
                    'default' => '',
                    'description' => 'Complete phone with country code'
                ],
                [
                    'label' => __('Rehab email', 'addic-clinic-directory'),
                    'id' => 'rehab_email',
                    'type' => 'text',
                    'default' => '',
                    'description' => 'Corporative email'
                ],
                [
                    'label' => __('Rehab website', 'addic-clinic-directory'),
                    'id' => 'rehab_website',
                    'type' => 'text',
                    'default' => '',
                    'description' => 'Corporative website'
                ],
                [
                    'label' => __('Add gallery images', 'addic-clinic-directory'),
                    'id' => 'rehab_image_gallery',
                    'type' => 'gallery',
                    'default' => '',
                    'description' => 'Gallery images of the rehab'
                ],
                
                [
                    'label' => __('Add Preload Video', 'addic-clinic-directory'),
                    'id' => 'rehab_video_preload',
                    'type' => 'media',
                    'button-text' => 'Upload',
                    'return' => 'url',
                    'default' => '',
                    'description' => 'Add video initial frame'
                ],
                [
                    'label' => __('Add Video', 'addic-clinic-directory'),
                    'id' => 'rehab_video_url',
                    'type' => 'media',
                    'button-text' => 'Upload',
                    'return' => 'url',
                    'default' => '',
                    'description' => 'Video of the rehab gallery'
                ],
                [
                    'label' => __('Level of care ', 'addic-clinic-directory'),
                    'id' => 'rehab_level_of_care',
                    'type' => 'accordion',
                    'add_image' => 'false',
                    'default' => '',
                    'description' => 'You can add the types of personalized care here, if you do not add them they will be taken from the filters.'
                ],
                [
                    'label' => __('Especiality block', 'addic-clinic-directory'),
                    'id' => 'rehab_highlight_blocks',
                    'type' => 'accordion',
                    'default' => '',
                    'description' => 'Add Especiality block blocks <br> Add Tittle and content and image'
                ],
                
                [
                    'label' => __('Show professional staff', 'addic-clinic-directory'),
                    'id' => 'rehab_staff',
                    'type' => 'checkbox',
                    'default' => '',
                    'description' => 'Show professional staff'
                ],
                [
                    'label' => __('Staff Title Section', 'addic-clinic-directory'),
                    'id' => 'rehab_staff_title_section',
                    'type' => 'text',
                    'default' => '',
                    'description' => 'Override staff title section'
                ],
                [
                    'label' => __('Staff Description Section', 'addic-clinic-directory'),
                    'id' => 'rehab_staff_description_section',
                    'type' => 'text',
                    'default' => '',
                    'description' => 'Override staff description section'
                ],

                [
                    'label' => __('Personal staff members', 'addic-clinic-directory'),
                    'id' => 'rehab_staff_members',
                    'type' => 'accordion',
                    'default' => '',
                    'description' => 'Add Personal staff member here: <br> Add <b>Image</b>, <b>Full Name</b>, <b>Position</b>'
                ],
                [
                    'label' => __('Google maps embed code', 'addic-clinic-directory'),
                    'id' => 'rehab_google_maps',
                    'type' => 'textarea',
                    'default' => '',
                    'description' => "Should problems occur with this field and its generated map, clear the following fields: 'Google Place ID', 'Rehab rating', and 'Google Maps embed code'. The system will then automatically retrieve the map and update Google data using the 'Google review title' field."
                ],
                [
                    'label' => __('Frequently asked questions', 'addic-clinic-directory'),
                    'id' => 'rehab_faq',
                    'type' => 'accordion',
                    'add_image' => 'false',
                    'default' => '',
                    'description' => 'Add frequently asked questions here: <br> Add <b>Question = title</b>, <b>Answer = content</b>'
                ]
               
            ]
        ];

        new ColtmanCreateMetabox($config);
    }
}

if ( function_exists( 'coltman_add_clinic_add_metas' ) ) {
    coltman_add_clinic_add_metas();
}