Hi Roy API
=========

A RESTful API server for saying "Hi Roy"

Have you said "Hi Roy" today? Join the club at [http://hiroy.club](http://hiroy.club)

### Making it work
* Set up Node & NPM
* `git clone` this repo
* `cd` to this
* `npm install` this
* `node app.js` to run this

### Routes
 
* GET `http://localhost:3000/hi`
    Returns "Hi Roy"
* GET `http://localhost:3000/hi/:someone`
    Returns "Hi {someone}" if someone is allowed. Else "Hi Roy"

