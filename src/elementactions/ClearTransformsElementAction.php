<?php
/**
 * Imager X plugin for Craft CMS
 *
 * Ninja powered image transforms.
 *
 * @link      https://www.spacecat.ninja
 * @copyright Copyright (c) 2020 André Elvan
 */

namespace spacecatninja\imagerx\elementactions;

use Craft;

use craft\elements\db\ElementQueryInterface;
use craft\base\ElementAction;
use yii\base\Exception;

use spacecatninja\imagerx\ImagerX as Plugin;

class ClearTransformsElementAction extends ElementAction
{
    /**
     * @inheritdoc
     */
    public function getTriggerLabel(): string
    {
        return Craft::t('imager-x', 'Clear Imager transforms');
    }

    /**
     * Clears transforms for selected assets
     * 
     * @param ElementQueryInterface $query
     *
     * @return bool
     */
    public function performAction(ElementQueryInterface $query): bool
    {
        try {
            foreach ($query->all() as $asset) {
                Plugin::$plugin->imagerx->removeTransformsForAsset($asset);
            }
        } catch (Exception $exception) {
            $this->setMessage($exception->getMessage());
            return false;
        }
        
        $this->setMessage(Craft::t('imager-x', 'Transforms were removed'));
        return true;
    }
}
