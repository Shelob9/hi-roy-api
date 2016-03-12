
var appRouter = function(app) {
    app.get("/hi", function(req, res) {
        res.setHeader('hi', 'roy');
        res.setHeader('content-type', 'text/json');
        res.status(200);
        return res.send({message: "Hi Roy"});
    });
};

module.exports = appRouter;
