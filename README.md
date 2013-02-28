Step 1: Setting up the bundle
=============================
### A) Download PMUtilZendeskBundle

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
    );
}
```

## That's it!

Step 2: Adding configuration
=============================
### A) Add the required configuration parameters to config.yml

``` yaml
pm_util_zendesk:
  api_url: <the zendesk url for your account>
  api_key: <your zendesk api key>
  api_user: <your zendesk api user>
```

Finished
=============================
