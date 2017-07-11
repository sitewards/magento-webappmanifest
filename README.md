Sitewards_MagentoWebAppManifest
===============================

This is an implementation of the web app manifest specification. A detailed review of this manifest may be found at the
following URL:

https://developer.mozilla.org/en-US/docs/Web/Manifest 

Recently, there has been an increasing interested in a set of technologies broadly known as the "progressive web app",
or "PWA". The ionoic framework describes this as:

> A Progressive Web App (PWA) is a web app that uses modern web capabilities to deliver an app-like experience to 
> users. These apps meet certain requirements (see below), are deployed to servers, accessible through URLs, and 
> indexed by search engines.

One of the technological aspects of this is the manifest specification. The manifest providers additional, site wide
metadata about the application, such as:

- Its orientation
- Its logo
- Descriptions

etc.

Architecture
------------

Broadly, the extension is based on the https://github.com/meanbee/magento2-webappmanifest extension. This is an
implementation of the same idea, in Magento 1.x

Deployment
----------

This extension is disabled by default. If it is to be enabled you can do so through the Magento configuration tree,
or through the admin panel.

Development Instructions
------------------------

Coming soon!

Installation instruction
------------------------

Installation is managed through Composer. This is the only supported method, and requires the excellent Magento
Composer Installer by Cotya (or another similar tool):

  https://github.com/Cotya/magento-composer-installer

Once this has been installed, you can undertake the following steps:

1. Add the git repository to the "repository" section of composer.json:

```
    {
        // Other composer.json stuff
        "repositories": [
            {
                "type": "vcs",
                "url": "git@github.com:sitewards/magento-webappmanifest.git"
            }
        ]
    }
```

2. Once you have completed this, you can require the module:

```
    composer require sitewards/magento-webappmanifest
```

This will install the most recent version. That's it! You're all up to date. Note: At the time of writing, there are
no stable releases. Thus, you might have to use:

```
    composer require sitewards/magento-webappmanifest dev-master
```

This is not production ready; when it is, it will be tagged, and you will be able to lock the version in composer.

contact: mail@sitewards.com
web:     http://www.sitewards.com

