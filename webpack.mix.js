let mix = require("laravel-mix");

mix.js(["resources/js/updateSelectedUser.js"], "public/js/app.js");

mix.styles(
    [
        "resources/css/app.css",
        "resources/css/auth.css",
        "resources/css/notes.css",
        "resources/css/payments.css",
    ],
    "public/css/all.css"
);
