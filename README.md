# Getting started

Validator class in object oriented PHP based on https://github.com/Wixel/GUMP

###### Install with composer

Add the following to your composer.json file:

```json
{
    "require": {
        "accexs/validator": "dev-master"
    }
}
```
Then open your terminal in your project directory and run:

`composer install`

or just do:

`composer require accexs/validator`

# Example

```php

require_once('vendor/autoload.php');

$validator = new Accexs\Validator;

$valid = $validator->validation_rules(array(
	'username'    => 'required|alpha_num|max_len,100|min_len,6',
	'password'    => 'required|max_len,100|min_len,6',
	'email'       => 'required|email',
	'gender'      => 'required|exact_len,1|contains,m f',
	'credit_card' => 'required|creditcard'
));

print_r($valid);

```


Available Validators
--------------------
* required `Ensures the specified key value exists and is not empty`
* email `Checks for a valid email address`
* maxlen:n `Checks key value length, makes sure it's not longer than the specified length. n = length parameter.`
* minlen,n `Checks key value length, makes sure it's not shorter than the specified length. n = length parameter.`
* exact_len:n (TODO) `Ensures that the key value length precisely matches the specified length. n = length parameter.`
* alpha `Ensure only alpha characters are present in the key value (a-z, A-Z)`
* alpha_num `Ensure only alpha-numeric characters are present in the key value (a-z, A-Z, 0-9)`
* alpha_dash `Ensure only alpha-numeric characters + dashes and underscores are present in the key value (a-z, A-Z, 0-9, _-)`
* alpha_space (TODO) `Ensure only alpha-numeric characters + spaces are present in the key value (a-z, A-Z, 0-9, \s)`
* numeric `Ensure only numeric key values`
* integer `Ensure only integer key values`
* boolean `Checks for PHP accepted boolean values, returns TRUE for "1", "true", "on" and "yes"`
* float `Checks for float values`
* url `Check for valid URL or subdomain`
* ip `Check for valid generic IP address`
* ipv4 `Check for valid IPv4 address`
* ipv6 `Check for valid IPv6 address`
* creditcard `Check for a valid credit card number (Uses the MOD10 Checksum Algorithm)`
* contains:n (TODO) `Verify that a value is contained within the pre-defined value set`
* contains_list:n (TODO) `Verify that a value is contained within the pre-defined value set. The list of valid values must be provided in semicolon-separated list format (like so: value1;value2;value3;..;valuen). If a validation error occurs, the list of valid values is not revelead (this means, the error will just say the input is invalid, but it won't reveal the valid set to the user.`
* doesnt_contain_list:n (TODO) `Verify that a value is not contained within the pre-defined value set. Semicolon (;) separated, list not outputted. See the rule above for more info.`
* min_numeric (TODO) `Determine if the provided numeric value is higher or equal to a specific value`
* max_numeric (TODO) `Determine if the provided numeric value is lower or equal to a specific value`
* date `Determine if the provided input is a valid date (ISO 8601)`
* starts `Ensures the value starts with a certain character / set of character`
* phone_number `Validate phone numbers that match the following examples: 555-555-5555 , 5555425555, 555 555 5555, 1(519) 555-4444, 1 (519) 555-4422, 1-555-555-5555`
* regex `You can pass a custom regex using the following format: 'regex,/your-regex/'`
* json `validate string to check if it's a valid json format`

#  Creating your own validators

Adding custom validators and filters is made easy by using callback functions.

```php
require("gump.class.php");

/*
   Create a custom validation rule named "is_object".
   The callback receives 3 arguments:
   The field to validate, the values being validated, and any parameters used in the validation rule.
   It should return a boolean value indicating whether the value is valid.
*/
GUMP::add_validator("is_object", function($field, $input, $param = NULL) {
    return is_object($input[$field]);
});

/*
   Create a custom filter named "upper".
   The callback function receives two arguments:
   The value to filter, and any parameters used in the filter rule. It should returned the filtered value.
*/
GUMP::add_filter("upper", function($value, $params = NULL) {
    return strtoupper($value);
});

```

# Set Custom Field Names

You can easily override your form field names for improved readability in errors using the `GUMP::set_field_name($field, $readable_name)` method as follows:

```php
$data = array(
	'str' => null
);

$rules = array(
	'str' => 'required'
);

GUMP::set_field_name("str", "Street");

$validated = GUMP::is_valid($data, $rules);

if($validated === true) {
	echo "Valid Street Address\n";
} else {
	print_r($validated);
}
```
