# Plugin for CakePHP for using Twitter Bootstrap 3

At the moment this package is far from being complete and possibly broken. Do not use for production!

The baked views need the [gourmet/twitter_bootstrap](https://github.com/gourmet/twitter_bootstrap) plugin to work, so my package depends on this plugin. 
All bake templates are highly opinionated and will reflect my own needs. Use them as a starting point or inspiration.

## What you get
1. Bake templates for the index, view, edit and add actions using some TwitterBootstrap Features, i.e. icons. 
2. An Icon Helper who can supply the markup for icons ([Icomoon](https://icomoon.io/), [FontAwesome](http://fortawesome.github.io/Font-Awesome/) and [Glyphicons](http://getbootstrap.com/components/) supported). You have to include the Font-Libraries yourself. I recommend using bower. The helper can although add icons to normal links.

## Installation
You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).
You first have to add the repository manually by adding this line to your composer.json:

```
"repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/cewi/cakephp_tb_starter"
        }
    ],
```


The recommended way to install the package is:

```
composer require cewi/cakephp_tb_starter
```

##Usage
For the IconHelper just include it in AppController or in any Controller, you wish to use it:

```
public $helpers = ['Cewi/CakephpTbStarter.Icon'];
```

you can then use it's public methods:

- $this->Icon->span($iconName) will output a span-Tag with the icon. I.e. $this->Icon->span('glyphicon-star') will output 
```
<span class="glyphicon glyphicon-star"  aria-hidden="true"></span>
```
- $this->Icon->link() and $this->Icon->postLink() will behave like $this->Html->link() resp. $this->Form->postLink(), unless the 'action' in the $url-Array is one of 'edit', 'add', 'index', 'list', or 'delete'. It then will output an icon instead of the text. If you want both icons and text, add 'keepTitle' => true to the $options-Array.

Using the bake-templates: coming soon...