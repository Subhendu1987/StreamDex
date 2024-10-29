
    <footer class="footer px-4 footer-sticky ">
        <div><?php echo ('<strong>'.aboutdetails()['sitedetails']['Name'].'</strong> © '.(date('Y')) ); ?> <span>All Rights Reserved</span></div>
        <div class="ms-auto">Powered by&nbsp;<a href="<?= esc(aboutdetails()['sitedetails']['Link']) ?> " target="_blank"><?= esc(aboutdetails()['sitedetails']['Org']) ?></a> || Version: <?=esc (aboutdetails()['version'])?></div>
    </footer>
    </div>
 
    <!-- CoreUI and necessary plugins-->
    <script src="<?= base_url('public/vendors/@coreui/coreui/js/coreui.bundle.min.js') ?>"></script>
    <script src="<?= base_url('public/vendors/simplebar/js/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('public/jquery/jquery.min.js') ?>"></script>
    <!-- jQuery UI -->
    <script src="<?= base_url('public/jquery/jquery-ui.min.js') ?>"></script>

    <script src="<?= base_url('public/vendors/trumbowyg/js/trumbowyg.min.js') ?>"></script>
    <script src="<?= base_url('public/vendors/trumbowyg/js/vendor/highlight.js') ?>"></script>
    <script src="<?= base_url('public/vendors/trumbowyg/js/main.js') ?>"></script>

    <script src='<?= base_url('public/vendors/justgauge/js/raphael-min.js') ?>'></script>
    <script src='<?= base_url('public/vendors/justgauge/js/justgage.js') ?>'></script>
    

  </body>
</html>
<script>
$(document).ready(function() {
    // Restrict input to numbers only (0-9)
    $('.numonly').on('input', function() {
        // Replace any non-digit character with an empty string
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});
</script>
<script>
    <?php if (session()->getFlashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '<?= session()->getFlashdata('success'); ?>',
            timer: 2000,
            showConfirmButton: false
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '<?= session()->getFlashdata('error'); ?>',
            timer: 2000,
            showConfirmButton: false
        });
    <?php endif; ?>
</script>



<script>
    (() => {
  'use strict'

  const THEME = 'coreui-docs-theme'

  const getStoredTheme = () => localStorage.getItem(THEME)
  const setStoredTheme = theme => localStorage.setItem(THEME, theme)

  const getPreferredTheme = () => {
    const storedTheme = getStoredTheme()
    if (storedTheme) {
      return storedTheme
    }

    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
  }

  const setTheme = theme => {
    if (theme === 'auto') {
      document.documentElement.setAttribute('data-coreui-theme', (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'))
      document.documentElement.setAttribute('data-bs-theme', (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'))
    } else {
      document.documentElement.setAttribute('data-coreui-theme', theme)
      document.documentElement.setAttribute('data-bs-theme', theme)
    }
  }

  setTheme(getPreferredTheme())

  const showActiveTheme = theme => {
    const activeThemeIcon = document.querySelector('.theme-icon-active')
    const btnToActive = document.querySelector(`[data-coreui-theme-value="${theme}"]`)
    const svgOfActiveBtn = btnToActive.querySelector('svg.theme-icon')

    document.querySelectorAll('[data-coreui-theme-value]').forEach(element => {
      element.classList.remove('active')
    })

    btnToActive.classList.add('active')
    activeThemeIcon.innerHTML = svgOfActiveBtn.innerHTML
  }

  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
    const storedTheme = getStoredTheme()
    if (storedTheme !== 'light' && storedTheme !== 'dark') {
      setTheme(getPreferredTheme())
    }
  })

  window.addEventListener('DOMContentLoaded', () => {
    showActiveTheme(getPreferredTheme())

    document.querySelectorAll('[data-coreui-theme-value]')
      .forEach(toggle => {
        toggle.addEventListener('click', () => {
          const theme = toggle.getAttribute('data-coreui-theme-value')
          setStoredTheme(theme)
          setTheme(theme)
          showActiveTheme(theme)
        })
      })
  })
})()
</script>