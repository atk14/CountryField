CountryField
============

Country select field localized for every single language. It is intended to be used in ATK14 Forms.

It uses https://github.com/umpirsky/country-list as the localized countries list.

It also contains Smarty modifier which displays the country name according to its code ISO.

Installation
------------

Just use the Composer:

    cd path/to/your/atk14/project/
    composer require atk14/country-field dev-master

    ln -s ../../vendor/atk14/country-field/src/app/fields/country_field.php app/fields/country_field.php
    ln -s ../../vendor/atk14/country-field/src/app/helpers/modifier.to_country_name.php app/helpers/modifier.to_country_name.php

Usage
-----

In a form:

    <?php
    // file: app/forms/users/create_new_form.php
    class CreateNewForm extends ApplicationForm {

      function set_up(){
        $this->add_field("name",new CharField(array(
          "label" => _("Your name"),
          "hint" => "John Doe"
        )));

        // other fields...

        $this->add_field("country_code",new CountryField(array(
          "label" => _("Choose your country"),
          "initial" => "CZ"
        )));
      }
    }

In a template:

    {*
     * file: app/views/users/detail.tpl
     *}

     <h1>{t}Your personal data{/t}</h1>

     <h3>{t}Address{/t}</h3>

     {t}Country:{/t} {$user->getCountryCode()|to_country_name}


License
-------

CountryField is free software distributed [under the terms of the MIT license](http://www.opensource.org/licenses/mit-license)
