<?php

namespace Gubler\ElixirBundle\Test\Twig;

use Gubler\ElixirBundle\Twig\ElixirExtension;

class ElixirExtensionTest extends \PHPUnit_Framework_TestCase
{
    const WEB_DIRECTORY = __DIR__;
    const BUILD_DIRECTORY = 'Stub';

    public function testElixirReturnsCorrectFilenameWithHash()
    {
        $elixirExtension = new ElixirExtension(self::WEB_DIRECTORY, self::BUILD_DIRECTORY);

        $this->assertSame(
            '/' . self::BUILD_DIRECTORY . '/css/an_asset.somecreazyhash.css',
            $elixirExtension->elixir('css/an_asset.css')
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testElixirThrowsExceptionWhenFileNotFound()
    {
        $elixirExtension = new ElixirExtension(self::WEB_DIRECTORY, self::BUILD_DIRECTORY);

        $elixirExtension->elixir('css/a_non_existing_asset.css');
    }
}
