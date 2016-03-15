
var appRouter = function(app) {
    app.get("/hi", function(req, res) {
        res.setHeader('Content-Type', 'application/json');
        res.setHeader('hi', 'roy');
        res.setHeader('Link', 'http://hiroy.club');
        res.status(200);
        return res.send({message: "Hi Roy"});
    });

    app.get("/hi/:someone", function(req, res) {
        var someone = req.params.someone;
        res.setHeader('someone', someone );
        var people = [
            'roy',
            'rachel',
            'shawn',
            'josh',
            'chris',
            'shelly'
        ];

        var found = false;
        for ( var i = 0; i <= people.length; i++ ){
            if( someone == people[i] ){
                found = true;
                break;
            }
        }
        if( false == found ){
            someone = 'roy';
        }


        someone = someone.charAt(0).toUpperCase() + someone.slice(1);
        var message = "Hi " + someone;

        res.setHeader('Content-Type', 'text/json');
        res.setHeader('hi', 'roy');
        res.setHeader('Link', 'http://hiroy.club');
        res.status(200);
        return res.send({message: message});
    });
};

module.exports = appRouter;
