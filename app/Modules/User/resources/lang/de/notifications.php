<?php
return [
    'giving_user_ability_to_add_special_career' => [
        'email' => [
            'subject' => 'Herzliche Glückwünsche!',
            'content' => 'Herzlichen Glückwunsch! Der Administrator von Rentnerjob hat Ihnen erlaubt, spezielle Jobs hinzuzufügen! Probieren Sie es jetzt <a href=":url">hier</a> aus.',
        ],
        'db' => [
            'title' =>'Herzliche Glückwünsche!',
            'body' => 'Herzlichen Glückwunsch! Der Administrator von Rentnerjob hat Ihnen erlaubt, spezielle Jobs hinzuzufügen! Probieren Sie es jetzt hier aus.',
        ]
    ],
    'withdrawal_user_ability_to_add_special_career' => [
        'email' => [
            'subject' =>'leider!',
            'content' => 'Die Fähigkeit, eine spezielle Jobs hinzuzufügen, wurde gewährt',
        ],
        'db' => [
            'title' => 'Leider!',
            'body' => 'Ziehen Sie die Möglichkeit, einen speziellen Job hinzuzufügen',
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
