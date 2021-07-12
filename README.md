CountryField
============

[![Build Status](https://travis-ci.com/atk14/CountryField.svg?branch=master)](https://travis-ci.com/atk14/CountryField)

Country select field localized for every single language. It is intended to be used in ATK14 Forms.

It uses https://github.com/umpirsky/country-list as the localized countries list.

It also contains Smarty modifier which displays the country name according to its code ISO.

Basic usage
-----------

In a form:

    <?php
    // file: app/forms/users/create_new_form.php
    class CreateNewForm extends ApplicationForm {

      function set_up(){
        $this->add_field("name", new CharField([
          "label" => "Your name",
          "hint" => "John Doe"
        ]));

        // other fields...

        $this->add_field("country_code", new CountryField([
          "label" => "Choose your country",
          "initial" => "CZ"
        ]));
      }
    }

In a template:

    {*
     * file: app/views/users/detail.tpl
     *}

     <h1>{t}Your personal data{/t}</h1>

     <h3>{t}Address{/t}</h3>

     {t}Country:{/t} {$user->getCountryCode()|to_country_name}

Special cases
-------------

It's possible to define a limited set of countries.

    $this->add_field("country_code", new CountryField([
      "label" => "Choose your favourite V4 country",
      "allowed_countries" => ["CZ","SK","PL","HU"]
    ]));


Installation
------------

Just use the Composer:

    cd path/to/your/atk14/project/
    composer require atk14/country-field

    ln -s ../../vendor/atk14/country-field/src/app/fields/country_field.php app/fields/country_field.php
    ln -s ../../vendor/atk14/country-field/src/app/helpers/modifier.to_country_name.php app/helpers/modifier.to_country_name.php

License
-------

CountryField is free software distributed [under the terms of the MIT license](http://www.opensource.org/licenses/mit-license)
