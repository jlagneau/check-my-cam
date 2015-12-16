"use strict";

function createSidebar(response) {
  var picturesList = document.getElementById("sidebar-pictures");
  var pictures = JSON.parse(response);
  if (!picturesList) return;
  picturesList.innerHTML = '';
  pictures.forEach(function (element, index, array) {
    var i = document.createElement('img');
    i.src = element.path;
    var li = document.createElement('li');
    li.appendChild(i);
    picturesList.appendChild(li);
  });
}

window.addEventListener("DOMContentLoaded", function() {
  var overlaySelected;
  var pic = document.getElementById("pic");
  var picContext = pic.getContext("2d");
  var overlay = document.getElementById("overlay");
  var overlayContext = overlay.getContext("2d");
  var video = document.getElementById("video");
  var overlayList = document.querySelectorAll(".overlay-elem");

  for (var i = 0; i < overlayList.length; i++) {
    var img = new Image();
    overlayList[i].onclick = function (e) {
      img.src = e.target.currentSrc;
      overlaySelected = img;
      picContext.clearRect(0, 0, overlay.width, overlay.height);
      overlayContext.clearRect(0, 0, overlay.width, overlay.height);
      overlayContext.drawImage(img, 0, 0, 640, 480, 0, 0, overlay.width, overlay.height);
      document.getElementById("takepic").disabled = false;
    };
  }

  document.getElementById("uploadedPic").addEventListener("change", function(e) {
    var img = new Image();
    img.src = window.URL.createObjectURL(e.target.files[0]);
    console.log(img);
    img.onload = function() {
      picContext.drawImage(img, 0, 0, 640, 480, 0, 0, pic.width, pic.height);
    }
    img.src = window.URL.createObjectURL(e.target.files[0]);
    document.getElementById("overlayList").style.display = "block";
  });

  document.getElementById("takepic").addEventListener("click", function() {
    overlayContext.drawImage(overlaySelected, 0, 0, 640, 480, 0, 0, overlay.width, overlay.height);
    picContext.drawImage(video, 0, 0, 640, 480, 0, 0, pic.width, pic.height);

    var dataURLpic = pic.toDataURL("image/png");
    var dataURLoverlay = overlay.toDataURL("image/png");
    document.getElementById("takepic").disabled = true;

    setTimeout("document.getElementById(\"pic\").className = \"visible\"", 2500);
    setTimeout("document.getElementById(\"pic\").getContext(\"2d\").\
      clearRect(0, 0, document.getElementById(\"pic\").width,\
      document.getElementById(\"pic\").height)", 2500);

    ajax.post('/account/new', {"pic": dataURLpic, "overlay": dataURLoverlay}, function () {
        ajax.get('/pictures', {"limit": 5, "offset": 0}, createSidebar);
    });
  });

  document.getElementById("resetpic").addEventListener("click", function() {
    document.getElementById("takepic").disabled = true;
    picContext.clearRect(0, 0, pic.width, pic.height);
  });

  ajax.get('/pictures', {"limit": 5, "offset": 0}, createSidebar);
}, false);
