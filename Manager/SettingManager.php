<?php
/**
 * Created by JetBrains PhpStorm.
 * User: shustrik
 * Date: 6/15/12
 * Time: 12:45 PM
 * To change this template use File | Settings | File Templates.
 */
namespace EM\SettingsBundle\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use EM\SettingsBundle\Model\Setting as AbstractSetting;


/**
 *
 */
class SettingManager implements ManagerInterface
{
    /**
     * @var
     */
    private $listDelimiter;

    /**
     * @var
     */
    private $objectManager;

    /**
     * @var
     */
    private $repository;


    /**
     *
     */
    public function __construct(ObjectManager $om, $class, $delimiter)
    {
        $this->objectManager = $om;
        $this->repository = $this->repository = $om->getRepository($class);
        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->name;
        $this->listDelimiter = $delimiter;
    }


    /**
     * @param $name
     *
     * @return \EM\SettingsBundle\Entity\Setting
     */
    public function getSetting($name)
    {
        /** @var $setting  AbstractSetting*/
        $setting = $this->repository->findOneByIdentifier($name);

        return $setting;
    }

    /**
     * @param      $name
     * @param null $default
     *
     * @return mixed|null
     */
    public function getSettingValue($name, $default = null)
    {
        $setting = $this->getSetting($name);
        if ($setting) {
            return $this->castType($setting);
        }

        return $default;
    }

    /**
     * @param $setting
     *
     * @return array|bool|mixed
     */
    public function castType($setting)
    {
        $value = $setting->getValue();
        if ($setting->getType() == Setting::TYPE_LIST) {
            $value = explode($value, $this->listDelimiter);
        } else {
            settype($value, Setting::getCurrentType($setting->getType()));
        }

        return $value;
    }

    /**
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return mixed
     */
    public function updateSetting(AbstractSetting $setting)
    {
        /** @var $setting \Settings\Bundle\Entity\Setting */
        $this->om->persist($setting);
        $this->om->flush();
    }

    /**
     *
     * @param $name
     * @param $value
     *
     * @return mixed
     */
    public function createSetting()
    {
        $setting = new $this->class;

        return $setting;
    }

    /**
     *
     * @param $name
     * @param $value
     *
     * @return mixed
     */
    public function deleteSetting(AbstractSetting $setting)
    {
        $this->om->remove($setting);
        $this->om->flush();
    }

    /**
     * @return mixed
     */
    function getRepository()
    {
        return $this->repository;
    }
}
