<?php

namespace App\AddonManager;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

abstract class Addon
{
    protected $app;

    /**
     * The Addon Name.
     *
     * @var string
     */
    public $name;

    /**
     * A description of the addon.
     *
     * @var string
     */
    public $description;

    /**
     * The version of the addon.
     *
     * @var string
     */
    public $version;

    /**
     * The author of the addon.
     *
     * @var string
     */
    public $author;

    /**
     * Domain of the addon.
     *
     * @var string
     */
    public $domain;

    /**
     * Domain of the addon.
     *
     * @var string
     */
    public $purchase_code;

    /**
     * Author Url of the addon.
     *
     * @var string
     */
    public $author_url;

    /**
     * Tags of the addon.
     *
     * @var string
     */
    public $tags;

    /**
     * Unique Addon Identifier.
     *
     * @var string
     */
    public $addon_identifier;

    /**
     * Minimum required Version of the CMS.
     *
     * @var string
     */
    public $required_cms_version;

    /**
     * License Name.
     *
     * @var string
     */
    public $license;

    /**
     * License URL.
     *
     * @var string
     */
    public $license_url;

    /**
     * @var $this
     */
    private $reflector = null;

    /**
     * Addon constructor.
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->checkAddonName();
    }

    abstract public function boot();

    /**
     * Addon Activate.
     */
    public function addonActivated()
    {

    }

    /**
     * Addon Deactivate.
     */
    public function addonDeactivated()
    {

    }

    /**
     * Check for empty addon name.
     *
     * @throws \InvalidArgumentException
     */
    private function checkAddonName()
    {
        if (! $this->name) {
            throw new \InvalidArgumentException('Missing Addon name.');
        }
    }

    /**
     * Returns the view namespace in a camel case format based off
     * the addons class name, with addon stripped off the end.
     *
     * Eg: ArticlesAddon will be accessible through 'addon:articles::<view name>'
     *
     * @return string
     */
    protected function getViewNamespace()
    {
        return 'addon:'.Str::camel(
            mb_substr(
                get_called_class(),
                strrpos(get_called_class(), '\\') + 1,
                -5
            )
        );
    }

    /**
     * Add a view namespace for this addon.
     * Eg: view("addon:articles::{view_name}")
     *
     * @param  string  $path
     */
    protected function enableViews($path = 'views')
    {
        $this->app['view']->addNamespace(
            $this->getViewNamespace(),
            $this->getAddonPath().DIRECTORY_SEPARATOR.$path
        );
    }

    /**
     * Enable routes for this addon.
     *
     * @param  string  $path
     * @param  array|string  $middleware
     */
    protected function enableRoutes($path = 'routes.php', $middleware = 'web')
    {
        $this->app->router->group(
            [
                'namespace'  => $this->getAddonControllerNamespace(),
                'middleware' => $middleware,
            ],
            function ($app) use ($path) {
                require $this->getAddonPath().DIRECTORY_SEPARATOR.$path;
            }
        );
    }

    /**
     * Register a database migration path for this addon.
     *
     * @param  array|string  $paths
     * @return void
     */
    protected function enableMigrations($paths = 'migrations')
    {
        $this->app->afterResolving('migrator', function ($migrator) use ($paths) {
            foreach ((array) $paths as $path) {
                $migrator->path($this->getAddonPath().DIRECTORY_SEPARATOR.$path);
            }
        });

    }

    /**
     * Register a database migration path for this addon.
     *
     * @param  array|string  $paths
     * @return void
     */

    /**
     * Add a translations namespace for this addon.
     * Eg: __("addon:articles::{trans_path}")
     *
     * @param  string  $path
     */
    protected function enableTranslations($path = 'lang')
    {
        $this->app->afterResolving('translator', function ($translator) use ($path) {
            $translator->addNamespace(
                $this->getViewNamespace(),
                $this->getAddonPath().DIRECTORY_SEPARATOR.$path
            );
        });
    }

    /**
     * @return string
     */
    public function getAddonPath()
    {
        $reflector = $this->getReflector();
        $fileName  = $reflector->getFileName();

        return dirname($fileName);
    }

    /**
     * @return string
     */
    public function getAddonDir()
    {
        $reflector = $this->getReflector();

        return basename(dirname($reflector->getFileName()));
    }

    /**
     * @return string
     */
    protected function getAddonControllerNamespace()
    {
        $reflector = $this->getReflector();
        $baseDir   = str_replace($reflector->getShortName(), '', $reflector->getName());

        return $baseDir.'Controllers';
    }

    /**
     * @return \ReflectionClass
     */
    private function getReflector()
    {
        if (is_null($this->reflector)) {
            $this->reflector = new \ReflectionClass($this);
        }

        return $this->reflector;
    }

    /**
     * Returns a addon view
     *
     * @return \Illuminate\View\View
     */
    protected function view($view)
    {
        return view($this->getViewNamespace().'::'.$view);
    }

    /**
     * Activate the addon.
     */
    public function activate()
    {
        DB::table('addons')->where('addon_identifier', $this->addon_identifier)->update([
            'status'     => true,
            'updated_at' => now(),
        ]);

        $this->addonActivated();
    }

    /**
     * Deactivate the addon.
     */
    public function deactivate()
    {
        DB::table('addons')->where('addon_identifier', $this->addon_identifier)->update([
            'status'     => false,
            'updated_at' => now(),
        ]);

        $this->addonDeactivated();
    }

    /**
     * Check if the addon is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        $addon = DB::table('addons')->where('addon_identifier', $this->addon_identifier)->first();

        return $addon->status;
    }
}
