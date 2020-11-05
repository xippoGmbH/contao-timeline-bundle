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
            'relation' => ['type'=>'belongsTo', 'load'=>'lazy'],
        ],
        'tstamp' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
        ],
		'sorting' => [
			'sql' => ['type' => 'integer', 'unsigned' => true, 'notnull' => true, 'default' => 0 ],
		],
        'title' => [
            'exclude' => true,
            'inputType' => 'text',
            'eval' => [
                'mandatory' => true,
                'maxlength' => 255,
            ],
            'sql' => ['type' => 'string', 'length' => 255, 'notnull' => true, 'default' => ''],
        ],
		'addImage' => [
			'label' => &$GLOBALS['TL_LANG']['tl_content']['addImage'],
			'exclude' => true,
			'inputType' => 'checkbox',
			'eval' => ['submitOnChange'=>true],
			'sql' => ['type' => 'string', 'length' => 1, 'fixed' => true, 'notnull' => true, 'default' => ''],
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
            'sql' => [ 'type' => 'binary', 'length' => 16, 'notnull' => false ],
            'save_callback' => [
                ['xippogmbh_contao_timeline_bundle.dca_helper', 'storeFileMetaInformation'],
            ],
        ],
		'date' => [
			'default' => time(),
			'exclude' => true,
			'filter' => true,
			'sorting' => true,
			'flag' => 8,
			'inputType' => 'text',
			'eval' => [ 'rgxp'=>'date', 'mandatory'=>true, 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard' ],
			'sql' => [ 'type' => 'integer', 'unsigned' => true, 'notnull' => true, 'default' => '0'],
		],
		'alt' => [
			'label' => &$GLOBALS['TL_LANG']['tl_content']['alt'],
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength'=>255, 'tl_class'=>'w50'],
			'sql' => [ 'type' => 'string', 'length' => 255, 'notnull' => true, 'default' => ''],
		],
		'imageTitle' => [
			'label' => &$GLOBALS['TL_LANG']['tl_content']['imageTitle'],
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength'=>255, 'tl_class'=>'w50'],
			'sql' => [ 'type' => 'string', 'length' => 255, 'notnull' => true, 'default' => ''],
		],
		'caption' => [
			'label' => &$GLOBALS['TL_LANG']['tl_content']['caption'],
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength'=>255, 'allowHtml'=>true, 'tl_class'=>'w50'],
			'sql' => [ 'type' => 'string', 'length' => 255, 'notnull' => true, 'default' => ''],
		],
		'fullsize' => [
			'label' => &$GLOBALS['TL_LANG']['tl_content']['fullsize'],
			'exclude' => true,
			'inputType' => 'checkbox',
			'eval' => ['tl_class'=>'w50 m12'],
			'sql' => [ 'type' => 'string', 'length' => 1, 'fixed' => true, 'notnull' => true, 'default' => ''],
		],
		'size' => [
			'label' => &$GLOBALS['TL_LANG']['tl_content']['size'],
			'exclude' => true,
			'inputType' => 'imageSize',
			'reference' => &$GLOBALS['TL_LANG']['MSC'],
			'eval' => ['rgxp'=>'natural', 'includeBlankOption'=>true, 'nospace'=>true, 'helpwizard'=>true, 'tl_class'=>'w50'],
			'options_callback' => static function ()
			{
				return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
			},
			'sql' => [ 'type' => 'string', 'length' => 64, 'notnull' => true, 'default' => ''],
		],
		'imagemargin' => [
			'label' => &$GLOBALS['TL_LANG']['tl_content']['imagemargin'],
			'exclude' => true,
			'inputType' => 'trbl',
			'options' => $GLOBALS['TL_CSS_UNITS'],
			'eval' => ['includeBlankOption'=>true, 'tl_class'=>'w50'],
			'sql' => [ 'type' => 'string', 'length' => 128, 'notnull' => true, 'default' => ''],
		],
		'imageUrl' => [
			'label' => &$GLOBALS['TL_LANG']['tl_content']['imageUrl'],
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'dcaPicker'=>true, 'addWizardClass'=>false, 'tl_class'=>'w50'],
			'sql' => [ 'type' => 'string', 'length' => 255, 'notnull' => true, 'default' => ''],
		],
		'floating' => [
			'label' => &$GLOBALS['TL_LANG']['tl_content']['floating'],
			'exclude' => true,
			'inputType' => 'radioTable',
			'options' => ['above', 'left', 'right', 'below'],
			'eval' => ['cols'=>4, 'tl_class'=>'w50'],
			'reference' => &$GLOBALS['TL_LANG']['MSC'],
			'sql' => [ 'type' => 'string', 'length' => 12, 'notnull' => true, 'default' => 'above'],
		],
        'description' => [
            'label' => &$GLOBALS['TL_LANG']['tl_xippo_timeline_item']['description'],
            'inputType' => 'textarea',
            'eval' => ['tl_class' => 'clr', 'rte' => 'tinyMCE', 'mandatory' => true],
            'sql' => ['type' => 'text', 'notnull' => false],
        ],
		'protected' => [
			'label' => &$GLOBALS['TL_LANG']['tl_content']['protected'],
			'exclude' => true,
			'filter' => true,
			'inputType' => 'checkbox',
			'eval' => ['submitOnChange'=>true],
			'sql' => [ 'type' => 'string', 'length' => 1, 'fixed' => true, 'notnull' => true, 'default' => ''],
		],
		'groups' => [
			'label' => &$GLOBALS['TL_LANG']['tl_content']['groups'],
			'exclude' => true,
			'inputType' => 'checkbox',
			'foreignKey' => 'tl_member_group.name',
			'eval' => ['mandatory'=>true, 'multiple'=>true],
			'sql' => [ 'type' => 'blob', 'notnull' => false],
		],
		'guests' => [
			'label' => &$GLOBALS['TL_LANG']['tl_content']['guests'],
			'exclude' => true,
			'filter' => true,
			'inputType' => 'checkbox',
			'sql' => [ 'type' => 'string', 'length' => 1, 'fixed' => true, 'notnull' => true, 'default' => ''],
		],
		'cssClass' => [
			'exclude' => true,
			'inputType' => 'text',
			'eval' => ['tl_class'=>'w50'],
			'sql' => [ 'type' => 'string', 'length' => 255, 'notnull' => true, 'default' => ''],
		],
    ],
    'palettes' => [
        'default' => '{timeline_legend},title,description;{date_legend},date;{image_legend},addImage;{expert_legend:hide},cssClass;',
		'__selector__' => [ 'addImage' ],
    ],
	'subpalettes' => [
		'addImage' => 'singleSRC,size,floating,imagemargin,fullsize,overwriteMeta',
		'overwriteMeta' => 'alt,imageTitle,imageUrl,caption'
	],
];

