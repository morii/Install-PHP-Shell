Installation Script For PHP Shell
=================================

It makes a new user with PHP Shell as default shell.
It uses git for downloading the PHP Shell.

Usage
-----

You need to be root to use this script.

  `./install.php [-t|--test] [{-u|--user} NEW_USER]`

You can pass two arguments:

`-u NEW_USER` | `--user NEW_USER`
  The new user will have NEW_USER name.

`-t` | `--test`
  Launches the tests of PHP Shell.

TODO List
---------

Things that still need to be done:

* Writing out commands, without actually executing them.
* uninstall function
* update function (synchronizing with git repository)

Contributing
------------

You can contribute to this project by:

* generating a patch using git and sending it to me, or
* opening Pull Request on GitHub.

Just make sure that the changes that you're sending to me are in a separate branch.

Any kind of help is welcomed.
