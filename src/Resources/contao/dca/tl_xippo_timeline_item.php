// contao/dca/tl_xippo_timeline_item.php
$GLOBALS['TL_DCA']['tl_xippo_timeline_item'] = [
    'config' => [
        'dataContainer' => 'Table',
		'ptable' => 'tl_xippo_timeline',
        'enableVersioning' => true,
        'sql' => [
            'keys' => [
                'id' => 'primary',
            ],
        ],
    ],
    'list' => [
        'sorting' => [
            'mode' => 4,
            'fields' => ['sorting'],
			'panelLayout' => 'filter;search,limit',
            'headerFields' => ['title'],
			'child_record_callback' => function (array $row) {
                return '<div class="tl_content_left">'.$row['title'].'</div>';
            },
        ],
        'label' => [
            'fields' => ['title'],
        ],
        'operations' => [
            'edit' => [
                'href' => 'table=tl_content',
                'icon' => 'edit.svg',
            ],
            'editheader' => [
                'href' => 'act=edit',
                'icon' => 'header.svg',
            ],
			'copy' => [
				'label' => &$GLOBALS['TL_LANG']['tl_xippo_timeline_item']['copy'],
				'href' => 'act=page&amp;mode=copy',
				'icon' => 'copy.gif'
			],
			'cut' => [
				'label' => &$GLOBALS['TL_LANG']['tl_xippo_timeline_item']['cut'],
				'href' => 'act=paste&amp;mode=cut',
				'icon' => 'cut.gif'
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
		'pid' => [
            'foreignKey' => 'tl_xippo_timeline.title',
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
            'relation' => ['type'=>'belongsTo', 'load'=>'lazy']
        ],
        'tstamp' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0]
        ],
		'sorting' => [
			'sql' => ['type' => 'integer', 'unsigned' => true, 'notnull' => true, 'default' => 0 ]
		],
        'title' => [
            'exclude' => true,
            'inputType' => 'text',
            'eval' => [
                'mandatory' => true,
                'maxlength' => 255,
            ],
            'sql' => "varchar(255) NOT NULL default ''",
        ],
		'singleSRC' => [
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => [
                'fieldType' => 'radio',
                'files' => true,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'mandatory' => false,
            ],
            'sql' => 'binary(16) NULL',
            'save_callback' => [
                ['xippogmbh_contao_bootstrap_slider_bundle.dca_helper', 'storeFileMetaInformation'],
            ],
        ],
		'cssClass' => [
			'label' => &$GLOBALS['TL_LANG']['tl_xippo_timeline_item']['cssClass'],
            'exclude' => true,
			'inputType' => 'text',
			'eval' => [ 'maxlength'=>128, 'tl_class'=>'w50'],
			'sql' => "varchar(128) NOT NULL default ''"
		],
        'cssID' => [
			'label' => &$GLOBALS['TL_LANG']['tl_xippo_timeline_item']['cssID'],
            'exclude' => true,
            'inputType' => 'text',
            'eval' => [ 'multiple' => true, 'size' => 2, 'tl_class' => 'w50 clr', ],
            'sql' => "varchar(255) NOT NULL default ''",
        ],
    ],
    'palettes' => [
        'default' => '{slider_legend},title,singleSRC;{expert_legend},cssID,cssClass;'
    ],
];

