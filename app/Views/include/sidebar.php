<!-- About Modal -->
<div class="modal fade" id="aboutmodal" tabindex="-1" data-coreui-backdrop="static" data-coreui-keyboard="false" aria-labelledby="aboutLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="aboutLabel">About Us</h5>
      </div>
      <div class="modal-body">
        <p>
            At <?= esc(aboutdetails()['sitedetails']['Name']) ?>, we are passionate about empowering content creators and streamers with the tools they need to thrive in the digital landscape. Our platform offers seamless streaming solutions, innovative features, and a user-friendly interface, allowing you to focus on what you do best—creating captivating content.
        </p>
        <p style="text-align: left;">
            For any inquiries or support, please reach out to us at :<br>
            <strong>Email:</strong> <a href="mailto:<?= esc(aboutdetails()['emaildetails']['Link']) ?>"><?= esc(aboutdetails()['emaildetails']['Link']) ?></a><br>
            <strong>GitHub:</strong> <a href="<?= esc(aboutdetails()['gitdetails']['Link']) ?>" target="_blank"><?= esc(aboutdetails()['gitdetails']['Name']) ?></a><br>
            <strong>YouTube:</strong> <a href="<?= esc(aboutdetails()['ytdetails']['Link']) ?>" target="_blank"><?= esc(aboutdetails()['ytdetails']['Name']) ?></a>
        </p>
      </div>
      <form class="needs-validation" id="deletePlaylistForm" novalidate>
      <input type="hidden" id="streamdeleteid" >
      <div class="modal-footer d-flex justify-content-between">
        <lebel><strong><?=esc (aboutdetails()['sitedetails']['Name'])?></strong> : <?=esc (aboutdetails()['version'])?></Lebel>
        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>        
      </div>
      </form>
    </div>
  </div>
</div>

<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
      <div class="sidebar-header border-bottom">
        <div class="sidebar-brand">
        <h5 class="sidebar-brand-full"><?= esc(aboutdetails()['sitedetails']['Name']) ?></h5>
        </div>
        <button class="btn-close d-lg-none" type="button" data-coreui-dismiss="offcanvas" data-coreui-theme="dark" aria-label="Close" onclick="coreui.Sidebar.getInstance(document.querySelector(&quot;#sidebar&quot;)).toggle()"></button>
      </div>
      <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/user') ?>">
            <svg class="nav-icon">
              <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-speedometer') ?>"></use>
            </svg> Dashboard</a></li>
        <li class="nav-title">Stream</li>
       
       
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/user/Video') ?>">
            <svg class="nav-icon">
              <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-featured-playlist') ?>"></use>
            </svg> Video</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/user/playlist') ?>">
            <svg class="nav-icon">
              <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-rss') ?>"></use>
            </svg> Video Playlist</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/user/musicVideo') ?>">
            <svg class="nav-icon">
              <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-music-note') ?>"></use>
            </svg> Music Video <?php if (isset($livemv) && !empty($livemv)): ?><?= $livemv; ?><?php endif; ?></a></li>
      
        

            
        <li class="nav-divider"></li>
        <li class="nav-title">System</li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('user/settings') ?>">
            <svg class="nav-icon">
              <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-settings') ?>"></use>
            </svg> Settings</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('user/profile') ?>">
            <svg class="nav-icon">
              <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-user') ?>"></use>
            </svg> Profile</a></li>


        <li class="nav-divider"></li>
        <li class="nav-title">Support</li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('user/guide') ?>">
            <svg class="nav-icon">
              <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-search') ?>"></use>
            </svg> Guide</a></li>
        <li class="nav-item">
        <button class="nav-link" data-coreui-toggle="modal" data-coreui-target="#aboutmodal"><svg class="nav-icon">
              <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-info') ?>"></use>
            </svg>About</button></li>

      </ul>
      <div >
        <!-- <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable">Logout</button> -->

        <ul class="sidebar-nav sidebar-footer border-top d-none d-md-flex" data-coreui="navigation" data-simplebar="" style="padding: 0px !important;">
            <li class="nav-divider"></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('logout') ?>">
                <svg class="nav-icon">
                <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-account-logout') ?>"></use>
                </svg> Logout</a></li>
        </ul>
      </div>
    </div>
