<?php
declare(strict_types=1);
namespace App\DataTransferObject;

/**
 * Auto generated data provider
 */
final class TipEventDataProvider extends \Xervice\DataProvider\Business\Model\DataProvider\AbstractDataProvider implements \Xervice\DataProvider\Business\Model\DataProvider\DataProviderInterface
{
    /** @var array */
    protected $tips;


    /**
     * @return array
     */
    public function getTips(): array
    {
        return $this->tips;
    }


    /**
     * @param array $tips
     * @return TipEventDataProvider
     */
    public function setTips(array $tips)
    {
        $this->tips = $tips;

        return $this;
    }


    /**
     * @return TipEventDataProvider
     */
    public function unsetTips()
    {
        $this->tips = null;

        return $this;
    }


    /**
     * @return bool
     */
    public function hasTips()
    {
        return ($this->tips !== null && $this->tips !== []);
    }


    /**
     * @return array
     */
    protected function getElements(): array
    {
        return array (
          'tips' =>
          array (
            'name' => 'tips',
            'allownull' => false,
            'default' => '',
            'type' => 'array',
            'is_collection' => false,
            'is_dataprovider' => false,
            'isCamelCase' => false,
          ),
        );
    }
}
