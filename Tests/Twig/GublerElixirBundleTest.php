<?php

namespace Gubler\ElixirBundle\Test\Twig;

use Gubler\ElixirBundle\Twig\ElixirExtension;

/**
 * Class ElixirExtensionTest
 *
 * @package Gubler\ElixirBundle\Test\Twig
 */
class ElixirExtensionTest extends \PHPUnit_Framework_TestCase
{
    const WEB_DIRECTORY = __DIR__;
    const BUILD_DIRECTORY = 'Stub';
    const URL_SUBDIRECTORY = null;

    /**
     * @test
     */
    public function testElixirReturnsCorrectFilenameWithHashWithoutSubdirectory()
    {
        $elixirExtension = new ElixirExtension(self::WEB_DIRECTORY, self::BUILD_DIRECTORY, self::URL_SUBDIRECTORY);

        $this->assertSame(
            '/' . self::BUILD_DIRECTORY . '/css/an_asset.somecrazyhash.css',
            $elixirExtension->elixir('css/an_asset.css')
        );
    }

    /**
     * @test
     */
    public function testElixirReturnsCorrectFilenameWithHashWithUrlSubdirectory()
    {
        $elixirExtension = new ElixirExtension(self::WEB_DIRECTORY, self::BUILD_DIRECTORY, 'subdir');

        $this->assertSame(
            '/subdir/' . self::BUILD_DIRECTORY . '/css/an_asset.somecrazyhash.css',
            $elixirExtension->elixir('css/an_asset.css')
        );
    }

    /**
     * @test
     */
    public function testElixirReturnsCorrectFilenameWithHashWithDeepUrlSubdirectory()
    {
        $elixirExtension = new ElixirExtension(self::WEB_DIRECTORY, self::BUILD_DIRECTORY, 'subdir1/subdir2/subdir3');

        $this->assertSame(
            '/subdir1/subdir2/subdir3/' . self::BUILD_DIRECTORY . '/css/an_asset.somecrazyhash.css',
            $elixirExtension->elixir('css/an_asset.css')
        );
    }

    /**
     * @test
     */
    public function testElixirReturnsCorrectFilenameWithHashWithUrlSubdirectoryThatHasLeadingSlash()
    {
        $elixirExtension = new ElixirExtension(self::WEB_DIRECTORY, self::BUILD_DIRECTORY, '/subdir');

        $this->assertSame(
            '/subdir/' . self::BUILD_DIRECTORY . '/css/an_asset.somecrazyhash.css',
            $elixirExtension->elixir('css/an_asset.css')
        );
    }

    /**
     * @test
     */
    public function testElixirReturnsCorrectFilenameWithHashWithUrlSubdirectoryThatHasTrailingSlash()
    {
        $elixirExtension = new ElixirExtension(self::WEB_DIRECTORY, self::BUILD_DIRECTORY, 'subdir/');

        $this->assertSame(
            '/subdir/' . self::BUILD_DIRECTORY . '/css/an_asset.somecrazyhash.css',
            $elixirExtension->elixir('css/an_asset.css')
        );
    }

    /**
     * @test
     */
    public function testElixirReturnsCorrectFilenameWithHashWithUrlSubdirectoryThatHasMultipleSlashes()
    {
        $elixirExtension = new ElixirExtension(self::WEB_DIRECTORY, self::BUILD_DIRECTORY, '/subdir/');

        $this->assertSame(
            '/subdir/' . self::BUILD_DIRECTORY . '/css/an_asset.somecrazyhash.css',
            $elixirExtension->elixir('css/an_asset.css')
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testElixirThrowsExceptionWhenFileNotFound()
    {
        $elixirExtension = new ElixirExtension(self::WEB_DIRECTORY, self::BUILD_DIRECTORY, self::URL_SUBDIRECTORY);

        $elixirExtension->elixir('css/a_non_existing_asset.css');
    }
}
