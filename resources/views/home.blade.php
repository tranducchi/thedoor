<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/range.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/fullpage.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
  <script src="js/vendor/modernizr-2.6.2.min.js"></script>
  <!-- full page -->
  <title>Web Marketing</title>
</head>
<div id="fullpage">
  <!-- Header -->
  <div class="section fp-auto-height" id="section0">
    <header id="header">
      <!-- Menu destop -->
      <div class="menu fixed-top" id="menu">
        <div class="container d-flex justify-content-between">
          <div class="logo">
            <a href="/" class="d-flex justify-content-start">
              <div class="thum-logo pr-2">
                <img src="img/logo.png" class="img-fluid" alt="">
              </div>
              <h3 class="d-flex align-items-end pb-2">THE DOOR</h3>
            </a>
          </div>
          <div class="left-menu d-flex justify-content-between">
            <div class="search d-none d-sm-block">
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
              </form>
            </div>
            <div class="lang pr-4 d-flex justify-content-start">
              <a href="#">VI</a>
              <span class="pl-2 pr-2">|</span>
              <a href="#">EN</a>
            </div>
            <div class="menu-button mt-1 d-flex flex-column">
              <span class="btn1"></span>
              <span class="btn2"></span>
            </div>
          </div>
        </div>
      </div>
      <!-- Menu mobile -->

      <!-- End menu -->
      <div id="carouselExampleIndicators" class="carousel slide">
        <ol class="carousel-indicators">
          @for($i=0; $i < $count; $i++) @if($i==0) <li data-target="#carouselExampleIndicators" data-slide-to="0"
            class="active">
            </li>
            @else
            <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>
            @endif
            @endfor
        </ol>
        <div class="carousel-inner">
          <?php $index=1; ?>
          @foreach($slide as $k)
          @if($index==1)
          <div class="carousel-item active">
            <img class="d-block w-100" src="{{asset('storage/img/'.$k->image)}}" alt="First slide">
            <div class="carousel-caption">
              <div class="row">
                <div class="col-12 col-md-7">
                  <div class="content-slide text-left">
                    <h2 class="pb-3">{{$k->title}}</h2>
                    <p>{{$k->describe}}</p>
                    <button class="btn btn-secondary d-none d-sm-block">Read More<i
                        class="fa fa-angle-double-right pl-1" aria-hidden="true"></i></button>
                  </div>
                </div>
              </div>
              <!-- end row -->
            </div>
          </div>
          @else
          <div class="carousel-item">
            <img class="d-block w-100" src="{{asset('storage/img/'.$k->image)}}" alt="First slide">
            <div class="carousel-caption">
              <div class="row">
                <div class="col-12 col-md-7">
                  <div class="content-slide text-left">
                    <h2 class="pb-3">{{$k->title}}</h2>
                    <p>{{$k->describe}}</p>
                    <button class="btn btn-secondary d-none d-sm-block">Read More<i
                        class="fa fa-angle-double-right pl-1" aria-hidden="true"></i></button>
                  </div>
                </div>
              </div>
              <!-- end row -->
            </div>
          </div>
          @endif
          <?php $index++; ?>
          @endforeach
        </div>
      </div>
      <!-- navigate -->
      <div class="scroll-div d-none d-sm-block">
        <div class="scroll-to d-flex justify-content-between">
          <span>HOME</span>
          <div class="group-arrow">
            <a href="#our-story" class="fa fa-long-arrow-right" aria-hidden="true"></a>
          </div>
        </div>
      </div>
      <div class="tab-menu" id="list-menutab">
        <p class="text-center">
        </p>
        <ul>
          <li><a href="">ABOUT</a></li>
          <li><a href="">CONTACT US</a></li>
          <li><a href="">CUSTOMER</a></li>
          <li><a href="">PRODUCT</a></li>
          <li><a href="/login"><i class="fa fa-sign-in pr-2" aria-hidden="true"></i>LOGIN</a></li>
        </ul>
      </div>
      <div class="page-number">
        <img src="img/dot-page.png" alt="">
        Page 1
      </div>
    </header>
  </div>
  <!-- End header -->
  <div class="section fp-auto-height" id="section1">
    <div id="our-story">
      <img class="about-bg" src="img/home-2.png" alt="">
      <div class="container story-content">
        <div class="img-story">
          <img src="img/story-1.jpg" class="img-fluid" alt="">
        </div>
        <p class="mt-5 text-white">
          We are not a traditional ad agency network —we are a radically open creative collective
          The overflow property specifies whether to clip content or to add scrollbars when an element's content is
          too big to fit in a specified
          content or to add scrollbars when an element's content is too big to fit in a specified
        </p>
      </div>
      <!-- navigate -->
      <div class="scroll-div d-none d-sm-block">
        <div class="scroll-to d-flex justify-content-between">
          <span>OUR STORY</span>
          <div class="group-arrow">
            <a href="#header" class="fa fa-long-arrow-left" aria-hidden="true"></a>
            <a href="#human-of-the-door" class="fa fa-long-arrow-right" aria-hidden="true"></a>
          </div>
        </div>
      </div>
      <div class="page-number">
        <img src="img/dot-page.png" alt=""> Page 2
      </div>
    </div>
  </div>
  <!-- human-of-the-door -->
  <div class="section fp-auto-height" id="section2">
    <div id="human-of-the-door">
      <img src="img/p-3.png" alt="" class="about-bg">
      <button type="button" class="btn btn-outline-light btn-send d-none d-sm-block">Meet the team</button>
      <div class="container " id="p3-content">
        <div class="two-carousel owl-carousel">
          <div class="item p3-img"><a href="#"><img src="img/p3-o1.png" alt="" id="p3-img-size" /></a></div>
          <div class="item p3-img"><a href="#"><img src="img/p3-o2.png" alt="" id="p3-img-size" /></a></div>
          <div class="item p3-img"><a href="#"><img src="img/p3-o1.png" alt="" id="p3-img-size" /></a></div>
          <div class="item p3-img"><a href="#"><img src="img/p3-o2.png" alt="" id="p3-img-size" /></a></div>
          <div class="item p3-img"><a href="#"><img src="img/p3-o1.png" alt="" id="p3-img-size" /></a></div>
          <div class="item p3-img"><a href="#"><img src="img/p3-o2.png" alt="" id="p3-img-size" /></a></div>
          <div class="item p3-img"><a href="#"><img src="img/p3-o1.png" alt="" id="p3-img-size" /></a></div>
          <div class="item p3-img"><a href="#"><img src="img/p3-o2.png" alt="" id="p3-img-size" /></a></div>
        </div>
        <p class="p3-content-p d-flex justify-content-center">Drag to see more</p>
      </div>
      <!-- navigate -->
      <div class="scroll-div d-none d-sm-block">
        <div class="scroll-to d-flex justify-content-between">
          <span>HUMAN</span>
          <div class="group-arrow">
            <a href="#our-story" class="fa fa-long-arrow-left" aria-hidden="true"></a>
            <a href="#what" class="fa fa-long-arrow-right" aria-hidden="true"></a>
          </div>
        </div>
      </div>
      <div class="page-number">
        <img src="img/dot-page.png" alt=""> Page 3
      </div>
    </div>
  </div>
  {{-- what --}}
  <div class="section fp-auto-height" id="section3">
    <div id="what">
      <img src="img/home-4.png" alt="" class="about-bg">
      <div class="what-content container">
        <div class="row">
          <div class="col-lg-3">
            <div class="what-left">
              <h3>WHAT ARE WHERE DOING?</h3>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, rerum numquam quas sint quisquam nihil
                vero omnis facilis repellat nobis,.</p>
            </div>
          </div>
          {{-- end col 4 --}}
          <div class="col-lg-9">
            <div class="what-right pl-5">
              <div class="three-owl owl-carousel owl-theme">
                <a href="#" class="item">
                  <div class="brand-box">
                    <img src="{{asset('/img/catalog.png')}}" alt="" class="img-fluid">
                    <div class="info-box text-center">
                      <div class="text-brand">
                        <div class="child-brand">
                          <p class="offset">1</p>
                          <p class="title-brand">BRAND-DESIGIN</p>
                        </div>
                        <div class="bg-brand"></div>
                      </div>
                    </div>
                  </div>
                </a>
                {{-- End item --}}
                <a class="item">
                  <div class="brand-box">
                    <img src="{{asset('/img/catalog.png')}}" alt="" class="img-fluid">
                    <div class="info-box text-center">
                      <div class="text-brand">
                        <div class="child-brand">
                          <p class="offset">1</p>
                          <p class="title-brand">BRAND-DESIGIN</p>
                        </div>
                        <div class="bg-brand"></div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              {{-- <div class="nav-what">
                  <div class="navi-btn mt-5">
                    <i class="fa fa-angle-left customNextBtnOne fa-2x pr-2" aria-hidden="true"></i>
                    <i class="fa fa-angle-right customPrevBtnOne fa-2x pl-2" aria-hidden="true"></i>
                  </div>
                </div> --}}
              {{-- custom button --}}
            </div>
          </div>
          {{-- end col 8 --}}


        </div>
      </div>
      {{-- end content what --}}
      <!-- navigate -->
      <div class="scroll-div d-none d-sm-block">
        <div class="scroll-to d-flex justify-content-between">
          <span>WHAT ARE WE DOING ?</span>
          <div class="group-arrow">
            <a href="#human-of-the-door" class="fa fa-long-arrow-left" aria-hidden="true"></a>
            <a href="#clients" class="fa fa-long-arrow-right" aria-hidden="true"></a>
          </div>
        </div>
      </div>
      <div class="page-number">
        <img src="img/dot-page.png" alt=""> Page 4
      </div>
    </div>
  </div>
  <!-- clients -->
  <div class="section fp-auto-height" id="section4">
    <div id="clients">
      <img src="img/home-6.png" alt="" class="about-bg">
      <div class="content-client">
        <div class="row">
          <div class="col-lg-3">
            <div class="this-spot w-75 text-center">
              <a href="#about-us">THIS SPOT AWAITS YOU</a>
              <div class="navi-btn mt-5">
                <i class="fa fa-angle-left customNextBtn fa-2x pr-2" aria-hidden="true"></i>
                <i class="fa fa-angle-right customPrevBtn fa-2x pl-2" aria-hidden="true"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="show-brand">
              <div class="one-carousel owl-carousel owl-theme" id="owl-client">
                <div class="item">
                  <a href="#" class="div-brand">
                    <div class="img-brand">
                      <img src="{{asset('/img/list-clients/1.png')}}" class="img-fluid" alt="">
                    </div>
                    <p class="title-brand">BIRD</p>
                  </a>
                  <a href="#" class="div-brand">
                    <div class="img-brand">
                      <img src="{{asset('/img/list-clients/1.png')}}" class="img-fluid" alt="">
                    </div>
                    <p class="title-brand">CHICKEN</p>
                  </a>
                </div>
                {{-- item --}}
                <div class="item">
                  <a href="#" class="div-brand">
                    <div class="img-brand">
                      <img src="{{asset('/img/list-clients/1.png')}}" class="img-fluid" alt="">
                    </div>
                    <p class="title-brand">VOID</p>
                  </a>
                  <a href="#" class="div-brand">
                    <div class="img-brand">
                      <img src="{{asset('/img/list-clients/1.png')}}" class="img-fluid" alt="">
                    </div>
                    <p class="title-brand">BIRD</p>
                  </a>
                </div>
                {{-- item --}}
                <div class="item">
                  <a href="#" class="div-brand">
                    <div class="img-brand">
                      <img src="{{asset('/img/list-clients/1.png')}}" class="img-fluid" alt="">
                    </div>
                    <p class="title-brand">POID</p>
                  </a>
                  <a href="#" class="div-brand">
                    <div class="img-brand">
                      <img src="{{asset('/img/list-clients/1.png')}}" class="img-fluid" alt="">
                    </div>
                    <p class="title-brand">BIRD</p>
                  </a>
                </div>
                {{-- item --}}
              </div>
            </div>
            {{-- end show brand --}}
          </div>
        </div>
      </div>
      {{-- end content brand --}}




      <!-- navigate -->
      <div class="scroll-div d-none d-sm-block">
        <div class="scroll-to d-flex justify-content-between">
          <span>CLIENTS</span>
          <div class="group-arrow">
            <a href="#what" class="fa fa-long-arrow-left" aria-hidden="true"></a>
            <a href="#about-us" class="fa fa-long-arrow-right" aria-hidden="true"></a>
          </div>
        </div>
      </div>
      <div class="page-number">
        <img src="img/dot-page.png" alt=""> Page 5
      </div>
    </div>
  </div>

  <!-- About Us -->
  <div class="section fp-auto-height" id="section5">
    <div id="about-us">
      <img src="img/home-6.png" alt="" class="about-bg">
      <div class="tabs-content">
        <!-- Section one -->
        <div class="section-one tab-content" id="tab1">
          <div class="container">
            <div class="row">
              <div class="col-6">
                <div class="about-left text-center text-white p1">
                  <div class="col-lg-8 offset-lg-2">
                    <h3 class="text-center">WHAT'S THE OCCASION ?</h3>
                    <div class="text-right d-none d-sm-none d-lg-block">
                      <small class="text-right">Tiktok, Choose wisely</small>
                    </div>
                    <div class="page-section pt-5 d-none d-sm-none d-lg-block">
                      <p>0.6</p>
                      <p>HERE WE ARE</p>
                      <P>let's work together</P>
                    </div>
                  </div>

                </div>
              </div>
              <!-- Col 6 -->
              <div class="col-6">
                <div class="selection">
                  <ul id="tabs-nav">
                    <li><a href="#tab2" class="atab">Hire us</a></li>
                    <li><a href="#tab3" class="atab">Be part of our team</a></li>
                    <li><a href="#tab4" class="atab">Something else</a></li>
                  </ul> <!-- END tabs-nav -->
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- End section two -->
        <div class="section-two tab-content" id="tab2">

          <!-- title -->
          <form action="/add_hire" method="get">
            <div class="container">
              <div class="row">
                <div class="d-none d-sm-none d-lg-block col-lg-6">
                  <div class="about-left text-center text-white p1">
                    <div class="col-lg-8 offset-lg-2">
                      <h3 class="text-center pb-3">HIRE US</h3>
                      <button class="btn btn-outline-light mt-5 btn-send"><i class="fa fa-paper-plane pr-1"
                          aria-hidden="true"></i>Send Us</button>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 d-flex flex-column">
                  <ul id="tabs-nav" class="arrow p-0">
                    <li>
                      <a href="#tab1">
                        <img src="img/arrow-left.png" alt="">
                      </a>
                    </li>
                  </ul>
                  <div class="about-right">
                    <div class="form-group">
                      <label for="exampleInputEmail1">WHAT'S YOUR NAME</label>
                      <input type="text" name="partner_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">DO YOU HAVE E-MAIL ?</label>
                      <input type="email" name="email"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">WHAT'S THE NAME OF YOUR PROJECT?</label>
                      <input type="text" name="project_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">TELL US A BIT ABOUT YOUR PROJECT.</label>
                      <input type="text" name="describe_project" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">HOW CAN WE HELP YOU</label>
                      <div class="list-option">
                        <div class="row">
                          @foreach($serv as $s)
                          <div class="col-lg-6">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="service_id" value="{{$s->id}}"><span>{{$s->service_name}}</span>
                            </label>
                          </div>
                          @endforeach
                        </div>
                        <!-- End row -->
                      </div>
                      <!-- End list option -->
                      <div class="row">
                        <div class="col-lg-4">
                          <h4 class="pt-2">WHAT'S YOUR BUDGET?</h4>
                        </div>
                        <div class="col-lg-8">
                          <div class="slidecontainer">
                            <input type="range" min="1" max="30" value="15" class="slider" id="range" name="budget">
                            <p>Value : <output for="range" class="output">15,000,000 VNĐ</output></p>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>


            </div>
          </form>
        </div>
        <!-- Section three -->
        <div class="section-three tab-content" id="tab3">
          <form action="/add_candidate" method="get">
            <div class="container">
              <div class="row">
                <div class="col-6">
                  <div class="about-left text-center text-white p1">
                    <div class="col-lg-8 offset-lg-2">
                      <h3 class="text-center pb-3">Be part of
                        our team</h3>
                      <button class="btn btn-outline-light mt-5 btn-send"><i class="fa fa-paper-plane pr-1"
                          aria-hidden="true"></i>Send Us</button>
                    </div>

                  </div>
                </div>
                <div class="col-6 d-flex flex-column">
                  <ul id="tabs-nav" class="arrow p-0">
                    <li>
                      <a href="#tab1">
                        <img src="img/arrow-left.png" alt="">
                      </a>
                    </li>

                  </ul>
                  <div class="about-right">
                    <div class="form-group">
                      <label for="exampleInputEmail1">WHAT'S YOUR NAME</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">DO YOU HAVE E-MAIL ?</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">WHAT'S THE NAME OF YOUR PROJECT?</label>
                      <input type="text" name="project_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">TELL US A BIT ABOUT YOUR PROJECT.</label>
                      <input type="text" name="introduce" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">HOW CAN WE HELP YOU</label>
                      <div class="list-option">
                        <div class="row">
                          @foreach($sldept as $sl)
                          <div class="col-lg-6">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="dept_id" value="{{$sl->id}}"><span>{{$sl->dept_name}}</span>
                            </label>
                          </div>
                          @endforeach
                        </div>
                        <!-- End row -->
                      </div>
                      <!-- End list option -->
                      <div class="image-upload d-flex justify-content-start pt-3">
                        <label for="file-input" class="pr-3">
                          <img src="img/upload-icon.png" alt="">
                        </label>
                        <input id="file-input" type="file" name="profile" hidden />
                        <p>Upload your Profile here !</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- Section four -->
        <div class="section-four tab-content" id="tab4">
          <form action="/add_somethingelse" method="POST">
            @csrf
            <div class="container">
              <div class="row">
                <div class="col-6">
                  <div class="about-left text-center text-white p1">
                    <div class="col-lg-8 offset-lg-2">
                      <h3 class="text-center pb-3">Something else</h3>
                      <button class="btn btn-outline-light mt-5 btn-send" name="btn_fb"><i
                          class="fa fa-paper-plane pr-1" aria-hidden="true"></i>Send Us</button>
                    </div>
                  </div>
                </div>
                <div class="col-6 d-flex flex-column">
                  <ul id="tabs-nav" class="arrow p-0">
                    <li>
                      <a href="#tab1">
                        <img src="img/arrow-left.png" alt="">
                      </a>
                    </li>
                  </ul>
                  <div class="about-right">

                    <div class="form-group">
                      <label for="exampleInputEmail1">WHAT'S YOUR NAME</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">DO YOU HAVE E-MAIL ?</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">WHAT’S YOUR MESSAGE DEAR?</label>
                      <textarea class="form-control" name="describe" id="exampleFormControlTextarea1" rows="12"
                        placeholder="Enter text here..."></textarea>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="scroll-div d-none d-sm-block">
          <div class="scroll-to d-flex justify-content-between">
            <span>CONTACT</span>
            <div class="group-arrow">
              <a href="#clients" class="fa fa-long-arrow-left" aria-hidden="true"></a>
            </div>
          </div>
        </div>
        <div class="page-number">
          <img src="img/dot-page.png" alt=""> Page 6
        </div>
      </div>
      <!-- navigate -->
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
    <script src="js/main.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/1.js"></script>
    <script src="js/select.js"></script>
    <script src="js/owl.carousel.js"></script>
    <!-- Full page -->
    <script src="js/fullpage.js"></script>
    <script type="text/javascript">
      var myFullpage = new fullpage('#fullpage', {
        scrollBar: true
      });
    </script>
    </body>

</html>