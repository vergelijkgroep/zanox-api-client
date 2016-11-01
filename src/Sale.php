<?php
namespace whitelabeled\ZanoxApi;

use \DateTime;
use SimpleXMLElement;

class Sale {
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $reviewState;

    /**
     * @var string
     */
    public $reviewNote;

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
    public $adSpace;

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
    public $amount;

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

    public static function createFromXml(SimpleXMLElement $saleItem) {
        $sale = new Sale();

        $sale->id = (string)$saleItem->attributes()->id;
        $sale->reviewState = (string)$saleItem->reviewState;
        $sale->reviewNote = (string)$saleItem->reviewNote;
        $sale->trackingDate = new DateTime($saleItem->trackingDate);
        $sale->clickDate = new DateTime($saleItem->clickDate);
        $sale->modifiedDate = new DateTime($saleItem->modifiedDate);
        $sale->adSpace = (string)$saleItem->adspace;
        $sale->adMedium = (string)$saleItem->admedium;
        $sale->program = (string)$saleItem->program;
        $sale->clickId = (string)$saleItem->clickId;
        $sale->currency = (string)$saleItem->currency;
        $sale->amount = (double)$saleItem->amount;
        $sale->commission = (double)$saleItem->commission;

        $sale->gpps = array();

        if (isset($saleItem->gpps)) {
            foreach ($saleItem->gpps->gpp as $gppItem) {
                $gppVarName = (string)$gppItem->attributes()->id;
                $gppValue = (string)$gppItem;
                $sale->gpps[$gppVarName] = $gppValue;
            }
        }

        return $sale;
    }
}