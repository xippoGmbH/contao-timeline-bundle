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
namespace XippoGmbH\ContaoTimelineBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use XippoGmbH\ContaoTimelineBundle\ContaoTimelineBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoTimelineBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
