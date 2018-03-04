instructions
==============

 - Install PHP 5.5.9
 - Composer https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx
 - Lumen framework https://lumen.laravel.com/docs/5.6#installation 
##Example
###Request
```
php artisan product:list http://www.mocky.io/v2/58ff37f2110000070cf5ff16 2017-11-20T09:30 2017-11-23T19:30 3
```
### Response 

```
[  
   {  
      "product_id":782,
      "available_starttimes":[  
         "2017-11-21T22:45"
      ]
   },
   {  
      "product_id":664,
      "available_starttimes":[  
         "2017-11-23T14:30"
      ]
   },
   {  
      "product_id":1005,
      "available_starttimes":[  
         "2017-11-23T12:00"
      ]
   },
   {  
      "product_id":925,
      "available_starttimes":[  
         "2017-11-22T15:00"
      ]
   },
   {  
      "product_id":177,
      "available_starttimes":[  
         "2017-11-23T12:15"
      ]
   },
   {  
      "product_id":154,
      "available_starttimes":[  
         "2017-11-22T08:00"
      ]
   },
   {  
      "product_id":326,
      "available_starttimes":[  
         "2017-11-23T08:00"
      ]
   },
   {  
      "product_id":720,
      "available_starttimes":[  
         "2017-11-23T05:15"
      ]
   },
   {  
      "product_id":215,
      "available_starttimes":[  
         "2017-11-20T20:15"
      ]
   }
]
```

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
 