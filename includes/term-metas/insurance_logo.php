<?php

if (class_exists('ColtmanTermMeta') && !function_exists('coltman_add_insurance_logo'))  {
    function coltman_add_insurance_logo (){
        new ColtmanTermMeta([
            'taxonomy' => 'coltman_insurance_method',
            'fields' => [
                'logo' => [
                    'label' => 'Logo',
                    'type' => 'media',
                    'button-text' => 'Upload',
                    'return' => 'url',
                    'default' => ''
                ],
            ]
        ]);
    }
    coltman_add_insurance_logo ();
}