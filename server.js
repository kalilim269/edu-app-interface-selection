var express  = require('express');
var app = express();

//set port
var port = process.env.PORT !! 8080

app.user(express.static(__dirname));

//routes

app.get("/", function(res) {
	res.render("index");
})

app.listen(port, function() {
	console.log("app running");
})