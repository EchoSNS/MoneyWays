<!DOCTYPE html>
<html lang="en">
<head>
	<title>Product Detail</title>
<?php
	require_once(__DIR__ . '/cpanel/config/db.php');
	require_once("layout/header.php");

	if(isset($_POST["submit"])){
		$cart->addProductToCart($_GET['id'], $_POST['numProduct'], $_SESSION['user_id']);
		echo '<script language="javascript">';
		echo 'alert("Product successfully added to cart!")';
		echo '</script>';
	}
?>

	<!-- breadcrumb -->
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="index.php" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<?php
			$product->getProductCategorybyProductID($_GET['id']);
		?>

		<span class="s-text17">
			<?php
				echo $product->GetProductName($_GET['id']);
			?>
		</span>
	</div>

	<!-- Product Detail -->
	<div class="container bgwhite p-t-35 p-b-80">
		<div class="flex-w flex-sb">
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>

					<div class="slick3">
						<div class="item-slick3" data-thumb="images/thumb-item-01.jpg">
							<div class="wrap-pic-w">
								<img src="images/product-detail-01.jpg" alt="IMG-PRODUCT">
							</div>
						</div>

						<div class="item-slick3" data-thumb="images/thumb-item-02.jpg">
							<div class="wrap-pic-w">
								<img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">
							</div>
						</div>

						<div class="item-slick3" data-thumb="images/thumb-item-03.jpg">
							<div class="wrap-pic-w">
								<img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="w-size14 p-t-30 respon5">
				<h4 class="product-detail-name m-text16 p-b-13">
					<?php
						echo $product->GetProductName($_GET['id']);
					?>
				</h4>

				<span class="m-text17">
					<?php
						echo "$" . $product->GetProductPrice($_GET['id']);
					?>
				</span>

				<p class="s-text8 p-t-10">
					<?php
						echo $product->GetProductDescription($_GET['id']);
					?>
				</p>

				<!--  -->
				<div class="p-t-33 p-b-60">

					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w">
							<form method="post" accept-charset="UTF-8" style="display: -webkit-box;">
								<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
										<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
											<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
										</button>
										<input class="size8 m-text18 t-center num-product" type="number" name="numProduct" value="1">

										<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
											<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
										</button>
								</div>

								<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
									<!-- Button -->
									<button name="submit" type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
										Add to Cart
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="p-b-45">
					<span class="s-text8">Categories:
						<?php
							$product->GetProductCategoryName($_GET['id']);
						?>
					</span>
				</div>
			</div>
		</div>
	</div>


	<!-- Relate Product -->
	<section class="relateproduct bgwhite p-t-45 p-b-138">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					Related Products
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">

					<?php
						$product->GetRelatedProduct($_GET['id']);
					?>
				</div>
			</div>

		</div>
	</section>


<?php
	require_once('layout/footer_gray.php');
?>
