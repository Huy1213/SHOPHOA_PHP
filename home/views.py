from django.shortcuts import render, redirect
from django.contrib import messages
from django.http import HttpResponse
from .models import SanPham, Loai, MauSac
from .forms import RegistrationForm
from django.contrib.auth import logout
from django.http import HttpResponseRedirect 


def register(request):
    form = RegistrationForm()
    if request.method == 'POST':
        form = RegistrationForm(request.POST)
        if form.is_valid():
            form.save()
            return HttpResponseRedirect('/')
    return render(request, 'page/register.html', {'form': form})

def logout_view(request):
    logout(request)
    return redirect('home')

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


def about_us(request):
    return render(request, 'page/contact_us.html')

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

def sanpham_view(request):
    sanpham_list = SanPham.objects.all().order_by('DonGia')
    return render(request, 'page/shop1.html', {'sanpham_list': sanpham_list})

def my_account(request):
    user = request.user  # Người dùng hiện đang đăng nhập
    context = {'user': user}
    if request.method == 'POST':
        # Lấy dữ liệu từ form
        first_name = request.POST.get('first_name')
        last_name = request.POST.get('last_name')
        username = request.POST.get('username')
        email = request.POST.get('email')
        
        # Cập nhật thông tin người dùng
        user = request.user
        user.first_name = first_name
        user.last_name = last_name
        user.username = username
        user.email = email
        user.save()  # Lưu thay đổi xuống cơ sở dữ liệu

        return redirect('home')  # Chuyển hướng đến trang thông tin người dùng sau khi cập nhật
    return render(request, 'page/my_account.html', context)

def update_profile(request):
    
    return render(request, 'update_profile.html')


def forgot_password(request):
    return render(request, 'page/forgot_password.html')


def product_details(request, product_id):
    sp = SanPham.objects.get(MaSP = product_id)
    data = {
        'sanpham':sp
    }
    return render(request, 'page/product_details.html',data)


    