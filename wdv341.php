<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!--
            Author: Nathaniel Han
            Date: January 19 2023
        -->
        <meta http-equiv="X-UA-Compatible" content ="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nathaniel's WDV341 Homework Page</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost&family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">     
        <style>
            html, body {
                margin: 0;
                height: 100%;
            }
            .body-bg {
                position: absolute;
                width: 100%;
                height: 100%;
                z-index: -9999;
                background: url("/img/bubbles.png");
                opacity: 0.1;
                background-position: 20% 0;
                background-repeat: no-repeat;
            }

            h1, h2, h3, h4, h5, h6 {
                font-family: 'Libre Baskerville', serif;
                margin: 0;
            }
            
            nav, main {
                padding: 0 20px;
            }
            nav {
                display: flex;
                justify-content: space-between;
                height: 80px;
                line-height: 80px;
                background:#EC8413;
            }
            nav .site-logo {
                height: 80px;
                fill: white;
                stroke: white;
                color: white;
            }
            nav a {
                color: white;
                font-family: 'Jost', sans-serif;
                text-decoration: none;
            }
            
            main {
                margin-top: 2em;
            }

            @media (min-width: 1280px) {
                nav, main {
                    padding: 0 200px;
                }
            }
        </style>
    </head>
    <body>
        <div class="body-bg"></div>
		<nav>
            <div>
                <a href="/">
                        <object class="site-logo" type="image/svg+xml" data="/img/ngh-logo-white.svg"></object>
                </a>
            </div>
            <div>
			    <a href="/">&lt; Back to Home</a>
            </div>
        </nav>
        <main>
            <h1>WDV 341 Homework Links</h1>
            <h2>Assignments:</h2>
            <ul>
            <li><a href="unit-2/git-terms.html">2-1: Download Git Client & Create a Repository Account (Research and Define Git Terms)</a></li>
            </ul>
        </main>
    </body>
</html>