Getting Started With PMUtilZendeskBundle
=====================================

Step 1: Setting up the bundle
=============================
### A) Download PMUtilZendeskBundle

**Note:**

> This bundle recommends using [JMSSerializer](https://github.com/schmittjoh/serializer) which is 
> integrated into Symfony2 via [JMSSerializerBundle](https://github.com/schmittjoh/JMSSerializerBundle).
> Please follow the instructions of the bundle to add it to your composer.json and how to set it up.
> If you do not add a dependency to JMSSerializerBundle, you will need to manually setup an alternative
> service and configure the Bundle to use it via the ``service`` section in the app config

**Using composer**

Simply run assuming you have installed composer.phar or composer binary:

``` bash
$ composer require pm/util-zendesk-bundle
```

### B) Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new PM\Util\ZendeskBundle\PMUtilZendeskBundle,
        
        // if you installed FOSRestBundle using composer you shoudn't forget
        // also registering JMSSerializerBundle.
        
        // new JMS\SerializerBundle\JMSSerializerBundle(),
    );
}
```

## That's it!