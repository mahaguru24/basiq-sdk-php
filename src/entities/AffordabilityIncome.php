<?php


namespace MMPBasiq\Entities;

class AffordabilityIncome extends Entity
{
    public $id;
    public $type = 'income';
    public $fromMonth;
    public $toMonth;
    public $coverageDays;
    public $generateDate = null;
    /** @var AffordabilityIncomeSummary */
    public $summary;
    /**
     * @var array
     */
    public $regular;
    /**
     * @var array
     */
    public $irregular;
    /**
     * @var array
     */
    public $otherCredit;

    public function __construct($body)
    {
        $this->id = $body['id'];
        $this->fromMonth = $body['fromMonth'];
        $this->toMonth = $body['toMonth'];
        $this->coverageDays = $body['coverageDays'];
        if (isset($body['generatedDate'])) {
            $this->generateDate = $body['generatedDate'];
        }
        $this->summary = new AffordabilityIncomeSummary($body['summary']);
        $regularIncome = [];
        foreach ($body['regular'] as $item) {
            array_push($regularIncome, new AffordabilityRegularIncome($item));
        }
        $this->regular = $regularIncome;
        $irregularIncome = [];
        foreach ($body['irregular'] as $item) {
            array_push($irregularIncome, new AffordabilityIrregularIncome($item));
        }
        $this->irregular = $irregularIncome;
        $otherCredit = [];
        foreach ($body['otherCredit'] as $item) {
            array_push($otherCredit, new AffordabilityOtherCreditSource($item));
        }
        $this->otherCredit = $otherCredit;
    }
}
