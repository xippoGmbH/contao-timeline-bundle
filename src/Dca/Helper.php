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

namespace XippoGmbH\ContaoTimelineBundle\Dca;

use Contao\Backend;
use Contao\BackendUser;
use Contao\ContentModel;
use Contao\Environment;
use Contao\File;
use Contao\FilesModel;
use Contao\Image;
use Contao\Input;
use Contao\Message;
use Contao\StringUtil;
use Contao\Versions;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class Helper extends Backend
{
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        parent::__construct();

        $token = $tokenStorage->getToken();

        if ($token instanceof TokenInterface) {
            $user = $token->getUser();

            if ($user instanceof BackendUser) {
                $this->User = $user;
            }
        }
    }

    public function storeFileMetaInformation($varValue, \DataContainer $dc)
    {
        if ($dc->activeRecord->singleSRC === $varValue) {
            return $varValue;
        }

        $objFile = FilesModel::findByUuid($varValue);

        if (null !== $objFile) {
            $arrMeta = StringUtil::deserialize($objFile->meta);

            if (!empty($arrMeta)) {
                $objPage = $this->Database->prepare('SELECT * FROM tl_page WHERE id=(SELECT pid FROM ' . ($dc->activeRecord->ptable ?: 'tl_article') . ' WHERE id=?)')
                    ->execute($dc->activeRecord->pid);

                if ($objPage->numRows) {
                    $objModel = new \PageModel();
                    $objModel->setRow($objPage->row());
                    $objModel->loadDetails();

                    // Convert the language to a locale (see #5678)
                    $strLanguage = str_replace('-', '_', $objModel->rootLanguage);

                    if (isset($arrMeta[$strLanguage])) {
                        Input::setPost('alt', $arrMeta[$strLanguage]['title']);
                        Input::setPost('caption', $arrMeta[$strLanguage]['caption']);
                    }
                }
            }
        }

        return $varValue;
    }

    public function showJsLibraryHint($dc): void
    {
        if ($_POST || 'edit' !== Input::get('act')) {
            return;
        }

        // Return if the user cannot access the layout module (see #6190)
        if (!$this->User->hasAccess('themes', 'modules') || !$this->User->hasAccess('layout', 'themes')) {
            return;
        }

        $objCte = ContentModel::findByPk($dc->id);

        if (null === $objCte) {
            return;
        }

        $i = $objCte->type;

        if ('points_of_interest' === $i) {
            Message::addInfo(sprintf($GLOBALS['TL_LANG']['tl_content']['includeTemplate'], 'j_colorbox'));
        }
    }
}