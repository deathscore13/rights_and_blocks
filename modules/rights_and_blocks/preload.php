<?php

const RIGHTS_AND_BLOCKS_V_MAJOR = 1;
const RIGHTS_AND_BLOCKS_V_MINOR = 0;
const RIGHTS_AND_BLOCKS_V_RELEASE = 0;
const RIGHTS_AND_BLOCKS_VERSION = RIGHTS_AND_BLOCKS_V_MAJOR.'.'.RIGHTS_AND_BLOCKS_V_MINOR.'.'.RIGHTS_AND_BLOCKS_V_RELEASE;

$m->lang('rights_and_blocks');

const RIGHTS_AND_BLOCKS_INFO = [
    'name' => 'Rights & Blocks',
    'description' => LANG_RIGHTS_AND_BLOCKS[17],
    'version' => RIGHTS_AND_BLOCKS_VERSION,
    'author' => 'DeathScore13',
    'url' => 'https://github.com/deathscore13/rights_and_blocks',
];

require('rights.php');
require('blocks.php');

$rights = new Rights($db);
$rights->changeChat($vk->obj['peer_id']);
$rights->regRight('root', LANG_RIGHTS_AND_BLOCKS[8]);

$blocks = new Blocks($db);
$blocks->changeChat($vk->obj['peer_id']);
$rights->regRight('blocks', LANG_RIGHTS_AND_BLOCKS[29]);

$m->regCmd(['rights', LANG_RIGHTS_AND_BLOCKS[18]], LANG_RIGHTS_AND_BLOCKS[16], [
    [
        'names' => [
            'set',
            LANG_RIGHTS_AND_BLOCKS[19]
        ],
        'params' => LANG_RIGHTS_AND_BLOCKS[7],
        'description' => LANG_RIGHTS_AND_BLOCKS[12]
    ],
    [
        'names' => [
            'info',
            LANG_RIGHTS_AND_BLOCKS[20]
        ],
        'params' => LANG_RIGHTS_AND_BLOCKS[13],
        'description' => LANG_RIGHTS_AND_BLOCKS[14]
    ],
    [
        'names' => [
            'list',
            LANG_RIGHTS_AND_BLOCKS[21]
        ],
        'description' => LANG_RIGHTS_AND_BLOCKS[15]
    ]
]);

$m->regCmd(['blocks', LANG_RIGHTS_AND_BLOCKS[23]], LANG_RIGHTS_AND_BLOCKS[24], [
    [
        'names' => [
            'set',
            LANG_RIGHTS_AND_BLOCKS[19]
        ],
        'params' => LANG_RIGHTS_AND_BLOCKS[25],
        'description' => LANG_RIGHTS_AND_BLOCKS[26]
    ],
    [
        'names' => [
            'info',
            LANG_RIGHTS_AND_BLOCKS[20]
        ],
        'params' => LANG_RIGHTS_AND_BLOCKS[13],
        'description' => LANG_RIGHTS_AND_BLOCKS[27]
    ],
    [
        'names' => [
            'list',
            LANG_RIGHTS_AND_BLOCKS[21]
        ],
        'description' => LANG_RIGHTS_AND_BLOCKS[28]
    ]
]);

function preloadEnd_rights_and_blocks()
{
    global $rights, $blocks;
    $rights->blockRegs();
    $blocks->blockRegs();
}