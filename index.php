<?php
/**
 * One Page Gallery
 * ================
 * Show a gallery from all images in the current directory
 * This script only needs a json file with gallery information
 * 
 * @author Chavaillaz Johan
 * @license Apache 2.0 License
 *
 * Started from http://photoswipe.com/documentation/getting-started.html
 */

$detailsFile = 'gallery.json';
if (!file_exists($detailsFile)) {
	exit("Please create a JSON file called '".$detailsFile."' that contains gallery details.");
}

// Get gallery details (name, etc)
$gallery = json_decode(utf8_encode(file_get_contents($detailsFile)), true);

// List all images from the current folder
$listImages = glob('*.{jpg,jpeg,JPG,JPEG,png,PNG}', GLOB_BRACE);

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?= $gallery['name'] ?></title>
	
	<!-- Mobile configuration -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- Fonts -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
	
	<!-- Core CSS file -->
	<link rel="stylesheet" href="gallery/photoswipe.css"> 

	<!-- Skin CSS file (styling of UI - buttons, caption, etc.) -->
	<link rel="stylesheet" href="gallery/default-skin/default-skin.css"> 
	
	<!-- One Page Gallery CSS -->
	<link rel="stylesheet" href="gallery/gallery.css"> 

	<!--[if lt IE 9]>
	<script src="gallery/html5.js"></script>
	<![endif]-->
</head>
<body>

	<h1><?= $gallery['name'] ?></h1>
	
	<div class="one-page-gallery" itemscope itemtype="http://schema.org/ImageGallery">

	<?php
	foreach ($listImages as $image) {
		list($width, $height) = getimagesize($image);
		?>
		<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
			<a href="<?= $image ?>" itemprop="contentUrl" data-size="<?= $width ?>x<?= $height ?>">
				<img src="<?= $image ?>" itemprop="thumbnail" alt="Image" />
			</a>
			<figcaption itemprop="caption description"><?= $gallery['name'] ?></figcaption>
		</figure>
	<?php
	}
	?>
	
	</div>
	
	<!-- Root element of PhotoSwipe. Must have class pswp. -->
	<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

		<!-- Background of PhotoSwipe. 
			 It's a separate element, as animating opacity is faster than rgba(). -->
		<div class="pswp__bg"></div>

		<!-- Slides wrapper with overflow:hidden. -->
		<div class="pswp__scroll-wrap">

			<!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
			<!-- don't modify these 3 pswp__item elements, data is added later on. -->
			<div class="pswp__container">
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
			</div>

			<!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
			<div class="pswp__ui pswp__ui--hidden">

				<div class="pswp__top-bar">

					<!--  Controls are self-explanatory. Order can be changed. -->
					<div class="pswp__counter"></div>
					<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
					<button class="pswp__button pswp__button--share" title="Share"></button>
					<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
					<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

					<!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
					<!-- element will get class pswp__preloader--active when preloader is running -->
					<div class="pswp__preloader">
						<div class="pswp__preloader__icn">
							<div class="pswp__preloader__cut">
								<div class="pswp__preloader__donut"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
					<div class="pswp__share-tooltip"></div> 
				</div>

				<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
				</button>

				<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
				</button>

				<div class="pswp__caption">
					<div class="pswp__caption__center"></div>
				</div>
			</div>
		</div>
	</div>

	<!-- Core JS file -->
	<script src="gallery/photoswipe.min.js"></script> 

	<!-- UI JS file -->
	<script src="gallery/photoswipe-ui-default.min.js"></script> 
	
	<!-- One Page Gallery JS -->
	<script src="gallery/gallery.js"></script> 
	
</body>
</html>