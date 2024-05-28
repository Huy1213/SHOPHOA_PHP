from django.shortcuts import render
from django.http import HttpResponse
def home(request):
    return render(request, 'page/home.html')
# Create your views here.
def login(request):
    return render(request, 'page/login.html')

def register(request):
    return render(request, 'page/register.html')

def about_us(request):
    return render(request, 'page/contact_us.html')

def my_account(request):
    return render(request, 'page/my_account.html')

def shop(request):
    return render(request, 'page/shop.html')

def cart(request):
    return render(request, 'page/cart.html')

def checkout(request):
    return render(request, 'page/checkout.html')

def forgotpassword(request):
    return render(request, 'page/forgotpassword.html')

def product_details(request):
    return render(request, 'page/product_details.html')