Below is a sample vhost for your Apache configuration. Add it, restart your
Apache server, and make sure you have an entry in your /etc/hosts file such as:

    127.0.0.1 phly-contact.dev

Vhost definition:

<VirtualHost *:80>
    ServerName phly-contact.dev

    ErrorLog ${APACHE_LOG_DIR}/phly-contact-error.log
	CustomLog ${APACHE_LOG_DIR}/phly-contact-access.log combined

    DocumentRoot /path/to/phly_contact/public
    <Directory /path/to/phly_contact/public>
        DirectoryIndex index.php index.html

        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
