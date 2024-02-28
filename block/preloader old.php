<div class="preloader show">
<div class="preloader__wrap">
   <div class="preloader__img">
      <svg class="preloader__svg" viewBox="0 0 2098 1281" fill="none" xmlns="http://www.w3.org/2000/svg">
         <g clip-path="url(#clip100)">
            <path d="M78.9375 1280.07L2029.36 1278.96C2070.15 1275.03 2105.4 1240.45 2094.32 1179.17L1879.08 183.145C1856.92 60.5831 1774.09 8.62106 1674.26 3.86303L426.935 9.08518C325.673 14.0577 248.2 62.2992 219.734 187.348L11.6835 1190.63C4.51943 1239.29 28.3069 1282.56 78.9375 1280.07Z" fill="url(#paint100_linear)"></path>
         </g>
         <defs>
            <linearGradient id="paint100_linear" x1="1000.82" y1="-61.7299" x2="1021.45" y2="1420.4" gradientUnits="userSpaceOnUse">
               <stop offset="0" stop-color="#39A586"></stop>
               <stop offset="0.515625" stop-color="#39A586" stop-opacity="0.63"></stop>
               <stop offset="1" stop-color="#39A586" stop-opacity="0"></stop>
            </linearGradient>
            <clipPath id="clip1000"><rect width="2098" height="1281" fill="white"></rect></clipPath>
         </defs>
      </svg>
   </div>
   <div data-progress="" class="preloader__progress"><span>0</span> %</div>
</div>
</div>
<script>
loader();
function loader(_success) {
   var htmlu = document.querySelector('html')
   if (htmlu.classList.contains('ovr_h') == false) htmlu.classList.add('ovr_h')

   var obj = document.querySelector('.preloader')
   var inner = document.querySelector('.preloader__progress span')
   var w = 0
   t = setInterval(function() {            
      w = w + 1;
      inner.textContent = w;
      if (w === 100){
         obj.classList.remove('show');
         htmlu.classList.remove('ovr_h')
         clearInterval(t);
         w = 0;
         if (_success) return _success()
      }
   }, 10);
}
</script>






<style>
   /* preloader */
.preloader {
	position: fixed;
	z-index: 20000;
	width: 100%;
	height: 100%;
	background-color: var(--wh);
	visibility: hidden;
	opacity: 0;
	transition: all .5s ease;
	transition-delay: .3s;
}
.show{
	visibility: visible !important;
	opacity: 1 !important;
}

.preloader__progress, .preloader__img{
	opacity: 0;
	transition: .3s ease;
}
.show .preloader__progress, .show .preloader__img{opacity:1}

.preloader__wrap {
	position: relative;
	width: 100%;
	height: 100%
}
.preloader__img {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	opacity: 0;
	transition: .3s ease;
}
.preloader__img svg{
	width: auto;
	height: 100%;
	-webkit-transform: translate(-50%,50%) scale(0);
	-ms-transform: translate(-50%,50%) scale(0);
	transform: translate(-50%,50%) scale(3);
	animation: preloader_svg 1.5s ease;
}
@keyframes preloader_svg {
	0% {
		-webkit-transform: translate(-50%,50%) scale(0);
		-ms-transform: translate(-50%,50%) scale(0);
		transform: translate(-50%,50%) scale(0);
	}
	100% {
		-webkit-transform: translate(-50%,50%) scale(0);
		-ms-transform: translate(-50%,50%) scale(0);
		transform: translate(-50%,50%) scale(3);
	}
}

.preloader__progress {
	position: absolute;
	bottom: 4.5rem;
	left: 5.5rem;
	z-index: 1;
	color: var(--bl);
	font-weight: 600;
	font-size: 6.25rem;
	line-height: 6.25rem;
}
@media (max-width: 989.98px) {
	.preloader__progress {
		font-size:4.5rem;
		line-height: 4.5rem;
	}
}
@media (max-width: 639.98px) {
	.preloader__progress {
		font-size: 3rem;
		line-height: 3rem
	}
}
@media (max-width: 989.98px) {
	.preloader__progress {
		bottom:8.75rem;
		left: 4.5rem
	}
}
@media (max-width: 639.98px) {
	.preloader__progress {
		bottom:5.5rem;
		left: 1.25rem
	}
}

</style>