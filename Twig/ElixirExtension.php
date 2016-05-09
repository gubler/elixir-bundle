<?php
/**
 * Add elixir twig function
 */
namespace Gubler\ElixirBundle\Twig;

/**
 * Class ElixirExtension
 *
 * @package Gubler\ElixirBundle\Twig
 */
class ElixirExtension extends \Twig_Extension
{
    /** @var string */
    protected $webDirectory;
    /** @var string */
    protected $buildDirectory;

    /**
     * ElixirExtension constructor.
     *
     * @param string $webDirectory
     * @param string $buildDirectory
     */
    public function __construct($webDirectory, $buildDirectory)
    {
        $this->webDirectory = $webDirectory;
        $this->buildDirectory = $buildDirectory;
    }

    /**
     * @{inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('elixir', array($this, 'elixir')),
        );
    }


    /**
     * Get the path to a versioned Elixir file.
     *
     * @param  string      $file
     * @param  string|null $buildDirectory
     * @return string
     *
     * @throws \InvalidArgumentException
     * @source https://github.com/laravel/framework/blob/f13bb7f0a3db39c9c9cf8618cb70c0c309a54090/src/Illuminate/Foundation/helpers.php
     */
    function elixir($file, $buildDirectory = null)
    {
        static $manifest;
        static $manifestPath;

        if ($buildDirectory !== null) {
            $this->buildDirectory = $buildDirectory;
        }

        if (is_null($manifest) || $manifestPath !== $this->buildDirectory) {
            $manifest = json_decode(
                file_get_contents($this->webDirectory.'/'.$this->buildDirectory.'/rev-manifest.json'),
                true
            );
            $manifestPath = $this->buildDirectory;
        }

        if (isset($manifest[$file])) {
            return '/'.$this->buildDirectory.'/'.$manifest[$file];
        }

        throw new \InvalidArgumentException("File {$file} not defined in asset manifest.");
    }

    /**
     * @{inheritdoc}
     */
    public function getName()
    {
        return 'elixir';
    }
}
