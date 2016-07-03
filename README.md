Hi Roy API
=========

A RESTful API server for saying "Hi Roy"

Have you said "Hi Roy" today? Join the club at [https://hiroy.club](https://hiroy.club).

Access the production API at [https://api.hiroy.club](https://api.hiroy.club).

## Making it work
* `git clone` this repo
* Place the code on a localhost environment or server.

## Routes
* GET `http://localhost/hi`
    Returns "Hi Roy"
* GET `http://localhost/hi/{someone}`
    Returns "Hi {someone}" if name is valid. Else "Hi Roy"
* GET `http://localhost/audio`, `http://localhost/audio/hi`
	Since Roy is the only person we are currently greeting, returns random "Hi Roy" audio message
	Add "?from={name}" to return "Hi Roy" audio message from specific person
* GET `http://localhost/audio/hi/roy`
	Returns random "Hi Roy" audio message
	Add "?from={name}" to return "Hi Roy" audio message from specific person