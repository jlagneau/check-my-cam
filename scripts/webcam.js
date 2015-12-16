"use strict";

window.addEventListener("DOMContentLoaded", function() {
  navigator.getMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia);

  navigator.getMedia(
    // constraints
    {video:true, audio:false},
    // success callback
    function (mediaStream) {
        var video = document.getElementById('video');
        video.src = window.URL.createObjectURL(mediaStream);
        video.play();
        document.getElementById("uploadedPic").style.display = "none";
        document.getElementById("overlayList").style.display = "block";
    },
    //handle error
    function (error) {
    })
}, false);
