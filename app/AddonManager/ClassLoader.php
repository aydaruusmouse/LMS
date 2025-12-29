<?php

namespace App\AddonManager;

class ClassLoader
{
    /**
     * @var AddonManager
     */
    protected $addonManager;

    /**
     * ClassLoader constructor.
     */
    public function __construct(AddonManager $addonManager)
    {
        $this->addonManager = $addonManager;
    }

    /**
     * Loads the given class or interface.
     *
     * @return bool|null
     */
    public function loadClass($class)
    {
        if (isset($this->addonManager->getClassMap()[$class])) {
            include $this->addonManager->getClassMap()[$class];

            return true;
        }
    }
}
