This repository hosts the E.S.H. Da Vinci B.arsysteem, originally built by Christiaan Goossens and now maintained by the CommunicatCie. It is built on the Laravel PHP framework.

### Install
1. Install PHP on your computer, version 7.*
2. Install Composer on your computer (https://getcomposer.org/)
3. Run the `composer install` command in the directory of the repository
4. Copy the .env.example file to .env and fill in the environment variables as required
5. Run the `vendor/bin/phinx migrate` and `vendor/bin/phinx seed:run` commands to prepare the database
6. Use the `composer run` command to run a local version of the application.
