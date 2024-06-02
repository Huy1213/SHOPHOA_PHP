from django import forms
import re
from django.contrib.auth.models import User
from .models import KhachHang
class RegistrationForm(forms.Form):
    username = forms.CharField(label='Tài khoản', max_length=30)
    email = forms.EmailField(label='Email')
    first_name = forms.CharField(label='Tên', max_length=30)
    last_name = forms.CharField(label='Họ', max_length=30)
    password1 = forms.CharField(label='Mật khẩu', widget=forms.PasswordInput())
    password2 = forms.CharField(label='Nhập lại mật khẩu', widget=forms.PasswordInput())

    def clean_password2(self):
        if 'password1' in self.cleaned_data:
            password1 = self.cleaned_data['password1']
            password2 = self.cleaned_data['password2']

            if len(password1) < 8:
                raise forms.ValidationError("Mật khẩu phải có ít nhất 8 ký tự")
            
            if not re.search(r'\d', password1):
                raise forms.ValidationError("Mật khẩu phải chứa ít nhất một số")
            
            if password1 == password2 and password1:
                return password2
        
        raise forms.ValidationError("Mật khẩu không hợp lệ")

    def clean_username(self):
        username = self.cleaned_data['username']
        if not re.search(r'^\w+$', username):
            raise forms.ValidationError("Tên tài khoản có kí tự đặc biệt")
        if User.objects.filter(username=username).exists():
            raise forms.ValidationError("Tài khoản đã tồn tại")
        return username

    def clean_email(self):
        email = self.cleaned_data['email']
        if User.objects.filter(email=email).exists():
            raise forms.ValidationError("Email đã tồn tại")
        return email

    def save(self):
        User.objects.create_user(
            username=self.cleaned_data['username'], 
            email=self.cleaned_data['email'], 
            password=self.cleaned_data['password1'],
            first_name=self.cleaned_data['first_name'],
            last_name=self.cleaned_data['last_name']
        )
class ThongTinKhachHang(forms.ModelForm):
    class Meta:
        model = KhachHang
        fields=['TenKH','DiaChi','DienThoai']
        widgets={
            'TenKH':forms.TextInput(attrs={'class':'form-control'}),
            'DiaChi':forms.TextInput(attrs={'class':'form-control'}),
            'DienThoai':forms.TextInput(attrs={'class':'form-control'}),
        }
  