<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Project RFID</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/primary.png" type="img/png" sizes="16x16">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/animate.css" />
    <link rel="stylesheet" href="js/jquery-toast-plugin-master/dist/jquery.toast.min.css">
    <script src=""></script>
</head>
<body>
    <div class="container">
        <div class="splitlayout" id="splitlayout">
            <div class="intro">
                <div class="side side-left">
                   
                    <ul class="cb-slideshow">
                        <li><span>Image 01</span><div><h3></h3></div></li>
                        <li><span>Image 02</span><div><h3></h3></div></li>
                        <li><span>Image 03</span><div><h3></h3></div></li>
                        <li><span>Image 04</span><div><h3></h3></div></li>
                        <li><span>Image 05</span><div><h3></h3></div></li>
                        <li><span>Image 06</span><div><h3></h3></div></li>
                    </ul>
                     
                    <div class="intro-content">
                        <div class="profile">
                            <!-- <img src="img/05-21-18.jpg"/> -->
                        </div>
                        <h3>
                            
                        </h3>
                        <h1>
                            <span><strong id="hours"></strong><strong id="point">:</strong><strong id="min"></strong> <strong id="ampm"></strong></span>
                            <span id="date"></span>
                        </h1>
                        <header class="codropsheader clearfix">	
                        <h1 id="num"></h1>
                        <nav>
                            <img src="img/primary.png"/>
                            <img src="img/ccs.png"/>
                        </nav>
                    </header>
                    </div>
                    <div class="overlay"></div>
                </div>
                <div class="side side-right">
                    <div class="list-content">
                        <ul class="list-content">
                            <!--student list -->
                            <svg width="400" height="200" viewBox="0 0 400 200">
                                <defs>
                                    <filter id="goo">
                                        <feGaussianBlur in="SourceGraphic" stdDeviation="7" result="blur" />
                                        <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 17 -7" result="cm" />
                                        <feComposite in="SourceGraphic" in2="cm">
                                    </filter>
                                    <filter id="f2" x="-200%" y="-40%" width="400%" height="200%">
                                        <feOffset in="SourceAlpha" dx="9" dy="3" />
                                        <feGaussianBlur result="blurOut" in="offOut" stdDeviation="0.51" />
                                        <feComponentTransfer>
                                            <feFuncA type="linear" slope="0.05" />
                                        </feComponentTransfer>
                                        <feMerge>
                                            <feMergeNode/>
                                            <feMergeNode in="SourceGraphic" />
                                        </feMerge>
                                    </filter>
                                </defs>
                                <g filter="url(#goo)" style="fill:#607D8B">
                                    <ellipse id="drop" cx="125" cy="90" rx="20" ry="20" fill-opacity="1" fill="#607D8B"/>
                                    <ellipse id="drop2"cx="125" cy="90" rx="20" ry="20" fill-opacity="1" fill="#607D8B"/>
                                </g>
                            </svg>
                            <span class="error">No data found</span>
                        </ul>
                    </div>
                    <div class="txtBox">
                        <form method="post" enctype="multipart/form-data" id="form-student">
                            <input type="text" name="studentNum" placeholder="Enter student number...">
                        </form>
                    </div>
                    <div class="overlay"></div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> -->
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/moment/moment.js"></script>
<script src="js/jquery-toast-plugin-master/dist/jquery.toast.min.js"></script>
<script type="text/javascript" src="js/function.js"></script>
<script src="js/three.min.js"></script>
<script src="js/perlin.js"></script>
<script src="js/TweenMax.min.js"></script>
<script>
	(function() {
		var container = document.getElementById('container');
		var drop = document.getElementById('drop');
		var drop2 = document.getElementById('drop2');
		var outline = document.getElementById('outline');

		TweenMax.set(['svg'], {
			position: 'absolute',
			top: '50%',
			left: '50%',
			xPercent: -50,
			yPercent: -50
		})

		TweenMax.set([container], {
			position: 'absolute',
			top: '50%',
			left: '50%',
			xPercent: -50,
			yPercent: -50
		})

		TweenMax.set(drop, {
			transformOrigin: '50% 50%'
		})

		var tl = new TimelineMax({
			repeat: -1,
			paused: false,
			repeatDelay: 0,
			immediateRender: false
		});

		tl.timeScale(3);

		tl.to(drop, 4, {
			attr: {
				cx: 250,
				rx: '+=10',
				ry: '+=10'
			},
			ease: Back.easeInOut.config(3)
		})
		.to(drop2, 4, {
			attr: {
				cx: 250
			},
			ease: Power1.easeInOut
		}, '-=4')
		.to(drop, 4, {
			attr: {
				cx: 125,
				rx: '-=10',
				ry: '-=10'
			},
			ease: Back.easeInOut.config(3)
		})
		.to(drop2, 4, {
			attr: {
				cx: 125,
				rx: '-=10',
				ry: '-=10'
			},
			ease: Power1.easeInOut
		}, '-=4')
	})()
	</script>
</html>