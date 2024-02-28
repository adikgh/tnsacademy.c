<? if (!isset($_SESSION['loader'])): ?>

   <div class="preloader show">
      <div class="preloader_c">
         <div class="preloader_logo"><?=$site['name']?></div>
         <div class="preloader_inner">
            <div class="preloader_inner2"></div>
         </div>
      </div>
   </div>
   <script>
      loader();
      function loader(_success) {
         var obj = document.querySelector('.preloader')
         t = setInterval(function() {
            obj.classList.remove('show');
            clearInterval(t);
            if (_success){return _success()}
         }, 2000);
      }
   </script>

   <? $_SESSION['loader'] = true; ?>
<? endif ?>