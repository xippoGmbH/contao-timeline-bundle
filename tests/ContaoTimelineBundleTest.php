<?php

/*
 * This file is part of [package name].
 *
 * (c) John Doe
 *
 * @license LGPL-3.0-or-later
 */

namespace XippoGmbH\ContaoTimelineBundle\Tests;

use XippoGmbH\ContaoTimelineBundle\ContaoTimelineBundle;
use PHPUnit\Framework\TestCase;

class ContaoTimelineBundleTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $bundle = new ContaoSkeletonBundle();

        $this->assertInstanceOf('XippoGmbH\ContaoTimelineBundle\ContaoTimelineBundle', $bundle);
    }
}
