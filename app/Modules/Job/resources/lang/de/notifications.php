<?php
return [
    'send_to_users_the_same_professions_and_regions' => [
        'email' => [
            'subject' => 'Seit kurzem gibt es eine neue Stellenanzeige!',
            'content' => 'Seit kurzem gibt es eine neue Stelleanzeige! Beeilen Sie sich und sehen Sie sich die Details von <a href=":url"> <b>:here </b> </a>',
        ],
        'db' => [
            'title' => 'Seit kurzem gibt es eine neue Stelleanzeige!',
            'body' => 'Seit kurzem gibt es eine neue Stelleanzeige! Beeilen Sie sich und sehen Sie sich die Details hier an',
        ],
    ],
    'send_to_users_who_can_add_special_career' => [
        'email' => [
            'subject' => 'Tolle Neuigkeiten!',
            'content' => 'tolle Neuigkeiten Sie wurden ausgewählt, um einen besonderen Job zu sehen! Klicken Sie <a href=":url"> <b>:hier </b> </a> , um weitere Informationen zu erhalten',
        ],
        'db' => [
            'title' => 'Tolle Neuigkeiten!',
            'body' => 'Tolle Neuigkeiten! Sie wurden ausgewählt, um einen besonderen Job zu sehen! Klicken Sie hier, um weitere Details zu erhalten',
        ]
    ],
    '' => [
        'email' => [
            'subject' => '',
            'content' => '',
        ],
        'db' => [
            'title' => '',
            'body' => '',
        ]
    ],
];
