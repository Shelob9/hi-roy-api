
var appRouter = function(app) {
    app.get("/hi", function(req, res) {
        return res.send({"status": "success", "message": "Hi Roy"});
    });
};

module.exports = appRouter;
