<?php

function typeofweb_courses_shortcode($atts) {
    return '
<h2 class="courses-header">
    Chcesz uczyć się szybciej?
    <a href="https://typeofweb.com/szkolenia/" aria-hidden="true" target="_blank"><img src="https://typeofweb.com/szkolenia/static/typeofweb_logo-szkolenia-no-border-small.png" width="200" alt=""></a>
    <a href="https://typeofweb.com/szkolenia/" target="_blank">Zapisz się na nasze szkolenie!</a>
</h2>
    ';
}

add_shortcode( 'typeofweb-courses',
'typeofweb_courses_shortcode' );

function typeofweb_courses_slogan_shortcode($atts) {
    $atts = shortcode_atts(array(
		'category' => NULL,
    ), $atts, 'typeofweb-courses-slogan');

    $technologies = [
        'React',
        'React.js',
        'React Hooks',
        'Redux',
        'Vue',
        'Vue.js',
        'Angular',
        'Node',
        'Node.js',
        'TypeScript',
        'Hapi.js',
        'Express.js'
    ];
    $slogans = [
        'Sprawdź nasze szkolenia z %s!',
        'Sprawdź szkolenia z %s!',
        'Sprawdź szkolenia Type of Web z %s!',
        'Poznaj %s w dwa dni na naszym szkoleniu!',
        'Poznaj %s w dwa dni na szkoleniu!',
        'Poznaj %s w dwa dni na szkoleniu Type of Web!',
        'Poznaj %s w dwa dni na szkoleniu z Type of Web!',
        'Poznaj %s z naszymi szkoleniami!',
        'Poznaj %s na naszym szkoleniu!',
        'Poznaj %s na szkoleniu!',
        'Poznaj %s na szkoleniu z Type of Web!',
        'Naucz się %s z naszymi szkoleniami!',
        'Naucz się %s na naszym szkoleniu!',
        'Naucz się %s na szkoleniu!',
        'Naucz się %s na szkoleniu Type of Web!',
        'Naucz się %s na szkoleniu z Type of Web!',
    ];

    $techIndex = array_rand($technologies);
    $sloganIndex = array_rand($slogans);

    $tech = $atts['category'] ?? $technologies[$techIndex];
    $slogan = $slogans[$sloganIndex];

    return '<a style="font-weight: 900" href="https://typeofweb.com/szkolenia?utm_source=https%3A%2F%2Ftypeofweb.com%2F&utm_medium=courses_slogan" target="_blank">' . sprintf($slogan, $tech) . '</a>';
}

add_shortcode( 'typeofweb-courses-slogan', 'typeofweb_courses_slogan_shortcode' );
