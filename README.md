# This project is deprecated

It is replaced by https://github.com/aequasi/git-hook-handler

# git-precommit-handler


Just create a `pre-commit-hook.yml` file in your projects base directory, and fill it with an array of commands you want to run:

```yml
- bldr run ci
- phpunit
- bin/phpcs
```
