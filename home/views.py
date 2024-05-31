from django.shortcuts import render
from django.http import HttpResponse
from .models import SanPham, Loai, MauSac
def home(request):
    data={
            'item_sanpham': SanPham.objects.all(),
            'item_loai': Loai.objects.all(),
    }
    return render(request, 'page/home.html',data)
def DSSPTheoLoai(request, maloai):
  
    dssp = SanPham.objects.filter(MaLoai = maloai)
    data = {
        
        'dm_sanpham': dssp,
        'item_sanpham': SanPham.objects.all(),
        'item_loai': Loai.objects.all(),
    }
    return render(request, 'page/shop1.html', data)
def DSSPTheoMau(request, mamau):
  
    dssp = SanPham.objects.filter(MaMau = mamau)
    data = {
        
        'dm_sanpham': dssp,
        'item_sanpham': SanPham.objects.all(),
        'item_loai': Loai.objects.all(),
    }
    return render(request, 'page/shop2.html', data)
def login(request):
    return render(request, 'page/login.html')

def register(request):
    return render(request, 'page/register.html')

def about_us(request):
    return render(request, 'page/contact_us.html')

def my_account(request):
    return render(request, 'page/my_account.html')

def shop(request):
    data={
            'item_sanpham': SanPham.objects.all(),
            'item_loai': Loai.objects.all(),
            'item_mausac': MauSac.objects.all(),
    }
    return render(request, 'page/shop.html',data)

def cart(request):
    return render(request, 'page/cart.html')

def checkout(request):
    return render(request, 'page/checkout.html')

def forgotpassword(request):
    return render(request, 'page/forgotpassword.html')

def product_details(request):
    return render(request, 'page/product_details.html')