// contao/dca/tl_xippo_timeline.php
$GLOBALS['TL_DCA']['tl_xippo_timeline'] = [
    'config' => [
        'dataContainer' => 'Table',
        'ctable' => ['tl_xippo_timeline_item'],
        'enableVersioning' => true,
        'sql' => [
            'keys' => [
                'id' => 'primary',
            ],
        ], 
    ],
    'list' => [
        'sorting' => [
            'mode' => 1,
            'fields' => ['title'],
            'flag' => 1,
            'panelLayout' => 'search,limit'
        ],
        'label' => [
            'fields' => ['title'],
            'format' => '%s',
        ],
        'operations' => [
            'edit' => [
                'href' => 'table=tl_xippo_timeline_item',
                'icon' => 'edit.svg',
            ],
            'editheader' => [
                'href' => 'act=edit',
                'icon' => 'header.svg',
            ],
            'delete' => [
                'href' => 'act=delete',
                'icon' => 'delete.svg',
            ],
            'show' => [
                'href' => 'act=show',
                'icon' => 'show.svg'
            ],
        ],
    ],
    'fields' => [
        'id' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'autoincrement' => true],
        ],
        'tstamp' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0]
        ],
        'title' => [
            'label' => &$GLOBALS['TL_LANG']['tl_xippo_timeline']['title'],
            'search' => true,
            'inputType' => 'text',
            'eval' => ['tl_class' => 'w50', 'maxlength' => 255, 'mandatory' => true],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => '']
        ],
    ],
    'palettes' => [
        'default' => '{slider_legend},title'
    ],
];
