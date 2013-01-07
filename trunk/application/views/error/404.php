<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Error 404 - Not Found</title>
	<meta name="viewport" content="width=device-width">
	<style type="text/css">
		@import url(http://fonts.googleapis.com/css?family=Droid+Sans);

		article, aside, details, figcaption, figure, footer, header, hgroup, nav, section { display: block; }
		audio, canvas, video { display: inline-block; *display: inline; *zoom: 1; }
		audio:not([controls]) { display: none; }
		[hidden] { display: none; }
		html { font-size: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
		html, button, input, select, textarea { font-family: sans-serif; color: #222; }
		body { margin: 0; font-size: 1em; line-height: 1.4; }
		::-moz-selection { background: #E37B52; color: #fff; text-shadow: none; }
		::selection { background: #E37B52; color: #fff; text-shadow: none; }
		a { color: #00e; }
		a:visited { color: #551a8b; }
		a:hover { color: #06e; }
		a:focus { outline: thin dotted; }
		a:hover, a:active { outline: 0; }
		abbr[title] { border-bottom: 1px dotted; }
		b, strong { font-weight: bold; }
		blockquote { margin: 1em 40px; }
		dfn { font-style: italic; }
		hr { display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0; }
		ins { background: #ff9; color: #000; text-decoration: none; }
		mark { background: #ff0; color: #000; font-style: italic; font-weight: bold; }
		pre, code, kbd, samp { font-family: monospace, serif; _font-family: 'courier new', monospace; font-size: 1em; }
		pre { white-space: pre; white-space: pre-wrap; word-wrap: break-word; }
		q { quotes: none; }
		q:before, q:after { content: ""; content: none; }
		small { font-size: 85%; }
		sub, sup { font-size: 75%; line-height: 0; position: relative; vertical-align: baseline; }
		sup { top: -0.5em; }
		sub { bottom: -0.25em; }
		ul, ol { margin: 1em 0; padding: 0 0 0 40px; }
		dd { margin: 0 0 0 40px; }
		nav ul, nav ol { list-style: none; list-style-image: none; margin: 0; padding: 0; }
		img { border: 0; -ms-interpolation-mode: bicubic; vertical-align: middle; }
		svg:not(:root) { overflow: hidden; }
		figure { margin: 0; }
		form { margin: 0; }
		fieldset { border: 0; margin: 0; padding: 0; }
		label { cursor: pointer; }
		legend { border: 0; *margin-left: -7px; padding: 0; white-space: normal; }
		button, input, select, textarea { font-size: 100%; margin: 0; vertical-align: baseline; *vertical-align: middle; }
		button, input { line-height: normal; }
		button, input[type="button"], input[type="reset"], input[type="submit"] { cursor: pointer; -webkit-appearance: button; *overflow: visible; }
		button[disabled], input[disabled] { cursor: default; }
		input[type="checkbox"], input[type="radio"] { box-sizing: border-box; padding: 0; *width: 13px; *height: 13px; }
		input[type="search"] { -webkit-appearance: textfield; -moz-box-sizing: content-box; -webkit-box-sizing: content-box; box-sizing: content-box; }
		input[type="search"]::-webkit-search-decoration, input[type="search"]::-webkit-search-cancel-button { -webkit-appearance: none; }
		button::-moz-focus-inner, input::-moz-focus-inner { border: 0; padding: 0; }
		textarea { overflow: auto; vertical-align: top; resize: vertical; }
		input:valid, textarea:valid {  }
		input:invalid, textarea:invalid { background-color: #f0dddd; }
		table { border-collapse: collapse; border-spacing: 0; }
		td { vertical-align: top; }

		body
		{
			font-family:'Droid Sans', sans-serif;
			font-size:10pt;
			color:#FFFFFF;
			line-height: 25px;
		}
                
                .h1 {   
                    font-size: 70px;
                    left: 470px;
                    position: relative;
                    top: -30px;
                    width: 300px;
                }
                
                .h2 {   
                    font-size: 50px;
                    left: 30px;
                    position: relative;
                    top: -100px;
                    width: 500px;
                }
                
                .mean {   
                   left: 550px;
                    position: relative;
                    top: -150px;
                    width: 400px;
                }
                
                .mean .h3 {  
                    font-size: 40px;
                    
                }
                #message { 
                    font-size: 26px;
                    left: 460px;
                    position: relative;
                    top: 130px;
                    width: 300px;
                }
		.wrapper
		{
			/*width: 760px;
			margin:0 auto 5em auto;*/
		}

		.main
		{
			overflow:hidden;
		}

		.error-spacer
		{
			height:4em;
		}

		a, a:visited
		{
			color:#2972A3;
		}

		a:hover
		{
			color:#72ADD4;
		}
	</style>
</head>
<body>
        <?php echo render('partial.head'); ?>
	<div class="wrapper">
		<div class="error-spacer"></div>
		<div role="main" class="main">
			<?php $messages = array('Bravo !', 'GG !', 'Whooh !'); ?>
                        <div id="message">Vous avez tout cassé !!</div>

			<h1 class="h1"><?php echo $messages[mt_rand(0, 2)]; ?></h1>
                        <br><br><br>
			<h2 class="h2">Server Error <br><br>404 (Not Found)</h2>

			<br>
                        <div class="mean">
                            <h3 class="h3">Ca veut dire quoi?</h3>

                            <p>
                                Nous n'avons pas pu trouver la page que vous recherchez sur le serveur et nous en sommes désolés.
                              
                            </p>

                            <p>
                                    Peut-être désirez-vous maintenant aller sur notre<?php echo HTML::link('/', 'page d\'accueil'); ?>?
                            </p>
                        </div>
		</div>
	</div>
    <?php echo render('partial.foot'); ?>
</body>
</html>