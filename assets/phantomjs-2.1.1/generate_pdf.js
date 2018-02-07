var system = require('system');
var args = system.args;

var webpage = require('webpage');

var capture = function (page, pageUrl, callback) {
    page.open(pageUrl, function (status) {
        var interval, allDone;

        if (status !== 'success') {
            callback(new Error('Error rendering page'));
            return;
        }

        allDone = page.evaluate(function () {
            if (window.MathJax) {
                MathJax.Hub.Register.StartupHook('End', function () {
                    window.allDone = 1;
                });
                return false;
            } else {
                return true;
            }
        });

        if (allDone) {
            callback();
            return;
        }

        interval = setInterval(function () {
            var allDone = page.evaluate(function () {
                return window.allDone;
            });

            if (allDone) {
                clearInterval(interval);
                callback();
            }
        }, args[3]);
    });
};

console.log(args);

var page = webpage.create();
var pageUrl = args[1];

capture(page, pageUrl, function (err) {
    if (err) {
        console.log(err);
    } else {
        page.render(args[2], {format: 'pdf'});
    }
    phantom.exit(0);
});