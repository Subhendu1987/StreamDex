<div class="container-fluid border-bottom px-4">
          <button class="header-toggler" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()" style="margin-inline-start: -14px;">
            <svg class="icon icon-lg">
              <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-menu') ?>"></use>
            </svg>
          </button>
          <ul class="header-nav d-none d-lg-flex">
            <li class="nav-item"><?= esc($page_name) ?></li>
          </ul>
          <ul class="header-nav ms-auto">

          </ul>




          <ul class="header-nav ms-auto">

            <li class="nav-item dropdown">
              <button class="btn btn-link nav-link py-2 px-2 px-lg-2 d-flex align-items-center" type="button" aria-expanded="false" data-coreui-toggle="dropdown" data-coreui-display="static">
                <svg xmlns="http://www.w3.org/2000/svg" class="theme-icon-active icon icon-xl" viewBox="0 0 512 512">
                  <path fill="var(--ci-primary-color, currentColor)" d="M256,16C123.452,16,16,123.452,16,256S123.452,496,256,496,496,388.548,496,256,388.548,16,256,16ZM234,462.849a208.346,208.346,0,0,1-169.667-125.9c-.364-.859-.706-1.724-1.057-2.587L234,429.939Zm0-69.582L50.889,290.76A209.848,209.848,0,0,1,48,256q0-9.912.922-19.67L234,339.939Zm0-90L54.819,202.96a206.385,206.385,0,0,1,9.514-27.913Q67.1,168.5,70.3,162.191L234,253.934Zm0-86.015L86.914,134.819a209.42,209.42,0,0,1,22.008-25.9q3.72-3.72,7.6-7.228L234,166.027Zm0-87.708L144.352,80.451A206.951,206.951,0,0,1,234,49.151ZM464,256A207.775,207.775,0,0,1,266,463.761V48.239A207.791,207.791,0,0,1,464,256Z" class="ci-primary"></path>
                </svg>

              </button>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cd-theme" style="--cui-dropdown-min-width: 8rem;">
                <li>
                  <button type="button" class="dropdown-item d-flex align-items-center" data-coreui-theme-value="light">
                    <svg xmlns="http://www.w3.org/2000/svg" class="theme-icon icon icon-lg me-2" viewBox="0 0 512 512">
                      <path fill="var(--ci-primary-color, currentColor)" d="M256,104c-83.813,0-152,68.187-152,152s68.187,152,152,152,152-68.187,152-152S339.813,104,256,104Zm0,272A120,120,0,1,1,376,256,120.136,120.136,0,0,1,256,376Z" class="ci-primary"></path>
                      <rect width="32" height="48" x="240" y="16" fill="var(--ci-primary-color, currentColor)" class="ci-primary"></rect>
                      <rect width="32" height="48" x="240" y="448" fill="var(--ci-primary-color, currentColor)" class="ci-primary"></rect>
                      <rect width="48" height="32" x="448" y="240" fill="var(--ci-primary-color, currentColor)" class="ci-primary"></rect>
                      <rect width="48" height="32" x="16" y="240" fill="var(--ci-primary-color, currentColor)" class="ci-primary"></rect>
                      <rect width="32" height="45.255" x="400" y="393.373" fill="var(--ci-primary-color, currentColor)" class="ci-primary" transform="rotate(-45 416 416)"></rect>
                      <rect width="32.001" height="45.255" x="80" y="73.373" fill="var(--ci-primary-color, currentColor)" class="ci-primary" transform="rotate(-45 96 96)"></rect>
                      <rect width="45.255" height="32" x="73.373" y="400" fill="var(--ci-primary-color, currentColor)" class="ci-primary" transform="rotate(-45.001 96.002 416.003)"></rect>
                      <rect width="45.255" height="32.001" x="393.373" y="80" fill="var(--ci-primary-color, currentColor)" class="ci-primary" transform="rotate(-45 416 96)"></rect>
                    </svg>

                    Light
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon bi ms-auto d-none" viewBox="0 0 512 512">
                      <path fill="var(--ci-primary-color, currentColor)" d="M199.066,456l-7.379-7.514-3.94-3.9-86.2-86.2.053-.055L17.936,274.665l97.614-97.613,83.565,83.565L398.388,61.344,496,158.958,296.729,358.229,285.469,369.6ZM146.6,358.183l52.459,52.46.1-.1.054.054,52.311-52.311,11.259-11.368L450.746,158.958,398.388,106.6,199.115,305.871,115.55,222.306,63.191,274.665l83.464,83.463Z" class="ci-primary"></path>
                    </svg>

                  </button>
                </li>
                <li>
                  <button type="button" class="dropdown-item d-flex align-items-center" data-coreui-theme-value="dark">
                    <svg xmlns="http://www.w3.org/2000/svg" class="theme-icon icon icon-lg me-2" viewBox="0 0 512 512">
                      <path fill="var(--ci-primary-color, currentColor)" d="M268.279,496c-67.574,0-130.978-26.191-178.534-73.745S16,311.293,16,243.718A252.252,252.252,0,0,1,154.183,18.676a24.44,24.44,0,0,1,34.46,28.958,220.12,220.12,0,0,0,54.8,220.923A218.746,218.746,0,0,0,399.085,333.2h0a220.2,220.2,0,0,0,65.277-9.846,24.439,24.439,0,0,1,28.959,34.461A252.256,252.256,0,0,1,268.279,496ZM153.31,55.781A219.3,219.3,0,0,0,48,243.718C48,365.181,146.816,464,268.279,464a219.3,219.3,0,0,0,187.938-105.31,252.912,252.912,0,0,1-57.13,6.513h0a250.539,250.539,0,0,1-178.268-74.016,252.147,252.147,0,0,1-67.509-235.4Z" class="ci-primary"></path>
                    </svg>

                    Dark
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon bi ms-auto d-none" viewBox="0 0 512 512">
                      <path fill="var(--ci-primary-color, currentColor)" d="M199.066,456l-7.379-7.514-3.94-3.9-86.2-86.2.053-.055L17.936,274.665l97.614-97.613,83.565,83.565L398.388,61.344,496,158.958,296.729,358.229,285.469,369.6ZM146.6,358.183l52.459,52.46.1-.1.054.054,52.311-52.311,11.259-11.368L450.746,158.958,398.388,106.6,199.115,305.871,115.55,222.306,63.191,274.665l83.464,83.463Z" class="ci-primary"></path>
                    </svg>

                  </button>
                </li>
                <li>
                  <button type="button" class="dropdown-item d-flex align-items-center active" data-coreui-theme-value="auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="theme-icon icon icon-lg me-2" viewBox="0 0 512 512">
                      <path fill="var(--ci-primary-color, currentColor)" d="M256,16C123.452,16,16,123.452,16,256S123.452,496,256,496,496,388.548,496,256,388.548,16,256,16ZM234,462.849a208.346,208.346,0,0,1-169.667-125.9c-.364-.859-.706-1.724-1.057-2.587L234,429.939Zm0-69.582L50.889,290.76A209.848,209.848,0,0,1,48,256q0-9.912.922-19.67L234,339.939Zm0-90L54.819,202.96a206.385,206.385,0,0,1,9.514-27.913Q67.1,168.5,70.3,162.191L234,253.934Zm0-86.015L86.914,134.819a209.42,209.42,0,0,1,22.008-25.9q3.72-3.72,7.6-7.228L234,166.027Zm0-87.708L144.352,80.451A206.951,206.951,0,0,1,234,49.151ZM464,256A207.775,207.775,0,0,1,266,463.761V48.239A207.791,207.791,0,0,1,464,256Z" class="ci-primary"></path>
                    </svg>

                    Auto
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon bi ms-auto d-none" viewBox="0 0 512 512">
                      <path fill="var(--ci-primary-color, currentColor)" d="M199.066,456l-7.379-7.514-3.94-3.9-86.2-86.2.053-.055L17.936,274.665l97.614-97.613,83.565,83.565L398.388,61.344,496,158.958,296.729,358.229,285.469,369.6ZM146.6,358.183l52.459,52.46.1-.1.054.054,52.311-52.311,11.259-11.368L450.746,158.958,398.388,106.6,199.115,305.871,115.55,222.306,63.191,274.665l83.464,83.463Z" class="ci-primary"></path>
                    </svg>

                  </button>
                </li>
              </ul>
            </li>
            <li class="nav-item py-2 py-lg-1">
              <div class="vr d-none d-lg-flex h-100 mx-lg-2 text-body text-opacity-75"></div>
              <hr class="d-lg-none my-2 text-white-50">
            </li>
          </ul>

          
          <ul class="header-nav">
          
            <li class="nav-item dropdown"><a class="nav-link py-0 pe-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                
                
                <div class="avatar avatar-md"><img class="avatar-img" src="<?= base_url('public/assets/img/defult.jpg') ?>" alt="user@email.com"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-end pt-0">
                <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold my-2 text-center">
                  <div class="fw-semibold"><?= esc(explode(' ', $user_name)[0]) ?></div>
                </div>
                  
                <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?= base_url('user/profile') ?>">
                    <svg class="icon me-2">
                      <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-user') ?>"></use>
                    </svg> Profile</a>
                

                  <a class="dropdown-item" href="<?= base_url('logout') ?>">
                    <svg class="icon me-2">
                      <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-account-logout') ?>"></use>
                    </svg> Logout</a>
              </div>
              
            </li>
          </ul>
        </div>

