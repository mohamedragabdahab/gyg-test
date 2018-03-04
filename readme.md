instructions
==============

 - Install PHP 5.5.9
 - Composer https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx
 - Lumen framework https://lumen.laravel.com/docs/5.6#installation 


Justifications
========
- I have used Lumen Framework, as it is a light weight version of Laravel, which i believe is it suitable for such small task, that could be extended in the future if needed, and to benefit from its built in components 
such as Command line, Validators, Service Container, etc.
- I have used guzzlehttp, i could use cURL, or even file_get_contents(), but  the reasons by using guzzlehttp i can use any http handler method such as 
cURL(default), PHP's stream wrapper, sockets etc.
- Used composer to install dependencies.
- Used exception for handling errors.


What next? (TODOs)
===========

- Unit testing 
- Validate Response Values
- cover Edge Case such as retry API call, in case server not responding 
- Logging Exception, and use Application performance moniroing i.e new relic
- Error message Internationalization
- Create Object Responsible for Response output, to support different formats (json, array, html, etc...)
 