emSettingsBundle
============

The emSettingsBundle adds support for save different information into database. You can save small imortant information for example api keys

Installing
----------

for symfony 2.0 read doc install for symfony 2.0

Install from composer for symfony 2.1
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Add emSettingsBundle in deps:

[emSettingBundle]
    git=git://github.com/Everymove/emSettingsBundle.git
    target=bundles/EM/SettingsBundle


Now, run the vendors script to download the bundle:

``` bash
$ php bin/vendors install
```

Add the `EM` namespace to your autoloader:

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    // ...
    'EM' => __DIR__.'/../vendor/bundles',
));
```


Register emSettingsBundle into your application kernel
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

::

    // app/AppKernel.php
    public function registerBundles()
    {
        $bundles = array(
            // ...,
           new EM\SettingsBundle\EMSettingsBundle()
            // ...,
        );

        //..
        return $bundles;
    }


How to use
----------

Get settings service
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

$container->get('em.settings')

Call service method
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

$container->get('em.settings')->getSettingValue($key, $default);

  get value of the settign, if value not found, returned default value

SettingManager contain all method which you can call


Twig
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

you can get value from twig
{{em_settings.getSettingValue(key, default)}}

emSettingBundle Configuration Reference
-----------------------------------------


``` yaml
# app/config/config.yml
em_settings:
    db_driver:              orm #[orm, mongodb]
    model_manager:          ~ #
    entity:
       orm:                 EM\\SettingsBundle\\Entity\\Setting
       mongodb:             EM\\SettingsBundle\\Document\\Setting
    array_delemiter:        ','
    setting_manager:        em.settings.manager.default


Well, this all to emSettingsBundle work. Suggestions, bug reports and observations
are wellcome.