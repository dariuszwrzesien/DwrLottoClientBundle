[![SensioLabsInsight](https://insight.sensiolabs.com/projects/b6a05abf-5bc5-4c90-befa-4adbc93ec11d/big.png)](https://insight.sensiolabs.com/projects/b6a05abf-5bc5-4c90-befa-4adbc93ec11d)
======================
[![Build Status](https://travis-ci.org/dariuszwrzesien/DwrLottoClientBundle.svg?branch=master)](https://travis-ci.org/dariuszwrzesien/DwrLottoClientBundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dariuszwrzesien/DwrLottoClientBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dariuszwrzesien/DwrLottoClientBundle/?branch=master)

# **DwrLottoClient**

This bundle helps to take results from polish national lottery

## **Installation**

Installation is a quick 3 steps process:

1. Download DwrLottoClientBundle using composer.
2. Enable the Bundle.
3. Use bundle in your controller.

### Step 1: Download DwrAvatarBundle using composer

Add DwrGlobalWeatherBundle in your composer.json:

``` js
{
    "require": {
        "dwr/lottoclient-bundle": "1.0"
    }
}
```

Download the bundle by running the command:

``` bash
$ php composer.phar update dwr/lottoclient-bundle
```

Composer will install the bundle into your project's `vendor/dwr/lottoclient-bundle` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
//app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Dwr\LottoClientBundle\DwrLottoClientBundle(),
    );
}
```

### Step 3: Use bundle in your controller

``` php
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

        $lotto = $this->get('dwr_lotto_client');
        $resultsDL = $lotto->getRecentlyResults(LottoClient::DUZY_LOTEK, 1); //takes last result from Duży lotek
        $resultsK  = $lotto->getRecentlyResults(LottoClient::KASKADA, 5); //takes 5 recently results from Kaskada
        
        var_dump($resultsDL);
        var_dump($resultsK);

        $date = new \DateTime('2014-10-10');
        $resultMINI = $lotto->getResultsByDate($date, LottoClient::MINI_LOTEK, 2); //takes 2 recently results from giving date for Mini Lotek
        $resultMULTI = $lotto->getResultsByDate($date, LottoClient::MULTI_LOTEK, 3); //takes 3 recently results from giving date for Multi Lotek

        var_dump($resultMINI);
        var_dump($resultMULTI);

        return $this->render('default/index.html.twig');
    }

```

**Congratulations!** You're ready to embed lotto results in your symfony2 application.

## **Usage**

Add this in your controller:

``` php
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

        $lotto = $this->get('dwr_lotto_client');
        
        /**
         * In order to take last result from Duży lotek pass 1 as a second argument for getRecentlyResults method.
         * Maximum you can take 10 recently results.
         */
        $resultsDL = $lotto->getRecentlyResults(LottoClient::DUZY_LOTEK, 1);
        var_dump($resultsDL); 
        
        /**
         * In order to take archive results use getResultsByDate method.
         * Specify date (e.g. new \DateTime('2014-10-10')) and pass it as first argument.
         */
        $date = new \DateTime('2014-10-10');
        $resultMINI = $lotto->getResultsByDate($date, LottoClient::MINI_LOTEK, 2);
        var_dump($resultMINI);
    }

```

### **Available lottery types:**

LottoClient::DUZY_LOTEK

LottoClient::MINI_LOTEK

LottoClient::MULTI_LOTEK

LottoClient::JOKER

LottoClient::KASKADA 
