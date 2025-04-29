<?php

/*
 * For more details about the configuration, see:
 * https://sweetalert2.github.io/#configuration
 */
return [
    'alert' => [
        'position' => 'top-end',
        'timer' => 3000,
        'toast' => true,
        'text' => null,
        'showCancelButton' => false,
        'showConfirmButton' => false,
    ],
    'confirm' => [
        'icon' => 'question',
        'position' => 'center',
        'toast' => false,
        'timer' => null,
        'showConfirmButton' => true,
        'showCancelButton' => true,
        'cancelButtonText' => 'No',
        'cancelButtonColor' => '#9333ea',
        'confirmButtonColor' => '#94a3b8',
    
    ],

            
    'customClass' => [
        'container' => 'z-[1000]',
        'popup' => '',
        'header' => '',
        'title' => '',
        'closeButton' => '',
        'icon' => '',
        'image' => '',
        'content' => '',
        'htmlContainer' => '',
        'input' => '',
        'inputLabel' => '',
        'validationMessage' => '',
        'actions' => '',
        'confirmButton' => '',
        'denyButton' => '',
        'cancelButton' => '',
        'loader' => '',
        'footer' => ''
        
    ]

];
