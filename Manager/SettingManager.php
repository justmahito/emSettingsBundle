<?php
/**
 * Created by JetBrains PhpStorm.
 * User: shustrik
 * Date: 6/15/12
 * Time: 12:45 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Settings\Bundle\Manager;

use Settings\Bundle\Model\Setting as AbstractSetting;


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
    private $entityManager;

    /**
     * @var
     */
    private $repository;


    /**
     *
     */
    public function __construct(\Doctrine\ORM\EntityManager $em, $class, $delimiter)
    {
        $this->entityManager = $em;
        $this->repository = $this->repository = $em->getRepository($class);
        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;
        $this->listDelimiter = $delimiter;
    }


    /**
     * @param $name
     *
     * @return \Settings\Bundle\Model\Setting
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
        $this->em->persist($setting);
        $this->em->flush();
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
        $this->em->remove($setting);
        $this->em->flush();
    }
}
