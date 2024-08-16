<?php 
    $masp = $sanpham[0]['MaSP']; 
    
    // Lấy mã hình từ sản phẩm
    $hinhanh = get_HinhAnh($masp);

    $DSHA = get_AllHinhAnh($masp);
?>

<div class="breadcrumbs-area position-relative">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="breadcrumb-content position-relative section-content">
                    <h3 class="title-3">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Thông tin chi tiết sản phẩm</font>
                        </font>
                    </h3>
                    <ul>
                        <li><a href="index.html">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Trang chủ</font>
                                </font>
                            </a></li>
                        <li>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Thông tin chi tiết sản phẩm</font>
                            </font>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="single-product-main-area">
    <div class="container container-default custom-area">
        <form id="cart-form" action="index.php?page=addcart" method="post">
            <div class="row">
                <div class="col-lg-5 offset-lg-0 col-md-8 offset-md-2 col-custom">
                    <div class="product-details-img">
                        <div class="single-product-img swiper-container gallery-top popup-gallery swiper-container-initialized swiper-container-horizontal">
                            <div class="swiper-wrapper" id="swiper-wrapper-10e5ca85ba4a0a182" aria-live="polite" style="transform: translate3d(0px, 0px, 0px);">
                                <div class="swiper-slide swiper-slide-active" role="group" aria-label="1/6" style="width: 470px; margin-right: 10px;">
                                    <a class="w-100" href="view/assets/images/product/large-size/1.jpg">
                                        <img class="w-100" src="view/assets/images/product/<?php echo $sanpham[0]['HinhAnh']?>" alt="Sản phẩm">
                                    </a>
                                </div>
                            </div>

                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                        </div>

                    </div>
                </div>
                <div class="col-lg-7 col-custom">
                    <div class="product-summery position-relative">
                        <div class="product-head mb-3">
                            <h2 class="product-title">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;"><?=$sanpham[0]['TenSP']  ?></font>
                                </font>
                            </h2>
                        </div>
                        <div class="price-box mb-2">
                            <span class="regular-price">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                    <?php
                                         $formattedValue = number_format($sanpham[0]['DonGia'], 0, ',', '.') . ' VNĐ';
                                         echo $formattedValue;
                                    ?></font>
                                </font>
                            </span>   
                        </div>
                        <div class="product-rating mb-3">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <div class="sku mb-3">
                            <span>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Tình trạng: <span class="text-danger ">
                                        <?php 
                                            if( $sanpham[0]['SoLuong'] <=0)
                                                echo 'Hết hàng';
                                            else
                                                echo 'Còn hàng';
                                        ?></span>
                                      </font>
                                </font>
                            </span>
                        </div>
                        <p class="desc-content mb-5">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;"><?php echo $sanpham[0]['MoTa'] ?></font>
                            </font>
                        </p>
                        <div class="quantity-with_btn mb-5">                      
                                <div class="quantity">
                                    <div class="cart-plus-minus">
                                        <input name="soluong" id="soluong" class="cart-plus-minus-box" value="1" type="text" min="1">
                                        <div class="dec qtybutton">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">-</font>
                                            </font>
                                        </div>
                                        <div class="inc qtybutton">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">+</font>
                                            </font>
                                        </div>
                                        
                                        <div class="dec qtybutton"><i class="fa fa-minus"></i></div>
                                        <div class="inc qtybutton"><i class="fa fa-plus"></i></div>
                                    </div>            
                                </div> 
                                                          
                                <div class="add-to_cart">
                                    <input class="btn product-cart button-icon flosun-button dark-btn" name="addtocart" type="submit" value="Thêm vào giỏ hàng" <?php if($sanpham[0]['SoLuong']<=0) echo 'disabled'  ?>>                             
                                    <input type="hidden" value="<?=$sanpham[0]['MaSP']  ?>" name="id">
                                    <input type="hidden" value="<?=$sanpham[0]['TenSP']  ?>" name="tensp">
                                    <input type="hidden" value="<?=$sanpham[0]['HinhAnh']  ?>" name="img">
                                    <input type="hidden" value="<?=$sanpham[0]['DonGia']  ?>" name="gia">
                                    <input type="hidden" id="availableStock" value="<?=$sanpham[0]['SoLuong']?>" name="availableStock">
                                </div>                             
                        </div>
                        <!-- <div class="social-share mb-4">
                            <span>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Chia sẻ :</font>
                                </font>
                            </span>
                            <a href="#"><i class="fa fa-facebook-square facebook-color"></i></a>
                            <a href="#"><i class="fa fa-twitter-square twitter-color"></i></a>
                            <a href="#"><i class="fa fa-linkedin-square linkedin-color"></i></a>
                            <a href="#"><i class="fa fa-pinterest-square pinterest-color"></i></a>
                        </div>
                        <div class="payment">
                            <a href="#"><img class="border" src="view/assets/images/payment/payment-icon.png" alt="Sự chi trả"></a>
                        </div> -->
                    </div>
                </div>
            </div>
        </form>
        <script>
            document.getElementById('cart-form').addEventListener('submit', function(event) {
                var quantity = document.getElementById('soluong').value;
                var availableStock = parseInt(document.getElementById('availableStock').value, 10);
                if (quantity < 1) {
                    alert('Số lượng phải lớn hơn hoặc bằng 1');
                    event.preventDefault();
                }
                else if (quantity > availableStock) {
                    alert('Số lượng nhập vượt quá số lượng sản phẩm hiện có.');
                    event.preventDefault();
                }
            });
        </script>
        <div class="row">
            <div class="single-product-thumb swiper-container gallery-thumbs swiper-container-initialized swiper-container-horizontal swiper-container-free-mode swiper-container-thumbs">
                <div class="swiper-wrapper" id="swiper-wrapper-8ad10ade1069f2bc108" aria-live="polite" style="transform: translate3d(0px, 0px, 0px);">
                    <?php foreach($DSHA as $ha) {?>
                    <div class="swiper-slide swiper-slide-visible swiper-slide-active swiper-slide-thumb-active" role="group" aria-label="1/6" style="width: 110px; margin-right: 10px;">
                        <img src="view/assets/images/product/<?php echo $ha['TenHinh'] ?>" alt="Sản phẩm">
                    </div>                  
                    <?php } ?>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next swiper-button-white" tabindex="0" role="button" aria-label="Trang trình bày tiếp theo" aria-controls="swiper-wrapper-10e5ca85ba4a0a182" aria-disabled="false"><i class="lnr lnr-arrow-right"></i></div>
                <div class="swiper-button-prev swiper-button-white swiper-button-disabled" tabindex="-1" role="button" aria-label="Slide trước" aria-controls="swiper-wrapper-10e5ca85ba4a0a182" aria-disabled="true"><i class="lnr lnr-arrow-left"></i></div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
        </div>
        <div class="row mt-no-text">
            <div class="col-lg-12 col-custom">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active text-uppercase" id="home-tab" data-bs-toggle="tab" href="#connect-1" role="tab" aria-selected="true">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Sự miêu tả</font>
                            </font>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-uppercase" id="profile-tab" data-bs-toggle="tab" href="#connect-2" role="tab" aria-selected="false" tabindex="-1">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Đánh giá</font>
                            </font>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-uppercase" id="contact-tab" data-bs-toggle="tab" href="#connect-3" role="tab" aria-selected="false" tabindex="-1">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">chính sách vận chuyển</font>
                            </font>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-uppercase" id="review-tab" data-bs-toggle="tab" href="#connect-4" role="tab" aria-selected="false" tabindex="-1">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Biểu đồ kích thước</font>
                            </font>
                        </a>
                    </li>
                </ul>
                <div class="tab-content mb-text" id="myTabContent">
                    <div class="tab-pane fade show active" id="connect-1" role="tabpanel" aria-labelledby="home-tab">
                        <div class="desc-content">
                            <p class="mb-3">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Mặt khác, chúng tôi tố cáo với sự phẫn nộ chính đáng và không thích những người bị mê hoặc và mất tinh thần bởi sự quyến rũ của thú vui nhất thời, mù quáng bởi ham muốn đến mức họ không thể thấy trước nỗi đau và rắc rối sắp xảy ra sau đó; và sự đổ lỗi tương đương thuộc về những người thất bại trong nhiệm vụ của mình do yếu kém về ý chí, điều này cũng giống như nói rằng do chùn bước trước sự vất vả và đau đớn. Những trường hợp này là hoàn toàn đơn giản và dễ dàng để phân biệt. Trong giờ phút rảnh rỗi, khi khả năng lựa chọn của chúng ta không bị cản trở và khi không có gì ngăn cản chúng ta có thể làm điều mình thích nhất, thì mọi niềm vui đều được đón nhận và mọi nỗi đau đều có thể tránh được. Nhưng trong một số trường hợp nhất định và do các yêu cầu về nghĩa vụ hoặc nghĩa vụ kinh doanh, thường xảy ra trường hợp niềm vui phải bị từ chối và những khó chịu phải chấp nhận. Do đó, người khôn ngoan luôn tuân theo nguyên tắc lựa chọn này trong những vấn đề này: anh ta từ chối những thú vui để đảm bảo những thú vui khác lớn hơn, hoặc nếu không thì anh ta chịu đựng nỗi đau để tránh những nỗi đau tồi tệ hơn.</font>
                                </font>
                            </p>
                           
                        </div>
                    </div>
                    <div class="tab-pane fade" id="connect-2" role="tabpanel" aria-labelledby="profile-tab">
                        <!-- Start Single Content -->
                        <div class="product_tab_content  border p-3">
                            <div class="review_address_inner">
                                <!-- Start Single Review -->
                                <div class="pro_review mb-5">
                                    <div class="review_thumb">
                                        <img alt="xem lại hình ảnh" src="view/assets/images/review/1.jpg">
                                    </div>
                                    <div class="review_details">
                                        <div class="review_info mb-2">
                                            <div class="product-rating mb-2">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <h5>
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Quản trị viên - </font>
                                                </font><span>
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">19 tháng 12 năm 2022</font>
                                                    </font>
                                                </span>
                                            </h5>
                                        </div>
                                        <p>
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin in viverra ex, vitae vestibulum arcu. Duis sollicitudin metus sed lorem commodo, eu dapibus libero interdum. Morbi convallis viverra erat, et aliquet orci congue vel. Số nguyên trong odio enim. Pellentesque trong dignissim leo. Vivamus varius ex sit amet quam tincidunt iaculis.</font>
                                            </font>
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Review -->
                            </div>
                            <!-- Start RAting Area -->
                            <div class="rating_wrap">
                                <h5 class="rating-title-1 font-weight-bold mb-2">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Thêm một bài đánh giá</font>
                                    </font>
                                </h5>
                                <p class="mb-2">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Địa chỉ email của bạn sẽ không được công bố. Các trường bắt buộc được đánh dấu *</font>
                                    </font>
                                </p>
                                <h6 class="rating-title-2 mb-2">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Đánh giá của bạn</font>
                                    </font>
                                </h6>
                                <div class="rating_list mb-4">
                                    <div class="review_info">
                                        <div class="product-rating mb-3">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End RAting Area -->
                            <div class="comments-area comments-reply-area">
                                <div class="row">
                                    <div class="col-lg-12 col-custom">
                                        <form action="#" class="comment-form-area">
                                            <div class="row comment-input">
                                                <div class="col-md-6 col-custom comment-form-author mb-3">
                                                    <label>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">Tên </font>
                                                        </font><span class="required">
                                                            <font style="vertical-align: inherit;">
                                                                <font style="vertical-align: inherit;">*</font>
                                                            </font>
                                                        </span>
                                                    </label>
                                                    <input type="text" required="required" name="Name">
                                                </div>
                                                <div class="col-md-6 col-custom comment-form-emai mb-3">
                                                    <label>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">Email </font>
                                                        </font><span class="required">
                                                            <font style="vertical-align: inherit;">
                                                                <font style="vertical-align: inherit;">*</font>
                                                            </font>
                                                        </span>
                                                    </label>
                                                    <input type="text" required="required" name="email">
                                                </div>
                                            </div>
                                            <div class="comment-form-comment mb-3">
                                                <label>
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Bình luận</font>
                                                    </font>
                                                </label>
                                                <textarea class="comment-notes" required="required"></textarea>
                                            </div>
                                            <div class="comment-form-submit">
                                                <button class="btn flosun-button secondary-btn rounded-0">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Nộp</font>
                                                    </font>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Content -->
                    </div>
                    <div class="tab-pane fade" id="connect-3" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="shipping-policy">
                            <h4 class="title-3 mb-4">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Chính sách vận chuyển của cửa hàng chúng tôi</font>
                                </font>
                            </h4>
                            <p class="desc-content mb-2">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate</p>
                            <ul class="policy-list mb-2">
                                <li>1-2 business days (Typically by end of day)</li>
                                <li><a href="#">30 days money back guaranty</a></li>
                                <li>24/7 live support</li>
                                <li>odio dignissim qui blandit praesent</li>
                                <li>luptatum zzril delenit augue duis dolore</li>
                                <li>te feugait nulla facilisi.</li>
                            </ul>
                            <p class="desc-content mb-2">Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum</p>
                            <p class="desc-content mb-2">claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per</p>
                            <p class="desc-content mb-2">seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="connect-4" role="tabpanel" aria-labelledby="review-tab">
                        <div class="size-tab table-responsive-lg">
                            <h4 class="title-3 mb-4">Size Chart</h4>
                            <table class="table border">
                                <tbody>
                                    <tr>
                                        <td class="cun-name"><span>UK</span></td>
                                        <td>18</td>
                                        <td>20</td>
                                        <td>22</td>
                                        <td>24</td>
                                        <td>26</td>
                                    </tr>
                                    <tr>
                                        <td class="cun-name"><span>European</span></td>
                                        <td>46</td>
                                        <td>48</td>
                                        <td>50</td>
                                        <td>52</td>
                                        <td>54</td>
                                    </tr>
                                    <tr>
                                        <td class="cun-name"><span>usa</span></td>
                                        <td>14</td>
                                        <td>16</td>
                                        <td>18</td>
                                        <td>20</td>
                                        <td>22</td>
                                    </tr>
                                    <tr>
                                        <td class="cun-name"><span>Australia</span></td>
                                        <td>28</td>
                                        <td>10</td>
                                        <td>12</td>
                                        <td>14</td>
                                        <td>16</td>
                                    </tr>
                                    <tr>
                                        <td class="cun-name"><span>Canada</span></td>
                                        <td>24</td>
                                        <td>18</td>
                                        <td>14</td>
                                        <td>42</td>
                                        <td>36</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-area mt-text-2">
        <div class="container custom-area-2 overflow-hidden">
            <div class="row">
                <!--Section Title Start-->
                <div class="col-12 col-custom">
                    <div class="section-title text-center mb-30">
                        <span class="section-title-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Món quà tuyệt vời</font></font></span>
                        <h3 class="section-title-3"style="font-family:'Times New Roman', Times, serif">Sản phẩm nổi bật</font></></h3>
                    </div>
                </div>
                <!--Section Title End-->
            </div>
            <div class="row product-row">
                <div class="col-12 col-custom">
                    <div class="product-slider swiper-container anime-element-multi swiper-container-initialized swiper-container-horizontal">
                        <div class="swiper-wrapper" id="swiper-wrapper-ae98ae85adbf2377" aria-live="polite" style="transform: translate3d(0px, 0px, 0px);">
                            <?php foreach($SP as $sp) {?>
                            <div class="single-item swiper-slide swiper-slide-active" role="group" aria-label="1/6" style="width: 235.333px; margin-right: 10px;">
                                <!--Single Product Start-->                            
                                <div class="single-product position-relative mb-30">
                                    <div class="product-image">
                                        <a class="d-block" href="index.php?page=chitietsanpham&id=<?php echo $sp['MaSP']; ?>">
                                            <img src="view/assets/images/product/<?php echo $sp["HinhAnh"] ?>" alt="" class="product-image-1 w-100">
                                            <img src="view/assets/images/product/<?php echo $sp["HinhAnh"] ?>" alt="" class="product-image-2 position-absolute w-100">
                                        </a>
                                        <span class="onsale"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Doanh thu!</font></font></span>
                                        <div class="add-action d-flex flex-column position-absolute">
                                            <a href="compare.php" title="So sánh">
                                                <i class="lnr lnr-sync" data-toggle="tooltip" data-placement="left" aria-label="So sánh" data-bs-original-title="Compare"></i>
                                            </a>
                                            <a href="wishlist.php" title="Thêm vào danh sách yêu thích">
                                                <i class="lnr lnr-heart" data-toggle="tooltip" data-placement="left" aria-label="Danh sách yêu thích" data-bs-original-title="Wishlist"></i>
                                            </a>
                                            <a href="#exampleModalCenter" title="Xem lướt qua" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                                <i class="lnr lnr-eye" data-toggle="tooltip" data-placement="left" aria-label="Xem lướt qua" data-bs-original-title="Quick View"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-title">
                                            <h4 class="title-2"> <a href="product-details.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $sp["TenSP"] ?></font></font></a></h4>
                                        </div>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="price-box">
                                            <span class="regular-price "><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $sp["DonGia"] ?></font></font></span>
                                            <span class="old-price"><del><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">$100</font></font></del></span>
                                        </div>
                                        <a href="cart.php" class="btn product-cart"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thêm vào giỏ hàng</font></font></a>
                                    </div>
                                </div>
                             
                                <!--Single Product End-->
                                
                               
                            </div>    
                            <?php }?>                  
                        </div>
                        <!-- Slider pagination -->
                       
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                </div>
            </div>
        </div>
    </div>