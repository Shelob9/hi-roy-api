var express = require("express");
var bodyParser = require("body-parser");
var app = express();

// Redirect to https, if necessary
app.use(function (req, res, next) {
	if ('https'==req.get('x-forwarded-protocol')) {
		next();
	} else {
		res.redirect('https://' + req.headers.host + req.url);
    }
});

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

var routes = require("./routes/routes.js")(app);

var server = app.listen(9000, function () {
    console.log("Listening on port %s...", server.address().port);
});
