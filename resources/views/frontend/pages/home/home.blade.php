<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ frontend_assets("logo.ico") }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ frontend_assets("bootstrap.min.css") }}">
    <!-- FontAwsome -->
    <link rel="stylesheet" href="{{ frontend_assets("all.css") }}">
    <!-- MyStyle -->
    <link rel="stylesheet" href="{{ frontend_assets("app.css") }}">

    <title>Home - Rebooting</title>
</head>
<body class="home-page">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="img/logo.svg" alt="rebooting logo">
        </a><!-- ./brand -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active"><a class="nav-link" href="index2.html"> Home </a></li>
                <li class="nav-item"><a class="nav-link" href="index2.html#task_manager"> Tasks Manager</a></li>
                <li class="nav-item"><a class="nav-link" href="index2.html#challenge"> Challenges</a></li>
                <li class="nav-item"><a class="nav-link" href="posts.html"> Posts</a></li>
                <li class="nav-item"><a class="nav-link" href="#"> About Us</a></li> <!-- modal  -->
                <li class="nav-item"><a class="nav-link" href="#"> Contact US </a></li><!-- modal  -->

            </ul> <!-- ./ menu -->

            <button class="btn btn-danger btn-help">Help</button>

            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="user-dropdown" src="img/user-profile.jpg"> mabdulmonem
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="profile.html">Profile</a>
                    <a class="dropdown-item" href="posts.html">Favorites</a>
                    <a class="dropdown-item" href="#">Pornography Test</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.html">Logout</a>
                </div>
            </div>
            <!-- if user auth -->
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="notification" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell"></i><span>10</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="notification">
                    <a href="" class="dropdown-item">
                        <div class="notify-icon"><i class="fas fa-newspaper"></i></div>
                        <div class="notify-details">
                            <h4 class="notify-title">new post</h4>
                            <p>Why We Don't need management to fight</p>
                        </div>
                        <div class="notify-date">
                            <i class="fas fa-clock"></i> Nov 19, 2019
                        </div>
                        <div></div>
                    </a>

                </div>
            </div>

        </div> <!-- ./collapse -->
    </div>
</nav><!-- ./nav -->

