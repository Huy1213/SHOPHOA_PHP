from django.shortcuts import render, redirect
from django.contrib import messages
from django.http import HttpResponse
from .models import SanPham, Loai, MauSac,KhachHang,Cart,Order,Diachi
from .forms import RegistrationForm, ThongTinKhachHang
from django.contrib.auth import logout
from django.contrib.auth.models import User
from django.http import HttpResponseRedirect 
from django.views import View
from django.http import JsonResponse
from django.views.decorators.csrf import csrf_exempt
import json

from django.template.loader import render_to_string

from django.contrib.sites.shortcuts import get_current_site
from django.utils.http import urlsafe_base64_encode, urlsafe_base64_decode
from django.utils.encoding import force_bytes, force_str
from django.core.mail import EmailMessage


from .tokens import account_activation_token


def activate(request, uidb64, token):
    try:
        uid = force_str(urlsafe_base64_decode(uidb64))
        user = User.objects.get(pk=uid)
    except (TypeError, ValueError, OverflowError, User.DoesNotExist):
        user = None

    if user is not None and account_activation_token.check_token(user, token):
        user.is_active = True
        user.save()
        messages.success(request, f'Tài khoản {user.username} đã được kích hoạt')
        return redirect('login')
    else:
        messages.error(request, 'Lỗi kích hoạt tài khoản')
        return redirect('register')

def activateEmail(request, user, to_email):
    mail_subject = "Xác minh Email"
    message = render_to_string('page/activate_email.html', {
        'user': user,
        'domain': get_current_site(request).domain,
        'uid': urlsafe_base64_encode(force_bytes(user.pk)),
        'token': account_activation_token.make_token(user),
        'protocol': 'https' if request.is_secure() else 'http'
    })

    email = EmailMessage(mail_subject, message, to=[to_email])
    if email.send():
        messages.success(request, f'Gửi  {user.username}, please go to your email {to_email}')
    else:
        messages.error(request, f'Lỗi gửi tới {to_email}')

def register(request):
    if request.method == 'POST':
        form = RegistrationForm(request.POST)
        if form.is_valid():
            user = form.save(commit=False)
            user.is_active = False
            user.save()
            activateEmail(request, user, form.cleaned_data.get('email'))

            duong = request.POST.get('duong')
            tinh = request.POST.get('hidden_tinh')
            quan = request.POST.get('hidden_quan')
            phuong = request.POST.get('hidden_phuong')

            Diachi.objects.create(
                username=user,
                Duong=duong,
                Tinh=tinh,
                Quan=quan,
                Phuong=phuong
            )
            return redirect('register')
    else:
        form = RegistrationForm()
    return render(request, 'page/register.html', {'form': form})

@csrf_exempt
def update_cart(request):
    if request.method == 'POST' and request.is_ajax():
        try:
            data = json.loads(request.POST.get('quantities'))
            for quantity_data in data:
                item_id = quantity_data['item_id']
                quantity = quantity_data['quantity']
                cart_item = Cart.objects.get(id=item_id)
                cart_item.soluong = quantity
                cart_item.save()

            # Recalculate the total amount
            user = request.user
            cart = Cart.objects.filter(user=user)
            total_price = sum(item.tong_tien for item in cart)

            # Return the new total amount in the response
            return JsonResponse({'total_amount': total_price})
        except Exception as e:
            return JsonResponse({'error': str(e)}, status=500)

    # Handle invalid requests
    return JsonResponse({'error': 'Invalid request'}, status=400)

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
    add = KhachHang.objects.filter(user=request.user)
    cart = Cart.objects.filter(user = request.user)
    total_price = sum(item.tong_tien for item in cart)
    return render(request, 'page/checkout.html',{'cart': cart, 'tong': total_price,'add':add})

def sanpham_view(request):
    sanpham_list = SanPham.objects.all().order_by('DonGia')
    return render(request, 'page/shop1.html', {'sanpham_list': sanpham_list})


from django.shortcuts import render, redirect
from django.contrib import messages
from .models import Diachi, KhachHang
from .forms import ThongTinKhachHang

def my_account(request):
    user = request.user  # Người dùng hiện đang đăng nhập
    
    # Fetch or initialize the address
    try:
        diachi = Diachi.objects.get(username=user)
    except Diachi.DoesNotExist:
        diachi = None
    
    # Initialize the context
    context = {
        'user': user,
        'diachi': diachi
    }
    
    if request.method == 'POST':
        # Handle the user information update
        first_name = request.POST.get('first_name')
        last_name = request.POST.get('last_name')
        username = request.POST.get('username')
        email = request.POST.get('email')
        
        # Handle the address information update
        duong = request.POST.get('duong')
        tinh = request.POST.get('tinh')
        quan = request.POST.get('quan')
        phuong = request.POST.get('phuong')
        
        # Update user information
        user.first_name = first_name
        user.last_name = last_name
        user.username = username
        user.email = email
        user.save()
        
        # Update or create address information
        if diachi:
            diachi.Duong = duong
            diachi.Tinh = tinh
            diachi.Quan = quan
            diachi.Phuong = phuong
        else:
            diachi = Diachi(username=user, Duong=duong, Tinh=tinh, Quan=quan, Phuong=phuong)
        
        diachi.save()
        
        # Handle the customer information update
        form = ThongTinKhachHang(request.POST)
        if form.is_valid():
            TenKH = form.cleaned_data['TenKH']
            DiaChi = form.cleaned_data['DiaChi']
            DienThoai = form.cleaned_data['DienThoai']

            KhachHang.objects.create(user=user, TenKH=TenKH, DiaChi=DiaChi, DienThoai=DienThoai)
            messages.success(request, "Thêm thông tin thành công")
            return redirect('home')
        else:
            messages.warning(request, "Không có giá trị dữ liệu")
        
    else:
        form = ThongTinKhachHang()
    
    context['form'] = form
    
    return render(request, 'page/my_account.html', context)

   
def address(request):
    add = KhachHang.objects.filter(user=request.user)
    return render(request,'page/address.html',locals())
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


def add_to_cart(request):
    user = request.user
    product_id = request.GET.get('prod_id')
    sanpham = SanPham.objects.get(MaSP=product_id)
    
    # Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng hay chưa
    existing_cart_item = Cart.objects.filter(user=user, sanpham=sanpham).first()

    if existing_cart_item:
        # Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
        existing_cart_item.soluong += 1
        existing_cart_item.save()
    else:
        # Nếu sản phẩm chưa có trong giỏ hàng, tạo một mục mới
        Cart(user=user, sanpham=sanpham).save()

    return redirect("/cart")
def show_cart(request):
    user = request.user
    cart = Cart.objects.filter(user = user)
    total_price = sum(item.tong_tien for item in cart)
    return render(request,'page/addtocart.html',{'cart': cart, 'tong': total_price})
def thanhtoanthanhcong(request):
    user = request.user
    cust_id=request.GET.get('custid')
    khachhang = KhachHang.objects.get(id = cust_id )
    cart = Cart.objects.filter(user=request.user)
    for c in cart:
        Order(user = user,khachhang = khachhang, sanpham = c.sanpham, soluong = c.soluong).save()
        c.delete()
    return redirect("/thankyou/")
