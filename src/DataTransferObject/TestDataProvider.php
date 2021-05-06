<?php
declare(strict_types=1);
namespace App\DataTransferObject;

/**
 * Auto generated data provider
 */
final class TestDataProvider extends \Xervice\DataProvider\Business\Model\DataProvider\AbstractDataProvider implements \Xervice\DataProvider\Business\Model\DataProvider\DataProviderInterface
{
    /** @var int */
    protected $ident;

    /** @var string */
    protected $name;


    /**
     * @return int
     */
    public function getIdent(): int
    {
        return $this->ident;
    }


    /**
     * @param int $ident
     * @return TestDataProvider
     */
    public function setIdent(int $ident)
    {
        $this->ident = $ident;

        return $this;
    }


    /**
     * @return TestDataProvider
     */
    public function unsetIdent()
    {
        $this->ident = null;

        return $this;
    }


    /**
     * @return bool
     */
    public function hasIdent()
    {
        return ($this->ident !== null && $this->ident !== []);
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @param string $name
     * @return TestDataProvider
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }


    /**
     * @return TestDataProvider
     */
    public function unsetName()
    {
        $this->name = null;

        return $this;
    }


    /**
     * @return bool
     */
    public function hasName()
    {
        return ($this->name !== null && $this->name !== []);
    }


    /**
     * @return array
     */
    protected function getElements(): array
    {
        return array (
          'ident' =>
          array (
            'name' => 'ident',
            'allownull' => false,
            'default' => '',
            'type' => 'int',
            'is_collection' => false,
            'is_dataprovider' => false,
            'isCamelCase' => false,
          ),
          'name' =>
          array (
            'name' => 'name',
            'allownull' => false,
            'default' => '',
            'type' => 'string',
            'is_collection' => false,
            'is_dataprovider' => false,
            'isCamelCase' => false,
          ),
        );
    }
}
