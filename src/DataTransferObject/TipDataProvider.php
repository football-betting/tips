<?php
declare(strict_types=1);
namespace App\DataTransferObject;

/**
 * Auto generated data provider
 */
final class TipDataProvider extends \Xervice\DataProvider\Business\Model\DataProvider\AbstractDataProvider implements \Xervice\DataProvider\Business\Model\DataProvider\DataProviderInterface
{
    /** @var string */
    protected $matchId;

    /** @var string */
    protected $user;

    /** @var string */
    protected $tipDatetime;

    /** @var int */
    protected $tipTeam1;

    /** @var int */
    protected $tipTeam2;


    /**
     * @return string
     */
    public function getMatchId(): string
    {
        return $this->matchId;
    }


    /**
     * @param string $matchId
     * @return TipDataProvider
     */
    public function setMatchId(string $matchId)
    {
        $this->matchId = $matchId;

        return $this;
    }


    /**
     * @return TipDataProvider
     */
    public function unsetMatchId()
    {
        $this->matchId = null;

        return $this;
    }


    /**
     * @return bool
     */
    public function hasMatchId()
    {
        return ($this->matchId !== null && $this->matchId !== []);
    }


    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }


    /**
     * @param string $user
     * @return TipDataProvider
     */
    public function setUser(string $user)
    {
        $this->user = $user;

        return $this;
    }


    /**
     * @return TipDataProvider
     */
    public function unsetUser()
    {
        $this->user = null;

        return $this;
    }


    /**
     * @return bool
     */
    public function hasUser()
    {
        return ($this->user !== null && $this->user !== []);
    }


    /**
     * @return string
     */
    public function getTipDatetime(): string
    {
        return $this->tipDatetime;
    }


    /**
     * @param string $tipDatetime
     * @return TipDataProvider
     */
    public function setTipDatetime(string $tipDatetime)
    {
        $this->tipDatetime = $tipDatetime;

        return $this;
    }


    /**
     * @return TipDataProvider
     */
    public function unsetTipDatetime()
    {
        $this->tipDatetime = null;

        return $this;
    }


    /**
     * @return bool
     */
    public function hasTipDatetime()
    {
        return ($this->tipDatetime !== null && $this->tipDatetime !== []);
    }


    /**
     * @return int
     */
    public function getTipTeam1(): int
    {
        return $this->tipTeam1;
    }


    /**
     * @param int $tipTeam1
     * @return TipDataProvider
     */
    public function setTipTeam1(int $tipTeam1)
    {
        $this->tipTeam1 = $tipTeam1;

        return $this;
    }


    /**
     * @return TipDataProvider
     */
    public function unsetTipTeam1()
    {
        $this->tipTeam1 = null;

        return $this;
    }


    /**
     * @return bool
     */
    public function hasTipTeam1()
    {
        return ($this->tipTeam1 !== null && $this->tipTeam1 !== []);
    }


    /**
     * @return int
     */
    public function getTipTeam2(): int
    {
        return $this->tipTeam2;
    }


    /**
     * @param int $tipTeam2
     * @return TipDataProvider
     */
    public function setTipTeam2(int $tipTeam2)
    {
        $this->tipTeam2 = $tipTeam2;

        return $this;
    }


    /**
     * @return TipDataProvider
     */
    public function unsetTipTeam2()
    {
        $this->tipTeam2 = null;

        return $this;
    }


    /**
     * @return bool
     */
    public function hasTipTeam2()
    {
        return ($this->tipTeam2 !== null && $this->tipTeam2 !== []);
    }


    /**
     * @return array
     */
    protected function getElements(): array
    {
        return array (
          'matchId' =>
          array (
            'name' => 'matchId',
            'allownull' => false,
            'default' => '',
            'type' => 'string',
            'is_collection' => false,
            'is_dataprovider' => false,
            'isCamelCase' => false,
          ),
          'user' =>
          array (
            'name' => 'user',
            'allownull' => false,
            'default' => '',
            'type' => 'string',
            'is_collection' => false,
            'is_dataprovider' => false,
            'isCamelCase' => false,
          ),
          'tipDatetime' =>
          array (
            'name' => 'tipDatetime',
            'allownull' => false,
            'default' => '',
            'type' => 'string',
            'is_collection' => false,
            'is_dataprovider' => false,
            'isCamelCase' => false,
          ),
          'tipTeam1' =>
          array (
            'name' => 'tipTeam1',
            'allownull' => false,
            'default' => '',
            'type' => 'int',
            'is_collection' => false,
            'is_dataprovider' => false,
            'isCamelCase' => false,
          ),
          'tipTeam2' =>
          array (
            'name' => 'tipTeam2',
            'allownull' => false,
            'default' => '',
            'type' => 'int',
            'is_collection' => false,
            'is_dataprovider' => false,
            'isCamelCase' => false,
          ),
        );
    }
}
