CountryField
============

Country select field localized for every single language. It is intended to be used in ATK14 Forms.

It uses https://github.com/umpirsky/country-list as the localized countries list.

Installation
------------

Just use the Composer:

    cd path/to/your/atk14/project/
    composer require atk14/country-field dev-master

    ln -s ../../vendor/atk14/country-field/src/app/fields/country_field.php app/fields/country_field.php

Usage in a form
---------------

    <?php
    // file: app/forms/users/create_new_form.php
    class CreateNewForm extends ApplicationForm {

      function set_up(){
        $this->add_field("name",new CharField(array(
          "label" => _("Your name"),
          "hint" => "John Doe"
        )));

        // other fields...

        $this->add_field("country",new CountryField(array(
          "label" => _("Choose your country"),
          "initial" => "CZ"
        )));
      }
    }



License
-------

CountryField is free software distributed [under the terms of the MIT license](http://www.opensource.org/licenses/mit-license)
