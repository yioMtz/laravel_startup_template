# larave_startup_template
Base template for starting a laravel project with user roles and permissions

<b>Installation:</b>
<ul>
<li>1- Download and unzip to local web root.</li>
<li>2- CD into the larave_startup_template directory</li>
<li>3- Run composer install</li>
<li>4- Run npm install</li>
<li>5- Run npm run dev to compile assets</li>
</ul>

<b>Configuration</b>
<ul>
<li>Duplicate .env.example and rename to .env </li>
<li>Configure APP_KEY using php artisan key:generate command.</li>
<li>Create database in local web server and set proper credentials in .env file</li>
</ul>

<p>Now migrate database usign the following command in terminal.</p>
<code>php artisan migrate</code>

<p>Seed default roles and permissions.</p>
<code>php artisan db:seed</code>

<h6>Username: admin@admin.com</h6>

<h6>Password: password</h6>
