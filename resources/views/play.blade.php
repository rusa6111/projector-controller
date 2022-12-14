<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>projector controller</title>
    <style media="screen">
      body {
        padding: 0;
        margin: 0;
        scrollbar-width: none;
        -ms-overflow-style: none;
      }
      body::-webkit-scrollbar {
        display: none;
      }
      video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
      }
      video.invisible {
        height: 0;
        width: 0;
      }
      .btn-group {
        position: absolute;
        top: 120vh;
        margin: 20px;
      }
      .blank {
        position: absolute;
        top: 120vh;
        height: 80px;
        width: 100px;
      }
    </style>
  </head>
  <body>
    @foreach($movies as $movie)
    <video class="invisible" id="video-{{ $movie->title }}">
      <source src="{{ asset('storage/' . $movie->path) }}" type="video/mp4">
    </video>
    @endforeach
    <div class="blank"></div>
    <div class="btn-group">
      <button id="btnA" class="btn btn-primary">Player A</button>
      <button id="btnB" class="btn btn-primary">Player B</button>
      <button id="btnC" class="btn btn-primary">Player C</button>
    </div>
    <script type="text/javascript">
      var request = new XMLHttpRequest();
      request.responseType = "json";
      var done = {};
      var player_id = "";
      var interval_id = null;
      function enquiry() {
        request.open("GET", "{{ route('enquiry') }}");
        request.send(null);
        request.onload = function() {
          if (request.status != 200) return;
          var responseObj = request.response;
          for (var i of responseObj.plays) {
            if (i.player_id != player_id) continue
            if (done[i.id]) continue;
            done[i.id] = true
            
            @foreach($movies as $movie)
            document.getElementById("video-{{ $movie->title }}").classList.add("invisible");
            @endforeach
            var play = document.getElementById("video-" + i.name);
            play.classList.remove("invisible");
            console.log(i.id, i.name)
            
            window.clearInterval(interval_id);
            
            window.setTimeout(function () {
              done[i.id] = false;
            }, 3000);
            window.setTimeout(function (a) {
              return function() {
                play.currentTime = 0;
                console.log(a.id, a.name);
                play.play();
              }
            } (i), i.play_time - responseObj.now);
            
            window.setTimeout(function (a) {
              return function () {
                interval_id = window.setInterval(function (b) {
                  nw = Date.now() - 1000 * play.currentTime;
                  return function() {
                    if (Date.now() - nw > 0 && Date.now() - nw - 1000 * play.currentTime > 50) {
                      play.playbackRate = 2;
                      console.log(Date.now() - nw, play.currentTime, Math.abs(Date.now() - nw - 1000 * play.currentTime));
                    } else if (Date.now() - nw > 0 && Date.now() - nw - 1000 * play.currentTime < -50) {
                      play.playbackRate = 0.5;
                      console.log(Date.now() - nw, play.currentTime, Math.abs(Date.now() - nw - 1000 * play.currentTime));
                    } else {
                      play.playbackRate = 1;
                    }
                  }
                } (a), 50);
              }
            } (i), i.play_time - responseObj.now + 500);
            
            
            
            play.addEventListener('ended', (event) => {
              window.clearInterval(interval_id);
            });
          }
        }
      }
      
      window.setInterval(enquiry, 200);
      
      var btnA = document.getElementById('btnA');
      var btnB = document.getElementById('btnB');
      var btnC = document.getElementById('btnC');
      
      function btnOnklick() {
        btnA.classList.remove('active');
        btnB.classList.remove('active');
        btnC.classList.remove('active');
        this.classList.add('active');
        player_id = this.id[3];
        console.log(player_id);
      }
      btnA.onclick = btnOnklick;
      btnB.onclick = btnOnklick;
      btnC.onclick = btnOnklick;
      
      
    </script>
  </body>
</html>














