# LSM Front-End
This repository represents the front-end website for Lakeshore Market, a RESTful Java API application for COMP433/388.  

## Components
* This website is built using PHP.  
* This website's HTML and design relies on the [1 Col Portfolio](http://startbootstrap.com/template-overviews/1-col-portfolio/) Bootstrap Template (included readme attached below).   
* This site uses cURL to send requests to the Java API.  
* This site uses the [PHP Curl Class](https://github.com/php-curl-class/php-curl-class/) wrapper for ease of sending API requests.  
* The site utilizes the composite design pattern. I have built a wrapper designed for LSM specifically which wraps the PHP Curl Class using the composite design pattern.  
* This program also relies on Javascript and the jQuery API.  

## Debug mode
* Debug mode can be enabled by a flip of a boolean in the config file. Enabling debug mode will automatically dump the curl requests into a scrollable, preformatted tag.  

## Structure
* URL rewriting works for up to 4 parameters, a 5th optional parameter q used to identify a query's resource ID, and any additional QSA as well.  
* eg: http://162.243.94.35/parameter1/parameter2/parameter3/parameter4/q/ID?entry=base64-url-encoded-entry  
* ex: http://162.243.94.35/customer/detail/q/1 would retrive the customer detail page for customer ID 1, if specifying entry as well, the API call with use the specified entry value instead of default value.  
* Entry value is supplied from HATEOAS link in previous call, and is then base64 and URL encoded and attached as QSA key/value entry to call-to-action.
* Index.php is the root file, using URL rewriting to call the appropriate template. The config file is first loaded, though, and the config file stores all site settings and loads site dependencies.  


# [Start Bootstrap](http://startbootstrap.com/) - [1 Col Portfolio](http://startbootstrap.com/template-overviews/1-col-portfolio/)

[1 Col Portfolio](http://startbootstrap.com/template-overviews/1-col-portfolio/) is a one column portfolio template for [Bootstrap](http://getbootstrap.com/) created by [Start Bootstrap](http://startbootstrap.com/).

## Getting Started

To use this template, choose one of the following options to get started:
* Download the latest release on Start Bootstrap
* Fork this repository on GitHub

## Bugs and Issues

Have a bug or an issue with this template? [Open a new issue](https://github.com/IronSummitMedia/startbootstrap-1-col-portfolio/issues) here on GitHub or leave a comment on the [template overview page at Start Bootstrap](http://startbootstrap.com/template-overviews/1-col-portfolio/).

## Creator

Start Bootstrap was created by and is maintained by **David Miller**, Managing Parter at [Iron Summit Media Strategies](http://www.ironsummitmedia.com/).

* https://twitter.com/davidmillerskt
* https://github.com/davidtmiller

Start Bootstrap is based on the [Bootstrap](http://getbootstrap.com/) framework created by [Mark Otto](https://twitter.com/mdo) and [Jacob Thorton](https://twitter.com/fat).

## Copyright and License

Copyright 2013-2015 Iron Summit Media Strategies, LLC. Code released under the [Apache 2.0](https://github.com/IronSummitMedia/startbootstrap-1-col-portfolio/blob/gh-pages/LICENSE) license.