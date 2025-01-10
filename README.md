# Experimental CMS

To install and use this experimental CMS on a live web host, your host will need to meed the minimum qualafications for a Laravel project, and you will need SSH access to the server that hosts your site.

## Local development

If you prefer to do all the setup in the terminal, you'll want to install PHP and Laravel via the instructions at [PHP.new](https://php.new/).

Laravel Herd

You can also install Laravel Herd, a desktop app that simplifies the process of creating and running Laravel applications locally.

Once you have installed Laravel Herd, create a test environment and navigate to that environment via the terminal.

```bash
cd /path/to/your/site/environment
git clone git@github.com:nathanrice/scribe.git .
git checkout exp
composer install
composer setup
php artisan migrate:fresh
```

If you are NOT using Laravel herd, follow the instructions above, but afterwards, be sure to start your local development server. The site should be available at http://127.0.0.1:8000 this way.

```bash
composer run dev
```

To seed the database with fresh data:

```bash
php artisan migrate:fresh -seed
```

Once you've seeded the database, you can log in at `{your_site_url}/login` with the following credentials:

```
email: tom@myspace.test
password: password
```
