# Introduction #
This is just a small demo app written for a client to prove my programming chops.

## Usage ##
The demo is entirely self-contained in a virtual machine. All you need to do
is install VirtualBox and Vagrant, clone the code base, create a `VagrantConfig.json`
file from the provided example, and run `vagrant up`

## What's included ##

If you look in the support/ directory of the project the `project.md` file has a
description of what this was for, all of the primary features are included and
you can also use the provided `group-by-category` command as well

## Usage ##

Once it's up and running the following commands are available

```
php artisan find-all <source>
php artisan find-by-id <source> <id>
php artisan find-by-category <source> <category>
php artisan group-by-category <source>
```

Note: The command line interface is slightly different than in the spec, because
this is the way Laravel does this sort of thing.
 
