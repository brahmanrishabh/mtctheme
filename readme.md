# MTC Theme
@Author Anand Kapre <anand@kapre.email>

### Development Environment
For local development I recommend [ddev](https://ddev.com/). 
Also we require nodejs v 12.22.9. I would recommend installing Node Version Manager from github and then installing the required version of nodejs.

Install the software and create a project with a wordpress installation. Clone the repo from the above url into the wp-content/themes folder. Start the project using:
```
ddev start
```

#### Database Import
Export the database from the live site using phpmyadmin.
Import the database to the local ddev site using the following command:
```
ddev import-db -f databse.sql
```
Please note you may have to update the table prefix in the wp-config.php file.

#### Change DB Urls
If your project is in a folder called `mtctheme`, the ddev generated url will be `mtctheme.ddev.site`. We need to search and replace the urls using the wp-cli provided with ddev. run the following command:

##### Fix urls DEV
```
ddev wp search-replace --all-tables --regex 'https?://(www\.)?medicaltourismco\.com' 'https://mtctheme.ddev.site'
ddev wp search-replace --all-tables --regex 'https?://(mtctheme\.)?medicaltourismco\.com' 'https://mtctheme.ddev.site'
```
##### Fix urls STAGE
```
ddev wp search-replace --all-tables --regex 'https?://(www\.)?medicaltourismco\.com' 'https://mtctheme.medicaltourismco.com'
```

#### Uploads Import
Import the uploads folder from the server via FTP.

#### Start Development
Within the theme folder, run the following commands:
```
npm install

gulp
```
The gulp command will launch a task runner that will do the following:
- Compile all SCSS and JS files into single css and js files. This will also minify the files and add the auto prefixes.
- Creates a git commit on every file save for easier rollback
- Generates an svg icon font along with css
- Optimizes images
