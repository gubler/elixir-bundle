# Gubler/ElixirBundle

`Gubler/ElixirBundle` is a small Symfony bundle to add an `elixr()` twig function. This function will allow you to
use [Laravel Elixir's versioning](https://laravel.com/docs/5.2/elixir#versioning-and-cache-busting) just like if you
were using it in a Laravel blade template (most of the code was taken
from [Laravel/Framework](https://github.com/laravel/framework)).

## Installation

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the following command to download the latest stable
version of this bundle:

```bash
$ composer require gubler/elixir-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Gubler\ElixirBundle\GublerElixirBundle(),
        );

        // ...
    }

    // ...
}
```

### Step 3: Configuration

This bundle supports the following configuration (shown here with the defaults):

```yml
# Elixir Bundle Config
gubler_elixir:
    web_directory: '%kernel.root_dir%/../web'
    build_directory: 'build'
    url_subdirectoty: ''
```

`web_directory` is the directory on disk where your Symfony project's `web` directory is located. 

The `build_directory` value is relational to your web_directory. For example, if your build directory is
`/{symfony-root}/web/elixir/build/`, you would need to change `build_directory` to `elixir/build`.

`url_subdirectory` is in case your application is in a subdirectory from your url root. This value should be left empty
if your app is at the root path (ex. `https://my-app.com`). If your app is in a subdirectory
(ex. `https://my-site.com/app/`), then you need to update this with the subdirectory (for the example, `app`). This also
works if your app is multiple subdirectories deep (URL: `https://my-site.com/here/is/my/app/` → setting: `here/is/my/app`).

## Usage

If you use Elixir to version a file, instead of using `asset()` in your twig templates like this:

```
<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
```

you can use `elixir()` like this:

```
<link rel="stylesheet" type="text/css" href="{{ elixir('css/app.css') }}" />
```

## TODO

- Add console command to generate base `package.json` file.
