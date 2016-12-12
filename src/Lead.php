<?php
namespace whitelabeled\ZanoxApi;

use \DateTime;
use SimpleXMLElement;

class Lead {
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $reviewState;

    /**
     * @var DateTime
     */
    public $trackingDate;

    /**
     * @var DateTime
     */
    public $clickDate;

    /**
     * @var DateTime
     */
    public $modifiedDate;

    /**
     * @var string
     */
    public $adMedium;

    /**
     * @var string
     */
    public $program;

    /**
     * @var string
     */
    public $clickId;

    /**
     * @var double
     */
    public $commission;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var array General purpose tracking parameters
     */
    public $gpps;

    /**
     * @var integer Adspace ID
     */
    public $mediaId;

    /**
     * @var integer Adspace name
     */
    public $mediaName;

    public static function createFromXml(SimpleXMLElement $leadItem) {
        $lead = new Lead();

        $lead->id = (string)$leadItem->attributes()->id;
        $lead->reviewState = (string)$leadItem->reviewState;
        if (isset($leadItem->trackingDate)) {
            $lead->trackingDate = new DateTime($leadItem->trackingDate);
        }
        if (isset($leadItem->clickDate)) {
            $lead->clickDate = new DateTime($leadItem->clickDate);
        }
        if (isset($leadItem->modifiedDate)) {
            $lead->modifiedDate = new DateTime($leadItem->modifiedDate);
        }

        $lead->adMedium = (string)$leadItem->admedium;
        $lead->mediaName = (string)$leadItem->adspace;
        $lead->mediaId = (string)$leadItem->adspace->attributes()->id;
        $lead->program = (string)$leadItem->program;
        $lead->clickId = (string)$leadItem->clickId;
        $lead->currency = (string)$leadItem->currency;
        $lead->commission = (double)$leadItem->commission;

        $lead->gpps = array();

        if (isset($leadItem->gpps)) {
            foreach ($leadItem->gpps->gpp as $gppItem) {
                $gppVarName = (string)$gppItem->attributes()->id;
                $gppValue = (string)$gppItem;
                $lead->gpps[$gppVarName] = $gppValue;
            }
        }

        return $lead;
    }
}