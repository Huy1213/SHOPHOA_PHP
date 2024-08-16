<?php
require_once('controller/config.php');
require_once('controller/core/controller.Class.php');
?>
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đăng nhập-Đăng ký</font></font></h3>
                        <ul>
                            <li><a href="index.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Trang chủ</font></font></a></li>
                            <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đăng nhập-Đăng ký</font></font></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Login Area Start Here -->
    <div class="login-register-area mt-no-text">
        <div class="container custom-area">
            <div class="row">           
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-custom">
                    <div class="login-register-wrapper">
                        <div class="section-content text-center mb-5">
                            <h2 class="title-4 mb-2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đăng nhập</font></font></h2>
                            <p class="desc-content"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Vui lòng đăng nhập bằng cách sử dụng chi tiết tài khoản dưới đây.</font></font></p>
                        </div>
                        <?php if(isset($_COOKIE['id']) && isset($_COOKIE['sess'])){
                        $Controller = new Controller;
                        if($Controller -> checkUserStatus($_COOKIE['id'], $_COOKIE['sess'])){
                            echo "Bạn đã đăng nhập";
                        }     
                        }else if(isset($_SESSION['iduser'])){
                            echo "Bạn đã đăng nhập";
                        }
                        else{   ?>
                        <form action="index.php?page=login" method="post">
                            <div class="single-input-item mb-3">
                                <input name="username" type="text" placeholder="Tên đăng nhập">
                            </div>
                            <div class="single-input-item mb-3">
                                <input name="password" type="password" placeholder="Nhập mật khẩu của bạn">
                            </div>
                            <div class="single-input-item mb-3">
                                <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                    <div class="remember-meta mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="rememberMe">
                                            <label class="custom-control-label" for="rememberMe"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nhớ tôi</font></font></label>
                                        </div>
                                    </div>
                                    <a href="index.php?page=quenmatkhau" class="forget-pwd mb-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Quên mật khẩu?</font></font></a>
                                </div>
                            </div>
                            <div class="single-input-item mb-3">
                                <input type="submit" name="login" class="btn flosun-button secondary-btn theme-color rounded-0" value="Đăng nhập">
                                <p class="text-danger "><?php echo $errDN ?></p>
                            </div>
                            <div class="single-input-item">
                                <a href="register.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tạo tài khoản</font></font></a>
                                <button  onclick="window.location = '<?php echo $login_url; ?>'" type="button" class="btn btn-alert-info  text-dark w-25"><img style="height: 30px;" class="img-fluid" src="view/assets/images/icon/icon_google.jpg" alt=""> </button>
                            </div>
                        </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Area End Here -->