<div class="wrapper home">

    <div class="content">
        <div class="container">
            <div class="counter">
                <div class="col-7">
                    <div class="card">
                        <div class="collapse-controls">
                            <a class="btn btn-collapse" data-toggle="collapse" data-target="#currentStreak" aria-expanded="true" aria-controls="currentStreak" id="headingOne">Current Streak</a>
                            <a class="btn btn-collapse" data-toggle="collapse" data-target="#bestStreak" aria-expanded="true" aria-controls="bestStreak" id="headingTwo">Best Streak</a>
                            <a href="" class="btn btn-collapse">Longest Streak </a>
                        </div><!-- ./collapse-controls -->
                        <div class="collapse-content">
                            <div class="collapse show" id="currentStreak" aria-labelledby="headingOne">
                                <div class="display-flex">
                                    <div class="col-4">
                                        <div class="counter-days">
                                            <div class="left-side half-circle"></div>
                                            <div class="right-side half-circle"></div>
                                            <div class="counter-content">
                                                <h4 class="text-white">10 <small>days</small></h4>
                                                <p>80 stayed</p>
                                            </div><!-- ./counter-content -->
                                        </div><!-- ./counter-days -->
                                        <div class="shadow"></div>
                                    </div><!-- ./col-4 -->
                                    <div class="col-8">
                                        <div class="details">
                                            <h3>What’s this?</h3>
                                            <p>
                                                lorem
                                            </p>
                                        </div><!-- ./details -->
                                        <div class="controls">
                                            <button class="btn btn-info">Check In</button>
                                            <button class="btn btn-danger">Check In</button>
                                        </div><!-- ./controls -->
                                    </div><!-- ./col-8 -->
                                </div><!-- ./display-flex -->
                            </div><!-- ./collapse ./multi-collapse -->
                            <div class="collapse" id="bestStreak" aria-labelledby="headingTwo">
                                <div class="col-4">
                                    test
                                </div><!-- ./col-4 -->
                                <div class="col-8">

                                </div><!-- ./col-8 -->
                            </div><!-- ./collapse ./multi-collapse -->
                        </div><!-- ./collapse-content -->
                    </div><!-- ./card -->
                </div><!-- col-7 -->
                <div class="col-5">
                    <div class="card set-back-history">
                        <h5 class="head">Set Back History</h5>
                        <ol class="card-content">
                            <li>
                                <p><span>started at : </span>Nov 19, 2019</p>
                                <p><span>Ended in : </span>Nov 30, 2019</p>
                                <p><span>Durations : </span>15 <span><small>Days</small></span></p>
                            </li>
                        </ol><!-- ./card-content -->
                    </div><!-- ./card -->
                </div><!-- col-5 -->
            </div><!-- ./counter -->
            <div class="quotes">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-head">Today’s Quote</div><!-- ./card-head -->
                        <div class=" text-center">
                            Genius is one percent inspiration and ninety-nine percent perspiration. - <span class="text-primary"> Thomas Edison</span>
                        </div><!-- ./card-content -->
                    </div><!-- ./card -->
                </div><!-- ./col-12 -->
            </div><!-- ./quotes  -->
            <div class="tasks">
                <div class="col-6">
                    <div class="card ">
                        <div class="head">Today’s Tasks</div><!-- ./head -->
                        <ul class="card-content">
                            <li>
                                <label class="checkbox">
                                    <input type="checkbox">
                                    <span>Remember Me? <small>At : NOV 19, 2019</small></span>
                                </label>
                                <i class="fas fa-pen float-right"></i>
                            </li>
                            <li>
                                <label class="checkbox">
                                    <input type="checkbox">
                                    <span>Remember Me? <small>At : NOV 19, 2019</small></span>
                                </label>
                                <i class="fas fa-pen float-right"></i>
                            </li>
                            <li>
                                <label class="checkbox">
                                    <input type="checkbox">
                                    <span>Remember Me? <small>At : NOV 19, 2019</small></span>
                                </label>
                                <i class="fas fa-pen float-right"></i>
                            </li>
                            <li>
                                <label class="checkbox">
                                    <input type="checkbox">
                                    <span>Remember Me? <small>At : NOV 19, 2019</small></span>
                                </label>
                                <i class="fas fa-pen float-right"></i>
                            </li>
                        </ul><!-- ./card-content -->
                    </div><!-- ./card -->
                </div><!-- ./col-6 -->
                <div class="col-6">
                    <div class="card ">
                        <div class="head">All Tasks</div><!-- ./head -->
                        <ul class="card-content">
                            <li>
                                <label class="checkbox">
                                    <input type="checkbox">
                                    <span>Remember Me? <small>At : NOV 19, 2019</small></span>
                                </label>
                                <i class="fas fa-pen float-right"></i>
                            </li>
                            <li>
                                <label class="checkbox">
                                    <input type="checkbox">
                                    <span>Remember Me? <small>At : NOV 19, 2019</small></span>
                                </label>
                                <i class="fas fa-pen float-right"></i>
                            </li>
                            <li>
                                <label class="checkbox">
                                    <input type="checkbox">
                                    <span>Remember Me? <small>At : NOV 19, 2019</small></span>
                                </label>
                                <i class="fas fa-pen float-right"></i>
                            </li>
                            <li>
                                <label class="checkbox">
                                    <input type="checkbox">
                                    <span>Remember Me? <small>At : NOV 19, 2019</small></span>
                                </label>
                                <i class="fas fa-pen float-right"></i>
                            </li>
                        </ul><!-- ./card-content -->
                    </div><!-- ./card -->
                </div><!-- ./col-6 -->

            </div><!-- ./tasks  -->
            <div class="challenge">
                <div class="col-7">
                    <div class="card">
                        <div class="collapse-controls">
                            <a class="btn btn-collapse" data-toggle="collapse" data-target="#currentChallenge" aria-expanded="true" aria-controls="currentStreak" >Current Challenge</a>
                            <a class="btn btn-collapse" data-toggle="collapse" data-target="#longestChallenge" aria-expanded="true" aria-controls="bestStreak" >Longest Duration</a>
                        </div><!-- ./collapse-controls -->
                        <div class="collapse-content">
                            <div class="collapse show" id="currentChallenge" aria-labelledby="headingOne">
                                <p>Current Challenge - <small class="text-primary">3 Days</small></p>
                                <div class="timer text-center">
                                    <div class="time-entry days text-primary">
                                        <span>2</span>
                                        Days
                                    </div>
                                    <div class="time-entry hour">
                                        <span>12</span>
                                        Hour
                                    </div>
                                    <div class="time-entry min">
                                        <span>11</span>
                                        Minutes
                                    </div>
                                    <div class="time-entry sec">
                                        <span>00</span>
                                        Seconds
                                    </div>
                                </div>
                                <div class="btn btn-info">New Challenge</div>
                                <div class="btn btn-primary">Custom Duration</div>
                            </div><!-- ./collapse ./multi-collapse -->
                            <div class="collapse" id="longestChallenge" aria-labelledby="headingTwo">
                                <div class="col-4">
                                    test
                                </div><!-- ./col-4 -->
                                <div class="col-8">

                                </div><!-- ./col-8 -->
                            </div><!-- ./collapse ./multi-collapse -->
                        </div><!-- ./collapse-content -->
                    </div><!-- ./card -->
                </div><!-- col-7 -->
                <div class="col-5">
                    <div class="card set-back-history">
                        <h5 class="head">Challenge History</h5>
                        <ol class="card-content">
                            <li>
                                <p><span>started at : </span>Nov 19, 2019</p>
                                <p><span>Ended in : </span>Nov 30, 2019</p>
                                <p><span>Durations : </span>15 <span><small>Days</small></span></p>
                            </li>
                        </ol><!-- ./card-content -->
                    </div><!-- ./card -->
                </div><!-- col-5 -->
            </div><!-- ./challenge -->
        </div><!-- ./container -->
    </div><!-- ./content -->

    <div class="footer">
        <div class="content">
            <div class="container">
                <div class="col-4">
                    <img src="img/logo.svg" alt="" class="logo">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua. Id eu nisl nunc mi.A iaculis at erat
                        pellentesque adipiscing commodo elit at.Est velit egestas
                        dui id ornare arcu odio ut. Placerat vestibulum
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore.
                    </p>
                </div><!-- ./col-4 -->
                <div class="col-4">
                    <h2 class="head">Site Map</h2>
                    <ul class="site-map">
                        <li class="active"><a class="nav-link" href="#"> Home </a></li>
                        <li class=""><a class="nav-link" href="#"> Services</a></li>
                        <li class=""><a class="nav-link" href="#"> Posts</a></li>
                        <li class=""><a class="nav-link" href="#"> About Us</a></li>
                        <li class=""><a class="nav-link" href="#"> Contact US </a></li>
                    </ul>
                </div><!-- ./col-4 -->
                <div class="col-4">
                    <h2 class="head">Available On</h2>
                    <img src="img/google.svg" alt="">
                    <img src="img/apple.svg" alt="">
                </div><!-- ./col-4 -->
            </div><!-- ./container -->
        </div>
        <div class="copyright text-center">
            &copy; 2019-2020 site-name,INC
        </div>
    </div>
</div><!-- ./wrapper -->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ frontend_assets("jquery-3.4.1.min.js") }}"></script>
<script src="{{ frontend_assets("bootstrap.bundle.min.js") }}"></script>
<!-- jQUERY, touch Slider plugin -->
<script src="{{ frontend_assets("jquery.touchSlider.js") }}"></script>
<!-- MyScript -->
<script src="{{ frontend_assets("abuabdo.js") }}"></script>
<script src="{{ frontend_assets("app.js") }}"></script>

</body>
</html>
