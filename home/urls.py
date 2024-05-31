from django.urls import path
from . import views # call to url_shortener/views.py
urlpatterns = [
    path('', views.home, name='home'),
    path('login/', views.login, name='login'),
    path('register/', views.register, name='register'),
    path('contact_us/', views.about_us, name='contact_us'),
    path('my_account/', views.my_account, name='my_account'),
    path('shop/', views.shop, name='shop'),
    path('DSSP_Loai/<int:maloai>/',views.DSSPTheoLoai, name = 'DSSPTheoLoai'),
    path('DSSP_Mau/<int:mamau>/',views.DSSPTheoMau, name = 'DSSPTheoMau'),
    path('cart/', views.cart, name='cart'),
    path('checkout/', views.checkout, name='checkout'),
    path('forgotpassword/', views.forgotpassword, name='forgotpassword'),
     path('product_details/<int:product_id>/', views.product_details, name='product_details'),

]
