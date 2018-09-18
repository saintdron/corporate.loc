<?php
return [
    'theme' => env('THEME'),

    'slider_path' => 'slider-cycle',
    'portfolios_path' => 'projects',
    'articles_path' => 'articles',
    'avatars_path' => 'avatar',

    'home_portfolios_count' => 5,
    'home_articles_count' => 3,
    'articles_paginate' => 2,
    'recent_portfolios' => 3,
    'recent_comments' => 3,
    'other_portfolios' => 8,

    'portfolio_index_preview_length' => 200,
    'portfolio_bar_preview_length' => 130,
    'comment_bar_preview_length' => 130,
    'articles_desc_length' => 260,

    'image' => ['width' => 1024, 'height' => 768],
    'articles_img' => [
        'max' => ['width' => 816, 'height' => 282],
        'mini' => ['width' => 55, 'height' => 55]
    ],

    'slider_img' => ['width' => 1920, 'height' => 483],

];