Hi Roy API
=========

A RESTful API server for saying "Hi Roy"

Have you said "Hi Roy" today? Join the club at [https://hiroy.club](https://hiroy.club).

## Making it work
* `git clone` this repo
* Place the code on a localhost environment or server.

## Routes
* GET `http://localhost/hi`
    Returns "Hi Roy"
* GET `http://localhost/hi/{someone}`
    Returns "Hi {someone}" if name is valid. Else "Hi Roy"

