<?php

namespace EM\SettingsBundle\Twig\Extension;

use Symfony\Bridge\Twig\Extension;
use Symfony\Component\Form\FormView;

/**
 * HelperExtension extends Twig with form capabilities.
 *
 * @author Shustrik
 */
class SettingsExtension extends \Twig_Extension
{

    protected $settings;

    function __construct(\Settings\Bundle\Manager\ManagerInterface $settings)
    {
        $this->settings = $settings;
    }

    public function getGlobals()
    {
        return array(
            'em_settings' => $this->settings
        );
    }

    public function getName()
    {
        return 'em_settings';
    }

}
