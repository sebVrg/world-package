# Introduction

https://github.com/sebVrg/world-package

- WHAT'S AN API ?

 An API is composed of functions, methods allowing one or several applications to take advantage of their functionalities.
 More simply, a programming interface is a structure that allows a client program to function and possibly generate information such as the api google map.

# Inspiration

 - WHY DOING API ?
 
The main advantage of developing programming interfaces is to automate and optimize client functionalities, thus enabling rapid and smooth deployment.
Depending on its degree of elaboration, the programming interface or structural core, it promotes great portability of the third-party applications it can offer and all the qualities sought on the web and web services: separation of tasks, simplicity and Interportability.

# Description

{
    "distribuable": true,
    "type": "library",
    "testable": true,
    "name": "movepopup",
    "package": "sebvrg\/move-popup",
    "homepage": "",
    "keywords": [],
    "license": "MIT",
    "author": "sebvrg",
    "version": [
        "0.0.1"
    ],
    "langage": "js",
    "devDependencies": [],
    "dependencies": [],
    "use": {
        "mocha": "3.2.0",
        "chai": "3.5.0",
        "jsdom": "9.12.0"
    },
    "description": "popup component."
}

The interest of the programming interface presented here is to recover by repository, descriptions of codes available via diferentes sources such as NPM, Packagist or even Travis whose answer is available in Json format.

# Tech

The REST or Representational State Transfer architecture is highlighted using the original HTTP protocol specifications.
Also 5 major rules must be followed in order to implement a REST type architecture:

- Rule N° 1: the URL as a resource identifier 
Based on the Uniform Resource Identifier (URI) in order to identify a resource, an application must build its URIs precisely, taking REST constraints into account.
> for example where "sebVrg" is the author and "world-package" is the source we will have: 
**https://github.com/sebVrg/world-package**


- Rule N° 2: HTTP verbs as an operations identifier
The possible actions using the http protocol are as follows:
    create => POST
    read => GET
    update => PUT
    delete => DELETE  (Even if in this api we do not want 
to give the possibility to the user to be able to directly 
erase its resources.)

- Rule N° 3: HTTP Responses as Representing Resources
 It is important to bear in mind that the reply sent is not a resource,
 it is the representation of a resource.
(Here the resources are consumed in json format.)

- Rule N° 4: Links as a Relationship Between Resources
Links from one resource to another all have one thing in common:
they indicate the presence of a relationship.

- Rule N° 5: A parameter as an authentication token
The authentication of the query is based on sending a token passed as a get parameter.

To summarize, the three strengths of the rest architecture are:
- Bandwidth and limited resources
        => The return structure can be of any format
        =>Any browser can be used since the REST approach uses the standard methods
          GET, PUT, POST and DELETE
        => REST can also use the XMLHttpRequest object that most modern browsers 
            support today, which adds an additional bonus to AJAX.

- stateless
        => If you just need CRUD stateless operation (Create, Read, Update and Delete),
            then REST is the solution.

- Caching
        => If the information can be cached the absence of state of the REST approach is perfect.







# Installation

Clone this repository

```sh
$ git clone https://github.com/sebVrg/world-package
```

#Run

Run with phpunit after install dependencies

```sh
$ composer update
```

```sh
$ phpunti
```

License
----

MIT

















 

