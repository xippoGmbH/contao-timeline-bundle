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
 * @ContentElement(category="xippo_elements")
 */
class ContentTimelineController extends AbstractContentElementController
{
	public function __construct(ContaoFramework $framework)
    {
        $this->framework = $framework;
    }
	
    protected function getResponse(Template $template, ContentModel $model, Request $request): ?Response
    {
		$timeline = TimelineModel::findBy('id', $model->timeline_id);
		
		if (!$timeline instanceof TimelineModel) {
            return $template->getResponse();
        }
		
		\System::log('Timeline gefunden, die ID ist: ' . $timeline->id, __METHOD__, TL_GENERAL);
		
		$options = [
			'order' => 'sorting ASC'
		];
		$tempTimelineItems = TimelineItemModel::findBy('pid', $timeline->id, $options);
		
		$timeline->timelineItemCount = count($tempTimelineItems);
		
		$template->timeline = $timeline;
        $timelineItems = [];
		
		if($tempTimelineItems->count() > 0) 
		{
			foreach($tempTimelineItems as $tempTimelineItem)
			{
				\System::log('Timeline Item ID: ' . $tempTimelineItem->id, __METHOD__, TL_GENERAL);
				
				if($tempTimelineItem->singleSRC != '')
				{
					$fileModel = FilesModel::findByUuid($tempTimelineItem->singleSRC);
				
					$file = new \File($fileModel->path);
					$img = new Image($file);

					$imgSize = $file->imageSize;
					// TODO: implement image size

					$tempTimelineItem->image = $img;
				}
				
				$timelineItems[] = $tempTimelineItem;
			}
		}
		
		$template->timelineItems = $timelineItems;
		
        return $template->getResponse();
    }
}