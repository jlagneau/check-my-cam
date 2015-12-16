<main id="new-picture">
    <div id="frame">
        <canvas id="overlay" width="640" height="480"></canvas>
        <canvas id="pic" width="640" height="480"></canvas>
        <video id="video" width="640" height="480" autoplay></video>
    </div>
    <p>Select an image: </p>
    <ul id="overlayList" style="display:none;">
        <li><img class="overlay-elem" src="/images/1.png" alt="overlat 1" width="100" /></li>
        <li><img class="overlay-elem" src="/images/2.png" alt="overlay 2" width="100" /></li>
        <li><img class="overlay-elem" src="/images/3.png" alt="overlay 3" width="100" /></li>
        <li><img class="overlay-elem" src="/images/4.png" alt="overlay 4" width="100" /></li>
    </ul>
    <input id="uploadedPic" type="file" name="uploadedPic" />
    <button id="takepic" disabled>Take picture</button>
    <button id="resetpic">Reset</button>
</main>

<aside id="sidebar">
    <p>Last pictures</p>
    <ul id="sidebar-pictures">
    </ul>
</aside>

<script src="/scripts/ajax.js"></script>
<script src="/scripts/webcam.js"></script>
<script src="/scripts/newPicture.js"></script>
