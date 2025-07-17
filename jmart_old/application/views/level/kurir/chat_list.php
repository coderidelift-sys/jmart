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

  ul.timeline>li {
    margin: 20px 20px 20px 20px;
    padding-left: 10px;
  }

  ul.timeline>li:before {
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
</style>
<?php $this->load->view('layouts/kurir/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
  <div class="container">
    <div class="nav-bar__left">
      <h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Chat</h1>
    </div>
  </div>
</nav>

<section class="mt-3 mb-4">
  <div class="container">
    <div class="d-flex my-3">
      <h3 class="title">Chat 🔥</h3>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header  d-block">
            <div class="input-icon">
              <span class="input-icon-addon"> <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                  <path d="M21 21l-6 -6"></path>
                </svg>
              </span>
              <input type="text" value="" class="form-control" placeholder="Search…" aria-label="Search">
            </div>
          </div>
          <div class="card-body p-0 scrollable" style="max-height: 35rem">
            <div class="nav flex-column nav-pills" role="tablist">
              <a href="<?= base_url('chat/history') ?>" class="nav-link text-start mw-100 p-3" id="chat-1-tab" role="tab" aria-selected="false" tabindex="-1">
                <div class="row align-items-center flex-fill">
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/000m.jpg)"></span>
                  </div>
                  <div class="col text-body">
                    <div>Paweł Kuna</div>
                    <div class="text-secondary text-truncate w-100">Sure Paweł, let me pull the latest updates.</div>
                  </div>
                </div>
              </a>
              <a href="#chat-1" class="nav-link text-start mw-100 p-3" id="chat-1-tab" role="tab" aria-selected="false" tabindex="-1">
                <div class="row align-items-center flex-fill">
                  <div class="col-auto"><span class="avatar">JL</span>
                  </div>
                  <div class="col text-body">
                    <div>Jeffie Lewzey</div>
                    <div class="text-secondary text-truncate w-100">I'm on it too 👊</div>
                  </div>
                </div>
              </a>
              <a href="#chat-1" class="nav-link text-start mw-100 p-3 active" id="chat-1-tab" role="tab" aria-selected="true">
                <div class="row align-items-center flex-fill">
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/002m.jpg)"></span>
                  </div>
                  <div class="col text-body">
                    <div>Mallory Hulme</div>
                    <div class="text-secondary text-truncate w-100">I see you've refactored the <code>calculateStatistics</code> function. The code is much cleaner now.</div>
                  </div>
                </div>
              </a>
              <a href="#chat-1" class="nav-link text-start mw-100 p-3" id="chat-1-tab" role="tab" aria-selected="false" tabindex="-1">
                <div class="row align-items-center flex-fill">
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/003m.jpg)"></span>
                  </div>
                  <div class="col text-body">
                    <div>Dunn Slane</div>
                    <div class="text-secondary text-truncate w-100">Yes, I thought it was getting a bit cluttered.</div>
                  </div>
                </div>
              </a>
              <a href="#chat-1" class="nav-link text-start mw-100 p-3" id="chat-1-tab" role="tab" aria-selected="false" tabindex="-1">
                <div class="row align-items-center flex-fill">
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/000f.jpg)"></span>
                  </div>
                  <div class="col text-body">
                    <div>Emmy Levet</div>
                    <div class="text-secondary text-truncate w-100">The commit message is descriptive, too. Good job on mentioning the issue number it fixes.</div>
                  </div>
                </div>
              </a>
              <a href="#chat-1" class="nav-link text-start mw-100 p-3" id="chat-1-tab" role="tab" aria-selected="false" tabindex="-1">
                <div class="row align-items-center flex-fill">
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/001f.jpg)"></span>
                  </div>
                  <div class="col text-body">
                    <div>Maryjo Lebarree</div>
                    <div class="text-secondary text-truncate w-100">I noticed you added some new dependencies in the <code>package.json</code>. Did you also update the <code>README</code> with the setup instructions?</div>
                  </div>
                </div>
              </a>
              <a href="#chat-1" class="nav-link text-start mw-100 p-3" id="chat-1-tab" role="tab" aria-selected="false" tabindex="-1">
                <div class="row align-items-center flex-fill">
                  <div class="col-auto"><span class="avatar">EP</span>
                  </div>
                  <div class="col text-body">
                    <div>Egan Poetz</div>
                    <div class="text-secondary text-truncate w-100">Oops, I forgot. I'll add that right away.</div>
                  </div>
                  <div class="col-auto">🌴</div>
                </div>
              </a>
              <a href="#chat-1" class="nav-link text-start mw-100 p-3" id="chat-1-tab" role="tab" aria-selected="false" tabindex="-1">
                <div class="row align-items-center flex-fill">
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/002f.jpg)"></span>
                  </div>
                  <div class="col text-body">
                    <div>Kellie Skingley</div>
                    <div class="text-secondary text-truncate w-100">I see a couple of edge cases we might not be handling in the <code>calculateStatistic</code> function. Should I open an issue for that?</div>
                  </div>
                </div>
              </a>
              <a href="#chat-1" class="nav-link text-start mw-100 p-3" id="chat-1-tab" role="tab" aria-selected="false" tabindex="-1">
                <div class="row align-items-center flex-fill">
                  <div class="col-auto"><span class="avatar" style="background-image: url(./static/avatars/003f.jpg)"></span>
                  </div>
                  <div class="col text-body">
                    <div>Christabel Charlwood</div>
                    <div class="text-secondary text-truncate w-100">Yes, Bob. Please do. We should not forget to handle those.</div>
                  </div>
                </div>
              </a>
              <a href="#chat-1" class="nav-link text-start mw-100 p-3" id="chat-1-tab" role="tab" aria-selected="false" tabindex="-1">
                <div class="row align-items-center flex-fill">
                  <div class="col-auto"><span class="avatar">HS</span>
                  </div>
                  <div class="col text-body">
                    <div>Haskel Shelper</div>
                    <div class="text-secondary text-truncate w-100">Alright, once the <code>README</code> is updated, I'll merge this commit into the main branch. Nice work, Paweł.</div>
                  </div>
                </div>
              </a>
            </div>
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