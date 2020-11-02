<?php
/**
 * This file is part of a Xippo GmbH Contao Timeline Bundle.
 *
 * (c) Aurelio Gisler (Xippo GmbH)
 *
 * @author     Aurelio Gisler
 * @package    ContaoTimeline
 * @license    MIT
 * @see        https://github.com/xippoGmbH/contao-timeline-bundle
 *
 */
// Backend modules
$GLOBALS['BE_MOD']['content']['timeline'] = ['tables' => ['tl_xippo_timeline','tl_xippo_timeline_item','tl_content'],
];
// Models
$GLOBALS['TL_MODELS']['tl_xippo_timeline'] = XippoGmbH\ContaoBootstrapSliderBundle\Model\TimelineModel::class;
$GLOBALS['TL_MODELS']['tl_xippo_timeline_item'] = XippoGmbH\ContaoBootstrapSliderBundle\Model\TimelineItemModel::class;