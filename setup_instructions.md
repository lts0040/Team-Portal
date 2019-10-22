### Installation Instructions

From a clean installation of Ubuntu 16.04:

1. Update all packages and upgrade
`sudo apt-get update && sudo apt-get upgrade -y`
2. Install apache2
`sudo apt-get install apache2 -y`
Note: apache2 should already be installed, but this should be run to confirm installation.
3. Set up firewall
`sudo apt-get install ufw -y`
4. Set firewall to allow requests from Apache
`sudo ufw allow in "Apache Full"`
5. Install mysql server
`sudo apt-get install mysql-server -y`
6. Set up root user for mysql when prompted.
7. Install PHP, git, nano, and curl
`sudo apt-get install php libapache2-mod-php php-mcrypt php-mysql git-core nano curl -y`
8. Set github username for git
`git config --global user.name "Your name here"`
9. Set github email for git
`git config --global user.email "your_email@example.com"`
10. Create ssh key for github
`ssh-keygen -t rsa -b 4096 -C "your_email@example.com"`
11. Use the default location and don't set a passphrase
12. Add key
`ssh-add ~/.ssh/id_rsa`
13. Copy the contents of `~/.ssh/id_rsa.pub` to your clipboard
If you used anything other than the default file location earlier, update it here.
14. On GitHub, go to your settings, then click on `SSH and GPG keys`
15. Click `New SSH key`
16. Paste the public key into the key section and add a description in the title.
17. Click add SSH key
Configure server and add redirect to project folder
18. `sudo nano /etc/apache2/mods-enabled/dir.conf`
19. Move `index.php` in front of `index.html` on line two.
`cd /var/www`
20. `git clone GIT_LINK_HERE`
21. Update apache2 to redirect to project folder
`sudo nano /etc/apache2/sites-enabled/000-default.conf`
22. Replace any instance of `/var/www/html` with `/var/www/Team-Portal/public`
23. `sudo systemctl restart apache2`
24. install phpmyadmin
`sudo apt-get install phpmyadmin php-mbstring php-gettext`
25. Set up root user

---

If you are setting up for production:
1. Set up apache2 to recognize domain name
2. `sudo apt-get install nano`
3. `sudo nano /etc/apache2/apache2.conf`
4. Add a new line at the bottom with the following: `ServerName DOMAIN_OR_IP_HERE`
Replace `DOMAIN_OR_IP_HERE` with your production domain or ip if you are not using a domain name
5. `sudo apache2ctl configtest`
If no errors:
6. `sudo systemctl restart apache2`
7. `mysql_secure_installation`
8. Enter root password when prompted.
9. Use the following settings when prompted:
Setting | Value
:--: | :--:
Validate Password | Y
Password Level | 2
Change Root Password | N
Remove Anonymous Users | Y
Disallow root login remotely | Y
Remove test database | Y
Reload Privilege Tables | Y
10. `sudo apt-get install software-properties-common -y`
11. `sudo add-apt-repository ppa:certbot/certbot`
12. `sudo apt-get update`
13. `sudo apt-get install python-certbot-apache -y`
14. `sudo certbot --apache -d example.com -d www.example.com`
NOTE: replace example.com with the domain name being used.

---


