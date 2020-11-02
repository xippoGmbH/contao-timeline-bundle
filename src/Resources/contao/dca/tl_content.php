// contao/dca/tl_content.php
$GLOBALS['TL_DCA']['tl_content']['fields']['timeline_id'] = [
			'label' => &$GLOBALS['TL_LANG']['tl_content']['timeline_id'],
			'inputType' => 'select',
			'foreignKey' => 'tl_xippo_timeline.title',
			'sql' => ['type' => 'integer', 'unsigned' => true, 'notnull' => true, 'default' => 0],
			'eval' => [
				'mandatory' => true,
				'includeBlankOption' => true
			]
		];
$GLOBALS['TL_DCA']['tl_content']['palettes']['timeline_id'] = '{type_legend},type,headline;{timeline_legend},timeline_id;{protected_legend:hide},protected;{expert_legend:hide},guests,invisible,cssID,space';