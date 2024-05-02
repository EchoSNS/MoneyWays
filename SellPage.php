<!DOCTYPE html>
<html lang="en">
<head>
	<title>Money Ways - Sell</title>
<?php
	require_once(__DIR__ . '/cpanel/config/db.php');
	require_once("layout/header.php");
	if($_GET['category'] > 0){
		$category->getCurrentCategoryActiveBuy($_GET['category']);
	}
?>

	<!-- Title Page -->
	<section class="bg-title-page" style="background-color: #CCCCCC;background-image: url(images/cover_img/background-no-mountains-bottom.jpg);">
		<div class="sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
			<span class=" m-text15 t-center m-b-15">
				"Not All Waste To Us Are Waste To Others"
			</span>

			<h2 class="xl-text3 t-center m-b-37">
				Sell Scraps From Different Users, Shops, Company, and Manufacturers
			</h2>

			<div class="w-size1">
				<!-- Button -->
				<a href="#sellnow" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
					Sell Now
				</a>
			</div>
		</div>
	</section>


	<!-- Content page -->
	<section id="sellnow" class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">
						<!--  -->
						<h4 class="m-text14 p-b-7">
							Categories
						</h4>

						<ul class="p-b-54">
							<li class="p-t-4">
							<a href="?category=0" class="s-text13
								<?php
								if( isset($_GET['category']) && (int)$_GET['category'] > 0){
									echo "";
								}
								else{
									echo "active1";
								}

								?> 
									">All
								</a>
							</li>
							<?php echo $category->GetAllCategory(); ?>
						</ul>

						<div class="search-product pos-relative bo4 of-hidden">
							<input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" placeholder="Search Products...">

							<button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
								<i class="fs-12 fa fa-search" aria-hidden="true"></i>
							</button>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!--  -->
					<div class="p-b-35">
						<h2 class="l-text14 t-center m-b-37">
							No Verified Seller
						</h2>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="blog bg5 p-t-94 p-b-65">
		<div class="container">
			<div class="sec-title p-b-52">
				<h3 class="m-text5 t-center">
					Details
				</h3>
			</div>

			<div class="row">
				<div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
					<!-- Block3 -->
					<div class="block3">
						<div class="block3-img dis-block hov-img-zoom">
							<img src="images/blog-01.jpg" alt="IMG-BLOG">
						</div>

						<div class="block3-txt p-t-14 t-center">
							<h4 class="p-b-7 m-text11">
								Top Sell Offers
							</h4>

							<p class="s-text8 p-t-16">
								Duis ut velit gravida nibh bibendum commodo. Sus-pendisse pellentesque mattis augue id euismod. Inter-dum et malesuada fames
							</p>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
					<!-- Block3 -->
					<div class="block3">
						<div class="block3-img dis-block hov-img-zoom">
							<img src="images/blog-02.jpg" alt="IMG-BLOG">
						</div>

						<div class="block3-txt p-t-14 t-center">
							<h4 class="p-b-7 m-text11">
								Most Buy Scraps
							</h4>

							<p class="s-text8 p-t-16">
								Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit ame
							</p>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
					<!-- Block3 -->
					<div class="block3">
						<div class="block3-img dis-block hov-img-zoom">
							<img src="images/blog-03.jpg" alt="IMG-BLOG">
						</div>

						<div class="block3-txt p-t-14 t-center">
							<h4 class="p-b-7 m-text11">
								Most Profittable Scraps
							</h4>

							<p class="s-text8 p-t-16">
								Proin nec vehicula lorem, a efficitur ex. Nam vehicula nulla vel erat tincidunt, sed hendrerit ligula porttitor. Fusce sit amet maximus nunc
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php
	require_once("layout/footer_white.php");
?>