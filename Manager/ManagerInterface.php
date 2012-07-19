<?php
/**
 * Created by JetBrains PhpStorm.
 * User: shustrik
 * Date: 6/15/12
 * Time: 12:46 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Settings\Bundle\Manager;
use Settings\Bundle\Model\Setting as AbstractSetting;
/**
 *
 */
interface ManagerInterface
{

    /**
     * @abstract
     *
     * @param $name
     *
     * @return mixed
     */
    function getSetting($name);


    /**
     * @abstract
     * @param      $name
     * @param null $default
     * @return mixed
     */
    function getSettingValue($name, $default = null);


    /**
     * @abstract
     * @param $setting
     * @return mixed
     */
    function castType($setting);

    /**
     * @abstract
     * @param Setting $setting
     * @return mixed
     */
    function updateSetting(AbstractSetting $setting);

    /**
     * @abstract
     * @return mixed
     */
    function createSetting();

    /**
     * @abstract
     * @param Setting $setting
     * @return mixed
     */
    function deleteSetting(AbstractSetting $setting);
}
