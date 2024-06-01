from django.urls import path
from django.contrib.auth import views as auth_views
from . import views # call to url_shortener/views.py
urlpatterns = [
    path('', views.home, name='home'),
    path('login/',auth_views.LoginView.as_view(template_name="page/login.html"), name="login"),
    path('sanpham/', views.sanpham_view, name='sanpham'),
    path('logout/', views.logout_view, name='logout'),
    path('register/', views.register, name='register'),
    path('contact_us/', views.about_us, name='contact_us'),
    path('my_account/', views.my_account, name='my_account'),
    path('shop/', views.shop, name='shop'),
    path('DSSP_Loai/<int:maloai>/',views.DSSPTheoLoai, name = 'DSSPTheoLoai'),
    path('DSSP_Mau/<int:mamau>/',views.DSSPTheoMau, name = 'DSSPTheoMau'),
    path('cart/', views.cart, name='cart'),
    path('checkout/', views.checkout, name='checkout'),
    path('forgot_password/', views.forgot_password, name='forgot_password'),
    path('product_details/<int:product_id>/', views.product_details, name='product_details'),

]
