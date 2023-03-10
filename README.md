# Sync With WMS

## Development Magento Version
Magento ver. 2.4.5-p1 with sample data

## Development PHP version
PHP 8.1.6

## Installation
- Download source code archive from repository's tag directory https://github.com/ctasca/wms/tags
- Extract the archive and copy recursively `Ctasca` directory in Magento's `app/code` directory
- Enable the module with `bin/magento module:enable Ctasca_WmsSync`
- Run setup upgrade with `bin/magento setup:upgrade`


## Configuration
No configuration required. Default configuration values are set in module's `config.xml` file.

## Logger file
Module's logs are found in `var/log//wms-sync.log`

## Testing Error
In order to test an error response, continue clicking the "Sync with WMS" button until you get the error's modal alert.

## Module Screenshots

![Screenshot 2023-03-08 at 10 29 47](https://user-images.githubusercontent.com/1621171/223678144-e1da1624-a771-442a-a672-06f509bac032.png)

![Screenshot 2023-03-08 at 10 30 06](https://user-images.githubusercontent.com/1621171/223678308-6b1e2755-ad55-43c9-b8b4-f31c1a18c27e.png)

![Screenshot 2023-03-08 at 10 30 16](https://user-images.githubusercontent.com/1621171/223678409-69965149-f967-4026-b8ef-1ea17281a8e1.png)

![Screenshot 2023-03-08 at 10 37 12](https://user-images.githubusercontent.com/1621171/223678446-855633b0-1b7a-4d34-9fd8-0bf0e1c7de18.png)

![Screenshot 2023-03-08 at 10 29 16](https://user-images.githubusercontent.com/1621171/223688010-967a1fe3-48e6-4000-9feb-03470be789f3.png)

![Screenshot 2023-03-08 at 10 52 53](https://user-images.githubusercontent.com/1621171/223680758-21392cf1-d1f5-4888-99b4-55bdd82f60fa.png)
