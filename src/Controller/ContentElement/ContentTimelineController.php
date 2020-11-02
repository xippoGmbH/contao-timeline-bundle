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
declare(strict_types=1);

namespace XippoGmbH\ContaoTimelineBundle\Controller\ContentElement;

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\ServiceAnnotation\ContentElement;
use Contao\ContentModel;
use Contao\FilesModel;
use Contao\Frontend;
use Contao\Image;
use Contao\Model;
use Contao\Template;
use XippoGmbH\ContaoTimelineBundle\Model\TimelineModel;
use XippoGmbH\ContaoTimelineBundle\Model\TimelineItemModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @ContentElement(category="texts")
 */
class ContentTimelineController extends AbstractContentElementController
{
	public function __construct(ContaoFramework $framework)
    {
        $this->framework = $framework;
    }
	
    protected function getResponse(Template $template, ContentModel $model, Request $request): ?Response
    {
		
		
        return $template->getResponse();
    }
}