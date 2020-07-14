
# OAuth Client All Versions.

## How to Change Versions?

* In `./_autoload.php`
  Change constant `version` to any of the following
    * `mo_free_version`
    * `mo_standard_version`
    * `mo_premium_version`
    * `mo_enterprise_version`

### Automatic
* cd to `build/`
* Run command: `python build.py`
* You will find the zipped plugin in the same folder: `mo_oauth_client_<version>.zip`

### Manually
* Add/Remove the corresponding folder:
    * For `mo_free_version` remove `./classes/Standard`, `./classes/Premium`, `./classes/Enterprise` folders.
    * For `mo_standard_version` add `./classes/Standard` folders.
    * For `mo_premium_version` add `./classes/Standard`, `./classes/Premium` folders.
    * For `mo_enterprise_version` add `./classes/Standard`, `./classes/Premium`, `./classes/Enterprise` folders.

## TODO
* New UI
* Single Login Flow

