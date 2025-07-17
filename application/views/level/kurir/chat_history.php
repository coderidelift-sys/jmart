<?php $this->load->view('layouts/kurir/head'); ?>
<style>
 ul.timeline {
  list-style-type: none;
  position: relative;
  padding-left: 40px;
}
ul.timeline:before {
  content: ' ';
  background: #d4d9df;
  display: inline-block;
  position: absolute;
  left: 29px;
  width: 2px;
  height: 100%;
  z-index: 2;
}
ul.timeline > li {
  margin: 20px 20px 20px 20px;
  padding-left: 10px;
}
ul.timeline > li:before {
  content: ' ';
  background: white;
  display: inline-block;
  position: absolute;
  border-radius: 50%;
  border: 3px solid #22c0e8;
  left: 20px;
  width: 20px;
  height: 20px;
  z-index: 2;
}
.title {
  font-weight: 700;
  margin-bottom: 0;
  color: #2C406E;
}
.navbar__left {
        width: 4rem;
        z-index: 2;
    }
</style>
<?php $this->load->view('layouts/kurir/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
 <div class="container">
  <div class="navbar__left">
        <a href="<?= base_url('chat') ?>">
            <svg class="navbar__left__icon fw-bold text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);cursor:pointer;z-index: 2;">
                <path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
            </svg>
        </a>
    </div>
    <div class="nav-bar__center">
        <h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">History Chat</h1>
    </div>
</div>
</nav>

<section class="mt-3 mb-4">
 <div class="container">
   <div class="row">
     <div class="col-12">
       <div class="card">
        <div class="card-header bg-primary text-white fw-bold fs-3">
          Pawel Kona
        </div>
         <div class="card-body scrollable" style="height: 35rem">
          <div class="text-center mb-3">
            <button class="btn btn-md btn-white" style="border-radius: 5%;">Filter per Tanggal</button>
          </div>
          <div class="chat">
            <div class="chat-bubbles">
              <div class="chat-item">
                <div class="row align-items-end justify-content-end">
                  <div class="col col-lg-6">
                    <div class="chat-bubble chat-bubble-me">
                      <div class="chat-bubble-title">
                        <div class="row">
                          <div class="col chat-bubble-author">Paweł Kuna</div>
                          <div class="col-auto chat-bubble-date">09:32</div>
                        </div>
                      </div>
                      <div class="chat-bubble-body">
                        <p>Hey guys, I just pushed a new commit on the <code>dev</code> branch. Can you have a look and tell me what you think?</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/000m.jpg)"></span>
                  </div>
                </div>
              </div>
              <div class="chat-item">
                <div class="row align-items-end">
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/002m.jpg)"></span>
                  </div>
                  <div class="col col-lg-6">
                    <div class="chat-bubble">
                      <div class="chat-bubble-title">
                        <div class="row">
                          <div class="col chat-bubble-author">Mallory Hulme</div>
                          <div class="col-auto chat-bubble-date">09:34</div>
                        </div>
                      </div>
                      <div class="chat-bubble-body">
                        <p>Sure Paweł, let me pull the latest updates.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="chat-item">
                <div class="row align-items-end">
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/003m.jpg)"></span>
                  </div>
                  <div class="col col-lg-6">
                    <div class="chat-bubble">
                      <div class="chat-bubble-title">
                        <div class="row">
                          <div class="col chat-bubble-author">Dunn Slane</div>
                          <div class="col-auto chat-bubble-date">09:34</div>
                        </div>
                      </div>
                      <div class="chat-bubble-body">
                        <p>I'm on it too 👊</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="chat-item">
                <div class="row align-items-end">
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/002m.jpg)"></span>
                  </div>
                  <div class="col col-lg-6">
                    <div class="chat-bubble">
                      <div class="chat-bubble-title">
                        <div class="row">
                          <div class="col chat-bubble-author">Mallory Hulme</div>
                          <div class="col-auto chat-bubble-date">09:40</div>
                        </div>
                      </div>
                      <div class="chat-bubble-body">
                        <p>I see you've refactored the <code>calculateStatistics</code> function. The code is much cleaner now.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="chat-item">
                <div class="row align-items-end justify-content-end">
                  <div class="col col-lg-6">
                    <div class="chat-bubble chat-bubble-me">
                      <div class="chat-bubble-title">
                        <div class="row">
                          <div class="col chat-bubble-author">Paweł Kuna</div>
                          <div class="col-auto chat-bubble-date">09:42</div>
                        </div>
                      </div>
                      <div class="chat-bubble-body">
                        <p>Yes, I thought it was getting a bit cluttered.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/000m.jpg)"></span>
                  </div>
                </div>
              </div>
              <div class="chat-item">
                <div class="row align-items-end">
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/000f.jpg)"></span>
                  </div>
                  <div class="col col-lg-6">
                    <div class="chat-bubble">
                      <div class="chat-bubble-title">
                        <div class="row">
                          <div class="col chat-bubble-author">Emmy Levet</div>
                          <div class="col-auto chat-bubble-date">09:43</div>
                        </div>
                      </div>
                      <div class="chat-bubble-body">
                        <p>The commit message is descriptive, too. Good job on mentioning the issue number it fixes.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="chat-item">
                <div class="row align-items-end">
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/003m.jpg)"></span>
                  </div>
                  <div class="col col-lg-6">
                    <div class="chat-bubble">
                      <div class="chat-bubble-title">
                        <div class="row">
                          <div class="col chat-bubble-author">Dunn Slane</div>
                          <div class="col-auto chat-bubble-date">09:44</div>
                        </div>
                      </div>
                      <div class="chat-bubble-body">
                        <p>I noticed you added some new dependencies in the <code>package.json</code>. Did you also update the <code>README</code> with the setup instructions?</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="chat-item">
                <div class="row align-items-end justify-content-end">
                  <div class="col col-lg-6">
                    <div class="chat-bubble chat-bubble-me">
                      <div class="chat-bubble-title">
                        <div class="row">
                          <div class="col chat-bubble-author">Paweł Kuna</div>
                          <div class="col-auto chat-bubble-date">09:45</div>
                        </div>
                      </div>
                      <div class="chat-bubble-body">
                        <p>Oops, I forgot. I'll add that right away.</p>
                        <div class="mt-2">
                          <img src="https://media3.giphy.com/media/VABbCpX94WCfS/giphy.gif" alt="" class="rounded img-fluid">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/000m.jpg)"></span>
                  </div>
                </div>
              </div>
              <div class="chat-item">
                <div class="row align-items-end">
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/002m.jpg)"></span>
                  </div>
                  <div class="col col-lg-6">
                    <div class="chat-bubble">
                      <div class="chat-bubble-title">
                        <div class="row">
                          <div class="col chat-bubble-author">Mallory Hulme</div>
                          <div class="col-auto chat-bubble-date">09:46</div>
                        </div>
                      </div>
                      <div class="chat-bubble-body">
                        <p>I see a couple of edge cases we might not be handling in the <code>calculateStatistic</code> function. Should I open an issue for that?</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="chat-item">
                <div class="row align-items-end justify-content-end">
                  <div class="col col-lg-6">
                    <div class="chat-bubble chat-bubble-me">
                      <div class="chat-bubble-title">
                        <div class="row">
                          <div class="col chat-bubble-author">Paweł Kuna</div>
                          <div class="col-auto chat-bubble-date">09:47</div>
                        </div>
                      </div>
                      <div class="chat-bubble-body">
                        <p>Yes, Bob. Please do. We should not forget to handle those.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/000m.jpg)"></span>
                  </div>
                </div>
              </div>
              <div class="chat-item">
                <div class="row align-items-end">
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/000f.jpg)"></span>
                  </div>
                  <div class="col col-lg-6">
                    <div class="chat-bubble">
                      <div class="chat-bubble-title">
                        <div class="row">
                          <div class="col chat-bubble-author">Emmy Levet</div>
                          <div class="col-auto chat-bubble-date">09:50</div>
                        </div>
                      </div>
                      <div class="chat-bubble-body">
                        <p>Alright, once the <code>README</code> is updated, I'll merge this commit into the main branch. Nice work, Paweł.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="chat-item">
                <div class="row align-items-end justify-content-end">
                  <div class="col col-lg-6">
                    <div class="chat-bubble chat-bubble-me">
                      <div class="chat-bubble-title">
                        <div class="row">
                          <div class="col chat-bubble-author">Paweł Kuna</div>
                          <div class="col-auto chat-bubble-date">09:52</div>
                        </div>
                      </div>
                      <div class="chat-bubble-body">
                        <p>Thanks, <a href="#">@everyone</a>! 🙌</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/000m.jpg)"></span>
                  </div>
                </div>
              </div>
              <div class="chat-item">
                <div class="row align-items-end">
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/000f.jpg)"></span>
                  </div>
                  <div class="col-auto">
                    <div class="chat-bubble">
                      <div class="chat-bubble-body">
                        <p class="text-secondary text-italic">typing<span class="animated-dots"></span></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
            <div class="input-group input-group-flat">
              <input type="text" class="form-control" autocomplete="off" placeholder="Type message">
              <span class="input-group-text">
                <a href="#" class="link-secondary" data-bs-toggle="tooltip" aria-label="Clear search" data-bs-original-title="Clear search"> <!-- Download SVG icon from http://tabler-icons.io/i/mood-smile -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M9 10l.01 0"></path><path d="M15 10l.01 0"></path><path d="M9.5 15a3.5 3.5 0 0 0 5 0"></path></svg>
                </a>
                <a href="#" class="link-secondary ms-2" data-bs-toggle="tooltip" aria-label="Add notification" data-bs-original-title="Add notification"> <!-- Download SVG icon from http://tabler-icons.io/i/paperclip -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5"></path></svg>
                </a>
              </span>
            </div>
          </div>
       </div>
     </div>
   </div>
 </section>

<div class="row">
 <br><br><br><br>
</div>

<?php $this->load->view('layouts/kurir/menu'); ?>
<?php $this->load->view('layouts/kurir/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>