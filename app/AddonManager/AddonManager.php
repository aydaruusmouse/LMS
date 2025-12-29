<?php

namespace App\AddonManager;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class AddonManager
{
    private $app;

    /**
     * @var AddonManager
     */
    private static $instance = null;

    /**
     * @var string
     */
    protected $addonDirectory;

    /**
     * @var array
     */
    protected $addons        = [];

    /**
     * @var array
     */
    protected $classMap      = [];

    /**
     * AddonManager constructor.
     */
    public function __construct($app)
    {
        $this->app            = $app;
        $this->addonDirectory = $app->path().DIRECTORY_SEPARATOR.'Addons';

        $this->bootAddons();

        $this->registerClassLoader();
    }

    /**
     * Registers addon autoloader.
     */
    private function registerClassLoader()
    {
        spl_autoload_register([new ClassLoader($this), 'loadClass'], true, true);
    }

    /**
     * @return AddonManager
     */
    public static function getInstance($app)
    {
        if (is_null(self::$instance)) {
            self::$instance = new self($app);
        }

        return self::$instance;
    }

    protected function bootAddons()
    {
        foreach (Finder::create()->in($this->addonDirectory)->directories()->depth(0) as $dir) {
            /** @var SplFileInfo $dir */
            $directoryName              = $dir->getBasename();

            $addonClass                 = $this->getAddonClassNameFromDirectory($directoryName);

            if (! class_exists($addonClass)) {
                dd('Addon '.$directoryName.' needs a '.$directoryName.'Addon class.');
            }

            try {
                $addon = $this->app->makeWith($addonClass, [$this->app]);
            } catch (\ReflectionException $e) {
                dd('Addon '.$directoryName.' could not be booted: "'.$e->getMessage().'"');
                exit;
            }

            if (! ($addon instanceof Addon)) {
                dd('Addon '.$directoryName.' must extends the Addon Base Class');
            }

            if (! class_exists($addonClass)) {
                // Addon class does not exist, update the addons table
                $existingAddon = \App\Models\Addon::where('name', $directoryName)->first();

                if ($existingAddon) {
                    // Update the existing addon record
                    $existingAddon->update([
                        // Update the desired columns with new values
                    ]);
                } else {
                    // Addon record does not exist, create a new one
                    \App\Models\Addon::create([
                        'name' => $directoryName,
                        // Other columns you want to populate, such as 'version', 'description', etc.
                    ]);
                }

                continue; // Skip further processing for this addon
            }

            $addon->boot();

            $this->addons[$addon->name] = $addon;
        }
    }

    /**
     * @return string
     */
    protected function getAddonClassNameFromDirectory($directory)
    {
        return 'App\\Addons\\'.$directory.'\\'.$directory.'Addon';
    }

    /**
     * @return array
     */
    public function getClassMap()
    {
        return $this->classMap;
    }

    /**
     * @param  array  $classMap
     * @return $this
     */
    public function setClassMap($classMap)
    {
        $this->classMap = $classMap;

        return $this;
    }

    public function addClassMapping($classNamespace, $storagePath)
    {
        $this->classMap[$classNamespace] = $storagePath;
    }

    /**
     * @return array
     */
    public function getAddons()
    {
        return $this->addons;
    }

    /**
     * @return string
     */
    public function getAddonDirectory()
    {
        return $this->addonDirectory;
    }
}
